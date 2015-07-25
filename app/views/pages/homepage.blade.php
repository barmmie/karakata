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
                        <div class="five wide column">
                            <div class="ui content m-b-md">
                                <a href="test" class="ui teal header">
                                    <i class="bordered inverted shadowed teal road icon"></i>
                                    <div class="content">
                                        Automobiles
                                        <div class="sub header">2,430</div>
                                    </div>
                                </a>
                                <div class="ui list">
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Car parts & accessories
                                    </a>
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Vans and trucks
                                    </a>

                                    <a class="item"><i class="right triangle icon"></i> Motorbikes</a>
                                    <a class="item"><i class="right triangle icon"></i>Wanted</a>

                                </div>
                            </div>

                            <div class="ui content m-b-md">
                                <a href="test" class="ui teal header">
                                    <i class="bordered inverted shadowed teal home icon"></i>
                                    <div class="content">
                                        Property
                                        <div class="sub header">5,430</div>
                                    </div>
                                </a>
                                <div class="ui list">
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        House for rent
                                    </a>
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                       House for sale
                                    </a>

                                    <a class="item"><i class="right triangle icon"></i> Apartments for rent</a>
                                    <a class="item"><i class="right triangle icon"></i> Apartments for sale</a>
                                    <a class="item"><i class="right triangle icon"></i> Farm ranches</a>

                                    <a class="item"><i class="right triangle icon"></i> Land</a>
                                    <a class="item"><i class="right triangle icon"></i> Vacation rentals</a>
                                    <a class="item"><i class="right triangle icon"></i> Commercial builidng</a>
                                </div>
                            </div>

                            <div class="ui content m-b-md">
                                <a href="test" class="ui teal header">
                                    <i class="bordered inverted shadowed teal folder icon"></i>
                                    <div class="content">
                                        Jobs
                                        <div class="sub header">6,375</div>
                                    </div>
                                </a>
                                <div class="ui list">
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Full-time jobs
                                    </a>
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Internet jobs
                                    </a>

                                    <a class="item"><i class="right triangle icon"></i> Learn and earn jobs</a>
                                    <a class="item"><i class="right triangle icon"></i> Manual labor jobs</a>

                                </div>
                            </div>

                        </div>
                        <div class="five wide column">
                            <div class="ui content m-b-md">
                                <a href="test" class="ui teal header">
                                    <i class="bordered inverted shadowed teal travel icon"></i>
                                    <div class="content">
                                        Services
                                        <div class="sub header">3,234</div>
                                    </div>
                                </a>
                                <div class="ui list">
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Building, Home & removals
                                    </a>
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Entertainment
                                    </a>

                                    <a class="item"><i class="right triangle icon"></i> Health and Beauty</a>
                                    <a class="item"><i class="right triangle icon"></i>Miscellaneous</a>
                                    <a class="item"><i class="right triangle icon"></i>Property & shipping</a>
                                    <a class="item"><i class="right triangle icon"></i>Tax, Money and Visas</a>
                                    <a class="item"><i class="right triangle icon"></i>Telecoms & computers</a>
                                    <a class="item"><i class="right triangle icon"></i>Travel services & Tours</a>
                                    <a class="item"><i class="right triangle icon"></i>Tuitions & home lessons</a>

                                </div>

                                <div class="ui content m-b-md">
                                    <a href="test" class="ui teal header">
                                        <i class="bordered inverted shadowed teal paw icon"></i>

                                        <div class="content">
                                            Pets
                                            <div class="sub header">2,430</div>
                                        </div>
                                    </a>
                                    <div class="ui list">
                                        <a class="item">
                                            <i class="right triangle icon"></i>
                                            Pets for sale
                                        </a>
                                        <a class="item">
                                            <i class="right triangle icon"></i>
                                           Petsitters & dogwalkers
                                        </a>

                                        <a class="item"><i class="right triangle icon"></i> Pet equipments & accessories</a>
                                        <a class="item"><i class="right triangle icon"></i>Missing lost and found</a>

                                    </div>
                                </div>

                                <div class="ui content m-b-md">
                                    <a href="test" class="ui teal header">
                                        <i class="bordered inverted shadowed teal student icon"></i>

                                        <div class="content">
                                            Learning
                                            <div class="sub header">2,430</div>
                                        </div>
                                    </a>
                                    <div class="ui list">
                                        <a class="item">
                                            <i class="right triangle icon"></i>
                                            Sports classes
                                        </a>
                                        <a class="item">
                                            <i class="right triangle icon"></i>
                                            Language classes
                                        </a>

                                        <a class="item"><i class="right triangle icon"></i> Personal fitness</a>
                                        <a class="item"><i class="right triangle icon"></i>Music lessons</a>

                                    </div>
                                </div>



                            </div>

                        </div>
                        <div class="five wide column">
                            <div class="ui content m-b-md">
                                <a href="test" class="ui teal header">
                                    <i class="bordered inverted shadowed teal shop icon"></i>

                                    <div class="content">
                                        For sale
                                        <div class="sub header">10,160</div>
                                    </div>
                                </a>
                                <div class="ui list">
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Audio & stereo
                                    </a>
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Baby kids & stuff
                                    </a>

                                    <a class="item"><i class="right triangle icon"></i> CDs, DVDs, Games & Books</a>
                                    <a class="item"><i class="right triangle icon"></i>Clothes, Footwear & Accessories</a>
                                    <a class="item"><i class="right triangle icon"></i>Computers & software</a>
                                    <a class="item"><i class="right triangle icon"></i>Home & garden</a>
                                    <a class="item"><i class="right triangle icon"></i>Music & instruments</a>
                                    <a class="item"><i class="right triangle icon"></i>Office furniture & equipments</a>
                                    <a class="item"><i class="right triangle icon"></i>Phones, Mobile phones & Telecoms</a>
                                    <a class="item"><i class="right triangle icon"></i>Sports, Leisure travel</a>
                                    <a class="item"><i class="right triangle icon"></i>Tickets</a>
                                    <a class="item"><i class="right triangle icon"></i>Tv Dvd & Cameras</a>
                                    <a class="item"><i class="right triangle icon"></i>Video games & cameras</a>
                                    <a class="item"><i class="right triangle icon"></i>Video games & consoles</a>

                                </div>
                            </div>

                            <div class="ui content m-b-md">
                                <a href="test" class="ui teal header">
                                    <i class="bordered inverted shadowed teal tree icon"></i>

                                    <div class="content">
                                        Community
                                        <div class="sub header">230</div>
                                    </div>
                                </a>
                                <div class="ui list">
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Pets for sale
                                    </a>
                                    <a class="item">
                                        <i class="right triangle icon"></i>
                                        Petsitters & dogwalkers
                                    </a>

                                    <a class="item"><i class="right triangle icon"></i> Pet equipments & accessories</a>
                                    <a class="item"><i class="right triangle icon"></i>Missing lost and found</a>

                                </div>
                            </div>
                        </div>


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