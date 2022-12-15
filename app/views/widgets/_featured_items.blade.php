    <h2 class="ui dividing header">
        {{trans('phrases.featured_items')}}
    </h2>
    <div class="ui grid">
        <div id="owl-demo" class="owl-carousel m-t-lg m-b-lg">
            @foreach($featured_items as $item)
                <div class="item featured-listing">
                    <div class="ui card fullheight">
                        <div class="ui fluid image">
                            <a class="ui right corner label">
                                <i class="camera icon"></i>
                                <i class=" corner icon">{{count($item->pictures)}}</i>

                            </a>
                            <img src="{{asset($item->mainThumbnail())}}" alt="{{$item->title}}">
                        </div>
                        <div class="content">

                            <a class="small header" href="{{route('items.show', $item->slug)}}">{{$item->title}}</a>


                        </div>
                        <div class="extra content">
                            <a>
                                <i class="marker icon"></i>
                                {{$item->location?$item->location->name: 'N/A'}}
                            </a>

                            <div class="right floated">
                                <div class="ui teal label">
                                    {{Setting::get('currency', '£')}} {{$item->amount}}
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>
    </div>

