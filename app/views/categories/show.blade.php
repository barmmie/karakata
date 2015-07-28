@extends('layouts.public')

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                @include('partials._category_sidebar')



            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                            <div class="ui breadcrumb">
                                <a class="section" href="{{route('pages.homepage')}}">Home</a>
                                <i class="right angle icon divider"></i>
                                <a class="section {{$sub_category? '': 'active'}}" href="{{route('categories.show', $parent_category->slug)}}">{{$parent_category->title}}</a>
                                @if($sub_category)
                                    <i class="right angle icon divider"></i>
                                    <div class="active section">{{$sub_category->title}}</div>
                                @endif
                            </div>
                    </div>
                    <div class="ui segment">
                        <div class="ui advanced_filter accordion">
                            <div class="title">
                                <i class="dropdown icon"></i>
                                Show advanced filter options
                            </div>
                            <div class="content">
                                <div class="ui floating dropdown labeled icon button">
                                    <i class="filter icon"></i>
                                    <span class="text">Filter Posts</span>
                                    <div class="menu">
                                        <div class="ui icon search input">
                                            <i class="search icon"></i>
                                            <input type="text" placeholder="Search tags...">
                                        </div>
                                        <div class="divider"></div>
                                        <div class="header">
                                            <i class="tags icon"></i>
                                            Tag Label
                                        </div>
                                        <div class="scrolling menu">
                                            <div class="item">
                                                <div class="ui red empty circular label"></div>
                                                Important
                                            </div>
                                            <div class="item">
                                                <div class="ui blue empty circular label"></div>
                                                Announcement
                                            </div>
                                            <div class="item">
                                                <div class="ui black empty circular label"></div>
                                                Cannot Fix
                                            </div>
                                            <div class="item">
                                                <div class="ui purple empty circular label"></div>
                                                News
                                            </div>
                                            <div class="item">
                                                <div class="ui orange empty circular label"></div>
                                                Enhancement
                                            </div>
                                            <div class="item">
                                                <div class="ui empty circular label"></div>
                                                Change Declined
                                            </div>
                                            <div class="item">
                                                <div class="ui yellow empty circular label"></div>
                                                Off Topic
                                            </div>
                                            <div class="item">
                                                <div class="ui pink empty circular label"></div>
                                                Interesting
                                            </div>
                                            <div class="item">
                                                <div class="ui green empty circular label"></div>
                                                Discussion
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui floating labeled icon dropdown button">
                                    <i class="sort icon"></i>
                                    <span class="text">Filter</span>
                                    <div class="menu">
                                        <div class="header">
                                            <i class="tags icon"></i>
                                            Filter by tag
                                        </div>
                                        <div class="divider"></div>
                                        <div class="item">
                                            <i class="attention icon"></i>
                                            Important
                                        </div>
                                        <div class="item">
                                            <i class="comment icon"></i>
                                            Announcement
                                        </div>
                                        <div class="item">
                                            <i class="conversation icon"></i>
                                            Discussion
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="ui  segment">


                        @if(count($items) < 1)
                            <div class="ui message">
                                There are no currently no items in this category.
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
                                            <span class="date">
                                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category">
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
                    @if(count($items) > 10)



                        <div class="ui secondary segment">
                            {{$items->links()}}

                        </div>
                    @endif
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
    </script>
@endsection