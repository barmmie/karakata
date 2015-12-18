@extends('layouts.admin')

@section('title')
    {{trans('phrases.manage_locations')}}
@endsection

@section('content')
    <div class="main ui container">
        <div class="ui stackable two column grid" id="locationList">
            <div class="six wide column">
                <div class="ui segments">
                    <div class="ui segment"><h4 class="ui header">{{trans('phrases.populate_from_country')}}</h4></div>
                    <div class="ui segment" id="countrySelection">
                        <div class="ui inverted dimmer" id="countrySelectionLoader">
                            <div class="ui indeterminate text loader">{{trans('phrases.fetching_locations')}}...</div>
                        </div>
                        <div class="content">
                            <div class="ui fluid search selection country dropdown">
                                <input type="hidden" name="country">
                                <i class="dropdown icon"></i>

                                <div class="default text">{{trans('phrases.select_country')}}</div>
                                @include('partials._country_list')
                            </div>

                            <div class="description p-sm" id="countrySelectionText">

                            </div>
                        </div>

                        <button class="ui concealed button " id="countrySelectionButton">
                            <i class="add icon"></i>
                            {{trans('phrases.add_them_to_locations')}}
                        </button>


                    </div>

                </div>
                <div class="ui segments">
                    <div class="ui segment">
                        <h4 class="ui header">
                            {{trans('phrases.add_location_manually')}}
                        </h4>
                    </div>
                    <div class="ui segment">
                        <form class="ui locationform form" method="POST" action="">

                            <div class="ui error message"></div>
                            <div class="field">
                                <label for="">{{trans('phrases.location_name')}}</label>
                                <input type="text" name="name" placeholder="{{trans('phrases.location_name')}}">
                            </div>

                            <div class="field">
                                <label for="">{{trans('phrases.country_name')}}</label>
                                <input type="text" name="parentName" placeholder="{{trans('phrases.country_name')}}">
                            </div>

                            <div class="field">
                                <label for="">{{trans('words.longitude')}}</label>
                                <input type="text" name="longitude" placeholder="{{trans('words.longitude')}}">
                            </div>

                            <div class="field">
                                <label for="">{{trans('words.latitude')}}</label>
                                <input type="text" name="latitude" placeholder="{{trans('words.latitude')}}">
                            </div>

                            <input type="submit" class="ui blue submit button" value="Save location"/>

                        </form>
                    </div>

                </div>
            </div>
            <div class="ten wide column">

                <div class="ui segments">
                    <div class="ui segment">
                        <h4 class="ui header">
                            {{trans('phrases.your_locations')}}
                        </h4>
                    </div>
                    <div class="ui segment">

                        <div class="ui left icon fluid input">
                            <input type="text" placeholder="{{trans('phrases.filter_location')}}..."
                                   v-model="searchKey">
                            <i class="marker icon"></i>
                        </div>
                    </div>
                    <div class="ui segment" v-class="loading:locationsLoadingIndicator">
                        <div class="ui middle aligned divided list">


                            <div class="item" v-repeat="location: locations|paginate | filterBy searchKey "
                                 track-by="id">
                                <div class="right floated content">
                                    <button class="ui icon button" v-on="click:remove(location)"><i
                                                class="cancel icon"></i>
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
                            <div class="header">No results found</div>
                        </div>

                        <div class="ui warning message" v-show="locations.length < 1">
                            <div class="header">{{trans('phrases.no_locations_setup')}}</div>
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
                incrementPageNumber: function (number) {
                    if (number === '...') {
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
                        i++;
                    }
                    return pages;
                }

            },
            methods: {
                setPage: function (pageNumber) {
                    if (pageNumber !== '...') {
                        this.currentPage = pageNumber
                    }
                },
                submitNewLocation: function (message, event) {
                    event.preventDefault()
                },
                remove: function (location) {
                    this.locationsLoadingIndicator = true;


                    this.$http.delete("{{route('admin.locations.index')}}/" + location.id, function (data) {

                        this.locationsLoadingIndicator = false;
                        this.locations.splice(this.locations.indexOf(location), 1)
                    })

                },
                refreshLocations: function () {
                    this.locationsLoadingIndicator = true;

                    this.$http.get("{{route('admin.locations.index')}}", function (data) {
                        this.$set('locations', data);
                        this.locationsLoadingIndicator = false

                    }, function (error) {
                        this.locationsLoadingIndicator = false

                    })
                },
                calculatePageNumber: function (i, currentPage, paginationRange, totalPages) {
                    var halfWay = Math.ceil(paginationRange / 2);
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
        $.ajaxSetup({cache: false});
        $countrySelectionLoader = $('#countrySelectionLoader');
        $countrySelectionText = $('#countrySelectionText')
        $countrySelectionButton = $('#countrySelectionButton')
        var locations = [];

        $('.country.dropdown')
                .dropdown({
                    onChange: function (value, text, $selectedItem) {
                        locations = [];


                        $countrySelectionLoader.addClass('active');
                        var jxhr = [];
                        $.getJSON('http://api.geonames.org/childrenJSON?username=karakata&geonameId=' + value, function (response) {

                            if (response.status) {
                                $countrySelectionText.html('No locations were found in ' + text)
                                $countrySelectionLoader.removeClass('active');

                            } else {

                                locations = response.geonames;

                                $countrySelectionLoader.removeClass('active');
                                if (locations.length > 0) {
                                    $countrySelectionText.html(locations.length + ' {{trans('phrases.locations_found_in')}} ' + text)
                                    $countrySelectionButton.removeClass('concealed');

                                } else {
                                    $countrySelectionText.html('{{trans('phrases.no_locations_found_in')}} ' + text)

                                }
                            }

                        }).error(function (status) {
                            $countrySelectionLoader.removeClass('active');
                            alertify.error("Couldn't retrieve " + text + "'s location list")
                        });
                    }
                });

        $locationform = $('.ui.form');

        $locationform.on('submit', function (e) {
            e.preventDefault();

        })

        $countrySelectionButton.on('click', function () {
            Vue.http.post("{{route('admin.locations.store')}}", parseLocationsData(locations), function (response) {
                alertify.success('{{trans('phrases.added_successfully')}} ');
                $locationform.removeClass('loading')
                $locationform.form('reset')

                vm.refreshLocations()
            }, function (errorResponse) {
                $locationform.removeClass('loading')

                alertify.error(errorResponse.error)
            })
        });


        $locationform.form({
            onSuccess: function (test) {
                var form_values = $locationform.form('get values');
                $countrySelectionLoader.addClass('active')
                Vue.http.post("{{route('admin.locations.store')}}", JSON.stringify([form_values]), function (response) {
                    alertify.success(form_values.name + ' {{trans('phrases.added_successfully')}} ');
                    $locationform.removeClass('active')

                    $locationform.form('reset')

                    vm.refreshLocations()
                }, function (errorResponse) {
                    $locationform.removeClass('active')

                    alertify.error(errorResponse.error)
                })

            },
            fields: {
                name: {
                    identifier: 'name',
                    rules: [
                        {
                            type: 'empty',
                            prompt: '{{trans('validation.required', ['attribute' => 'location name'])}}'

                        }
                    ]
                },
                parentName: {
                    identifier: 'parentName',
                    rules: [
                        {
                            type: 'empty',
                            prompt: '{{trans('validation.required', ['attribute' => 'country name'])}}'
                        }
                    ]
                },
                longitude: {
                    identifier: 'longitude',
                    rules: [
                        {
                            type: 'empty',
                            prompt: '{{trans('validation.required', ['attribute' => 'location longitude'])}}'
                        }
                    ]
                },
                latitude: {
                    identifier: 'latitude',
                    rules: [
                        {
                            type: 'empty',
                            prompt: '{{trans('validation.required', ['attribute' => 'location latitude'])}}'
                        }
                    ]
                }
            }
        })

        function parseLocationsData(locations) {

            locationdata = []
            $.each(locations, function (index, location) {
                locationdata.push({
                    name: location.name,
                    latitude: location.lat,
                    longitude: location.lng,
                    parentName: location.countryName,
                    geonameid: location.geonameId


                })
            })

            return JSON.stringify(locationdata);
        }


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


        });


    </script>






@endsection