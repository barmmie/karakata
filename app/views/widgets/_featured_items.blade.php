<h2 class="ui dividing header">
    Featured listing
</h2>
<div class="ui grid">
    <div id="owl-demo" class="owl-carousel m-t-lg m-b-lg">
    @foreach($featured_items as $item)
        <div data-mh="featured-listing" class="item">
            <div class="ui card">
                <div class="ui fluid image">
                    <a class="ui right corner label">
                        <i class="camera icon"></i>
                        <i class=" corner icon">{{count($item->pictures)}}</i>

                    </a>
                    <img class="lazyOwl" data-src="{{asset($item->mainThumbnail())}}">
                </div>
                <div class="content">

                    <a class="small header">{{$item->title}}</a>


                </div>
                <div class="extra content">
                    <a>
                        <i class="marker icon"></i>
                        {{$item->location->name}}
                    </a>
                    <div class="right floated">
                        <div class="ui teal label">
                            £ {{$item->amount}}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    @endforeach

    </div>
</div>