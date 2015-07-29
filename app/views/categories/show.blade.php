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
                                    @include('partials._item')
                                @endforeach
                            </div>

                        @endif



                    </div>


                    @if($item_count > 10)
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