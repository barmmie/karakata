@if(count($premium_items) > 0)
    <div class="ui purple secondary segment">

        <div class="ui divided items">
            @foreach($premium_items as $item)
                @include('partials._item')
            @endforeach
        </div>

    </div>
@endif

