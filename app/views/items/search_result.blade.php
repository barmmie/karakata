@extends('layouts.public')

@section('title')
    {{trans('words.search')}} -   {{Input::get('query')}}
@endsection

@section('content')
    @include('partials._search_cta')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">


                <div class="desktop-only">

                    <div class="ui segment">
                        @include('widgets._popular_categories')
                    </div>
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

                            <div class="section"> {{trans('words.search')}} : '{{Input::get('query')}}'</div>

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
                                {{trans('phrases.search_no_results', ['query' => Input::get('query') ])}}

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
                            {{$items->appends(Input::all())->links()}}

                        </div>
                    @endif
                </div>

                <div class="desktop-only">
                    @if(Setting::get('ad_leaderboard')!='')
                        {{Setting::get('ad_leaderboard')}}
                    @endif
                </div>
                <div class="mobile-only">
                    <div class="ui segment">
                        @include('widgets._popular_categories')
                    </div>
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