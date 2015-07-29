<div class="ui advanced_filter styled fluid accordion">
    <div class="title {{Input::has('filtered') ?'active':''}}">
        <i class="dropdown icon"></i>
        Show advanced filter options
    </div>
    <div class="content {{Input::has('filtered') ?'active':''}}">
        <form action="" method="GET" class="ui form">
            {{Form::hidden('filtered', true)}}
            <div class="ui floating dropdown labeled icon button m-b-xs">
                {{Form::hidden('location_id', Input::get('location_id'))}}
                <i class="filter icon"></i>
                <span class="text">Filter by location</span>
                <div class="menu">
                    <div class="ui icon search input">
                        <i class="search icon"></i>
                        <input type="text" placeholder="Search locations...">
                    </div>
                    <div class="divider"></div>
                    <div class="header">
                        <i class="location arrow icon"></i>
                        Locations
                    </div>
                    <div class="scrolling menu">
                        @foreach($locations as $location)
                            <div class="item" data-value="{{$location->id}}">
                                <i class="marker icon"></i>
                                {{$location->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="ui floating labeled icon dropdown button m-b-xs">
                {{Form::hidden('price_sort', Input::get('price_sort'))}}
                <i class="sort icon"></i>
                <span class="text">Sort by</span>
                <div class="menu">
                    <div class="header">
                        <i class="currency icon"></i>
                        Sort by price/amount
                    </div>
                    <div class="divider"></div>
                    <div class="item" data-value="asc">
                        <i class="sort ascending icon"></i>
                        Price lowest first
                    </div>
                    <div class="item" data-value="desc">
                        <i class="sort descending icon"></i>
                        Price highest first
                    </div>

                </div>
            </div>
            <button class="ui left labeled icon teal button m-b-xs">
                <i class="refresh icon"></i>
                Apply filters
            </button>

            <button class="ui left labeled icon basic button m-b-xs clear">
                <i class="remove icon"></i>
                Clear filters
            </button>
        </form>
    </div>
</div>