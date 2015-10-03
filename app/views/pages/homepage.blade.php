@extends('layouts.public')

@section('title')
    {{Setting::get('site_slogan')}}
@endsection

@section('styles')
    <link href="{{asset('assets/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/owl.theme.css')}}" rel="stylesheet">

@endsection

@section('content')
    @include('partials._search_cta')
    <div class="ui two column stackable grid container">

        <div class="eleven wide column">

            <div class="ui segment ">
                <div class="m-b-lg">
                    <h2 class="ui dividing header m-b-lg">
                        {{Setting::get('site_slogan')}}
                    </h2>
                </div>

                <div class="ui doubling stackable grid">
                    @if(count($categories) > 0)
                        @foreach($categories as $category_list)
                            <div class="five wide column">
                                @foreach($category_list as $category)
                                    <div class="ui content m-b-md">
                                        <a class="ui teal header"
                                           href="{{route('categories.show', $category['slug'] )}}">
                                            <i class="bordered inverted shadowed teal huge {{$category['icon']?:'search'}} icon"></i>

                                            <div class="content">
                                                {{$category['label']}}
                                            </div>
                                        </a>

                                        <div class="ui list">
                                            @foreach($category['children'] as $child)
                                                <a class="item"
                                                   href="{{route('categories.show', [$category['slug'], $child['slug']])}}">
                                                    <i class="right triangle icon"></i>
                                                    {{$child['label']}} ({{count($child['active_items'])}})
                                                </a>
                                            @endforeach


                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        @endforeach

                    @endif


                </div>
            </div>

            <div class="ui segment">
                @include('widgets._featured_items')
            </div>


            @if(Setting::get('ad_leaderboard')!='')
                {{Setting::get('ad_leaderboard')}}
            @endif

        </div>
        <div class="four wide column">
            @if(Setting::get('ad_250')!='')
                <div class="ui segment padding-reset">
                    {{Setting::get('ad_250')}}
                </div>
            @endif
            <div class="ui segment">
                @include('widgets._popular_categories')
            </div>
            <div class="ui segment padding-reset">
                @include('widgets._recent_items')
            </div>
        </div>
    </div>



    {{--<div class="teal row padding-reset m-b-n-lg">--}}
    {{--<div class="column padding-reset">--}}

    {{--<div class="ui olive p-lg container">--}}
    {{--<div class="ui four statistics">--}}
    {{--<div class="statistic">--}}
    {{--<div class="value">--}}
    {{--22--}}
    {{--</div>--}}
    {{--<div class="label">--}}
    {{--Saves--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="statistic">--}}
    {{--<div class="text value">--}}
    {{--Three<br>--}}
    {{--Thousand--}}
    {{--</div>--}}
    {{--<div class="label">--}}
    {{--Signups--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="statistic">--}}
    {{--<div class="value">--}}
    {{--<i class="plane icon"></i> 5--}}
    {{--</div>--}}
    {{--<div class="label">--}}
    {{--Flights--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="statistic">--}}
    {{--<div class="value">--}}
    {{--<img src="/images/avatar/small/joe.jpg" class="ui circular inline image">--}}
    {{--42--}}
    {{--</div>--}}
    {{--<div class="label">--}}
    {{--Team Members--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}


@endsection

@section('scripts')
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/matchHeight/jquery.matchHeight-min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $("#owl-demo").owlCarousel({
                items: 4,
                lazyLoad: true,
                navigation: true
            });

            $('.item.featured-listing').matchHeight({
                byRow: true,
                property: 'height'
            });

        });
    </script>

@endsection