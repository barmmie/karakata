@extends('layouts.public')

@section('title')
    {{Lang::choice('words.item',1)}} - {{$item->title}}
@endsection

@section('meta')
    <meta property="og:title" content="{{$item->title}}"/>
    <meta property="twitter:title" content="{{$item->title}}"/>
    <meta property="og:type" content="{{$item->category? $item->category->title: 'N/A'}}"/>
    <meta property="og:url" content="{{route('items.show', $item->slug)}}"/>
    <meta property="og:image" content="{{asset($item->mainThumbnail())}}"/>
    <meta property="twitter:image" content="{{asset($item->mainThumbnail())}}"/>
    <meta property="og:description" content="{{str_limit(strip_tags($item->description), 100)}}"/>
    <meta property="twitter:description" content="{{str_limit(strip_tags($item->description), 100)}}"/>
@endsection

@section('styles')
    @if(count($item->pictures) > 0)
        <link rel="stylesheet" href="{{asset('assets/bxslider-4/dist/jquery.bxslider.min.css')}}"/>
    @endif

    <style>
        #bx-pager {
            text-align: center;
            margin-top: -30px;
        }

        #bx-pager a {
            margin: 0 3px;
        }

        #bx-pager a img {
            padding: 3px;
            width: 100px;
            height: auto;
            border: solid #ccc 1px;
        }

        #bx-pager a.active img {
            border: solid #5280DD 1px;
        }
    </style>
@endsection

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">


            <div class="twelve wide column">


                <div class="ui segments">

                    <div class="ui segment">
                        @if($item->isPremium())

                            <div class="trap ribbon-wrap fl-right">
                                <div class="trap-ribbon">
                                    <a href="#"><i class="inverted circular star icon"></i> Premium </a>
                                </div>
                            </div>

                        @endif
                        <div class="ui breadcrumb">
                            <a class="section" href="{{route('pages.homepage')}}">{{trans('words.home')}}</a>
                            @if($item->category)
                                @if($item->category->parent && $item->category->parent->id !=1)
                                    <i class="right angle icon divider"></i>
                                    <a class="section"
                                       href="{{route('categories.show', $item->category->parent->slug)}}">{{$item->category->parent->title}}</a>
                                @endif
                                <i class="right angle icon divider"></i>
                                <a class="section "
                                   href="{{route('categories.show', $item->category->slug)}}">{{$item->category->title}}</a>
                            @endif


                        </div>

                    </div>

                    <div class="ui padded segment">

                        <h3 class="ui dividing header">
                            {{$item->title}}
                        </h3>

                            <div class="ui two column grid p-b-sm">
                                <div class="ten wide column">
                                    <div class="ui horizontal list">
                                        <div class="item">
                                            <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                        </div>

                                        <div class="item">
                                            <i class="teal marker icon"></i> {{$item->location? $item->location->name : 'N/A'}}
                                        </div>
                                    </div>
                                </div>
                                <div class="six wide column m-b-sm">
                                    <div style="float: right;">
                                        <a class="ui big  teal tag label">{{Setting::get('currency', '£')}} {{$item->amount}}</a>


                                    </div>

                                </div>
                            </div>





                        @if(count($item->pictures) > 0)


                            <ul class="bxslider">

                                @foreach($item->pictures as $picture)
                                    <li class="ui fluid bordered rounded image">
                                        <img alt="{{$picture->title}}" class="ui fluid bordered rounded image"
                                             src="{{asset($picture->image_src)}}">
                                    </li>
                                @endforeach
                            </ul>

                            <div id="bx-pager">
                                @foreach($item->pictures as $index => $picture)
                                    <a data-slide-index="{{$index}}" href=""><img alt="{{$item->title}}"
                                                                                  src="{{asset($picture->thumbnail_src)}}"/></a>
                                @endforeach

                            </div>
                        @else
                            <div class="ui fluid bordered rounded image">
                                <img style="max-height: 400px;" src="{{asset('images/no-image-default.png')}}" alt=""/>
                            </div>

                        @endif








                        <h4 class="ui horizontal divider header">
                            <i class="tag icon"></i>
                            {{trans('words.description')}}
                        </h4>

                        <div class="ui content">
                            <div class="ui stackable equal height stackable grid">
                                <div class="ten wide column">
                                    {{$item->description}}
                                </div>

                                <div class="six wide column">
                                    <div class="ui message m-b-lg">
                                        <ul class="ui list">
                                            <div class="item">
                                                <strong>{{trans('words.price')}}
                                                    :</strong> {{Setting::get('currency', '£')}} {{$item->amount}}
                                            </div>
                                            <div class="item">
                                                <strong>{{trans('words.negotiable')}}:</strong> <span><i
                                                            class="{{$item->negotiable? 'teal check': 'brown cancel'}} icon"></i></span>
                                            </div>
                                            <div class="item">
                                                <strong>{{Lang::choice('words.category', 1)}}
                                                    :</strong> {{$item->category?$item->category->title: 'N/A'}}
                                            </div>
                                            <div class="item">
                                                <strong>{{Lang::choice('words.location', 1)}}:</strong> <span><i
                                                            class="marker icon"></i>{{$item->location? $item->location->name : 'N/A'}}</span>
                                            </div>

                                            <div class="item">
                                                <strong>{{trans('phrases.posted_by')}}</strong>
                                                <span>{{($item->type == 'personal')? '<i class="user icon"></i>'.trans("words.individual") :  '<i class="suitcase icon"></i>'.trans("words.business")}}</span>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="ui middle aligned divided list">
                                        <div class="item">
                                            <i class="user icon"></i>

                                            <div class="content">
                                                <a class="header" href="{{route('users.items', $item->owner->id)}}">
                                                    {{trans('phrases.more_ads_by_user')}}
                                                </a>
                                            </div>
                                        </div>

                                        @if(Auth::check() && $item->favoriters->contains(Auth::user()->id))
                                            <div class="item">
                                                <i class="red heart icon"></i>

                                                <div class="content">
                                                    <a class="header nag-login"
                                                       href="{{route('items.unfavorite', $item->id)}}"
                                                       data-content="{{trans('phrases.login_required')}}">
                                                        {{trans('phrases.remove_from_favorites')}}
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="item">
                                                <i class="heart icon"></i>

                                                <div class="content">
                                                    <a class="header nag-login"
                                                       href="{{route('items.favorite', $item->id)}}"
                                                       data-content="{{trans('phrases.login_required')}}">
                                                        {{trans('phrases.add_to_favorites')}}
                                                    </a>
                                                </div>
                                            </div>

                                        @endif

                                        <div class="item">
                                            <i class="warning sign icon"></i>

                                            <div class="content">
                                                <a class="header report link">{{trans('phrases.report_abuse')}}</a>
                                            </div>
                                        </div>

                                    </div>
                                    <a class="header share-button">{{trans('phrases.share_on_social')}}</a>

                                </div>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="desktop-only">
                    @if(Setting::get('ad_leaderboard')!='')
                        {{Setting::get('ad_leaderboard')}}
                    @endif
                </div>

            </div>
            <div class="four wide column">

                <div class="ui segments">
                    <div class="ui secondary segment">
                        <h4 class="header">{{trans('phrases.contact_seller')}}</h4>
                    </div>
                    <div class="ui segment">
                        <h3 class="ui header">
                            <img src="{{gravatar($item->email)}}" class="ui circular image">
                            {{$item->seller_name}}
                            <div class="sub header">{{Lang::choice('words.location',1)}}
                                : {{$item->location?$item->location->name:'N/A'}}</div>
                            <div class="sub header">{{trans('phrases.joined_in')}}
                                : {{$item->owner->created_at->format('M j, Y')}}</div>
                        </h3>
                        <button class="fluid ui message button toggle m-b-xs">
                            <i class="mail icon"></i>
                            {{trans('phrases.send_a_message')}}
                        </button>
                        @if(Setting::get('mask_phone', '0')== '1')
                            <button class="fluid ui yellow button phone">
                                <i class="phone icon"></i> 0-XXX-XXX-XXX
                            </button>

                            <div class="masked-phone " style="display:none">
                                <a href="tel:{{$item->phone}}" class="fluid ui yellow button">
                                    <i class="phone icon"></i> {{$item->phone}}
                                </a>

                            </div>
                        @endif

                        @if(Setting::get('mask_phone', '0')== '0')
                            <a href="tel:{{$item->phone}}" class="fluid ui yellow button">
                                <i class="phone icon"></i> {{$item->phone}}
                            </a>
                        @endif


                    </div>
                    <div class="ui segment">
                            <div class="p-b-sm">
                                <div class="ui star rating myrating" data-rating="{{(int)$item->owner->rating()}}" max-rating="5"></div>
                                <p>
                                    {{trans('words.rating')}}: {{$item->owner->rating()}} - <a href="{{route('users.reviews', $item->owner->id)}}">{{count($item->owner->reviews)}} {{trans('words.reviews')}}</a>
                                </p>

                            </div>
                            <a class="ui button" href="{{route('users.reviews', $item->owner->id)}}">{{trans('phrases.leave_review')}}</a>

                    </div>
                </div>


                <div class="ui segments">
                    <div class="ui secondary segment">
                        <h4 class="header">Safety tips for buyers</h4>
                    </div>
                    <div class="ui segment">
                        <div class="ui list">
                            <div class="item"><i class="check circle icon"></i> Meet seller at a public place</div>
                            <div class="item"><i class="check circle icon"></i> Check the item before you buy</div>
                            <div class="item"><i class="check circle icon"></i> Pay only after collecting the item</div>
                        </div>
                    </div>
                </div>

                @if(Setting::get('ad_250')!='')
                    <div class="ui segment padding-reset">
                        {{Setting::get('ad_250')}}
                    </div>
                @endif

            </div>
        </div>


    </div>
    </div>



    {{--Modals--}}

    <div class="ui sendmessage modal">
        <i class="grey close icon"></i>

        <div class="header">
            {{trans('phrases.send_a_message')}} <i class="arrow right icon"></i> {{$item->seller_name}}
        </div>
        <div class="content">
            <form class="ui sendmessage form">
                <div class="ui error message"></div>

                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <label>{{trans('words.name')}}</label>
                            {{Form::text('name', Auth::check()?Auth::user()->full_name:'')}}

                        </div>
                        <div class="field">
                            <label>{{trans('words.email')}}</label>
                            {{Form::text('email', Auth::check()?Auth::user()->email:'')}}

                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>{{Lang::choice('words.message', 1)}}</label>

                    {{Form::textarea('content')}}
                </div>
                {{Form::hidden('item_id', $item->id)}}
            </form>
        </div>
        <div class="actions">
            <div class="ui button cancel">{{trans('words.cancel')}}</div>
            <div class="ui green button approve">{{trans('words.send')}}</div>
        </div>
    </div>

    <div class="ui report modal">
        <i class="grey close icon"></i>

        <div class="header">
            {{trans('phrases.report_abuse')}}
        </div>
        <div class="content">
            <form class="ui report form">
                <h4 class="ui dividing header">{{trans('phrases._report_abuse_copy')}}</h4>

                <div class="ui error message"></div>
                {{Form::hidden('item_id', $item->id)}}
                <div class="field">
                    <textarea name="content"></textarea>
                </div>
            </form>
        </div>
        <div class="actions">
            <div class="ui button cancel ">{{trans('words.cancel')}}</div>
            <div class="ui green button approve">{{trans('words.send')}}</div>
        </div>
    </div>


@endsection

@section('scripts')
    @if(count($item->pictures) > 0)
        <script src="{{asset('assets/bxslider-4/dist/jquery.bxslider.min.js')}}"></script>
    @endif
    <script src="{{asset('assets/share-button/build/share.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.advanced_filter.accordion').accordion();
        });

        @if(count($item->pictures) > 0)

        $('.bxslider').bxSlider({
            adaptiveHeight: true,
            pagerCustom: '#bx-pager'
        });

        @endif

        $('.ui.phone.button').on('click', function() {
                    $(this).hide();
                    $('div.masked-phone').show()
                })

                var $sendform = $('.ui.sendmessage.form')
        var $reportform = $('.ui.report.form')

        $sendform.form({
            fields: {
                name: {
                    identifier: 'name',
                    rules: [
                        {
                            type: 'length[3]',
                            prompt: '{{trans('validation.min.string', ['attribute' => 'name', 'min' => 3])}}'
                        }
                    ]
                },
                email: {
                    identifier: 'email',
                    rules: [
                        {
                            type: 'email',
                            prompt: '{{trans('validation.email', ['attribute' => 'email'])}}'
                        }
                    ]
                },
                content: {
                    identifier: 'content',
                    rules: [
                        {
                            type: 'empty',
                            prompt: '{{trans('validation.required', ['attribute' => 'content'])}}'
                        },
                        {
                            type: 'length[10]',
                            prompt: '{{trans('validation.min.string', ['attribute' => 'content', 'min' => 10])}}'

                        }
                    ]
                }
            }
        })
        ;

        $reportform.form({
            fields: {
                content: {
                    identifier: 'content',
                    rules: [
                        {
                            type: 'empty',
                            prompt: '{{trans('validation.required', ['attribute' => 'content'])}}'
                        },
                        {
                            type: 'length[10]',
                            prompt: '{{trans('validation.min.string', ['attribute' => 'content', 'min' => 10])}}'

                        }
                    ]
                }
            }
        })
        ;

        $messageModal = $('.sendmessage.modal');
        $reportModal = $('.report.modal');
        $messageModal.modal('attach events', '.message.button', 'show')
                .modal('setting', 'transition', 'fade up')
                .modal('setting', 'autofocus', 'true')
                .modal({
                    onApprove: function () {
                        $sendform.form('validate form')

                        if ($sendform.form('is valid')) {
                            var form_values = $sendform.form('get values')
                            $sendform.addClass('loading')
                            $.ajax({
                                method: 'POST',
                                data: form_values,
                                url: "{{route('messages.store')}}",
                                success: function (response) {
                                    $sendform.removeClass('loading')

                                    alertify.success(response.message);
                                    $sendform.form('reset');
                                    $messageModal.modal('hide');

                                },
                                error: function (xhr) {
                                    $sendform.removeClass('loading')
                                    alertify.error(xhr.responseJSON.message)
                                    $sendform.form('add errors', [xhr.responseJSON.message]);
                                    return false;
                                }
                            })
                        }

                        return false;
                    }
                })
        ;

        $reportModal.modal('attach events', '.report.link', 'show')
                .modal('setting', 'transition', 'fade up')
                .modal('setting', 'autofocus', 'true')
                .modal({
                    onApprove: function () {
                        $reportform.form('validate form')

                        if ($reportform.form('is valid')) {
                            var form_values = $reportform.form('get values')
                            $reportform.addClass('loading')
                            $.ajax({
                                method: 'POST',
                                data: form_values,
                                url: "{{route('reports.store')}}",
                                success: function (response) {
                                    $reportform.removeClass('loading')
                                    $reportform.form('reset')
                                    alertify.success(response.message);
                                    $reportModal.modal('hide');

                                },
                                error: function (xhr) {
                                    $reportform.removeClass('loading')
                                    alertify.error(xhr.responseJSON.message)
                                    $reportform.form('add errors', [xhr.responseJSON.message]);
                                    return false;
                                }
                            })
                        }

                        return false;
                    }
                })
        ;


        new Share(".share-button", {
            title: "{{$item->title}}",
            networks: {
                facebook: {
                    app_id: "{{Setting::get('facebook_app_id', 602752456409826)}}"
                }
            }
        });

        $('.ui.myrating').rating({
            maxRating: 5,
            interactive: false
        });


    </script>
@endsection