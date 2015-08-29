<div class="mast item">
    @if(Setting::get('logo_src')!='')
        <img src="{{Setting::get('logo_src')}}" class="logo" alt=""/>
    @else
        <i class="circular inverted big teal shadowed search icon"></i>
    @endif
    <a href="/"><b>{{Setting::get('site_name', 'Enclassified')}}</b></a>
</div>

<a class="item" target="_blank" href="{{route('pages.homepage')}}">
    <i class="sign out icon"></i>View frontend
</a>

<div class="item">
    <div class="header">Content</div>
    <div class="menu">

        <a class="item" href="{{route('admin.users.index')}}">
           <i class="users icon"></i> Manage users
        </a>

        <a class="item" href="{{route('admin.items.index')}}">
            <i class="tags icon"></i>Manage posted items
        </a>

        <a class="item" href="{{route('admin.reports.index')}}">
            <i class="warning circle icon"></i> Manage abuse reports
        </a>



    </div>
</div>
<div class="item">
    <div class="header">Settings</div>
    <div class="menu">

        <a class="item" href="{{route('settings.edit')}}">
            <i class="settings icon"></i> App settings
        </a>

        <a class="item" href="{{route('admin.locations.index')}}">
            <i class="marker icon"></i> Manage locations
        </a>

        <a class="item" href="{{URL::action('Admin\CategoriesController@getIndex')}}">
           <i class="sitemap icon"></i> Manage Categories
        </a>

    </div>
</div>
<a class="item" href="/introduction/new.html">
    <i class="sign out icon"></i>Logout
</a>
