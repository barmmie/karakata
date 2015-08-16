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

        <a class="header" href="{{route('items.show', $item->slug)}}">{{$item->title}}</a>
        <div class="meta">
                                            <span class="date m-b-xs">
                                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category m-b-xs">
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
            {{--<a class="ui right floated button" href="{{route('items.edit', $item->id)}}">--}}
            {{--<i class="pencil icon"></i>--}}

            {{--Edit--}}
            {{--</a>--}}
            @if($item->negotiable)
                <div class="ui brown tag label">Negotiable</div>
            @endif

        </div>
    </div>
</div>