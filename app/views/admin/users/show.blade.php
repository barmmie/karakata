@extends('layouts.admin')


@section('title')
    {{Lang::choice('words.user', 1)}} - {{$user->full_name}}
@endsection

@section('content')
    <div class="main ui container">

        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                <div class="ui content">
                    <div class="ui card">
                        <div class="image">
                            <img src="{{gravatar($user->email, 200)}}">
                        </div>
                        <div class="content">
                            <a class="header">{{$user->full_name}}</a>

                            <div class="meta">
                                <span class="date">{{trans('phrases.joined_in')}} {{$user->created_at->format('M, j Y')}}</span>
                            </div>

                        </div>
                        <div class="extra content">
                            <a>
                                <i class="file icon"></i>
                                {{$item_count}} {{Lang::choice('words.item', $item_count)}}
                            </a>


                        </div>

                        <div class="extra content">
                            <a>
                                <i class="world icon"> </i>
                                {{$user->last_ip_address}}
                            </a>
                        </div>
                    </div>
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
                                {{trans('phrases.user_no_items')}}.
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
                                               href="{{route('admin.items.show', $item->id)}}">{{$item->title}}</a>

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
                                                @if($item->negotiable)
                                                    <div class="ui brown tag label">{{trans('words.negotiable')}}</div>
                                                @endif

                                                @if($item->isApproved())
                                                    <div class="ui blue label">{{trans('words.approved')}}</div>
                                                @endif

                                                @if($item->isRejected())
                                                    <div class="ui orange label">{{trans('words.rejected')}}</div>
                                                @endif

                                                @if($item->isPending())
                                                    <div class="ui grey label">{{trans('phrases.pending_approval')}}</div>
                                                @endif

                                            </div>
                                            <div class="extra">

                                                <a href="{{route('admin.items.delete', $item->id)}}"
                                                   class="ui right floated tiny red button confirm-delete">
                                                    <i class="trash icon"></i>
                                                    {{trans('words.delete')}}
                                                </a>
                                                @if(! $item->isRejected())
                                                    <a href="{{route('admin.items.reject', $item->id)}}"
                                                       class="ui right floated tiny orange button">
                                                        <i class="cancel icon"></i>
                                                        x
                                                        {{trans('words.reject')}}
                                                    </a>
                                                @endif
                                                @if(! $item->isApproved())
                                                    <a href="{{route('admin.items.approve', $item->id)}}"
                                                       class="ui right floated tiny primary button">
                                                        <i class="check icon"></i>
                                                        {{trans('words.approve')}}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        @endif


                    </div>


                    @if($item_count > 10)
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
        $('.pointing .item')
                .tab()
        ;

        $('.ui.dropdown').dropdown()
    </script>

@endsection