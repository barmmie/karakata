@extends('layouts.public')

@section('content')
    @include('partials._search_cta')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                @include('partials._category_sidebar')



            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                            <div class="ui breadcrumb">
                                <a class="section" href="{{route('pages.homepage')}}">Home</a>
                                <i class="right angle icon divider"></i>
                                <a class="section {{$sub_category? '': 'active'}}" href="{{route('categories.show', $parent_category->slug)}}">{{$parent_category->title}}</a>
                                @if($sub_category)
                                    <i class="right angle icon divider"></i>
                                    <div class="active section">{{$sub_category->title}}</div>
                                @endif
                                <i class="right arrow icon divider"></i>
                                <div class="active section">{{$item_count}} result(s)</div>
                            </div>
                    </div>
                    <div class="ui segment">
                       @include('partials._items_filter')


                    </div>

                    <div class="ui padded segment">


                        @if(count($items) < 1)
                            <div class="ui message">
                                <div class="header">

                                </div>
                                There are no currently no items in this category.
                                @if(Input::has('filtered'))
                                    <p>Consider modifying your filters perhaps?</p>
                                    @endif
                            </div>
                        @else
                            <div class="ui divided items">

                                @foreach($items as $item)
                                    <div class="item">

                                        <div class="ui small bordered rounded image">
                                            <a class="ui brown ribbon label">£ {{$item->amount}}</a>

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
                                @endforeach
                            </div>

                        @endif



                    </div>
                    @if(count($items) > 9)



                        <div class="ui segment">
                            {{$items->links()}}

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.ui.advanced_filter.accordion').accordion();
        });

        $('.ui.form').form();


    </script>
@endsection