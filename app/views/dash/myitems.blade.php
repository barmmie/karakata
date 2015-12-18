@extends('layouts.public')

@section('title')
    {{trans('words.dashboard')}} - {{trans('phrases.my_items')}}
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
                            <i class="folder icon"></i>
                            {{trans('phrases.my_items')}}
                        </h3>

                        @if(count($items) < 1)
                            <div class="ui message">
                                {{trans('phrases.user_no_items')}}

                            </div>

                        @else
                            <div class="ui divided items">

                                @foreach($items as $item)
                                    <div class="item">
                                        <div class="image">
                                            <img src="{{asset($item->mainThumbnail())}}">
                                        </div>
                                        <div class="content">
                                            <a href="{{$item->isApproved()? route('items.show', $item->slug):'#'}}" class="header">{{$item->title}}</a>

                                            <div class="meta">
                                            <span class="date">
                                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category">
                                                <i class="minus icon"></i>{{$item->category->title}}<i
                                                        class="minus icon"></i>
                                            </span>
                                             <span class="location">
                                                <i class="teal marker icon"></i>{{$item->location->name}}
                                            </span>

                                            </div>
                                            <div class="description">

                                            </div>
                                            <div class="extra">

                                                <div class="ui brown tag label">{{Setting::get('currency', '£')}} {{$item->amount}}</div>
                                                @if($item->isApproved())
                                                    <div class="ui green label">{{trans('words.approved')}}</div>
                                                @endif

                                                @if($item->isPending())
                                                    <div class="ui yellow label">{{trans('phrases.pending_approval')}}</div>
                                                @endif

                                                @if($item->isRejected())
                                                    <div class="ui red label">{{trans('words.rejected')}}</div>
                                                @endif

                                                @if( $item->isPremium())
                                                    <div class="ui purple label">
                                                        <i class="inverted circular star icon">
                                                        </i>
                                                        {{trans('phrases.premium_until')}} {{\Carbon\Carbon::parse($item->premium_until)->toDayDateTimeString()}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="extra">

                                                <a class="ui right floated red tiny button"
                                                   href="{{route('items.delete', $item->id)}}">
                                                    <i class="trash icon"></i>
                                                    {{trans('words.delete')}}
                                                </a>

                                                <a class="ui right floated yellow tiny button"
                                                   href="{{route('items.edit', $item->id)}}">
                                                    <i class="pencil icon"></i>

                                                    {{trans('words.edit')}}
                                                </a>
                                                </div>
                                            @if(! $item->isPremium())
                                            <div class="extra">

                                                @if(Setting::get('allow_premium_payment', '0') == '1')

                                                <a class="ui right floated animated facebook fade button"
                                                   href="{{route('items.payment', $item->id)}}">
                                                    <div class="visible content">
                                                        <i class="big paypal card icon"></i>
                                                        {{trans('phrases.pay_for_premium')}}</div>
                                                    <div class="hidden content">
                                                        {{Setting::get('paypal_currency', 'USD')}}{{Setting::get('premium_amount', '10.00')}}
                                                        for {{Setting::get('premium_days', '40')}} day(s)
                                                    </div>
                                                </a>

                                                @endif

                                                @if(Setting::get('allow_stripe_premium_payment', '0') == '1')

                                                    <a class="ui right floated twitter animated fade button"
                                                       href="{{route('items.stripe_form', $item->id)}}">
                                                        <div class="visible content">
                                                            <i class="big stripe icon"></i>
                                                            {{trans('phrases.pay_for_premium')}}</div>
                                                        <div class="hidden content">
                                                            {{Setting::get('paypal_currency', 'USD')}}{{Setting::get('premium_amount', '10.00')}}
                                                            for {{Setting::get('premium_days', '40')}} day(s)
                                                        </div>
                                                    </a>

                                                @endif
                                            </div>
                                            @endif




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