@extends('layouts.public')

@section('title')
    {{trans('phrases.error_occured')}}
@endsection

@section('content')

    <div class="ui middle aligned center aligned text container p-t-lg p-b-lg">
        <div class="column">
            <h2 class="ui red center aligned icon header">
                <i class="large warning circle icon"></i>

                <div class="content">
                    500 {{trans('phrases.error_occured')}}

                </div>
            </h2>
            <div class="ui stacked segment">

                <a class="ui massive teal button" onclick="history.back()">
                    <i class="reply icon"></i>
                    {{trans('phrases.return_back')}}
                </a>


                <a href="{{route('pages.homepage')}}" class="ui massive basic  button">
                    <i class="home icon"></i>
                    {{trans('phrases.go_home')}}
                </a>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a class="ui massive basic  button" href="{{route('admin.dashboard')}}">
                        <i class="sign out icon "></i> {{trans('phrases.admin_dashboard')}}
                    </a>
                @endif
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
