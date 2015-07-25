<div class="mast item">
    <a class="ui logo icon image" href="/">
        <i class="shadowed circular search icon "></i>
    </a>
    <a href="/"><b>Enclassified</b></a>
</div>

<div class="item" href="/introduction/getting-started.html">
    <h4 class="ui grey header">
        <img src="{{asset('images/user.jpg')}}" class="ui circular image">
        <div class="content">
            <div class="sub header">Welcome</div>
            Plug-ins
        </div>
    </h4>
</div>

<div class="item">
    <div class="header">Introduction</div>
    <div class="menu">

        <a class="item" href="/introduction/integrations.html">
            Integrations
        </a>

        <a class="item" href="/introduction/build-tools.html">
            Build Tools
        </a>

        <a class="item" href="/introduction/advanced-usage.html">
            Recipes
        </a>

        <a class="item" href="/introduction/glossary.html">
            Glossary
        </a>

    </div>
</div>
<div class="item">
    <div class="header">Settings</div>
    <div class="menu">

        <a class="item" href="{{route('admin.locations.index')}}">
            <i class="marker icon"></i> Manage locations
        </a>

        <a class="item" href="{{URL::action('Admin\CategoriesController@getIndex')}}">
            Manage Categories
        </a>

    </div>
</div>
<a class="item" href="/introduction/new.html">
    <i class="sign out icon"></i>Logout
</a>
