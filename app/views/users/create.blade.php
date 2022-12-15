@extends('layouts.public')

@section('title')
    {{trans('phrases.creating_account')}}

@endsection

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="twelve wide column">
                <div class="ui segment">
                    <h3 class="ui dividing header">
                        <i class="add user icon"></i>
                        {{trans('phrases.create_account_copy', ['site_name' => Setting::get('site_name', 'Karakata')])}}
                    </h3>
                    @include('partials._form_errors')


                    {{Form::open(['route'=>'users.store', 'class'=>'ui form attached p-lg', 'novalidate' => 'novalidate'])}}
                    <div class="ui error message"></div>
                    <div class="required field">

                        <label>{{trans('words.full_name')}}</label>
                        {{Form::text('full_name', null, ['placeholder'=> 'Full Name'])}}


                    </div>
                    <div class="two fields">
                        <div class="required field">
                            <label for="">{{trans('words.email')}}</label>
                            {{Form::email('email', null, ['placeholder'=> 'E-mail address'])}}


                        </div>
                        <div class="required field">
                            <label for="">{{trans('words.phone')}}</label>
                            {{Form::text('phone', null, ['placeholder'=> 'Phone number'])}}


                        </div>
                    </div>

                    <div class="two fields">
                        <div class="required field">
                            <label for="">{{trans('words.password')}}</label>
                            {{Form::password('password', ['placeholder'=> 'Password'])}}


                        </div>
                        <div class="required field">
                            <label for="">{{trans('words.confirm_password')}}</label>
                            {{Form::password('confirm_password', ['placeholder'=> 'Confirm password'])}}
                        </div>
                    </div>


                    <div class="ui segment">
                        <div class="field">
                            <div class="ui teal toggle checkbox">
                                <input type="checkbox" name="terms" tabindex="0" class="hidden">
                                <label>{{trans('phrases.agree_terms')}}</label>
                            </div>
                        </div>
                    </div>

                    <button class="ui teal button right labeled icon button" tabindex="0">
                        <i class="right arrow icon"></i>{{trans('phrases.create_my_account')}}</button>
                    {{Form::close()}}

                    <div class="ui segment">
                        @if(Setting::get('allow_facebook_login', '0') == '1')
                            <a class="ui fluid facebook button" href="{{route('social.facebook')}}">
                                <i class="facebook icon"></i>
                                {{trans('words.login')}} via Facebook
                            </a>
                        @endif


                        @if(Setting::get('allow_google_login', '0') == '1')
                            <a class="ui fluid google plus button m-t-sm" href="{{route('social.google')}}">
                                <i class="google plus icon"></i>
                                {{trans('words.login')}} via Google Plus
                            </a>
                        @endif

                    </div>

                    <div class="ui bottom attached info message">
                        <i class="icon help"></i>
                        {{trans('phrases.already_signed_up')}}
                    </div>
                </div>
            </div>
            <div class="four wide column">
                @include('partials._how_to_sell_buy')
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
                                        prompt: '{{trans('validation.required', ['attribute' => 'name'])}}'
                                    },
                                    {
                                        type: 'length[4]',
                                        prompt: '{{trans('validation.min.string', ['attribute' => 'name', 'min' => 4])}}'
                                    }
                                ]
                            },

                            phone: {
                                identifier: 'phone',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: '{{trans('validation.required', ['attribute' => 'phone number'])}}'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: '{{trans('validation.min.string', ['attribute' => 'phone number', 'min' => 6])}}'
                                    }
                                ]
                            },
                            email: {
                                identifier: 'email',
                                rules: [
                                    {
                                        type: 'email',
                                        prompt: '{{trans('validation.email', ['attribute' => 'email'])}}'
                                    }
                                ]
                            },
                            password: {
                                identifier: 'password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: '{{trans('validation.required', ['attribute' => 'password'])}}'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: '{{trans('validation.min.string', ['attribute' => 'password', 'min' => 6])}}'
                                    }
                                ]
                            },
                            confirm_password: {
                                identifier: 'confirm_password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: '{{trans('validation.required', ['attribute' => 'confirm password'])}}'
                                    },
                                    {
                                        type: 'match[password]',
                                        prompt: '{{trans('validation.confirmed', ['attribute' => 'password'])}}'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: '{{trans('validation.min.string', ['attribute' => 'password confirmation', 'min' => 6])}}'
                                    }
                                ]
                            },
                            terms: {
                                identifier: 'terms',
                                rules: [
                                    {
                                        type: 'checked',
                                        prompt: '{{trans('validation.accepted', ['attribute' => 'terms and conditions'])}}'
                                    }
                                ]
                            }
                        }
                    })
            ;
        })
    </script>
@endsection