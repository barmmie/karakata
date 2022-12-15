@extends('layouts.admin')

@section('title')
    {{trans('words.dashboard')}}
@endsection

@section('styles')
    <script src="//www.google.com/jsapi"></script>
    <script src="{{asset('assets/chartkick/chartkick.js')}}"></script>

@endsection

@section('content')
    <div class="main ui container">

        <div class="ui stackable grid">
            <div class="ui column">
                <div class="ui inverted segment">
                    <div class="ui four inverted statistics">
                        <div class="statistic">
                            <div class="value">
                                <i class="user icon"></i>
                                {{$users_count}}
                            </div>
                            <div class="label">
                                {{Lang::choice('words.user', $users_count)}}
                            </div>
                        </div>
                        <div class="statistic">
                            <div class=" value">
                                <i class="file icon"></i> {{$items_count}}
                            </div>
                            <div class="label">
                                {{Lang::choice('words.item', $items_count)}}

                            </div>
                        </div>
                        <div class="statistic">
                            <div class="value">
                                <i class="sitemap icon"></i> {{$categories_count}}
                            </div>
                            <div class="label">
                                {{Lang::choice('words.category', $categories_count)}}

                            </div>
                        </div>
                        <div class="statistic">
                            <div class="value">
                                <i class="icon marker"></i>
                                {{$locations_count}}
                            </div>
                            <div class="label">
                                {{Lang::choice('words.location', $locations_count)}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui stackable grid">
            <div class="ui column">
                <div class="ui segments">
                    <div class="ui segment">
                        <div class="ui header">
                            {{trans('phrases.items_by_time')}}
                        </div>
                    </div>
                    <div class="ui secondary segment">
                        <div class="ui form">
                            <div class="three fields">
                                <div class="field">
                                    <label for="">{{trans('words.month')}}</label>
                                    {{ Form::selectMonth('month', Carbon\Carbon::now()->month, ['class' => 'ui month dropdown',]) }}
                                </div>

                                <div class="field">
                                    <label for="">{{trans('words.year')}}</label>
                                    {{ Form::selectYear('month', 2014,Carbon\Carbon::now()->year, Carbon\Carbon::now()->year,  ['class' => 'ui year dropdown']) }}
                                </div>

                                <div class="field">
                                    <label for="">&nbsp;</label>
                                    <button class="ui button blue filter_item_by_year label left icon">
                                        <i class="icon refresh"></i>
                                        {{trans('phrases.apply_filters')}}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="ui segment itemsbyyear" id="itemsByYear" style="height: 300px;">
                    </div>


                </div>
            </div>
        </div>

        <div class="ui stackable two column grid">
            <div class="sixteen wide column">

                <div class="ui segments">
                    <div class="ui segment">
                        <h4 class="ui header">
                            {{trans('phrases.your_locations')}}
                        </h4>
                    </div>
                    <div class="ui segment itemsbylocation" id="itemsByLocation" style="height: 500px;">

                    </div>


                </div>
            </div>

        </div>


    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {

            $('select.dropdown')
                    .dropdown();

            $itemsByYearSegment = $('.ui.segment.itemsbyyear')
            $yearDropdown = $('.ui.year.dropdown');
            $monthDropdown = $('.ui.month.dropdown');
            $filterItemByYear = $('.ui.filter_item_by_year');

            $.ajaxSetup({
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name=token]').attr("content")}
            });

            var items_by_year_url = "{{route('admin.items_by_year')}}";
            var items_by_location_url = "{{route('admin.items_by_location')}}";

            var refreshItemsByYear = function () {
                $itemsByYearSegment.addClass('loading')
                $.ajax(items_by_year_url, {
                    method: 'GET',
                    data: {
                        month: $monthDropdown.dropdown('get value'),
                        year: $yearDropdown.dropdown('get value')
                    },
                    success: function (response) {
                        $itemsByYearSegment.removeClass('loading')

                        if ($.isEmptyObject(response)) {
                            $itemsByYearSegment.html(
                                    "<div class='ui warning message'>" +
                                    "<p>{{trans('phrases.no_results')}} in " + $monthDropdown.dropdown('get text') + ", " + $yearDropdown.dropdown('get text') + "</p>" +
                                    "</div>"
                            );

                        } else {
                            new Chartkick.LineChart("itemsByYear", response,
                                    {
                                        "library": {
                                            "backgroundColor": "#eee",
                                            "chart": {"zoomType": "x"},
                                            "legend": {"position": "top"},
                                            "hAxis": {"title": "Time"},
                                            "vAxis": {"title": "{{trans('phrases.no_of_items')}}"}
                                        }
                                    });

                        }

                    },
                    error: function () {
                        $itemsByYearSegment.removeClass('loading')
                        $itemsByYearSegment.html(
                                "<div class='ui warning message'>" +
                                "<p>{{trans('phrases.error_occurred')}}}</p>" +
                                "</div>"
                        );

                    }

                });
            };

            $filterItemByYear.on('click', function (e) {
                e.preventDefault()
                refreshItemsByYear();

            })

            $itemsByLocationSegment = $('.ui.segment.itemsbylocation')

            var refreshItemsByLocation = function () {
                $itemsByLocationSegment.addClass('loading')
                $.ajax(items_by_location_url, {
                    method: 'GET',

                    success: function (response) {
                        $itemsByLocationSegment.removeClass('loading')

                        if ($.isEmptyObject(response)) {
                            $itemsByLocationSegment.html(
                                    "<div class='ui warning message'>" +
                                    "<p>{{trans('phrases.no_results')}} " +
                                    "</div>"
                            );

                        } else {
                            new Chartkick.PieChart("itemsByLocation", response);

                        }
                    },
                    error: function () {
                        $itemsByLocationSegment.removeClass('loading')
                        $itemsByLocationSegment.html(
                                "<div class='ui warning message'>" +
                                "<p>{{trans('phrases.error_occurred')}}}</p>" +
                                "</div>"
                        );

                    }

                });
            }

            refreshItemsByYear();
            refreshItemsByLocation();


        });
    </script>

@endsection