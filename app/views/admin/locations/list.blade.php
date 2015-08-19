@extends('layouts.admin')

@section('content')
    <div class="main ui container">
        <div class="ui stackable two column grid" id="locationList">
            <div class="six wide column" >

                <div class="ui segments">
                    <div class="ui segment"><h4 class="ui header">Populate from a country</h4></div>
                    <div class="ui segment" id="countrySelection">
                        <div class="ui inverted dimmer" id="countrySelectionLoader">
                            <div class="ui indeterminate text loader">Fetching locations...</div>
                        </div>
                            <div class="content">
                                    <div class="ui fluid search selection country dropdown">
                                        <input type="hidden" name="country">
                                        <i class="dropdown icon"></i>

                                        <div class="default text">Select Country</div>
                                        @include('partials._country_list')
                                    </div>

                                <div class="description p-sm" id="countrySelectionText">

                                </div>
                            </div>

                        <button class="ui concealed button " id="countrySelectionButton">
                            <i class="add icon"></i>
                            Add them to my locations
                        </button>


                    </div>

                </div>
                {{--<div class="ui segments">--}}
                    {{--<div class="ui segment">--}}
                        {{--<h4 class="ui header">--}}
                            {{--Add a location--}}
                        {{--</h4>--}}
                    {{--</div>--}}
                    {{--<div class="ui segment">--}}
                        {{--<div class="ui google search category">--}}
                            {{--<div class="ui left icon fluid input">--}}
                                {{--<input class="prompt" type="text" placeholder="Search google">--}}
                                {{--<i class="google icon"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="ui segment singlelocation" style="display: none;">--}}
                        {{--<div class="ui card">--}}
                            {{--<div class="content">--}}
                                {{--<div class="header"> <i id="locationicon"></i> <span id="locationtext"></span></div>--}}
                                {{--<div class="description" id="locationdescription">--}}

                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<a class="ui bottom attached button" id="addToLocation">--}}
                                {{--<i class="add icon"></i>--}}
                                {{--Add to my locations--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="ten wide column">

                <div class="ui segments" >
                    <div class="ui segment">
                        <h4 class="ui header">
                            Your locations
                        </h4>
                    </div>
                    <div class="ui segment">

                        <div class="ui left icon input">
                            <input type="text" placeholder="Filter location..." v-model="searchKey">
                            <i class="marker icon"></i>
                        </div>
                    </div>
                    <div class="ui segment" v-class="loading:locationsLoadingIndicator">
                        <div class="ui middle aligned divided list">


                            <div class="item" v-repeat="location: locations| filterBy searchKey |paginate " track-by="id">
                                <div class="right floated content">
                                    <button class="ui icon button" v-on="click:remove(this)"><i class="cancel icon"></i>
                                    </button>
                                </div>
                                <i class="large marker middle aligned icon"></i>

                                <div class="content">

                                    <a class="header">@{{ location.name }}</a>

                                    <div class="description">@{{location.parentName}}</div>

                                </div>
                            </div>
                        </div>
                        <div class="ui info message" v-show="resultCount < 1 && locations.length > 0">
                            <div class="header">No results found </div>
                        </div>

                        <div class="ui warning message" v-show="locations.length < 1">
                            <div class="header">No locations have been setup yet</div>
                        </div>
                    </div>
                    <div class="ui segment">
                        <div class="ui pagination menu" v-show="resultCount > 1">


                            <a class="active item" v-repeat="pageNumber: totalPages" v-on="click: setPage(pageNumber)"
                               v-class="active: currentPage === pageNumber, disabled: pageNumber==='...'">
                                @{{ pageNumber }}
                            </a>

                        </div>

                    </div>

                </div>
            </div>

        </div>


    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/vue/dist/vue.min.js')}}"></script>
    <script src="{{asset('assets/vue-resource/dist/vue-resource.min.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            cache: false,
//        headers: {'X-CSRF-TOKEN' : $('meta[name=token]').attr("content")}
        });
        Vue.http.options.emulateJSON = true;
        Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=token]').attr("content");


        vm = new Vue({
            el: '#locationList',

            ready: function () {
            },

            data: {

                locations: {{$locations}},
                searchKey: '',
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                locationsLoadingIndicator: false
            },
            computed: {
                incrementPageNumber: function(number) {
                    if(number==='...') {
                        return number;
                    } else {
                        return number + 1
                    }


                },
                totalPages: function () {
                    //return Math.ceil(this.resultCount / this.itemsPerPage)

                    var pages = [];
                    var paginationRange = 10;
                    var totalPages = Math.ceil(this.resultCount / this.itemsPerPage);
                    var halfWay = Math.ceil(paginationRange / 2);
                    var position;

                    if (this.currentPage <= halfWay) {
                        position = 'start';
                    } else if (totalPages - halfWay < this.currentPage) {
                        position = 'end';
                    } else {
                        position = 'middle';
                    }

                    var ellipsesNeeded = paginationRange < totalPages;
                    var i = 1;
                    while (i <= totalPages && i <= paginationRange) {
                        var pageNumber = this.calculatePageNumber(i, this.currentPage, paginationRange, totalPages);

                        var openingEllipsesNeeded = (i === 1 && (position === 'middle' || position === 'end'));
                        var closingEllipsesNeeded = (i === paginationRange - 1 && (position === 'middle' || position === 'start'));
                        if (ellipsesNeeded && (openingEllipsesNeeded || closingEllipsesNeeded)) {
                            pages.push('...');
                        } else {
                            pages.push(pageNumber);
                        }
                        i ++;
                    }
                    return pages;
                }

            },
            methods: {
                setPage: function (pageNumber) {
                    if(pageNumber!=='...') {
                        this.currentPage = pageNumber
                    }
                },
                refreshLocations: function() {
                    this.locationsLoadingIndicator= true;

                    this.$http.get("{{route('admin.locations.index')}}", function(data){
//                        this.$set('locations', data);
                        this.locationsLoadingIndicator =  false

                    }, function(error){
                        this.locationsLoadingIndicator = false

                    })
                },
                calculatePageNumber: function (i, currentPage, paginationRange, totalPages) {
                    var halfWay = Math.ceil(paginationRange/2);
                    if (i === paginationRange) {
                        return totalPages;
                    } else if (i === 1) {
                        return i;
                    } else if (paginationRange < totalPages) {
                        if (totalPages - halfWay < currentPage) {
                            return totalPages - paginationRange + i;
                        } else if (halfWay < currentPage) {
                            return currentPage - halfWay + i;
                        } else {
                            return i;
                        }
                    } else {
                        return i;
                    }
                }
            },
            filters: {
                paginate: function (list) {
                    this.resultCount = list.length
                    if (this.currentPage >= this.totalPages) {
                        this.currentPage = this.totalPages - 1
                    }
                    var index = (this.currentPage - 1) * this.itemsPerPage
                    return list.slice(index, index + this.itemsPerPage)
                }
            }
        })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({ cache: false });
        $countrySelectionLoader = $('#countrySelectionLoader');
        $countrySelectionText = $('#countrySelectionText');
        $countrySelectionButton = $('#countrySelectionButton');
        var locations = [];

        $('.country.dropdown')
                .dropdown({
                    onChange: function (value, text, $selectedItem) {
                        locations = [];


                        $countrySelectionLoader.addClass('active');
                        var jxhr = [];
                        $.getJSON('http://api.geonames.org/childrenJSON?username=demo&geonameId=' + value, function(response){

                            if(response.status) {
                                $countrySelectionText.html('No locations were found in ' + text)
                                $countrySelectionLoader.removeClass('active');


                            } else {

                                if(response.geonames.length > 0) {
                                    $.each(response.geonames, function(index, item){
                                        jxhr.push(
                                                $.getJSON('http://api.geonames.org/childrenJSON?username=demo&geonameId='+ item.geonameId, function (locationResponse) {
                                                    if(locationResponse.geonames) {
                                                        locations = $.merge(locations, locationResponse.geonames)

                                                    }
                                                })
                                        );
                                    })

                                    $.when.apply($, jxhr).done(function() {
                                        $countrySelectionLoader.removeClass('active');
                                        if(locations.length > 0) {
                                            $countrySelectionText.html(locations.length + ' locations were found in ' + text)
                                            $countrySelectionButton.removeClass('concealed');

                                        } else {
                                            $countrySelectionText.html('No locations were found in ' + text)

                                        }

                                    });
                                } else {
                                    $countrySelectionText.html('No locations were found in ' + text)

                                }

                            }



                        }).error(function(status){
                            $countrySelectionLoader.removeClass('active');
                            alertify.error("Couldn't retrieve " + text + "'s location list")
                        });
                    }
                });

        function parseLocationsData(locations) {

            locationdata = []
            $.each(locations, function(index, location){
                locationdata.push({
                    name: location.name,
                    latitude: location.lat,
                    longitude: location.lng,
                    parentName: location.countryName,
                    geonameid: location.geonameId


                })
            })

            return locationdata;
        }


        $countrySelectionButton.on('click', function(e){
            e.preventDefault();
            if(locations.length > 0) {
                $countrySelectionLoader.addClass('active');

                Vue.http.post("{{route('admin.locations.store')}}", JSON.stringify(parseLocationsData(locations)), function(response) {
                    alertify.success(locations.length + 'locations added successfully');
                    $countrySelectionText.html('');
                    $countrySelectionButton.addClass('concelaled');
                    $countrySelectionLoader.removeClass('active');
                    cities = [];
                    vm.refreshLocations()
                }, function(errorResponse){
                    console.dir(errorResponse)
                    alertify.error(errorResponse.error)
                })
            } else {
                $countrySelectionText.html('No locations were found in ' + text)

            }
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function () {

            var GoogleParser = {

                isObject: function (a) {
                    if ((typeof a === "object") && (a !== null)) {
                        return true
                    }

                    return false;
                },

                isGooglePlace: function (place) {
                    if (!place)
                        return false;
                    return !!place.place_id;
                },


                getAddrComponent: function (place, componentTemplate) {
                    var result;
                    if (!this.isGooglePlace(place))
                        return;
                    for (var i = 0; i < place.address_components.length; i++) {
                        var addressType = place.address_components[i].types[0];
                        if (componentTemplate[addressType]) {
                            result = place.address_components[i][componentTemplate[addressType]];
                            return result;
                        }
                    }
                    return;
                },
                getPlaceId: function (place) {
                    if (!this.isGooglePlace(place))
                        return;
                    return place.place_id;
                },

                getStreetNumber: function (place) {
                    var COMPONENT_TEMPLATE = {street_number: 'short_name'},
                            streetNumber = this.getAddrComponent(place, COMPONENT_TEMPLATE);
                    return streetNumber;
                },

                getStreet: function (place) {
                    var COMPONENT_TEMPLATE = {route: 'long_name'},
                            street = this.getAddrComponent(place, COMPONENT_TEMPLATE);
                    return street;
                },

                getCity: function (place) {
                    var COMPONENT_TEMPLATE = {locality: 'long_name'},
                            city = this.getAddrComponent(place, COMPONENT_TEMPLATE);
                    return city;
                },

                getState: function (place) {
                    var COMPONENT_TEMPLATE = {administrative_area_level_1: 'short_name'},
                            state = this.getAddrComponent(place, COMPONENT_TEMPLATE);
                    return state;
                },

                getCountryShort: function (place) {
                    var COMPONENT_TEMPLATE = {country: 'short_name'},
                            countryShort = this.getAddrComponent(place, COMPONENT_TEMPLATE);
                    return countryShort;
                },

                getCountry: function (place) {
                    var COMPONENT_TEMPLATE = {country: 'long_name'},
                            country = this.getAddrComponent(place, COMPONENT_TEMPLATE);
                    return country;
                },

                isGeometryExist: function (place) {
                    return this.isObject(place) && this.isObject(place.geometry);
                },

                getLatitude: function (place) {
                    if (!this.isGeometryExist(place)) return;
                    return place.geometry.location.A || place.geometry.location.lat;
                },

                getLongitude: function (place) {
                    if (!this.isGeometryExist(place)) return;
                    return place.geometry.location.F || place.geometry.location.lng;
                }
            }

            $singleLocationResult = $('.ui.segment.singlelocation');
            $locationIcon = $('#locationicon');
            $locationText = $('#locationtext');
            $locationDesc = $('#locationdescription');

            var singleLocationResult = {}

            $addToLocation = $('#addToLocation');

            $.fn.search.settings.templates.category = function (response) {
                var
                        html = '',
                        escape = $.fn.search.settings.templates.escape
                        ;
                if (response.results !== undefined) {
                    // each category
                    $.each(response.results, function (index, category) {
                        if (category.results !== undefined && category.results.length > 0) {
                            html += ''
                            + '<div class="category">'
                            + '<div class="name">' + '<i class="' + category.icon + ' flag"></i>' + category.name + '</div>'
                            ;
                            // each item inside category
                            $.each(category.results, function (index, result) {
                                html += '<div class="result">';
                                if (result.url) {
                                    html += '<a href="' + result.url + '"></a>';
                                }
                                if (result.image !== undefined) {
                                    result.image = escape(result.image);
                                    html += ''
                                    + '<div class="image">'
                                    + ' <img src="' + result.image + '" alt="">'
                                    + '</div>'
                                    ;
                                }
                                html += '<div class="content">';
                                if (result.price !== undefined) {
                                    result.price = escape(result.price);
                                    html += '<div class="price">' + result.price + '</div>';
                                }
                                if (result.title !== undefined) {
                                    result.title = escape(result.title);
                                    html += '<div class="title">' + result.title + '</div>';
                                }
                                if (result.description !== undefined) {
                                    html += '<div class="description">' + result.description + '</div>';
                                }
                                html += ''
                                + '</div>'
                                + '</div>'
                                ;
                            });
                            html += ''
                            + '</div>'
                            ;
                        }
                    });
                    if (response.action) {
                        html += ''
                        + '<a href="' + response.action.url + '" class="action">'
                        + response.action.text
                        + '</a>';
                    }
                    return html;
                }
                return false;
            },


                    $('.ui.google.search')
                            .search({
                                type: 'category',
                                minCharacters: 3,
                                onSelect: function (result) {
                                    singleLocationResult ={
                                        name: result.title,
                                        latitude: result.latitude,
                                        longitude: result.longitude,
                                        parentName: result.country,
                                        geonameid: result.id

                                    }

                                    $singleLocationResult.show()
                                    $locationIcon.removeClass()
                                    $locationIcon.addClass(result.icon + ' flag')
                                    $locationText.html(result.title)
                                    $locationDesc.html(
                                            '<ul class="ui list">' +
                                                    '<li><strong>Latitude:</strong> '+ result.latitude + '</li>'+
                                                    '<li><strong>Longitude:</strong> '+ result.longitude + '</li>'+
                                            '</ul>'
                                    )

                                },
                                searchDelay:	500,
                                apiSettings: {
                                    onResponse: function (googleResponse) {
                                        var response = {
                                            results: {}
                                        };
                                        // translate github api response to work with search
                                        $.each(googleResponse.results, function (index, item) {
                                            var
                                                    countryCategory = GoogleParser.getCountry(item) || 'Unknown',
                                                    maxResults = 8
                                                    ;
                                            if (index >= maxResults) {
                                                return false;
                                            }
                                            // create new countryCategory category
                                            if (response.results[countryCategory] === undefined) {
                                                response.results[countryCategory] = {
                                                    name: countryCategory,
                                                    icon: GoogleParser.getCountryShort(item),
                                                    results: []
                                                };
                                            }
                                            // add result to category
                                            response.results[countryCategory].results.push({
                                                title: item.formatted_address,
                                                description: item.description,
                                                latitude: GoogleParser.getLatitude(item),
                                                longitude: GoogleParser.getLongitude(item),
                                                icon: GoogleParser.getCountryShort(item),
                                                country: GoogleParser.getCountry(item) || 'Unknown'

                                            });
                                        });
                                        return response;
                                    },
                                    url: 'https://maps.googleapis.com/maps/api/geocode/json?address={query}'
                                }
                            })

            $addToLocation.on('click', function(e){
                e.preventDefault()
                $singleLocationResult.addClass('loader')
                Vue.http.post("{{route('admin.locations.store')}}", JSON.stringify([singleLocationResult]), function(response) {
                    alertify.success(singleLocationResult.name + ' added successfully');
                    $countrySelectionButton.addClass('concelaled');
                    $singleLocationResult.removeClass('loader')
                    $singleLocationResult.hide()


                    vm.refreshLocations()
                }, function(errorResponse){
                    console.dir(errorResponse)
                    alertify.error(errorResponse.error)
                })
            })
        });


    </script>






@endsection