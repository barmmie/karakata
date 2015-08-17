@extends('layouts.admin')


@section('content')
    <div class="main ui container">

        <div class="ui segments">
            <div class="ui segment">
                <h4 class="ui header">Manage users
                    <div class="sub header">
                        Click on a category name below to modify it. Drag to make it a sub-category or modify its position
                    </div>
                </h4>
            </div>
            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a href="{{route('admin.users.index')}}" class="{{$status == null ? 'active' : ''}} item" >All</a>
                    <a href="{{route('admin.users.index', 'unverified')}}" class="{{$status == 'unverified' ? 'active' : ''}} item" >Unverified only</a>
                    <a href="{{route('admin.users.index', 'verified')}}" class="{{$status == 'verified' ? 'active' : ''}} item" >Verified only</a>
                    <a class="{{$status == 'active' ? 'active' : ''}} item" href="{{route('admin.users.index', 'active')}}" >Active only</a>
                    <a class="{{$status == 'banned' ? 'active' : ''}} item" href="{{route('admin.users.index', 'banned')}}" >Banned only</a>
                </div>

            </div>
            <div class="ui segment">
                <form action="" method="GET">
                    <div class="ui fluid action input">
                        <input type="text" name="query" value="{{Input::get('query')}}" placeholder="Search by name, email or phone"/>
                        <button class="ui button" type="submit">Search</button>
                    </div>
                </form>

            </div>
            <div class="ui segment">
                <table class="ui selectable stacked table">
                    <thead>
                    <tr>
                        <th>Actions</th>

                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th>No of item(s)</th>
                        <th>Date Joined</th>

                        <th>Verified</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><div class="ui icon top left pointing dropdown button">
                                    <i class="wrench icon"></i>
                                    <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <div class="header">{{$user->full_name}} </div>
                                        @if(! $user->isVerified())
                                            <a href="{{route('admin.users.verify', $user->id)}}" class="item"><i class="green check icon"></i>Verify user email.</a>
                                        @endif

                                        @if($user->isActive())
                                            <a href="{{route('admin.users.ban', $user->id)}}" class="item"> <i class="red ban icon"></i>Ban this user.</a>
                                        @endif

                                        @if($user->isBanned())
                                            <a href="{{route('admin.users.activate', $user->id)}}" class="item">Activate user.</a>
                                        @endif
                                    </div>
                                </div></td>
                            <td>{{$user->full_name}}  </td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td><strong>{{count($user->items)}}</strong></td>
                            <td>{{$user->created_at->format('M j, Y')}}</td>
                            <td>{{$user->isVerified()? '<div class="ui green label">Yes</div>': '<div class="ui yellow label">No</div>'}}</td>
                            <td>{{$user->isBanned()? '<div class="ui grey label">Banned</div>' : ''}}
                                {{$user->isActive()? '<div class="ui blue label">Active</div>' : ''}}
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

            @if($users->getTotal() > $users->getPerPage())
                <div class="ui segment">
                    {{$users->appends(Input::all())->links()}}
                </div>
            @endif
        </div>


    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $('.pointing .item')
                .tab()
        ;

        $('.ui.dropdown').dropdown()
    </script>

@endsection