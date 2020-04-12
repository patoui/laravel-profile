<?php

namespace App\Http\Controllers;

use App\Covid19;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;
use Regression\RegressionFactory;

class Covid19Controller
{
    private array $confirmed = [];
    private array $deaths    = [];
    private array $recovered = [];

    private array $confirmed_filtered = [];
    private array $deaths_filtered    = [];
    private array $recovered_filtered = [];

    private bool $is_show_confirmed;
    private bool $is_show_deaths;
    private bool $is_show_recovered;
    private bool $is_show_regression;

    private Covid19 $covid_19;

    public function __construct(Covid19 $covid_19)
    {
        $this->covid_19 = $covid_19;
    }

    public function index(Request $request): View
    {
        if (strpos((string) $request->getClientIp(), '24.53.251.') === false) {
            Redis::incr('covid19_views');
        }
        $from = $request->input('from', date('Y-m-d', strtotime('-10 days')));
        $to = $request->input('to', date('Y-m-d'));

        $is_show_confirmed = $request->input('is_show_confirmed', '1');
        $is_show_deaths = $request->input('is_show_deaths', '1');
        $is_show_recovered = $request->input('is_show_recovered');
        $is_show_regression = $request->input('is_show_regression');
        $not_enough_data = false;

        $c_from = Carbon::parse($from);
        $c_to = Carbon::parse($to);

        if ($is_show_regression && $c_from->diffInDays($c_to) < 7) {
            $is_show_regression = false;
            $not_enough_data = true;
        }

        $this->is_show_confirmed = (bool) $is_show_confirmed;
        $this->is_show_deaths = (bool) $is_show_deaths;
        $this->is_show_recovered = (bool) $is_show_recovered;
        $this->is_show_regression = (bool) $is_show_regression;

        $countries = $this->covid_19->getCountries();
        usort($countries, fn($a, $b) => strcmp($a['Slug'], $b['Slug']));

        $country_slugs = $request->input('country_slugs', ['canada']);
        $country_label = $this->getCountryLabels($country_slugs);

        $table_data = $this->getTableData($country_slugs, $c_from, $c_to);
        $graph_data = $this->getGraphData($country_slugs, $c_from, $c_to);
        $bar_data = $this->getBarData($country_slugs, $c_from, $c_to);

        return view('covid19.index')
            ->with('country_slugs', $country_slugs)
            ->with('from', $from)
            ->with('to', $to)
            ->with('is_show_table', $request->input('is_show_table'))
            ->with('is_show_graph', $request->input('is_show_graph', '1'))
            ->with('is_show_bar', $request->input('is_show_bar', '1'))
            ->with('is_show_confirmed', $is_show_confirmed)
            ->with('is_show_deaths', $is_show_deaths)
            ->with('is_show_recovered', $is_show_recovered)
            ->with('is_show_regression', $is_show_regression)
            ->with('not_enough_data', $not_enough_data)
            ->with('country_label', $country_label)
            ->with('countries', $countries)
            ->with('table_data', $table_data)
            ->with('graph_labels', $this->getGraphLabels($country_slugs[0], $c_from, $c_to))
            ->with('graph_data', $graph_data)
            ->with('bar_data', $bar_data);
    }

    private function getCountryLabels(array $country_slugs): string
    {
        return ltrim(array_reduce($country_slugs, function ($label, $slug) {
            $label .= ' vs ' . $this->covid_19->getCountryLabelBySlug($slug);
            return $label;
        }, ''), ' vs ');
    }

    private function getCountryConfirmed(string $country_slug): array
    {
        if (isset($this->confirmed[$country_slug])) {
            return $this->confirmed[$country_slug];
        }

        $data = $this->covid_19->getCountryConfirmed($country_slug);

        $this->confirmed[$country_slug] = $data;

        return $data;
    }

    private function getCountryDeaths(string $country_slug): array
    {
        if (isset($this->deaths[$country_slug])) {
            return $this->deaths[$country_slug];
        }

        $data = $this->covid_19->getCountryDeaths($country_slug);

        $this->deaths[$country_slug] = $data;

        return $data;
    }

    private function getCountryRecovered(string $country_slug): array
    {
        if (isset($this->recovered[$country_slug])) {
            return $this->recovered[$country_slug];
        }

        $data = $this->covid_19->getCountryRecovered($country_slug);

        $this->recovered[$country_slug] = $data;

        return $data;
    }

    private function getCountryConfirmedFiltered(
        string $country_slug,
        CarbonInterface $from,
        CarbonInterface $to
    ): array {
        if (isset($this->confirmed_filtered[$country_slug])) {
            return $this->confirmed_filtered[$country_slug];
        }

        $data = array_values(
            array_filter($this->getCountryConfirmed($country_slug), static function ($day_data) use ($from, $to) {
                $day = Carbon::parse($day_data['Date']);
                return $day->gte($from) && $day->lte($to);
            })
        );

        $this->confirmed_filtered[$country_slug] = $data;

        return $data;
    }

    private function getCountryDeathsFiltered(
        string $country_slug,
        CarbonInterface $from,
        CarbonInterface $to
    ): array {
        if (isset($this->deaths_filtered[$country_slug])) {
            return $this->deaths_filtered[$country_slug];
        }

        $data = array_values(
            array_filter($this->getCountryDeaths($country_slug), static function ($day_data) use ($from, $to) {
                $day = Carbon::parse($day_data['Date']);
                return $day->gte($from) && $day->lte($to);
            })
        );

        $this->deaths_filtered[$country_slug] = $data;

        return $data;
    }

    private function getCountryRecoveredFiltered(
        string $country_slug,
        CarbonInterface $from,
        CarbonInterface $to
    ): array {
        if (isset($this->recovered_filtered[$country_slug])) {
            return $this->recovered_filtered[$country_slug];
        }

        $data = array_values(
            array_filter($this->getCountryRecovered($country_slug), static function ($day_data) use ($from, $to) {
                $day = Carbon::parse($day_data['Date']);
                return $day->gte($from) && $day->lte($to);
            })
        );

        $this->recovered_filtered[$country_slug] = $data;

        return $data;
    }

    private function getCountryExponentialRegressionFiltered(
        string $country_slug,
        CarbonInterface $from,
        CarbonInterface $to
    ): array {
        $confirmed_cases = array_column($this->getCountryConfirmedFiltered($country_slug, $from, $to), 'Cases');
        $exponential_data = array_map(static function ($key, $value) {
            return [$key, $value];
        }, array_keys($confirmed_cases), array_values($confirmed_cases));
        if (count($exponential_data) >= 6) {
            $exponential_data = array_column(
                RegressionFactory::exponential($exponential_data)->getResultSequence(),
                '1'
            );
        } else {
            $exponential_data = array_fill(0, count($exponential_data), 0);
        }
        return array_map('round', $exponential_data);
    }

    private function getTableData(array $country_slugs, CarbonInterface $from, CarbonInterface $to): array
    {
        $data = [];

        foreach ($country_slugs as $country_slug) {
            $confirmed = $this->getCountryConfirmedFiltered($country_slug, $from, $to);
            foreach ($confirmed as $key => $c) {
                $confirm = $c['Cases'] ?? 0;
                $deaths = $this->getCountryDeathsFiltered($country_slug, $from, $to)[$key]['Cases'] ?? 0;
                $recovered = $this->getCountryRecoveredFiltered($country_slug, $from, $to)[$key]['Cases'] ?? 0;
                $regression = $this->getCountryExponentialRegressionFiltered($country_slug, $from, $to)[$key] ?? 0;

                $confirmed = isset($data[$key]['confirmed']) ? $data[$key]['confirmed'] . '/' . $confirm : $confirm;
                $deaths = isset($data[$key]['deaths']) ? $data[$key]['deaths'] . '/' . $deaths : $deaths;
                $recovered = isset($data[$key]['recovered']) ? $data[$key]['recovered'] . '/' . $recovered : $recovered;
                $regression = isset($data[$key]['regression']) ?
                    $data[$key]['regression'] . '/' . $regression
                    : $regression;

                if (!isset($data[$key])) {
                    $data[$key] = [];
                }

                if ($this->is_show_confirmed) {
                    $data[$key]['confirmed'] = $confirmed;
                }

                if ($this->is_show_deaths) {
                    $data[$key]['deaths'] = $deaths;
                }

                if ($this->is_show_recovered) {
                    $data[$key]['recovered'] = $recovered;
                }

                if ($this->is_show_regression) {
                    $data[$key]['regression'] = $regression;
                }

                $data[$key]['date'] = Carbon::parse($c['Date'])->format('M jS');
            }
        }

        return $data;
    }

    private function getGraphLabels(string $country_slug, CarbonInterface $from, CarbonInterface $to): array
    {
        return array_map(static function ($date) {
            return Carbon::parse($date, 'UTC')->format('M jS');
        }, array_column($this->getCountryConfirmedFiltered($country_slug, $from, $to), 'Date'));
    }

    private function getGraphData(array $country_slugs, CarbonInterface $from, CarbonInterface $to): array
    {
        $data = [];
        $is_multiple = count($country_slugs) > 1;

        foreach ($country_slugs as $key => $country_slug) {
            if ($this->is_show_confirmed) {
                $data[] = [
                    'label'           => 'Confirmed' . (
                        $is_multiple ? ' (' . $this->covid_19->getCountryLabelBySlug($country_slug) . ')' : ''
                        ),
                    'backgroundColor' => $key === 0 ? 'rgba(0, 0, 0, 1)' : 'rgba(150, 150, 150, 1)',
                    'borderColor'     => $key === 0 ? 'rgba(0, 0, 0, 1)' : 'rgba(150, 150, 150, 1)',
                    'data'            => array_column(
                        $this->getCountryConfirmedFiltered($country_slug, $from, $to),
                        'Cases'
                    ),
                    'fill'            => false,
                ];
            }
            if ($this->is_show_deaths) {
                $data[] = [
                    'label'           => 'Deaths' . (
                        $is_multiple ? ' (' . $this->covid_19->getCountryLabelBySlug($country_slug) . ')' : ''
                        ),
                    'backgroundColor' => $key === 0 ? 'rgba(255, 0, 0, 1)' : 'rgba(255, 127, 0, 1)',
                    'borderColor'     => $key === 0 ? 'rgba(255, 0, 0, 1)' : 'rgba(255, 127, 0, 1)',
                    'data'            => array_column(
                        $this->getCountryDeathsFiltered($country_slug, $from, $to),
                        'Cases'
                    ),
                    'fill'            => false,
                ];
            }
            if ($this->is_show_recovered) {
                $data[] = [
                    'label'           => 'Recovered' . (
                        $is_multiple ? ' (' . $this->covid_19->getCountryLabelBySlug($country_slug) . ')' : ''
                        ),
                    'backgroundColor' => $key === 0 ? 'rgba(0, 255, 0, 1)' : 'rgba(0, 0, 255, 1)',
                    'borderColor'     => $key === 0 ? 'rgba(0, 255, 0, 1)' : 'rgba(0, 0, 255, 1)',
                    'data'            => array_column(
                        $this->getCountryRecoveredFiltered($country_slug, $from, $to),
                        'Cases'
                    ),
                    'fill'            => false,
                ];
            }
            if ($this->is_show_regression) {
                $data[] = [
                    'label'           => 'Exp. Regression' . (
                        $is_multiple ? ' (' . $this->covid_19->getCountryLabelBySlug($country_slug) . ')' : ''
                        ),
                    'backgroundColor' => $key === 0 ? 'rgba(252, 100, 6, 0.5)' : 'rgba(19, 150, 175, 0.5)',
                    'borderColor'     => $key === 0 ? 'rgba(252, 100, 6, 0.5)' : 'rgba(19, 150, 175, 0.5)',
                    'data'            => $this->getCountryExponentialRegressionFiltered($country_slug, $from, $to),
                    'fill'            => false,
                    'borderDash'      => [5, 5],
                ];
            }
        }

        return $data;
    }

    private function getBarData(array $country_slugs, CarbonInterface $from, CarbonInterface $to): array
    {
        $data = [];
        $is_multiple = count($country_slugs) > 1;

        foreach ($country_slugs as $key => $country_slug) {
            if ($this->is_show_confirmed) {
                $data[] = [
                    'label'           => 'Confirmed' . (
                        $is_multiple ? ' (' . $this->covid_19->getCountryLabelBySlug($country_slug) . ')' : ''
                        ),
                    'backgroundColor' => $key === 0 ? 'rgba(0, 0, 0, 1)' : 'rgba(150, 150, 150, 1)',
                    'borderColor'     => $key === 0 ? 'rgba(0, 0, 0, 1)' : 'rgba(150, 150, 150, 1)',
                    'data'            => array_column(
                        $this->getCountryConfirmedFiltered($country_slug, $from, $to),
                        'Difference'
                    ),
                    'fill'            => false,
                ];
            }
            if ($this->is_show_deaths) {
                $data[] = [
                    'label'           => 'Deaths' . (
                        $is_multiple ? ' (' . $this->covid_19->getCountryLabelBySlug($country_slug) . ')' : ''
                        ),
                    'backgroundColor' => $key === 0 ? 'rgba(255, 0, 0, 1)' : 'rgba(255, 127, 0, 1)',
                    'borderColor'     => $key === 0 ? 'rgba(255, 0, 0, 1)' : 'rgba(255, 127, 0, 1)',
                    'data'            => array_column(
                        $this->getCountryDeathsFiltered($country_slug, $from, $to),
                        'Difference'
                    ),
                    'fill'            => false,
                ];
            }
            if ($this->is_show_recovered) {
                $data[] = [
                    'label'           => 'Recovered' . (
                        $is_multiple ? ' (' . $this->covid_19->getCountryLabelBySlug($country_slug) . ')' : ''
                        ),
                    'backgroundColor' => $key === 0 ? 'rgba(0, 255, 0, 1)' : 'rgba(0, 0, 255, 1)',
                    'borderColor'     => $key === 0 ? 'rgba(0, 255, 0, 1)' : 'rgba(0, 0, 255, 1)',
                    'data'            => array_column(
                        $this->getCountryRecoveredFiltered($country_slug, $from, $to),
                        'Difference'
                    ),
                    'fill'            => false,
                ];
            }
        }

        return $data;
    }
}
