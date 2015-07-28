@extends('layouts.public')

@section('content')
    @include('partials._search_cta')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">



            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <div class="ui breadcrumb">
                            <a class="section" href="{{route('pages.homepage')}}">Home</a>
                            <i class="right angle icon divider"></i>
                            <div class="section"> Search : '{{Input::get('query')}}'</div>

                            <i class="right arrow icon divider"></i>
                            <div class="active section">{{$item_count}} result(s)</div>
                        </div>
                    </div>
                    <div class="ui segment">
                        <div class="ui advanced_filter styled fluid accordion">
                            <div class="title {{Input::has('filtered') ?'active':''}}">
                                <i class="dropdown icon"></i>
                                Show advanced filter options
                            </div>
                            <div class="content {{Input::has('filtered') ?'active':''}}">
                                <form action="" method="GET" class="ui form">
                                    {{Form::hidden('filtered', true)}}
                                    {{Form::hidden('query', Input::get('query'))}}
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


                    </div>

                    <div class="ui padded segment">


                        @if(count($items) < 1)
                            <div class="ui message">
                                <div class="header">

                                </div>
                                There are no currently no items in this category.
                                @if(Input::has('filtered'))
                                    <p>Consider modifying your filters perhaps?</p>
                                @endif
                            </div>
                        @else
                            <div class="ui divided items">

                                @foreach($items as $item)
                                    <div class="item">

                                        <div class="ui small bordered rounded image">
                                            <a class="ui brown ribbon label">£ {{$item->amount}}</a>

                                            <a class="ui right corner label">
                                                <i class="camera icon"></i>
                                                <i class=" corner icon">{{count($item->pictures)}}</i>

                                            </a>
                                            <img src="{{asset($item->mainThumbnail())}}">
                                        </div>
                                        <div class="content">

                                            <a class="header">{{$item->title}}</a>
                                            <div class="meta">
                                            <span class="date m-b-xs">
                                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category m-b-xs">
                                                <i class="minus icon"></i>{{$item->category->title}}<i class="minus icon"></i>
                                            </span>
                                             <span class="location">
                                                <i class="teal marker icon"></i>{{$item->location->name}}
                                            </span>

                                            </div>
                                            <div class="description">
                                                <p></p>
                                            </div>
                                            <div class="extra">
                                                {{--<a class="ui right floated button" href="{{route('items.edit', $item->id)}}">--}}
                                                {{--<i class="pencil icon"></i>--}}

                                                {{--Edit--}}
                                                {{--</a>--}}
                                                {{--<div class="ui brown tag label"></div>--}}

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @endif



                    </div>

                        <div class="ui segment">
                            {{$items->appends(Input::all())->links()}}

                        </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.ui.advanced_filter.accordion').accordion();
        });

        $('.ui.form').form();


    </script>
@endsection