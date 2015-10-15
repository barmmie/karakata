@extends('layouts.public')

@section('title')
    {{trans('phrases.page_not_found')}}
@endsection

@section('content')

    <div class="ui middle aligned center aligned text container p-t-lg p-b-lg">
        <div class="column">
            <h2 class="ui red center aligned icon header">
                <i class="large dont icon"></i>

                <div class="content">
                    404 {{trans('phrases.page_not_found')}}

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


