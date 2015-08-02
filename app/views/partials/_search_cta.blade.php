
<div class="row padding-reset">
    <div class="column padding-reset">
        <div class="ui large message cta">
            @if(Route::is('pages.homepage'))
            <div class="p-md">
                <h1 class="ui huge centered-text inverted header ">
                    Buy what you want
                    <div class="inverted sub header">Sell what you don't use.
                        It's free and with no commission</div>
                </h1>
            </div>
            @endif

            <div class="ui center aligned text container">
                    <form class="ui huge form" action="{{route('items.search')}}" method="GET">

                        <div class="fields">
                            <div class="eight wide field p-r-none">
                                <div class="ui right action left icon input">
                                    <i class="search icon"></i>
                                    {{Form::text('query', Input::get('query'), ['placeholder'=>"What are you looking for"])}}
                                    </div>

                            </div>

                            <div class="eight wide field p-l-none">

                                <div class="ui action input">

                                    {{Form::select('location_id', ['any' => 'Any location'] + $locations->lists('name', 'id') , Input::get('location_id'),  ['class' => 'ui fluid search dropdown'])}}
                                    {{--<select name="location_id" class="ui fluid search dropdown">--}}
                                        {{--<option value="any">Any location</option>--}}
                                        {{--@foreach($locations as $location)--}}
                                            {{--<option value="{{$location->id}}"> <i class="marker icon"></i> {{$location->name}}</option>--}}

                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    <button type="submit" class="ui teal button">
                                        Search
                                    </button>
                                </div>

                            </div>

                        </div>
                    </form>
            </div>


        </div>
    </div>
</div>

