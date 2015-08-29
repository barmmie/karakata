@extends('layouts.public')

@section('title')
    Creating account
@endsection

@section('content')
        <div class="ui container p-t-lg">
            <div class="ui two column relaxed stackable grid">
                <div class="twelve wide column">
                    <div class="ui segment">
                        <h3 class="ui dividing header">
                            <i class="add user icon"></i>
                            Create an {{Setting::get('site_name', 'Enclassified')}} account it is free
                        </h3>
                        @include('partials._form_errors')


                        {{Form::open(['route'=>'users.store', 'class'=>'ui form attached p-lg', 'novalidate' => 'novalidate'])}}
                        <div class="ui error message"></div>
                            <div class="required field">

                                        <label>Full Name</label>
                            {{Form::text('full_name', null, ['placeholder'=> 'Full Name'])}}


                            </div>
                            <div class="two fields">
                                <div class="required field">
                                    <label for="">Email</label>
                                    {{Form::email('email', null, ['placeholder'=> 'E-mail address'])}}


                                </div>
                                <div class="required field">
                                    <label for="">Phone</label>
                                    {{Form::text('phone', null, ['placeholder'=> 'Phone number'])}}


                                </div>
                            </div>

                            <div class="two fields">
                                <div class="required field">
                                    <label for="">Password</label>
                                    {{Form::password('password', ['placeholder'=> 'Password'])}}


                                </div>
                                <div class="required field">
                                    <label for="">Confirm password</label>
                                    {{Form::password('confirm_password', ['placeholder'=> 'Confirm password'])}}
                                </div>
                            </div>


                            <div class="ui segment">
                                <div class="field">
                                    <div class="ui teal toggle checkbox">
                                        <input type="checkbox" name="terms" tabindex="0" class="hidden">
                                        <label>I agree to the <a href="{{route('pages.terms')}}">Terms and
                                                conditions</a></label>
                                    </div>
                                </div>
                            </div>
                            <button class="ui teal button right labeled icon button" tabindex="0">
                                <i class="right arrow icon"></i>Create my account</button>
                        {{Form::close()}}
                        {{--<div class="ui bottom attached warning message">--}}
                            {{--<i class="icon help"></i>--}}
                            {{--Already signed up? <a href="#">Login here</a> instead.--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="four wide column">
                    <div class="ui content p-md">
                        <div class="ui center aligned icon header">
                            <i class="orange circular icon picture">

                            </i>
                            Post a Free Classified
                        </div>
                        <p>                            Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>

                    <div class="ui piled segment">
                        <h4 class="ui header">HOW TO SELL QUICKLY?</h4>
                        <div class="ui bulleted list">
                            <div class="item">Gaining Access</div>
                            <div class="item">Inviting Friends</div>
                            <div class="item">
                                <div>Benefits</div>
                                <div class="list">
                                    <div class="item">Use Anywhere</div>
                                    <div class="item">Rebates</div>
                                    <div class="item">Discounts</div>
                                </div>
                            </div>
                            <div class="item">Warranty</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.ui.checkbox')
                    .checkbox();

            $('.ui.form')
                    .form({
                        fields: {
                            name: {
                                identifier: 'full_name',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter your name'
                                    },
                                    {
                                        type: 'length[4]',
                                        prompt: 'Your full name should be at least 4 characters'
                                    }
                                ]
                            },

                            phone: {
                                identifier: 'phone',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter phone number'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: 'Enter valid phone number'
                                    }
                                ]
                            },
                            email: {
                                identifier: 'email',
                                rules: [
                                    {
                                        type: 'email',
                                        prompt: 'Please enter a valid email'
                                    }
                                ]
                            },
                            password: {
                                identifier: 'password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter a password'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: 'Your password must be at least 6 characters'
                                    }
                                ]
                            },
                            confirm_password: {
                                identifier: 'confirm_password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please confirm your chosen password'
                                    },
                                    {
                                        type: 'match[password]',
                                        prompt: 'The two passwords do not match'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: 'Your password must be at least 6 characters'
                                    }
                                ]
                            },
                            terms: {
                                identifier: 'terms',
                                rules: [
                                    {
                                        type: 'checked',
                                        prompt: 'You must agree to the terms and conditions'
                                    }
                                ]
                            }
                        }
                    })
            ;
        })
    </script>
@endsection