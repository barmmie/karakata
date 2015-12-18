@extends('layouts.public')

@section('title')
    {{trans('phrases.pay_for_premium')}} - {{$item->title}}
@endsection

@section('content')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">

                @include('partials._user_sidebar')


            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <div class="ui breadcrumb">
                            <a class="section" href="{{route('pages.homepage')}}">{{trans('words.home')}}</a>
                            <i class="right angle icon divider"></i>

                            <div class="section"> {{$item->title}}</div>

                            <i class="right arrow icon divider"></i>

                            <div class="active section">{{trans('phrases.pay_for_premium')}}</div>
                        </div>
                    </div>


                    <div class="ui padded segment">
                        <form action="{{route('items.post_payment', $item->id)}}" method="POST">


                        <div class="ui segments">
                            <div class="ui secondary segment">
                                <div class="ui header">
                                    {{trans('phrases.pay_for_premium')}}
                                </div>
                            </div>
                            @include('partials._payment_invoice')
                                {{Form::hidden('item_id', $item->id)}}
                                {{Form::hidden('name', $data['product'])}}
                                {{Form::hidden('description', $data['description'])}}
                                {{Form::hidden('price', $data['price'])}}
                                {{Form::hidden('currency', $data['currency'])}}
                                <div class="ui clearing secondary segment">
                                    <h4>{{trans('phrases.processed_securely_by')}}</h4>
                                    <i class="huge blue paypal card icon"></i>
                                    <i class="huge lock icon"></i>


                                    <div class="ui right floated large buttons">


                                        <button type="submit" class="ui teal button"><i
                                                    class="payment icon"></i> {{trans('phrases.pay_now')}}</button>
                                        <div class="or"></div>
                                        <a href="{{route('dash.myitems')}}" class="ui yellow button"><i
                                                    class="cancel icon"></i>{{trans('words.cancel')}}</a>


                                    </div>


                                </div>


                        </div>
                        </form>


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