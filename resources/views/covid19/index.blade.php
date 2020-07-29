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
        <h2 class="text-center text-2xl mb-4">World Stats</h2>
        <div class="flex justify-center">
            <div class="mr-6">
                <p class="text-gray-500 text-sm">Confirmed</p>
                <p class="font-bold text-2xl tracking-wide text-orange-700">{{ $world_stats['TotalConfirmed'] }}</p>
            </div>
            <div class="mr-6">
                <p class="text-gray-500 text-sm">Deaths</p>
                <p class="font-bold text-2xl tracking-wide text-red-700">{{ $world_stats['TotalDeaths'] }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Recovered</p>
                <p class="font-bold text-2xl tracking-wide text-green-700">{{ $world_stats['TotalRecovered'] }}</p>
            </div>
        </div>
        <hr class="mt-4 mb-4">
        <h1 class="block text-4xl mb-4 text-center w-full">COVID-19 Stats: {{ $country_label }}</h1>
        <div class="mb-4 text-center">
            @foreach($country_details as $slug => $label)
            <a href="{{ route('covid19.show', ['country_slug' => $slug]) }}" class="text-sm underline text-blue-500 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ "{$label} Province Stats" }}</a>
            @endforeach
        </div>
        <form action="{{ route('covid19.index') }}" method="get" class="mb-4">
            @foreach($country_slugs as $country_slug)
                <div class="country-container">
                    <div class="country-item mb-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                            COUNTRY
                        </label>
                        <div class="relative">
                            <select name="country_slugs[]"
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
                </div>
            @endforeach

            <div class="mb-4">
                <button id="add_comparison" class="bg-blue-500 text-sm hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        style="display: {{ count($country_slugs) === 1 ? 'block' : 'none' }}" type="button">
                    Compare +
                </button>
                <button id="remove_comparison" class="bg-red-500 text-sm hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        style="display: {{ count($country_slugs) > 1 ? 'block' : 'none' }}" type="button">
                    Remove -
                </button>
            </div>

            <div class="flex flex-wrap -mx-3 mb-4">
                <div class="w-full md:w-1/2 px-3 md:mb-0">
                    <div class="mb-4 sm:mb-0 md:mb-0 lg:mb-0 xl:mb-0">
                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="from">
                            FROM
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
                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="to">
                            TO
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
                        <input class="mr-2 leading-tight checkbox-toggle" type="checkbox" id="is_show_table" value="1" {{ $is_show_table ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_table_hidden" name="is_show_table" value="{{ (int) $is_show_table }}">
                        <span class="text-xs uppercase">SHOW TABLE</span>
                    </label>
                </div>
                <div class="w-1/2 px-3">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight checkbox-toggle" type="checkbox" id="is_show_graph" value="1" {{ $is_show_graph ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_graph_hidden" name="is_show_graph" value="{{ (int) $is_show_graph }}">
                        <span class="text-xs uppercase">SHOW CUMULATIVE</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-1/2">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight checkbox-toggle" type="checkbox" id="is_show_bar" value="1" {{ $is_show_bar ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_bar_hidden" name="is_show_bar" value="{{ (int) $is_show_bar }}">
                        <span class="text-xs uppercase">SHOW NEW</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-wrap pt-4 mb-4 text-center border-t-2">
                <h1 class="w-full text-gray-600">FILTER VALUES</h1>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-1/2">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight checkbox-toggle" type="checkbox" id="is_show_confirmed" value="1" {{ $is_show_confirmed ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_confirmed_hidden" name="is_show_confirmed" value="{{ (int) $is_show_confirmed }}">
                        <span class="text-xs uppercase">SHOW CONFIRMED</span>
                    </label>
                </div>
                <div class="w-1/2 px-3">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight checkbox-toggle" type="checkbox" id="is_show_deaths" value="1" {{ $is_show_deaths ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_deaths_hidden" name="is_show_deaths" value="{{ (int) $is_show_deaths }}">
                        <span class="text-xs uppercase">SHOW DEATHS</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-1/2">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight checkbox-toggle" type="checkbox" id="is_show_recovered" value="1" {{ $is_show_recovered ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_recovered_hidden" name="is_show_recovered" value="{{ (int) $is_show_recovered }}">
                        <span class="text-xs uppercase">SHOW RECOVERED</span>
                    </label>
                </div>
                <div class="w-1/2 px-3">
                    <label class="w-full block text-gray-600 font-bold">
                        <input class="mr-2 leading-tight checkbox-toggle" type="checkbox" id="is_show_regression" value="1" {{ $is_show_regression ? 'checked' : '' }}>
                        <input type="hidden" id="is_show_regression_hidden" name="is_show_regression" value="{{ (int) $is_show_regression }}">
                        <span class="text-xs uppercase">SHOW REGRESSION</span>
                    </label>
                </div>
            </div>

            <div class="w-full">
                <button class="bg-blue-500 text-sm hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>

        @if ($is_show_table)
            <table class="w-full text-left table-collapse">
                <caption class="mt-4 mb-4">Cumulative Cases: {{ $country_label }}</caption>
                <thead>
                <tr>
                    @if ($is_show_confirmed)
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Confirmed</th>
                    @endif
                    @if ($is_show_deaths)
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Deaths</th>
                    @endif
                    @if ($is_show_recovered)
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Recovered</th>
                    @endif
                    @if ($is_show_regression)
                        <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100">Exp. Regression</th>
                    @endif
                    <th class="text-sm font-semibold text-gray-700 p-2 bg-gray-100 text-right">Date</th>
                </tr>
                </thead>
                <tbody class="align-baseline">
                @foreach($table_data as $row)
                    <tr>
                        @if ($is_show_confirmed)
                            <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $row['confirmed'] }}</td>
                        @endif
                        @if ($is_show_deaths)
                            <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $row['deaths'] }}</td>
                        @endif
                        @if ($is_show_recovered)
                            <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $row['recovered'] }}</td>
                        @endif
                        @if ($is_show_regression)
                            <td class="p-2 border-t border-gray-300 font-mono text-xs text-purple-700 whitespace-no-wrap">{{ $row['regression'] }}</td>
                        @endif
                        <td class="p-2 border-t border-gray-300 font-mono text-xs text-blue-700 whitespace-pre text-right">{{ $row['date'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if ($is_show_graph)
            <canvas id="graph" style="display: block;"></canvas>
        @endif

        @if ($is_show_bar)
            <canvas id="bar" style="display: block;"></canvas>
        @endif
    </div>

    <div class="w-full mt-8 mb-4 text-center">
        <p class="text-gray-600">Data provided by <a href="https://covid19api.com/" target="_blank" class="text-blue-600">https://covid19api.com/</a></p>
    </div>
@endsection

@if ($not_enough_data)
    <script>alert('Regression requires at least 7 days worth of data')</script>
@endif
@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script nonce="{{ csp_nonce() }}">
      let options = {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 1.25,
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
      };

      let config = {
        type: 'line',
        data: {
          labels: {!! json_encode($graph_labels) !!},
          datasets: {!! json_encode($graph_data) !!}
        },
        options: options
      };

      let bar_options = JSON.parse(JSON.stringify(options));
      bar_options.title.text = 'New Cases by Day';
      let bar_config = {
        type: 'bar',
        data: {
          labels: {!! json_encode($graph_labels) !!},
          datasets: {!! json_encode($bar_data) !!}
        },
        options: bar_options
      };

      window.onload = function () {
        let graph_element = document.getElementById('graph');
        if (graph_element) {
          new Chart(document.getElementById('graph').getContext('2d'), config);
        }
        let bar_element = document.getElementById('bar');
        if (bar_element) {
          new Chart(document.getElementById('bar').getContext('2d'), bar_config);
        }
        document.querySelectorAll('.checkbox-toggle').forEach(function (element) {
          element.addEventListener('click', function (e) {
            document.querySelector('#' + e.target.id + '_hidden').value = e.target.checked ? 1 : 0;
          });
        });
        document.querySelector('#add_comparison').addEventListener('click', function () {
          var country_item = document.querySelector('.country-item').cloneNode(true);
          document.querySelector('.country-container').append(country_item);
          document.querySelector('#add_comparison').style.display = 'none';
          document.querySelector('#remove_comparison').style.display = 'block';
        });
        document.querySelector('#remove_comparison').addEventListener('click', function () {
          var country_items = document.querySelectorAll('.country-item');
          country_items[country_items.length - 1].remove();
          document.querySelector('#add_comparison').style.display = 'block';
          document.querySelector('#remove_comparison').style.display = 'none';
        });
      };
    </script>
@endsection