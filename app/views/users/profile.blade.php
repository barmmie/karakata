@extends('layouts.public')

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                @include('partials._user_sidebar')
            </div>

            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui  segment">
                        <h3 class="ui dividing header">
                            <i class="user icon"></i>
                            Update Profile
                        </h3>

                    </div>
                        <div class="ui secondary segment">
                            <h3 class="ui dividing header">
                                <i class="lock icon"></i>
                                Update password
                            </h3>
                        </div>
                </div>
            </div>
        </div>
    </div>


@endsection