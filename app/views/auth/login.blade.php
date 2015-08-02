@extends('layouts.public')

@section('content')
        <div class="ui middle aligned center aligned text container p-t-lg">
            <div class="column">
                <h2 class="ui teal center aligned icon header">
                    <i class="large lock icon"></i>
                    <div class="content">
                        Log-in to your {{Setting::get('site_name', 'Enclassified')}} account
                    </div>
                </h2>
                    {{Form::open(['route' => 'sessions.store', 'class'=> 'ui form'])}}
                    <div class="ui stacked segment">
                        @include('partials._form_errors')

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
                        <button type="submit" class="ui fluid large teal submit button">Signin</button>
                    </div>

                    <div class="ui error message"></div>

                {{Form::close()}}
                <div class="ui message">
                    New to us? <a href="#">Sign Up</a>
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
                                        prompt: 'Please enter a valid email'
                                    }
                                ]
                            },
                            password: {
                                identifier: 'password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter your password'
                                    },
                                ]
                            }
                        }
                    });
        });
        </script>
    @endsection
