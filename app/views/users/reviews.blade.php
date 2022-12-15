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
                            <a href="{{route('users.show', $user->id )}}" class="header">{{$user->full_name}}</a>

                            <div class="meta">
                                <span class="date">{{trans('phrases.joined_in')}} {{$user->created_at->format('M, j Y')}}</span>
                            </div>

                        </div>
                        @if(count($reviews))

                        <div class="extra content">
                            <div class="ui star rating myrating" data-rating="{{(int)$user->rating()}}"></div> - {{$user->rating()}} - {{count($user->reviews)}} {{trans('words.reviews')}}

                        </div>
                        @endif

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
                            <i class="icon"></i> {{trans('words.reviews')}} :: {{$user->full_name}}
                        </h4>
                    </div>
                    <div class="ui segment">

                        @if(Auth::check())
                            @if(Auth::user()->reviewed($user->id))
                                <div class="ui message">
                                    {{trans('phrases.already_reviewed')}}

                                </div>
                            {{--@elseif(Auth::id() == $user->id)--}}

                            @else
                                @include('partials._form_errors')
                                {{Form::open(['route'=>['users.post_review', $user->id], 'class'=>'ui form attached', 'novalidate' => 'novalidate'])}}

                                <div class="two fields">
                                    <div class="required six wide field">
                                        <label for="">{{trans('words.rating')}}</label>
                                        {{Form::hidden('rating', null, ['id' => 'review_rating'])}}
                                        <div class="ui massive star rating" data-rating="0" data-max-rating="5"></div>

                                    </div>
                                    <div class="ten wide field">
                                        <label for="">{{trans('phrases.leave_review')}}</label>
                                        {{Form::textarea('comment', null)}}


                                    </div>
                                </div>
                                <button class="ui teal button right labeled icon button" tabindex="0">
                                    <i class="save icon"></i>{{trans('phrases.add_review')}}</button>
                                {{Form::close()}}
                            @endif

                        @else
                            <div class="ui message">
                                {{trans('phrases.login_to_review')}}. <a href="{{route('users.login')}}">{{trans('phrases.sign_in_copy', ['site_name' => Setting::get('sitename')])}}</a>

                            </div>

                        @endif

                    </div>

                    <div class="ui padded segment">


                        @if(count($reviews) < 1)
                            <div class="ui message">
                                <div class="header">

                                </div>
                                {{trans('phrases.user_has_no_reviews')}}
                            </div>
                        @else
                            <div class="ui divided items">
                                @foreach($reviews as $review)
                                    <div class="item">
                                        <div class="ui tiny image">
                                            <img src="{{gravatar($review->author->email)}}">
                                        </div>
                                        <div class="content">
                                            <a class="header">{{$review->author->full_name}}</a> -  <span class="cinema">{{$review->created_at->toDayDateTimeString()}}</span>
                                            <div class="meta">
                                                <div class="ui star rating myrating" data-rating="{{$review->rating}}"></div>

                                            </div>
                                            <div class="description">
                                                {{$review->comment}}
                                            </div>
                                        </div>
                                    </div>
                                <div class="item">

                                </div>

                                @endforeach
                            </div>

                        @endif


                    </div>

                    @if($reviews->getTotal() > 10)
                        <div class="ui segment">
                            {{$reviews->links()}}

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
        $('.ui.rating')
                .rating({
                    initialRating: 0,
                    maxRating: 5,
                    onRate: function(rate) {
                        $('#review_rating').val(rate)
                    }
                })
        ;

        $('.ui.myrating').rating('disable')
        $('.ui.form').form();


    </script>
@endsection