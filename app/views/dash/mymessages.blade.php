@extends('layouts.public')

@section('title')
    {{Lang::choice('words.message',2)}} - {{trans('phrases.my_messages')}}
@endsection

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                @include('partials._user_sidebar')
            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <h3 class="ui header">
                            <i class="mail icon"></i>
                            {{trans('phrases.my_messages')}}
                        </h3>
                    </div>
                    <div class="ui segment">
                        <div class="ui pointing secondary menu">
                            <a class="item {{$message_filter==null?'active':''}}"
                               href="{{route('dash.mymessages')}}">{{trans('words.all')}}</a>
                            <a class="item {{$message_filter=='read'?'active':''}}"
                               href="{{route('dash.mymessages', 'read')}}">{{trans('phrases.read_messages')}}</a>
                            <a class="item {{$message_filter=='unread'?'active':''}}"
                               href="{{route('dash.mymessages', 'unread')}}">{{trans('phrases.unread_messages')}}</a>
                        </div>
                    </div>
                    <div class="ui  segment">


                        @if(count($messages) < 1)
                            <div class="ui message">
                                {{trans('phrases.user_no_messages')}}
                            </div>

                        @else
                            <div class="ui divided items">

                                @foreach($messages as $message)
                                    <div class="item">
                                        <div class="image">
                                            <img src="{{asset($message->item->mainThumbnail())}}">
                                        </div>
                                        <div class="content">
                                            <a class="header">{{$message->item->title}}</a>

                                            <div class="meta">
                                                <span><strong>{{trans('words.from')}}:</strong></span>

                                            <span class="category">
                                                <i class="user icon"></i>{{$message->name}}
                                            </span>

                                                 <span class="location">
                                                <i class="mail icon"></i>{{$message->email}}
                                            </span>

                                                <span class="date">
                                                <i class="teal calendar icon"></i> {{$message->created_at->format('M j, Y g:i A')}}
                                            </span>


                                            </div>
                                            <div class="description">
                                                <p>{{$message->content}}</p>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @endif


                    </div>
                    <div class="ui segment">
                        {{$messages->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection