<div class="ui segments">
    <div class="ui segment">


        <h4 class="header">My items</h4>

        <div class="ui secondary pointing vertical side menu">
            <a class="active teal item">
                My items
                <div class="ui teal pointing left label">{{Auth::user()->items()->count()}}</div>
            </a>
            <a class="item ">
                Liked items
                <div class="ui left label">{{Auth::user()->favorites()->count()}}</div>
            </a>

            <a class="item ">
                Messages
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

