@extends('layouts.public')

@section('title')
    Dash - My items
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
                        My items
                    </h3>

                    @if(count($items) < 1)
                        <div class="ui message">
                            You currently have no active items for sale.
                        </div>

                    @else
                        <div class="ui divided items">

                            @foreach($items as $item)
                                <div class="item">
                                    <div class="image">
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
                                            <a class="ui right floated button" href="{{route('items.edit', $item->id)}}">
                                                <i class="pencil icon"></i>

                                                Edit
                                            </a>
                                            <div class="ui brown tag label">{{Setting::get('currency', '£')}} {{$item->amount}}</div>
                                            @if($item->isApproved())
                                            <div class="ui green label">APPROVED</div>
                                            @endif

                                            @if($item->isPending())
                                            <div class="ui yellow label">PENDING APPROVAL</div>
                                            @endif

                                            @if($item->isRejected())
                                            <div class="ui red label">REJECTED</div>
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