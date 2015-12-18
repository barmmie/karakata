<div class="ui grid">
    <div class="computer tablet only row">
        <div class="ui fixed padded secondary menu navbar page grid ">
            <a class="item p-r-none m-r-none" href="{{route('pages.homepage')}}">
                @if(Setting::get('logo_src')!='')
                    <img src="{{asset(Setting::get('logo_src'))}}" class="logo" alt=""/>
                @else
                    <i class="circular inverted big teal shadowed search icon"></i>
                @endif
                <span class="ui large header p-l-xs m-t-none">{{Setting::get('site_name', 'Karakata')}}</span>
            </a>

            <div class="right secondary menu p-l-none">
                @if(Auth::check())

                    @if(Auth::user()->isAdmin())
                        <a class="item p-v-none" href="{{route('admin.dashboard')}}">
                            <i class="sign out icon "></i> {{trans('phrases.admin_dashboard')}}
                        </a>
                    @else



                        <div class="item p-v-none">
                            <div class="ui buttons">


                                <a class="ui button" href="{{route('dash.myitems')}}">
                                    @if($unread_message_count > 0)
                                        <div class=" ui circular red label">{{$unread_message_count}}</div>
                                    @endif

                                    {{Auth::user()->full_name}}
                                </a>

                                <div class="ui floating dropdown icon button">
                                    <i class="dropdown icon"></i>

                                    <div class="menu">
                                        <a class="item" href="{{route('users.profile')}}">
                                            <i class="user icon"></i> {{trans('words.profile')}}</a>
                                        <a class="item" href="{{route('sessions.destroy')}}">
                                            <i class="sign out icon "></i> {{trans('words.logout')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                @else
                    <a href="{{route('users.login')}}" class="item ">{{trans('words.login')}}</a>
                    <a href="{{route('users.register')}}" class="item ">{{trans('words.signup')}}</a>
                @endif

                <div class="item p-v-none">
                    <a class="ui huge red icon button nag-login" href="{{route('items.new')}}"
                       data-content="{{trans('phrases.login_required')}}">
                        <i class="icon money"></i>
                        {{trans('phrases.sell_your_item')}}
                    </a>
                </div>

                <div class="item p-v-none">
                    <div class="ui floating dropdown labeled search icon button">
                        <i class="world icon"></i>
                        <span class="text">Change Language</span>
                        <div class="menu">
                            @foreach($available_langs as $key => $lang)
                                <a href="{{route('language_switcher', $key)}}" class="item">{{$lang}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="mobile only row">
        <div class="ui fixed  navbar menu">
            <div class="item">
                <i class="circular inverted teal search icon"></i>

                <a href="{{route('pages.homepage')}}" class="brand">{{Setting::get('site_name', 'Karakata')}}</a>
            </div>

            <div class="right menu open">
                <a href="" class="menu item">
                    <i class="content icon"></i>
                </a>
            </div>
        </div>

        <div class="ui vertical navbar menu">
            <div style="margin-top: 80px; ">
                @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                        <a class="item" href="{{route('admin.dashboard')}}">
                            <i class="sign out icon "></i> {{trans('phrases.admin_dashboard')}}
                        </a>
                    @else

                        <a class="item" href="{{route('sessions.destroy')}}">
                            <i class="sign out icon "></i> {{trans('words.logout')}}
                        </a>

                        <div class="item">
                            <div class="ui buttons">


                                <a class="ui button" href="{{route('dash.myitems')}}">
                                    @if($unread_message_count > 0)
                                        <div class=" ui circular red label">{{$unread_message_count}}</div>
                                    @endif

                                    {{Auth::user()->full_name}}
                                </a>

                                <div class="ui floating dropdown icon button">
                                    <i class="dropdown icon"></i>

                                    <div class="menu">
                                        <a class="item" href="">{{trans('words.profile')}}</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <a href="{{route('users.login')}}" class="item">{{trans('words.login')}}</a>
                    <a href="{{route('users.register')}}" class="item">{{trans('words.signup')}}</a>

                @endif
                <div class="item">
                    <a class="ui huge red button" href="{{route('items.new')}}">
                        <i class="icon money"></i>
                        {{trans('phrases.sell_your_item')}}
                    </a>
                </div>
                    <div class="item">
                        <div class="ui floating dropdown labeled search icon button">
                            <i class="world icon"></i>
                            <span class="text">Change Language</span>
                            <div class="menu">
                                @foreach($available_langs as $key => $lang)
                                    <a href="{{route('language_switcher', $key)}}" class="item">{{$lang}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>


        </div>
    </div>
</div>