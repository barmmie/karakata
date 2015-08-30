<div class="ui grid">
    <div class="computer tablet only row">
        <div class="ui fixed padded secondary menu navbar page grid ">
            <a class="item" href="{{route('pages.homepage')}}">
                @if(Setting::get('logo_src')!='')
                <img src="{{Setting::get('logo_src')}}" class="logo" alt=""/>
                @else
                <i class="circular inverted big teal shadowed search icon"></i>
                @endif
               <span class="ui large header p-l-xs m-t-none">{{Setting::get('site_name', 'Enclassified')}}</span>
            </a>
            <div class="right secondary menu">
                @if(Auth::check())

                        <a class="item p-r-none" href="{{route('sessions.destroy')}}">
                            <i class="sign out icon "></i> {{trans('words.logout')}}
                        </a>

                    <div class="item p-r-none">
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
                @else
                     <a href="{{route('users.login')}}" class="item p-r-none">{{trans('words.login')}}</a>
                    <a href="{{route('users.register')}}" class="item p-r-none">{{trans('words.signup')}}</a>
                @endif

                <div class="item p-r-none">
                    <a class="ui huge red icon button nag-login" href="{{route('items.new')}}" data-content="{{trans('phrases.login_required')}}">
                        <i class="icon money"></i>
                        {{trans('phrases.sell_your_item')}}
                    </a>
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
            <div class="m-t-lg p-t-lg">
                @if(Auth::check())
                @else
                <a href="{{route('users.login')}}" class="item">{{trans('words.login')}}</a>
                <a href="{{route('users.register')}}" class="item">{{trans('words.login')}}</a>

                @endif
                <div class="item">
                    <a class="ui huge red button" href="{{route('items.new')}}">
                        <i class="icon money"></i>
                        {{trans('phrases.sell_your_item')}}
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>