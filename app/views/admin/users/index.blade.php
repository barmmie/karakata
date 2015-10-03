@extends('layouts.admin')


@section('title')
    {{trans('phrases.manage_users')}}
@endsection

@section('content')
    <div class="main ui container">

        <div class="ui segments">
            <div class="ui segment">
                <h4 class="ui header">
                    {{trans('phrases.manage_users')}}


                </h4>


            </div>
            <div class="ui clearing segment">
                <button class="ui right floated icon button newAdmin">
                    <i class="icon add"></i> {{trans('phrases.add_new_admin')}}
                </button>
            </div>
            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a href="{{route('admin.users.index')}}"
                       class="{{$status == null ? 'active' : ''}} item">{{trans('words.all')}}</a>
                    <a href="{{route('admin.users.index', 'unverified')}}"
                       class="{{$status == 'unverified' ? 'active' : ''}} item">{{trans('phrases.unverified_only')}}</a>
                    <a href="{{route('admin.users.index', 'verified')}}"
                       class="{{$status == 'verified' ? 'active' : ''}} item">{{trans('phrases.verified_only')}}</a>
                    <a class="{{$status == 'active' ? 'active' : ''}} item"
                       href="{{route('admin.users.index', 'active')}}">{{trans('phrases.active_only')}}</a>
                    <a class="{{$status == 'banned' ? 'active' : ''}} item"
                       href="{{route('admin.users.index', 'banned')}}">{{trans('phrases.banned_only')}}</a>
                    <a class="{{$status == 'admin' ? 'active' : ''}} item"
                       href="{{route('admin.users.index', 'admin')}}">{{trans('phrases.admin_only')}}</a>
                </div>

            </div>
            <div class="ui segment">
                <form action="" method="GET">
                    <div class="ui fluid action input">
                        <input type="text" name="query" value="{{Input::get('query')}}"
                               placeholder="{{trans('phrases.search_users')}}"/>
                        <button class="ui button" type="submit">{{trans('words.search')}}</button>
                    </div>
                </form>

            </div>
            <div class="ui segment">
                <table class="ui selectable stacked table">
                    <thead>
                    <tr>
                        <th>{{trans('words.actions')}}</th>

                        <th>{{trans('words.name')}}</th>
                        <th>{{trans('words.email')}}</th>
                        <th>{{trans('words.phone')}}</th>
                        <th>{{trans('phrases.no_of_items')}}</th>
                        <th>{{trans('phrases.joined_in')}}</th>

                        <th>{{trans('words.verified')}}</th>
                        <th>{{trans('words.status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="ui icon top left pointing dropdown button">
                                    <i class="wrench icon"></i>
                                    <i class="dropdown icon"></i>

                                    <div class="menu">
                                        <div class="header">{{$user->full_name}} </div>

                                        @if(! $user->isVerified())
                                            <a href="{{route('admin.users.verify', $user->id)}}" class="item">
                                                <i class="green thumbs up icon"></i>
                                                {{trans('phrases.verify_user_email')}}
                                            </a>
                                        @endif

                                        @if($user->isActive())
                                            <a href="{{route('admin.users.ban', $user->id)}}" class="item">
                                                <i class="red ban icon"></i>
                                                {{trans('phrases.ban_user')}}

                                            </a>
                                        @endif

                                        @if($user->isBanned())
                                            <a href="{{route('admin.users.activate', $user->id)}}" class="item">
                                                <i class="green check icon"></i>
                                                {{trans('phrases.activate_user')}}

                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </td>
                            <td><a href="{{route('admin.users.items', $user->id)}}">{{$user->full_name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td><strong>{{count($user->items)}}</strong></td>
                            <td>{{$user->created_at->format('M j, Y')}}</td>
                            <td>{{$user->isVerified()? '<div class="ui green label">'.trans('words.yes').'</div>': '<div class="ui yellow label">'.trans('words.no').'</div>'}}</td>
                            <td>{{$user->isBanned()? '<div class="ui grey label">'.trans('words.banned').'</div>' : ''}}
                                {{$user->isActive()? '<div class="ui blue label">'.trans('words.active').'</div>' : ''}}
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

        <div class="ui modal">
            <i class="close icon"></i>

            <div class="header">
                {{trans('phrases.add_new_admin')}}
            </div>
            <div class="content">
                {{Form::open(['route' => 'admin.create', 'class' => 'ui form'])}}
                <div class="ui error message"></div>

                <div class="field">
                    <label for="">{{trans('words.full_name')}}</label>
                    <input type="text" name="full_name" placeholder="{{trans('words.full_name')}}">
                </div>
                <div class="field">

                    <label for="">{{trans('words.email')}}</label>
                    <input type="text" name="email" placeholder="{{trans('words.email')}}"/>
                </div>

                <div class="field">

                    <label for="">{{trans('words.password')}}</label>
                    <input type="password" name="password" placeholder="{{trans('words.password')}}"/>
                </div>

                <button type="submit" class="ui positive right labeled icon button">
                    {{trans('words.save')}}
                    <i class="checkmark icon"></i>
                </button>


                {{Form::close()}}
            </div>
            <div class="actions">
                <div class="ui default deny button">
                    {{trans('words.close')}}
                </div>


            </div>
        </div>


    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $('.pointing .item')
                .tab()
        ;

        $('.ui.dropdown').dropdown()

        $('.newAdmin').on('click', function () {
            $('.ui.modal').
                    modal('show')
        })

        $catform = $('.ui.form')

        $catform.form({
            fields: {
                name: {
                    identifier: 'full_name',
                    rules: [
                        {
                            type: 'empty',
                            prompt: '{{trans('validation.required', ['attribute' => 'full name'])}}'

                        }

                    ]
                }, email: {
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
                        },
                        {
                            type: 'length[6]',
                            prompt: '{{trans('validation.min.string', ['attribute' => 'password', 'min' => 6])}}'
                        }
                    ]
                },

            }
        })
        ;
    </script>

@endsection