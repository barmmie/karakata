<div class="ui grid">
    <div class="computer tablet only row">
        <div class="ui fixed padded secondary menu navbar page grid ">
            <a class="item" href="{{route('pages.homepage')}}">
                <i class="circular inverted big teal shadowed search icon"></i>
               <span class="ui large header  m-t-none">ENCLASSIFIED</span>

            </a>

            <div class="right secondary menu">
                @if(Auth::check())

                        <a class="item p-r-none" href="{{route('sessions.destroy')}}">
                            <i class="sign out icon "></i> Logout
                        </a>



                    <div class="item p-r-none">
                        <div class="ui buttons">
                            <div class="ui button">{{Auth::user()->full_name}}</div>
                            <div class="ui floating dropdown icon button">
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="item" data-value="drop">Drop</div>
                                    <div class="item" data-value="horizontal flip">Horizontal Flip</div>
                                    <div class="item" data-value="fade up">Fade Up</div>
                                    <div class="item" data-value="scale">Scale</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                     <a href="{{route('users.login')}}" class="item p-r-none">Login</a>
                    <a href="{{route('users.register')}}" class="item p-r-none">Signup</a>
                @endif

                <div class="item p-r-none">
                    <a class="ui huge red icon button nag-login" href="{{route('items.new')}}" data-content="Login required">
                        <i class="icon money"></i>
                        Sell your item
                    </a>
                </div>

            </div>

        </div>

    </div>
    <div class="mobile only row">
        <div class="ui fixed  navbar menu">
            <div class="item">
                <i class="circular inverted teal search icon"></i>

                <a href="{{route('pages.homepage')}}" class="brand">Enclassified</a>
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
                <a href="{{route('users.login')}}" class="item">Login</a>
                <a href="{{route('users.register')}}" class="item">Signup</a>

                @endif
                <div class="item">
                    <a class="ui huge red button" href="{{route('items.new')}}">
                        <i class="icon money"></i>
                        Sell your item
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>