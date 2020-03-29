<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Zttp\Zttp;

class Covid19Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from', date('Y-m-d', strtotime('-10 days')));
        $to = $request->input('to', date('Y-m-d'));

        $countries = Cache::get('covid19_countries', static function () {
            $data = Zttp::get('https://api.covid19api.com/countries')->json();
            Cache::put('covid19_countries', $data, Carbon::now()->endOfDay());
            return $data;
        });

        $country_slug = $request->input('country_slug', 'canada');
        $country_index = array_search($country_slug, array_column($countries, 'Slug'), true);
        $country_label = $countries[$country_index]['Country'] ?? '';

        $country_confirmed_cases = Cache::get('covid19_confirmed_' . $country_slug, static function () use ($country_slug) {
            $data = Zttp::get("https://api.covid19api.com/total/country/{$country_slug}/status/confirmed")->json();
            Cache::put('covid19_confirmed_' . $country_slug, $data, Carbon::now()->endOfDay());
            return $data;
        });
        $country_deaths_cases = Cache::get('covid19_deaths_' . $country_slug, static function () use ($country_slug) {
            $data = Zttp::get("https://api.covid19api.com/total/country/{$country_slug}/status/deaths")->json();
            Cache::put('covid19_deaths_' . $country_slug, $data, Carbon::now()->endOfDay());
            return $data;
        });
        $country_recovered_cases = Cache::get('covid19_recovered_' . $country_slug, static function () use ($country_slug) {
            $data = Zttp::get("https://api.covid19api.com/total/country/{$country_slug}/status/recovered")->json();
            Cache::put('covid19_recovered_' . $country_slug, $data, Carbon::now()->endOfDay());
            return $data;
        });

        $c_from = Carbon::parse($from);
        $c_to = Carbon::parse($to);

        $country_confirmed_table = array_filter($country_confirmed_cases, static function ($day_data) use ($c_from, $c_to) {
            $c_day = Carbon::parse($day_data['Date']);
            return $c_day->gte($c_from) && $c_day->lte($c_to);
        });
        $country_confirmed_graph = implode(',', array_column($country_confirmed_table, 'Cases'));

        $country_deaths_table = array_filter($country_deaths_cases, static function ($day_data) use ($c_from, $c_to) {
            $c_day = Carbon::parse($day_data['Date']);
            return $c_day->gte($c_from) && $c_day->lte($c_to);
        });
        $country_deaths_graph = implode(',', array_column($country_deaths_table, 'Cases'));

        $country_recovered_table = array_filter($country_recovered_cases, static function ($day_data) use ($c_from, $c_to) {
            $c_day = Carbon::parse($day_data['Date']);
            return $c_day->gte($c_from) && $c_day->lte($c_to);
        });
        $country_recovered_graph = implode(',', array_column($country_recovered_table, 'Cases'));

        $country_graph_labels = '"' . implode('","', array_map(static function ($date) {
            return Carbon::parse($date, 'UTC')->format('M jS');
        }, array_column($country_confirmed_table, 'Date'))) . '"';

        return view('covid19.index')
            ->with('country_slug', $country_slug)
            ->with('from', $from)
            ->with('to', $to)
            ->with('is_show_table', $request->input('is_show_table', '1'))
            ->with('is_show_graph', $request->input('is_show_graph'))
            ->with('country_label', $country_label)
            ->with('countries', $countries)
            ->with('country_confirmed_table', $country_confirmed_table)
            ->with('country_deaths_table', $country_deaths_table)
            ->with('country_recovered_table', $country_recovered_table)
            ->with('graph_labels', $country_graph_labels)
            ->with('country_confirmed_graph', $country_confirmed_graph)
            ->with('country_deaths_graph', $country_deaths_graph)
            ->with('country_recovered_graph', $country_recovered_graph);
    }
}
