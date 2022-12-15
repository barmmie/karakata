@extends('layouts.public')

@section('title')
    {{trans('phrases.items_by')}} {{$user->full_name}}
@endsection

@section('content')
    @include('partials._search_cta')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                <div class="ui content">
                    <div class="ui card">
                        <div class="image">
                            <img src="{{gravatar($user->email, 200)}}">
                        </div>
                        <div class="content">
                            <a href="{{route('users.show', $user->id)}}" class="header">{{$user->full_name}}</a>

                            <div class="meta">
                                <span class="date">{{trans('phrases.joined_in')}} {{$user->created_at->format('M, j Y')}}</span>
                            </div>

                        </div>
                        <div class="content">
                            <div class="p-b-sm">
                                <div class="ui star rating myrating" data-rating="{{(int)$user->rating()}}" max-rating="5"></div>
                                <p>
                                    {{trans('words.rating')}}: {{$user->rating()}} - <a href="{{route('users.reviews', $user->id)}}">{{count($user->reviews)}} {{trans('words.reviews')}}</a>
                                </p>

                            </div>
                            <a class="ui button" href="{{route('users.reviews', $user->id)}}">{{trans('phrases.leave_review')}}</a>

                        </div>

                        <div class="extra content">
                            <a>
                                <i class="file icon"></i>
                                {{$item_count}} {{Lang::choice('words.item', $item_count)}}
                            </a>
                            <a>

                            </a>
                        </div>
                    </div>
                </div>


                <div class="ui segment">
                    @include('widgets._popular_categories')
                </div>

                <div class="ui segment">
                    @include('widgets._recent_items')
                </div>


            </div>

            <div class="twelve wide column">
                <div class="ui segments">

                    <div class="ui segment">
                        <h4 class="header">
                            <i class="icon"></i> {{trans('phrases.items_by')}} {{$user->full_name}}

                        </h4>

                    </div>

                    <div class="ui padded segment">


                        @if(count($items) < 1)
                            <div class="ui message">
                                <div class="header">

                                </div>
                                {{trans('phrases.user_has_no_items')}}
                            </div>
                        @else
                            <div class="ui divided items">

                                @foreach($items as $item)
                                    @include('partials._item')
                                @endforeach
                            </div>

                        @endif


                    </div>

                        @if($items->getTotal() > 10)
                        <div class="ui segment">
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
        $(document).ready(function () {
            $('.ui.advanced_filter.accordion').accordion();
        });

        $('.ui.form').form();

        $('.ui.myrating').rating({
            maxRating: 5,
            interactive: false
        });


    </script>
@endsection