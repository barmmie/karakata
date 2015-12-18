@extends('layouts.admin')

@section('title')
    {{trans('phrases.manage_posted_items')}}
@endsection

@section('content')
    <div class="main ui container">

        <div class="ui segments">

            <div class="ui segment">
                <h4 class="header">
                    <i class="icon"></i>     {{trans('phrases.manage_posted_items')}}

                </h4>

            </div>

            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a href="{{route('admin.items.index')}}"
                       class="{{$status == null ? 'active' : ''}} item">{{trans('words.all')}}</a>
                    <a href="{{route('admin.items.index', 'pending')}}"
                       class="{{$status == 'pending' ? 'active' : ''}} item">{{trans('phrases.pending_only')}}</a>
                    <a href="{{route('admin.items.index', 'approved')}}"
                       class="{{$status == 'approved' ? 'active' : ''}} item">{{trans('phrases.approved_only')}}</a>
                    <a class="{{$status == 'rejected' ? 'active' : ''}} item"
                       href="{{route('admin.items.index', 'rejected')}}">{{trans('phrases.rejected_only')}}</a>
                </div>

            </div>

            <div class="ui segment">
                <form action="" method="GET">
                    <div class="ui fluid action input">
                        <input type="text" name="query" value="{{Input::get('query')}}"
                               placeholder="{{trans('phrases.search_item_copy')}}"/>
                        <button class="ui button" type="submit">{{trans('words.search')}}</button>
                    </div>
                </form>

            </div>

            <div class="ui padded segment">


                @if(count($items) < 1)
                    <div class="ui message">
                        <div class="header">

                        </div>
                        {{trans('phrases.no_items_here')}}
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
                                    @if($item->isPremium())

                                        <div class="trap ribbon-wrap fl-right">
                                            <div class="trap-ribbon">
                                                <a href="#"><i class="inverted circular star icon"></i> Premium </a>
                                            </div>
                                        </div>

                                    @endif

                                    <a class="header"
                                       href="{{route('admin.items.show', $item->id)}}">{{$item->title}}</a>

                                    <div class="meta">
                                            <span class="date m-b-xs">
                                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                            </span>


                                            <span class="category m-b-xs">
                                                <i class="minus icon"></i>{{$item->category? $item->category->title: 'N/A'}}<i
                                                        class="minus icon"></i>
                                            </span>


                                             <span class="location">
                                                <i class="teal marker icon"></i>{{$item->location? $item->location->name : 'N/A'}}
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

                                        @if(!$item->isPremium())
                                            <a href="{{route('admin.items.mark_premium', $item->id)}}"
                                               class="ui right floated tiny purple button">
                                                <i class="star icon"></i>

                                                {{trans('phrases.mark_as_premium')}}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>

                @endif


            </div>


            @if($items->getTotal() > $items->getPerPage())
                <div class="ui segment">
                    {{$items->links()}}

                </div>
            @endif
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