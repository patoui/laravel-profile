<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use RuntimeException;
use Zttp\Zttp;

class Covid19
{
    private function makeRequest(string $url): array
    {
        $response = Zttp::get($url);

        if (!$response->isOk()) {
            $status = $response->status();
            $body = $response->body();
            throw new RuntimeException("Error occurred while fetching data {$url} ({$status}): {$body}");
        }

        $data = $response->json();

        if (!is_array($data)) {
            $status = $response->status();
            $body = $response->body();
            throw new RuntimeException("No data returned {$url} ({$status}): {$body}");
        }

        return $data;
    }

    public function process(string $last_slug = null): void
    {
        $countries = $this->getCountries(true);

        if ($last_slug) {
            $last_index = array_search($last_slug, array_column($countries, 'Slug'), true);
            if ($last_index) {
                $countries = array_slice($countries, $last_index);
            }
        } else {
            Redis::del(Redis::keys('laravel:covid19_*'));
        }

        foreach ($countries as $country) {
            Cache::put('covid19_last_country_slug', $country['Slug']);
            $this->setCountryConfirmed($country['Slug']);
            $this->setCountryDeaths($country['Slug']);
            $this->setCountryRecovered($country['Slug']);
        }
    }

    public function getCountries(bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_countries');
        }

        return Cache::get('covid19_countries', fn() => $this->setCountries());
    }

    public function getCountryIndex(string $country_slug): int
    {
        return array_search($country_slug, array_column($this->getCountries(), 'Slug'), true);
    }

    public function getCountryConfirmed(string $country_slug, bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_confirmed_' . $country_slug);
        }

        return Cache::get(
            'covid19_confirmed_' . $country_slug,
            fn() => $this->setCountryConfirmed($country_slug)
        );
    }

    public function getCountryDeaths(string $country_slug, bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_deaths_' . $country_slug);
        }

        return Cache::get(
            'covid19_deaths_' . $country_slug,
            fn() => $this->setCountryDeaths($country_slug)
        );
    }

    public function getCountryDetails(array $country_slugs): array
    {
        $details = [];

        foreach ($country_slugs as $country_slug) {
            $details[$country_slug] = $this->getCountryLabelBySlug($country_slug);
        }

        return $details;
    }

    public function getCountryLabelBySlug(string $country_slug): string
    {
        return array_column($this->getCountries(), 'Country')[$this->getCountryIndex($country_slug)] ?? '';
    }

    public function getCountryRecovered(string $country_slug, bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_recovered_' . $country_slug);
        }

        return Cache::get(
            'covid19_recovered_' . $country_slug,
            fn() => $this->setCountryRecovered($country_slug)
        );
    }

    public function getLiveCountryData(string $country_slug): array
    {
        $query = http_build_query([
            'from' => Carbon::yesterday()->toISOString(),
            'to'   => Carbon::today()->toISOString(),
        ]);

        $today_slug = Carbon::today()->format('Y_m_d_H_i_s');
        $confirmed_key = "covid19_confirmed_live_country_{$country_slug}_{$today_slug}";
        $deaths_key = "covid19_deaths_live_country_{$country_slug}_{$today_slug}";
        $recovered_key = "covid19_recovered_live_country_{$country_slug}_{$today_slug}";

        $confirmed = Cache::get($confirmed_key, function () use ($confirmed_key, $country_slug, $query) {
            $data = $this->makeRequest(
                "https://api.covid19api.com/country/{$country_slug}/status/confirmed/live?" . $query
            );
            Cache::put($confirmed_key, $data, Carbon::now()->addHour());
            return $data;
        });
        $deaths = Cache::get($deaths_key, function () use ($deaths_key, $country_slug, $query) {
            $data = $this->makeRequest(
                "https://api.covid19api.com/country/{$country_slug}/status/deaths/live?" . $query
            );
            Cache::put($deaths_key, $data, Carbon::now()->addHour());
            return $data;
        });
        $recovered = Cache::get($recovered_key, function () use ($recovered_key, $country_slug, $query) {
            $data = $this->makeRequest(
                "https://api.covid19api.com/country/{$country_slug}/status/recovered/live?" . $query
            );
            Cache::put($recovered_key, $data, Carbon::now()->addHour());
            return $data;
        });

        $data = [];
        foreach ($confirmed as $key => $confirm) {
            if (!empty($confirm['Province'])) {
                $data[$confirm['Province']] = [
                    'label'     => $confirm['Province'],
                    'confirmed' => $confirm['Cases'] ?? 0,
                    'deaths'    => $deaths[$key]['Cases'] ?? 0,
                    'recovered' => $recovered[$key]['Cases'] ?? 0,
                    'date'      => Carbon::parse($confirm['Date'])->format('M jS'),
                ];
            }
        }

        return $data;
    }

    public function getWorldStats(): array
    {
        return Cache::get('covid19_world_stats', function () {
            $data = $this->makeRequest('https://api.covid19api.com/world/total');
            $data['TotalConfirmed'] = number_format($data['TotalConfirmed'] ?? 0, 0);
            $data['TotalDeaths'] = number_format($data['TotalDeaths'] ?? 0, 0);
            $data['TotalRecovered'] = number_format($data['TotalRecovered'] ?? 0, 0);
            Cache::put('covid19_world_stats', $data, Carbon::now()->addHour());
            return $data;
        });
    }

    public function setCountries(): array
    {
        $data = $this->makeRequest('https://api.covid19api.com/countries');
        Cache::put('covid19_countries', $data);
        return $data;
    }

    public function setCountryConfirmed(string $country_slug): array
    {
        $data = $this->makeRequest("https://api.covid19api.com/total/country/{$country_slug}/status/confirmed");
        foreach ($data as $key => $set) {
            $prev_cases = $data[$key - 1]['Cases'] ?? 0;
            $current_cases = $set['Cases'] ?? 0;
            $data[$key]['Difference'] = $current_cases - $prev_cases;
        }
        Cache::put('covid19_confirmed_' . $country_slug, $data);
        return $data;
    }

    public function setCountryDeaths(string $country_slug): array
    {
        $data = $this->makeRequest("https://api.covid19api.com/total/country/{$country_slug}/status/deaths");
        foreach ($data as $key => $set) {
            $prev_cases = $data[$key - 1]['Cases'] ?? 0;
            $current_cases = $set['Cases'] ?? 0;
            $data[$key]['Difference'] = $current_cases - $prev_cases;
        }
        Cache::put('covid19_deaths_' . $country_slug, $data);
        return $data;
    }

    public function setCountryRecovered(string $country_slug): array
    {
        $data = $this->makeRequest("https://api.covid19api.com/total/country/{$country_slug}/status/recovered");
        foreach ($data as $key => $set) {
            $prev_cases = $data[$key - 1]['Cases'] ?? 0;
            $current_cases = $set['Cases'] ?? 0;
            $data[$key]['Difference'] = $current_cases - $prev_cases;
        }
        Cache::put('covid19_recovered_' . $country_slug, $data);
        return $data;
    }
}
