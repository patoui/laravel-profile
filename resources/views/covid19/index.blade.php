@extends('layouts.app')

@section('meta')
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="COVID-19 Statistics and Graphs by Country"/>
    <meta property="og:description" content="COVID-19 Statistics and Graphs by Country"/>
    <meta property="keywords" content="covid19,covid,coronavirus"/>
@endsection

@section('title', 'Covid 19 Stats')

@section('content')
    <div class="flex flex-col w-full">
        <h1 class="block text-4xl mb-4 text-center w-full">COVID-19 Stats: {{ $country_label }}</h1>
        <form action="{{ route('covid19') }}" method="get" class="mb-4">
            <div class="mb-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    Country
                </label>
                <div class="relative">
                    <select name="country_slug"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                        @foreach($countries as $country)
                            <option value="{{ $country['Slug'] }}" {{ $country_slug === $country['Slug'] ? 'selected' : '' }}>{{ $country['Country'] }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-4">
                <div class="w-full md:w-1/2 px-3 md:mb-0">
                    <div class="mb-4 sm:mb-0 md:mb-0 lg:mb-0 xl:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="from">
                            From
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="from"
                               name="from"
                               type="date"
                               value="{{ $from }}"
                               placeholder="From">
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 md:mb-0">
                    <div class="mb-4 sm:mb-0 md:mb-0 lg:mb-0 xl:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="to">
                            To
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="to"
                               name="to"
                               type="date"
                               value="{{ $to }}"
                               placeholder="To">
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-1/2">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight" type="checkbox" id="is_show_table" value="1" {{ $is_show_table ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_table_hidden" name="is_show_table" value="{{ (int) $is_show_table }}">
                        <span class="text-sm">Show Table</span>
                    </label>
                </div>
                <div class="w-1/2 px-3">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight" type="checkbox" id="is_show_graph" value="1" {{ $is_show_graph ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_graph_hidden" name="is_show_graph" value="{{ (int) $is_show_graph }}">
                        <span class="text-sm">Show Graph</span>
                    </label>
                </div>
            </div>

            <div class="w-full">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>

        @if ($is_show_table)
            <table class="w-full text-left table-collapse">
                <caption class="mt-4 mb-4">Cumulative Cases</caption>
                <thead>
                    <tr>
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Confirmed</th>
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Deaths</th>
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Recovered</th>
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100 text-right">Date</th>
                    </tr>
                </thead>
                <tbody class="align-baseline">
                @foreach($country_confirmed_table as $key => $cases)
                    <tr>
                        <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $cases['Cases'] }}</td>
                        <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $country_deaths_table[$key]['Cases'] ?? 0 }}</td>
                        <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $country_recovered_table[$key]['Cases'] ?? 0 }}</td>
                        <td class="p-2 border-t border-gray-300 font-mono text-xs text-blue-700 whitespace-pre text-right">{{ \Carbon\Carbon::parse($cases['Date'])->format('M jS') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if ($is_show_graph)
            <canvas id="graph" style="display: block;"></canvas>
        @endif
    </div>

    <div class="w-full mt-8 mb-4 text-center">
        <p class="text-gray-600">Data provided by <a href="https://covid19api.com/" target="_blank" class="text-blue-600">https://covid19api.com/</a></p>
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
      var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var config = {
        type: 'line',
        data: {
          labels: [{!! $graph_labels !!}],
          datasets: [
            {
              label: 'Confirmed',
              backgroundColor: '#000000',
              borderColor: '#000000',
              data: [{{ $country_confirmed_graph }}],
              fill: false
            },
            {
              label: 'Deaths',
              backgroundColor: '#FF0000',
              borderColor: '#FF0000',
              data: [{{ $country_deaths_graph }}],
              fill: false
            },
            {
              label: 'Recovered',
              backgroundColor: '#008000',
              borderColor: '#008000',
              data: [{{ $country_recovered_graph }}],
              fill: false
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          title: {
            display: true,
            text: 'Cumulative Cases by Day'
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: false,
                labelString: 'Day'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: false,
                labelString: 'Value'
              }
            }]
          }
        }
      };

      window.onload = function () {
        let graph_element = document.getElementById('graph');
        if (graph_element) {
          new Chart(document.getElementById('graph').getContext('2d'), config);
        }
        document.querySelector('#is_show_table').addEventListener('click', function () {
          document.querySelector('#is_show_table_hidden').value = document.querySelector('#is_show_table').checked ? 1 : 0;
        });
        document.querySelector('#is_show_graph').addEventListener('click', function () {
          document.querySelector('#is_show_graph_hidden').value = document.querySelector('#is_show_graph').checked ? 1 : 0;
        });
      };
    </script>
@endsection