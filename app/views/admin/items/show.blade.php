@extends('layouts.admin')

@section('title')
    {{Lang::choice('item', 1)}} - {{$item->title}}
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
    <div class="main ui container">
        <div class="ui two column relaxed stackable grid">


            <div class="eleven wide column">
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
                                                <a class="header" href="{{route('admin.users.items', $item->owner->id)}}">
                                                    {{trans('phrases.more_ads_by_user')}}
                                                </a>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                </div>


            </div>
            <div class="five wide column">

                <div class="ui segments">
                    <div class="ui secondary segment">
                        <h4 class="header"> {{trans('phrases.contact_seller')}}</h4>
                    </div>
                    <div class="ui segment">
                        <h3 class="ui header">
                            <img src="{{gravatar($item->email)}}" class="ui circular image">
                            {{$item->seller_name}}
                            <div class="sub header m-b-xs"><strong>{{Lang::choice('words.location',1)}}
                                    :</strong> {{$item->location? $item->location->name : 'N/A'}}</div>
                            <div class="sub header m-b-xs">
                                <strong>{{trans('phrases.joined_in')}}</strong>: {{$item->owner->created_at->format('M j, Y')}}
                            </div>
                            <div class="sub header m-b-xs"><strong>{{trans('words.email')}}:</strong> {{$item->email}}
                            </div>
                            <div class="sub header"><strong>{{trans('words.phone')}}:</strong> {{$item->phone}}</div>
                        </h3>
                    </div>
                </div>

                <div class="ui segments">
                    <div class="ui secondary segment">
                        <h4 class="header">{{trans('words.actions')}}</h4>
                    </div>
                    <div class="ui segment">
                        @if(! $item->isRejected())
                            <a href="{{route('admin.items.reject', $item->id)}}" class="ui fluid m-b-xs orange button">
                                <i class="cancel icon"></i>

                                {{trans('words.reject')}}
                            </a>
                        @endif
                        @if(! $item->isApproved())
                            <a href="{{route('admin.items.approve', $item->id)}}"
                               class="ui fluid m-b-xs primary button">
                                <i class="check icon"></i>

                                {{trans('words.approve')}}
                            </a>
                        @endif

                        @if(!$item->isPremium())
                                <a href="{{route('admin.items.mark_premium', $item->id)}}"
                                   class="ui fluid m-b-xs purple button">
                                    <i class="star icon"></i>

                                    {{trans('phrases.mark_as_premium')}}
                                </a>
                        @endif
                        <a href="{{route('admin.items.delete', $item->id)}}"
                           class="ui fluid m-b-xs red button confirm-delete">
                            <i class="trash icon"></i>

                            {{trans('words.delete')}}
                        </a>

                    </div>
                </div>

                <div class="ui segments">
                    <div class="ui secondary segment">
                        <h4 class="header"><i class="warning sign icon"></i>{{trans('phrases.abuse_reports')}}</h4>
                    </div>
                    <div class="ui segment">
                        <div class="ui comments">
                            @if(count($reports) < 1)
                                {{trans('phrases.no_abuse_reports')}}
                            @endif
                            @foreach($reports as $report)
                                <div class="comment">
                                    <div class="content">
                                        <a class="author">{{$report->ip_address}}</a>

                                        <div class="metadata">
                                            <div class="date">{{$report->created_at->diffForHumans()}}</div>
                                            <div class="rating">
                                                <i class="star icon"></i>

                                            </div>
                                        </div>
                                        <div class="text">
                                            {{$report->message}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($reports->getTotal() >  $reports->getPerPage())

                        <div class="ui segment">

                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>
@endsection


@section('scripts')
    @if(count($item->pictures) > 0)
        <script src="{{asset('assets/bxslider-4/dist/jquery.bxslider.min.js')}}"></script>
    @endif
    <script src="{{asset('assets/share-button/build/share.min.js')}}"></script>

    <script type="text/javascript">

        @if(count($item->pictures) > 0)

        $('.bxslider').bxSlider({
            adaptiveHeight: true,
            pagerCustom: '#bx-pager'
        });

        @endif

        $('.pointing .item')
                .tab()
        ;

        $('.ui.dropdown').dropdown()
    </script>

@endsection