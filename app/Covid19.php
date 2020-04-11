<?php

declare(strict_types=1);

namespace App;

use Illuminate\Support\Facades\Cache;
use Zttp\Zttp;

class Covid19
{
    public function process(bool $update_cache = false, string $last_slug = null): void
    {
        $countries = $this->getCountries(true);

        if ($last_slug) {
            $last_index = array_search($last_slug, array_column($countries, 'Slug'), true);
            if ($last_index) {
                $countries = array_slice($countries, $last_index);
            }
        }

        foreach ($countries as $country) {
            Cache::put('covid19_last_country_slug', $country['Slug']);
            $this->getCountryConfirmed($country['Slug'], $update_cache);
            $this->getCountryDeaths($country['Slug'], $update_cache);
            $this->getCountryRecovered($country['Slug'], $update_cache);
        }
    }

    public function getCountries(bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_countries');
        }

        return Cache::get('covid19_countries', function () {
            $data = Zttp::get('https://api.covid19api.com/countries')->json();
            Cache::put('covid19_countries', $data);
            return $data;
        });
    }

    public function getCountryConfirmed(string $country_slug, bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_confirmed_' . $country_slug);
        }

        return Cache::get('covid19_confirmed_' . $country_slug, static function () use ($country_slug) {
            $data = Zttp::get("https://api.covid19api.com/total/country/{$country_slug}/status/confirmed")->json();
            foreach ($data as $key => $set) {
                $prev_cases = $data[$key - 1]['Cases'] ?? 0;
                $current_cases = $set['Cases'] ?? 0;
                $data[$key]['Difference'] = $current_cases - $prev_cases;
            }
            Cache::put('covid19_confirmed_' . $country_slug, $data);
            return $data;
        });
    }

    public function getCountryDeaths(string $country_slug, bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_deaths_' . $country_slug);
        }

        return Cache::get('covid19_deaths_' . $country_slug, static function () use ($country_slug) {
            $data = Zttp::get("https://api.covid19api.com/total/country/{$country_slug}/status/deaths")->json();
            foreach ($data as $key => $set) {
                $prev_cases = $data[$key - 1]['Cases'] ?? 0;
                $current_cases = $set['Cases'] ?? 0;
                $data[$key]['Difference'] = $current_cases - $prev_cases;
            }
            Cache::put('covid19_deaths_' . $country_slug, $data);
            return $data;
        });
    }

    public function getCountryRecovered(string $country_slug, bool $update_cache = false): array
    {
        if ($update_cache) {
            Cache::forget('covid19_recovered_' . $country_slug);
        }

        return Cache::get('covid19_recovered_' . $country_slug, static function () use ($country_slug) {
            $data = Zttp::get("https://api.covid19api.com/total/country/{$country_slug}/status/recovered")->json();
            foreach ($data as $key => $set) {
                $prev_cases = $data[$key - 1]['Cases'] ?? 0;
                $current_cases = $set['Cases'] ?? 0;
                $data[$key]['Difference'] = $current_cases - $prev_cases;
            }
            Cache::put('covid19_recovered_' . $country_slug, $data);
            return $data;
        });
    }
}
