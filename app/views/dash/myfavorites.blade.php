@extends('layouts.public')
@section('title')
    {{trans('words.dashboard')}} - {{trans('phrases.liked_items')}}
@endsection

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                @include('partials._user_sidebar')


            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui  segment">
                        <h3 class="ui dividing header">
                            <i class="red heart icon"></i>
                            {{trans('phrases.liked_items')}}
                        </h3>

                        @if(count($items) < 1)
                            <div class="ui message">
                                {{trans('phrases.user_no_favorites')}}
                            </div>

                        @else
                            <div class="ui divided items">

                                @foreach($items as $item)
                                    <div class="item">

                                        <div class="ui small bordered rounded image">
                                            <a class="ui brown ribbon label">{{Setting::get('currency', '£')}} {{$item->amount}}</a>

                                            <a class="ui right corner label">
                                                <i class="camera icon"></i>
                                                <i class=" corner icon">{{count($item->pictures)}}</i>
                                            </a>
                                            <img src="{{asset($item->mainThumbnail())}}">
                                        </div>
                                        <div class="content">

                                            <a class="header"
                                               href="{{route('items.show', $item->slug)}}">{{$item->title}}</a>

                                            <div class="meta">
                                            <span class="date m-b-xs">
                                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category m-b-xs">
                                                <i class="minus icon"></i>{{$item->category->title}}<i
                                                        class="minus icon"></i>
                                            </span>
                                             <span class="location">
                                                <i class="teal marker icon"></i>{{$item->location->name}}
                                            </span>

                                            </div>
                                            <div class="description">
                                                <p></p>
                                            </div>
                                            <div class="extra">
                                                <a class="ui right floated red small button"
                                                   href="{{route('items.unfavorite', $item->id)}}">
                                                    <i class="cancel icon"></i>
                                                    {{trans('phrases.remove_from_favorites')}}
                                                </a>
                                                @if($item->negotiable)
                                                    <div class="ui brown tag label">{{trans('words.negotiable')}}</div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @endif


                    </div>

                    <div class="ui segment">
                        {{$items->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection