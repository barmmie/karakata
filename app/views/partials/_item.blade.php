<div class="item">

    <div class="ui small real-bordered rounded image">
        <a class="ui brown ribbon label">{{Setting::get('currency', '£')}} {{$item->amount}}</a>

        <a class="ui right corner label">
            <i class="camera icon"></i>
            <i class=" corner icon">{{count($item->pictures)}}</i>

        </a>

        <img class="" src="{{asset($item->mainThumbnail())}}" alt="{{$item->title}}">
    </div>

    <div class="content">

        @if($item->isPremium())

            <div class="trap ribbon-wrap fl-right">
                <div class="trap-ribbon">
                    <a href="#"><i class="inverted circular star icon"></i> Premium </a>
                </div>
            </div>

        @endif


        <a class="header" href="{{route('items.show', $item->slug)}}">{{$item->title}}</a>

        <div class="meta">
                                            <span class="date m-b-xs">
                                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category m-b-xs">
                                                <i class="minus icon"></i>{{$item->category?$item->category->title:'N/A'}}<i
                                                        class="minus icon"></i>
                                            </span>
                                             <span class="location">
                                                <i class="teal marker icon"></i>{{$item->location?$item->location->name:'N/A'}}
                                            </span>

        </div>
        <div class="description">
            <p></p>
        </div>
        <div class="extra">
            @if($item->negotiable)
                <div class="ui brown tag label">{{trans('words.negotiable')}}</div>
            @endif

        </div>
    </div>
</div>