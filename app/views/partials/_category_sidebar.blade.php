<div class="ui segments">
    <div class="ui segment">
        <h3 class="header">  {{Lang::choice('words.category', 2)}}
        </h3>
    </div>
    <div class="ui segment">


        {{--<h4 class="header"><a href="{{route('categories.show', [$parent_category->slug])}}">{{$parent_category->title}}</a></h4>--}}

        {{--<div class="ui link list">--}}

        {{--@foreach($parent_category->children as $child )--}}

        {{--<a class="item {{$sub_category->id == $child->id ? 'active' : ''}}" href="{{route('categories.show', [$parent_category->slug, $child->slug])}}">--}}
        {{--<i class="right caret icon"></i>--}}
        {{--{{$child->title}}--}}
        {{--</a>--}}

        {{--@endforeach--}}

        {{--</div>--}}

        {{--@else--}}
        <div class="ui link list">
            <div class="item active" href="">
                {{$parent_category->title}}
                <div class="link list">
                    @foreach($parent_category->children as $child )

                        <a class="item " href="{{route('categories.show', [$parent_category->slug, $child->slug])}}">
                            <i class="right caret icon"></i>
                            {{$child->title}}
                        </a>

                    @endforeach
                </div>
            </div>

            @foreach($parent_category->siblings()->get() as $child )

                <a class="item" href="{{route('categories.show',  $child->slug)}}">
                    <i class="right caret icon"></i>

                    {{$child->title}}
                </a>


            @endforeach


        </div>


    </div>


</div>

