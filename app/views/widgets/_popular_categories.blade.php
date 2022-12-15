<div class="m-b-md">
    <h2 class="ui dividing header">

        {{trans('phrases.popular_categories')}}

    </h2>
</div>

<div class="ui column">
    <div class="ui divided list">
        @foreach($popular_categories as $category)
            <a class="item"
               href="{{route('categories.show', $category->parent_slug?:$category->slug, $category->slug)}}">
                <i class="angle double right icon"></i>
                {{$category->title}} ({{$category->item_count}})
            </a>
        @endforeach

    </div>
</div>