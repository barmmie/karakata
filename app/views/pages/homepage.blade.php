@extends('layouts.public')

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
                            Find classified ads worldwide
                        </h2>
                    </div>

                    <div class="ui doubling stackable grid">
                        @if(count($categories) > 0)
                            @foreach($categories as $category_list)
                                <div class="five wide column">
                                    @foreach($category_list as $category)
                                    <div class="ui content m-b-md">
                                        <a class="ui teal header" href="{{route('categories.show', $category['slug'] )}}">
                                            <i class="bordered inverted shadowed teal road icon"></i>
                                            <div class="content">
                                                {{$category['label']}}
                                            </div>
                                        </a>
                                        <div class="ui list">
                                            @foreach($category['children'] as $child)
                                            <a class="item" href="{{route('categories.show', [$category['slug'], $child['slug']])}}">
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
                    <h2 class="ui dividing header">
                        Featured listing
                    </h2>
                    <div class="ui grid">
                        <div id="owl-demo" class="owl-carousel m-t-lg m-b-lg">

                            <div data-mh="featured-listing" class="item">
                                <div class="ui card">
                                    <div class="ui fluid image">
                                        <a class="ui right corner label">
                                            <i class="camera icon"></i>
                                            <i class=" corner icon">2</i>

                                        </a>
                                        <img class="lazyOwl" data-src="{{asset('images/item/tp/Image00002.jpg')}}">
                                    </div>
                                    <div class="content">

                                        <a class="small header">Google android Nexus 4 </a>


                                    </div>
                                    <div class="extra content">
                                        <a>
                                            <i class="marker icon"></i>
                                            Ontario
                                        </a>
                                        <div class="right floated">
                                            <div class="ui teal label">
                                                $23.00
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div data-mh="featured-listing" class="item">
                                <div class="ui card">
                                    <div class="ui fluid image">
                                        <a class="ui right corner label">
                                            <i class="camera icon"></i>
                                            <i class=" corner icon">2</i>

                                        </a>
                                        <img class="lazyOwl" data-src="{{asset('images/item/tp/Image00006.jpg')}}">
                                    </div>
                                    <div class="content">

                                        <a class="small header">Google Nexus 4 </a>


                                    </div>
                                    <div class="extra content">
                                        <a>
                                            <i class="marker icon"></i>
                                            New jersey
                                        </a>
                                        <div class="right floated">
                                            <div class="ui teal label">
                                                $23.00
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div data-mh="featured-listing" class="item">
                                <div class="ui card">
                                    <div class="ui fluid image">
                                        <a class="ui right corner label">
                                            <i class="camera icon"></i>
                                            <i class=" corner icon">2</i>

                                        </a>
                                        <img class="lazyOwl" data-src="{{asset('images/item/tp/Image00011.jpg')}}">
                                    </div>
                                    <div class="content">

                                        <a class="small header">Google android nexus 4 (still working)</a>


                                    </div>
                                    <div class="extra content">
                                        <a>
                                            <i class="marker icon"></i>
                                            Atlanta
                                        </a>
                                        <div class="right floated">
                                            <div class="ui teal label">
                                                $23.00
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div data-mh="featured-listing" class="item">
                                <div class="ui card">
                                    <div class="ui fluid image">
                                        <a class="ui right corner label">
                                            <i class="camera icon"></i>
                                            <i class=" corner icon">2</i>

                                        </a>
                                        <img class="lazyOwl" data-src="{{asset('images/item/tp/Image00013.jpg')}}">
                                    </div>
                                    <div class="content">

                                        <a class="small header">Google android Nexus 4 </a>


                                    </div>
                                    <div class="extra content">
                                        <a>
                                            <i class="marker icon"></i>
                                            New hampshire
                                        </a>
                                        <div class="right floated">
                                            <div class="ui teal label">
                                                $23.00
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div data-mh="featured-listing" class="item">
                                <div class="ui card">
                                    <div class="ui fluid image">
                                        <a class="ui right corner label">
                                            <i class="camera icon"></i>
                                            <i class=" corner icon">2</i>

                                        </a>
                                        <img class="lazyOwl" data-src="{{asset('images/item/tp/Image00014.jpg')}}">
                                    </div>
                                    <div class="content">

                                        <a class="small header">Google android Nexus 4 </a>


                                    </div>
                                    <div class="extra content">
                                        <a>
                                            <i class="marker icon"></i>
                                            Illinois
                                        </a>
                                        <div class="right floated">
                                            <div class="ui teal label">
                                                $23.00
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="four wide column">
                <div class="ui segment padding-reset">
                    <a href="http://google.com" class="ui medium image">
                        <img src="{{asset('images/site/app.jpg')}}">
                    </a>
                </div>
                <div class="ui segment">
                    <div class="m-b-md">
                        <h2 class="ui dividing header">
                            Popular categories
                        </h2>
                    </div>

                    <div class="ui column">
                        <div class="ui divided list">
                            <a class="item">
                                <i class="angle double right icon"></i>
                                Getting Started
                            </a>
                            <a class="item"><i class="angle double right icon"></i>Introduction</a>


                            <a class="item"><i class="angle double right icon"></i>Review</a>
                            <a class="item padded">
                                <i class="angle double right icon"></i>
                                Getting Started
                            </a>
                            <a class="item"><i class="angle double right icon"></i>Introduction</a>


                            <a class="item"><i class="angle double right icon"></i>Review</a>
                        </div>
                    </div>
                </div>
                <div class="ui segment padding-reset">
                    <a href="http://google.com" class="ui medium image">
                        <img src="{{asset('images/add2.jpg')}}">
                    </a>
                </div>
            </div>
        </div>

    <div class="ui row ">
        <div class="ui column ">

            <div class="ui olive padded container">
                <div class="ui four statistics">
                    <div class="statistic">
                        <div class="value">
                            22
                        </div>
                        <div class="label">
                            Saves
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="text value">
                            Three<br>
                            Thousand
                        </div>
                        <div class="label">
                            Signups
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            <i class="plane icon"></i> 5
                        </div>
                        <div class="label">
                            Flights
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            <img src="/images/avatar/small/joe.jpg" class="ui circular inline image">
                            42
                        </div>
                        <div class="label">
                            Team Members
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function() {

            $("#owl-demo").owlCarousel({
                items : 4,
                lazyLoad : true,
                navigation : true
            });

        });
    </script>

@endsection