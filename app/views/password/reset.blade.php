@extends('layouts.public')

@section('title')
    {{trans('phrases.reset_password')}}
@endsection

@section('content')
    <div class="ui middle aligned center aligned text container p-t-lg">
        <div class="column">
            <h2 class="ui teal center aligned icon header">
                <i class="large lock icon"></i>

                <div class="content">
                    {{trans('phrases.reset_password')}}
                </div>
            </h2>

            <input type="email" name="email">
            </form>
            {{Form::open(['action' => 'RemindersController@postReset', 'class'=>"ui form"])}}
            <input type="hidden" name="token" value="{{ $token }}">

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
                <div class="field">
                    <label for="">{{trans('words.password')}}</label>

                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        {{Form::password('password', ['placeholder'=>trans('words.password')])}}
                    </div>
                </div>

                <div class="field">
                    <label for="">{{trans('phrases.confirm_new_password')}}</label>

                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        {{Form::password('password_confirmation', ['placeholder'=>trans('words.confirm_new_password')])}}
                    </div>
                </div>
                <input type="submit" class="ui fluid large teal submit button"
                       value="{{trans('phrases.reset_password')}}">
            </div>


            {{Form::close()}}
            <div class="ui message">
                {{trans('phrases.new_user')}} <a href="#">{{trans('words.signup')}}</a>
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
