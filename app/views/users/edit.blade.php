@extends('layouts.public')

@section('title')
    {{trans('phrases.update_profile')}}
@endsection

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                @include('partials._user_sidebar')
            </div>

            <div class="twelve wide column">
                @include('partials._form_errors')
                <div class="ui  segment">
                    <h3 class="ui dividing header">
                        <i class="user icon"></i>
                        {{trans('phrases.update_profile')}}
                    </h3>

                    {{Form::open(['route'=>'users.update_profile', 'class'=> 'ui profile form '])}}
                    <div class="ui error message"></div>
                    <div class="field">
                        <div class="two fields">

                            <div class="field">
                                <label>{{trans('words.full_name')}}</label>

                                {{Form::text('full_name', $user->full_name)}}
                            </div>
                            <div class="field">
                                <label>{{trans('words.phone')}}</label>

                                {{Form::text('phone', $user->phone)}}
                            </div>
                        </div>
                    </div>
                    <button class="ui teal button right labeled icon button" tabindex="0">
                        <i class="right arrow icon"></i>{{trans('phrases.update_profile')}}</button>

                    {{Form::close()}}

                </div>
                <div class="ui secondary segment">
                    <h3 class="ui dividing header">
                        <i class="lock icon"></i>
                        {{trans('phrases.update_password')}}
                    </h3>

                    {{Form::open(['route'=>'users.update_password', 'class'=> 'ui profile form '])}}
                    <div class="field">
                        <label>
                            {{trans('phrases.current_password')}}
                        </label>

                        <div class="fields">
                            <div class="twelve wide field">
                                {{Form::password('current_password')}}
                            </div>

                        </div>
                    </div>

                    <div class="field">
                        <div class="two fields">

                            <div class="field">
                                <label>                            {{trans('phrases.new_password')}}
                                </label>

                                {{Form::password('new_password')}}
                            </div>
                            <div class="field">
                                <label>                            {{trans('phrases.confirm_new_password')}}
                                </label>

                                {{Form::password('confirm_new_password')}}
                            </div>
                        </div>
                    </div>

                    <button class="ui brown button right labeled icon button" tabindex="0">
                        <i class="right arrow icon"></i>                            {{trans('phrases.update_password')}}
                    </button>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <script type="text/javascript">

        $('.ui.profile.form').form({
            fields: {
                full_name: {
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
                category: {
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
                }
            }
        });

    </script>

@endsection