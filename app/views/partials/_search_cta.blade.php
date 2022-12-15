<div class="row padding-reset">
    <div class="column padding-reset">
        <div class="ui large message cta">
            @if(Route::is('pages.homepage'))
                <div class="p-md">
                    <h1 class="ui huge centered-text inverted header ">
                        {{trans('phrases.search_cta_heading')}}
                        <div class="inverted sub header">
                            {{trans('phrases.search_cta_subheading')}}

                        </div>
                    </h1>
                </div>
            @endif

            <div class="ui center aligned text container">
                <form class="ui huge form" action="{{route('items.search')}}" method="GET">

                    <div class="fields">
                        <div class="eight wide field p-r-none">
                            <div class="ui right action left icon input">
                                <i class="search icon"></i>
                                {{Form::text('query', Input::get('query'), ['placeholder'=>trans('phrases.search_cta_placeholder')])}}
                            </div>

                        </div>

                        <div class="eight wide field p-l-none">

                            <div class="ui action input">

                                {{Form::select('location_id', ['any' => trans('phrases.any_location')] + $locations->lists('name', 'id') , Input::get('location_id'),  ['class' => 'ui fluid search dropdown'])}}

                                <button type="submit" class="ui teal button">
                                    {{trans('words.search')}}
                                </button>
                            </div>

                        </div>

                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

