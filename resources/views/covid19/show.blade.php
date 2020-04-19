@extends('layouts.app')

@section('meta')
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="COVID-19 Statistics and Graph"/>
    <meta property="og:description" content="COVID-19 Statistics and Graph"/>
    <meta property="og:image" content="{{ Request::root() . '/img/black-white-profile.png' }}"/>
    <meta property="keywords" content="covid-19,covid19,covid,coronavirus"/>
@endsection

@section('title', 'COVID-19 Statistics and Graph')

@section('content')
    <div class="flex flex-col w-full">
        <h1 class="block text-4xl mb-4 text-center w-full">COVID-19 Stats: {{ $country_label }}</h1>

        <table class="w-full text-left table-collapse">
            <caption class="mt-4 mb-4">Province/State Cases: {{ $country_label }}</caption>
            <thead>
            <tr>
                <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Province/State</th>
                <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Confirmed</th>
                <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Deaths</th>
                <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Recovered</th>
                <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100 text-right">Last Updated</th>
            </tr>
            </thead>
            <tbody class="align-baseline">
            @foreach($provinces as $province)
                <tr>
                    <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $province['label'] }}</td>
                    <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $province['confirmed'] }}</td>
                    <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $province['deaths'] }}</td>
                    <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $province['recovered'] }}</td>
                    <td class="p-2 border-t border-gray-300 font-mono text-xs text-blue-700 whitespace-pre text-right">{{ $province['date'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="w-full mt-8 mb-4 text-center">
        <p class="text-gray-600">Data provided by <a href="https://covid19api.com/" target="_blank" class="text-blue-600">https://covid19api.com/</a></p>
    </div>
@endsection
