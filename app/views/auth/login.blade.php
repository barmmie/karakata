@extends('layouts.public')

@section('title')
    {{trans('words.login')}}
@endsection

@section('content')
    <div class="ui middle aligned center aligned text container p-t-lg">
        <div class="column">
            <h2 class="ui teal center aligned icon header">
                <i class="large lock icon"></i>

                <div class="content">
                    {{trans('phrases.sign_in_copy', ['site_name' => Setting::get('site_name', 'Karakata')])}}

                </div>
            </h2>
            {{Form::open(['route' => 'sessions.store', 'class'=> 'ui form'])}}
            <div class="ui stacked segment">
                @include('partials._form_errors')
                <div class="ui error message"></div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        {{Form::email('email', null, ['placeholder'=>"E-mail address"])}}
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        {{Form::password('password', ['placeholder'=>"Password"])}}
                    </div>
                </div>
                <button type="submit" class="ui fluid large teal submit button">    {{trans('words.login')}}
                </button>
            </div>

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


            {{Form::close()}}
            <div class="ui message">
                <div class="ui header">
                    {{trans('phrases.new_user')}} <a href="{{route('users.register')}}">{{trans('words.signup')}}</a>

                </div>
                <p>{{trans('phrases.forgot_password')}} <a
                            href="{{URL::action('RemindersController@getRemind')}}">{{trans('phrases.reset_password')}}</a>
                </p>
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
                                    }
                                ]
                            }
                        }
                    });
        });
    </script>
@endsection
