<div class="m-md">
    <h3 class="ui dividing header">
        {{trans('phrases.recent_items')}}
    </h3>
</div>

<div class="ui column p-md">
    <div class="ui feed">
        @foreach($latest_items as $item)
            <div class="event">
                <div class="label">
                    <img src="{{gravatar($item->email)}}">
                </div>
                <div class="content">
                    <div class="summary">
                        <a href="{{route('users.items', $item->user_id)}}">{{$item->seller_name}}</a> wants to sell <a
                                href="{{route('items.show', $item->slug)}}">{{$item->title}}</a>

                        <div class="date">
                            {{$item->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <div class="extra images">
                        <a><img src="{{asset($item->mainThumbnail())}}" alt="{{$item->title}}"></a>
                    </div>
                    <div class="meta">
                    <span class="like">
                        <i class="red marker icon"></i> {{$item->location? $item->location->name : 'N/A'}}
                    </span>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>