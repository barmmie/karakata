<div class="ui segments">
    <div class="ui segment">


        <h4 class="header">My items</h4>

        <div class="ui secondary pointing vertical side menu">
            <a class=" item {{Route::is('dash.myitems')?' teal active':''}}" href="{{route('dash.myitems')}}">
                My items
                <div class="ui {{Route::is('dash.myitems')?' teal pointing left ':''}}  label">{{Auth::user()->items()->count()}}</div>
            </a>
            <a class="item {{Route::is('dash.myfavorites')?' teal active':''}}" href="{{route('dash.myfavorites')}}">
                Liked items
                <div class="ui {{Route::is('dash.myfavorites')?' teal pointing left':''}}  label">{{Auth::user()->favorites()->count()}}</div>
            </a>

            <a class="item {{Route::is('dash.mymessages')?' teal active':''}}" href="{{route('dash.mymessages')}}">
                Messages
                <div class="ui {{Route::is('dash.mymessages')?' teal pointing left':''}}  label">{{$unread_message_count}}</div>

            </a>
        </div>


    </div>

    <div class="ui segment">
        <h4 class="header">Enclassified</h4>
        <div class="ui secondary pointing vertical side menu">
            <a class="teal item" href="{{route('users.profile')}}">
                <i class="user icon"></i>
                Update profile
            </a>
            <a class="item" href="{{route('sessions.destroy')}}">
                <i class="sign out icon"></i>
                Logout

            </a>


        </div>
    </div>
</div>

