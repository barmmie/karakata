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


                        <div class="ui segments">
                            <div class="ui secondary segment">
                                <div class="ui header">
                                    {{trans('phrases.pay_for_premium')}}
                                </div>
                            </div>
                            <div class="ui segment">
                                <div class="ui two column middle aligned very relaxed stackable grid">
                                    <div class="six wide column">
                                        <div class="ui bordered rounded large image">
                                            <img src="{{asset($item->mainThumbnail())}}" alt="{{$item->title}}"/>
                                        </div>
                                    </div>

                                    <div class="ten wide column">
                                        <table class="ui very basic collapsing table">


                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td>Date</td>
                                                <td>{{\Carbon\Carbon::now()->toDateString()}}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                    {{trans('words.full_name')}}
                                                </td>
                                                <td>
                                                    {{Auth::user()->full_name}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                    {{trans('words.email')}}
                                                </td>
                                                <td>
                                                    {{Auth::user()->email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{Lang::choice('words.item', 1)}} #{{$item->id}}

                                                </td>
                                                <td>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    {{$data['product']}}

                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>{{trans('words.description')}}</strong>
                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    <strong>{{trans('words.amount')}}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{$data['description']}}
                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    {{$data['currency']}} {{$data['price']}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>

                                                </td>
                                                <td>
                                                    {{trans('phrases.total_payable')}}
                                                </td>
                                                <td>
                                                    {{$data['currency']}} {{$data['price']}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('items.post_payment', $item->id)}}" method="POST">
                                {{Form::hidden('item_id', $item->id)}}
                                {{Form::hidden('name', $data['product'])}}
                                {{Form::hidden('description', $data['description'])}}
                                {{Form::hidden('price', $data['price'])}}
                                {{Form::hidden('currency', $data['currency'])}}
                                <div class="ui clearing secondary segment">
                                    <h4>Powered by</h4>
                                    <i class="huge blue paypal card icon"></i>

                                    <div class="ui right floated large buttons">


                                        <button type="submit" class="ui teal button"><i
                                                    class="payment icon"></i> {{trans('phrases.pay_now')}}</button>
                                        <div class="or"></div>
                                        <a href="{{route('dash.myitems')}}" class="ui yellow button"><i
                                                    class="cancel icon"></i>{{trans('words.cancel')}}</a>


                                    </div>


                                </div>
                            </form>


                        </div>

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