@extends('layouts.public')

@section('title')
    {{trans('phrases.pay_for_premium')}} - {{$item->title}}
@endsection

@section('styles')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey("{{Setting::get('stripe_api_publishable_key')}}");
    </script>
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

                        {{Form::open(['route' => ['items.process_stripe_form', $item->id], 'class' => 'ui form', 'id' => 'payment-form'])}}

                        <div class="ui segments">
                            <div class="ui secondary segment">
                                <div class="ui header">
                                    {{trans('phrases.pay_for_premium')}}
                                </div>
                            </div>
                            @include('partials._payment_invoice')

                                <div class="ui segment">

                                    <div class="ui  {{Auth::user()->is_stripe_customer?'two columns':''}} relaxed grid">
                                        @if(Auth::user()->is_stripe_customer)
                                        <div class="column">
                                                <p>{{trans('phrases.existing_card_on_file')}}</p>
                                                <div class="ui card">
                                                    <div class="content">
                                                        <img class="right floated mini ui image" src="{{Auth::user()->cardImage()}}">
                                                        <div class="header">
                                                            {{Auth::user()->card_type}}
                                                        </div>

                                                        <div class="description">
                                                            **** **** **** {{Auth::user()->last_four}}
                                                        </div>
                                                        <div class="meta">
                                                            {{Auth::user()->expiry_month}} /
                                                            {{Auth::user()->expiry_year}}
                                                        </div>
                                                    </div>
                                                    <div class="extra content">
                                                        <div class="ui two buttons">
                                                            <a href="{{route('items.stripe_existing', $item->id)}}" class="ui basic green button">{{trans('phrases.pay_with_this')}}</a>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="ui vertical divider">
                                            or
                                        </div>
                                        @endif

                                        <div class="column">
                                            <div class="ui error message"></div>

                                            <div class="field">
                                                <div class="fields">
                                                    <div class="ten wide field">
                                                        <label>Card Number</label>
                                                        <input type="text"  size="20" data-stripe="number" placeholder="Card #">
                                                    </div>
                                                    <div class="six wide field">
                                                        <label>CVC</label>
                                                        <input type="text" size="3" data-stripe="cvc" placeholder="CVC">
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="field">
                                                <label>Expiration</label>
                                                <div class="two fields">
                                                    <div class="field">
                                                        <select class="ui fluid search dropdown" data-stripe="exp-month">
                                                            <option value="">Month</option>
                                                            <option value="1">January</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                            <option value="4">April</option>
                                                            <option value="5">May</option>
                                                            <option value="6">June</option>
                                                            <option value="7">July</option>
                                                            <option value="8">August</option>
                                                            <option value="9">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="field">
                                                        <input type="text" size="4" data-stripe="exp-year" placeholder="Year">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ui buttons">
                                                <button type="submit" class="ui teal submit button"><i
                                                            class="payment icon"></i> {{trans('phrases.pay_with_new_card')}}</button>
                                                <div class="or"></div>
                                                <a href="{{route('dash.myitems')}}" class="ui yellow button"><i
                                                            class="cancel icon"></i>{{trans('words.cancel')}}</a>
                                            </div>

                                        </div>
                                    </div>



                                </div>
                                <div class="ui clearing secondary segment">
                                    <h4>{{trans('phrases.processed_securely_by')}}</h4>

                                    <i class="huge blue stripe card icon"></i>
                                    <i class="huge lock icon"></i>

                                </div>


                        </div>
                        {{Form::close()}}


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

            function stripeResponseHandler(status, response) {
                var $form = $('#payment-form');

                if (response.error) {
                    // Show the errors on the form
                    $messageBox = $form.find('.ui.message')
                    $messageBox.removeClass('error')
                    $messageBox.addClass('red')
                    $messageBox.text(response.error.message);
                    $form.find('.ui.submit.button').prop('disabled', false);
                } else {
                    // response contains id and card, which contains additional card details
                    var token = response.id;
                    // Insert the token into the form so it gets submitted to the server
                    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                    // and submit
                    $form.get(0).submit();
                }
            };

            $('#payment-form').on('submit', function(event) {
                var $form = $(this);

                // Disable the submit button to prevent repeated clicks
                $form.find('.ui.submit.button').prop('disabled', true);

                Stripe.card.createToken($form, stripeResponseHandler);

                // Prevent the form from submitting with the default action
                return false;
            });
        });



    </script>
@endsection