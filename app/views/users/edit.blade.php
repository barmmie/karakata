@extends('layouts.public')

@section('title')
    Update profile
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
                            Update Profile
                        </h3>

                            {{Form::open(['route'=>'users.update_profile', 'class'=> 'ui profile form '])}}
                            <div class="ui error message"></div>
                            <div class="field">
                                <div class="two fields">

                                    <div class="field">
                                        <label>Full name</label>

                                        {{Form::text('full_name', $user->full_name)}}
                                    </div>
                                    <div class="field">
                                        <label>Phone</label>

                                        {{Form::text('phone', $user->phone)}}
                                    </div>
                                </div>
                            </div>
                        <button class="ui teal button right labeled icon button" tabindex="0">
                            <i class="right arrow icon"></i>Update my profile</button>

                            {{Form::close()}}

                    </div>
                    <div class="ui secondary segment">
                        <h3 class="ui dividing header">
                            <i class="lock icon"></i>
                            Update password
                        </h3>

                        {{Form::open(['route'=>'users.update_password', 'class'=> 'ui profile form '])}}
                        <div class="field">
                            <label>Current password</label>
                            <div class="fields">
                                <div class="twelve wide field">
                                    {{Form::password('current_password')}}
                                </div>

                            </div>
                        </div>

                        <div class="field">
                            <div class="two fields">

                                <div class="field">
                                    <label>New password</label>

                                    {{Form::password('new_password')}}
                                </div>
                                <div class="field">
                                    <label>Confirm new password</label>

                                    {{Form::password('confirm_new_password')}}
                                </div>
                            </div>
                        </div>

                        <button class="ui brown button right labeled icon button" tabindex="0">
                            <i class="right arrow icon"></i>Update my password</button>

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
                            prompt: 'Please enter your full name'
                        },
                        {
                            type: 'length[4]',
                            prompt: 'Your full name should be at least 4 characters'
                        }
                    ]
                },
                category: {
                    identifier: 'phone',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter a phone '
                        },
                        {
                            type: 'length[4]',
                            prompt: 'Enter a valid phone number'
                        }

                    ]
                }
            }
        });

    </script>

    @endsection