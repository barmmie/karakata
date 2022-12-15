@extends('layouts.public')

@section('title')
    {{trans('phrases.password_reminder')}}
@endsection

@section('content')
    <div class="ui middle aligned center aligned text container p-t-lg">
        <div class="column">
            <h2 class="ui teal center aligned icon header">
                <i class="large lock icon"></i>

                <div class="content">
                    {{trans('phrases.forgot_password')}}
                </div>
            </h2>

            </form>
            {{Form::open(['action' => 'RemindersController@postRemind', 'class'=>"ui form"])}}


            <div class="ui stacked segment">
                @include('partials._form_errors')
                <div class="ui error message"></div>

                <div class="field">
                    <label for="">{{trans('words.email')}}</label>

                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        {{Form::email('email', null, ['placeholder'=>trans('words.email')])}}
                    </div>
                </div>

                <input type="submit" class="ui fluid large teal submit button"
                       value="{{trans('phrases.send_reminder')}}">
            </div>


            {{Form::close()}}
            <div class="ui message">
                {{trans('phrases.new_user')}} <a href="{{route('users.register')}}">{{trans('words.signup')}}</a>
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

                        }
                    });
        });
    </script>
@endsection
