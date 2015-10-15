@extends('layouts.public')


@section('title')
    {{Lang::choice('words.category', 1)}} - {{$parent_category->title}} {{$sub_category? "- $sub_category->title": ''}}
@endsection

@section('content')
    @include('partials._search_cta')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                <div class="ui segment">
                    @include('partials._category_sidebar')

                </div>

                <div class="desktop-only">
                    <div class="ui segment">
                        @include('widgets._recent_items')
                    </div>
                </div>


            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <div class="ui breadcrumb">
                            <a class="section" href="{{route('pages.homepage')}}">{{trans('words.home')}}</a>
                            <i class="right angle icon divider"></i>
                            <a class="section {{$sub_category? '': 'active'}}"
                               href="{{route('categories.show', $parent_category->slug)}}">{{$parent_category->title}}</a>
                            @if($sub_category)
                                <i class="right angle icon divider"></i>
                                <div class="active section">{{$sub_category->title}}</div>
                            @endif
                            <i class="right arrow icon divider"></i>

                            <div class="active section">{{$item_count}} {{Lang::choice('words.result', $item_count)}}</div>
                        </div>
                    </div>
                    <div class="ui segment">
                        @include('partials._items_filter')
                    </div>

                    @include('widgets._premium_items')


                    <div class="ui purple padded segment">


                        @if(count($items) < 1)
                            <div class="ui message">
                                <div class="header">

                                </div>
                                {{trans('phrases.category_no_items')}}
                                @if(Input::has('filtered'))
                                    <p>{{trans('phrases.consider_modify_filter')}}</p>
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

                    @if($items->getTotal() > $items->getPerPage())
                        <div class="ui segment">
                            {{$items->links()}}

                        </div>
                    @endif
                </div>
                <div class="desktop-only">
                    @if(Setting::get('ad_leaderboard')!='')
                        {{Setting::get('ad_leaderboard')}}
                    @endif
                </div>


            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.advanced_filter.accordion').accordion();
        });

        $('.ui.form').form();


    </script>
@endsection