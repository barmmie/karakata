@extends('layouts.public')

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                @include('partials._category_sidebar')



            </div>

            <div class="twelve wide column">
                <div class="ui segments">

                    <div class="ui  segment">
                        <h3 class="ui dividing header">
                            <div class="ui breadcrumb">
                                <a class="section" href="{{route('pages.homepage')}}">Home</a>
                                <i class="right angle icon divider"></i>
                                <a class="section {{$sub_category? '': 'active'}}" href="{{route('categories.show', $parent_category->slug)}}">{{$parent_category->title}}</a>
                                @if($sub_category)
                                <i class="right angle icon divider"></i>
                                <div class="active section">{{$sub_category->title}}</div>
                                @endif
                            </div>
                        </h3>

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

                        {{$items->links()}}
                        <div class="ui secondary segment">
                            <div class="ui pagination menu">
                                <a class="active item">
                                    1
                                </a>
                                <div class="disabled item">
                                    ...
                                </div>
                                <a class="item">
                                    10
                                </a>
                                <a class="item">
                                    11
                                </a>
                                <a class="item">
                                    12
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection