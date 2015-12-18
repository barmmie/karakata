
<div class="mast item">
    @if(Setting::get('logo_src')!='')
        <img src="{{asset(Setting::get('logo_src'))}}" class="logo" alt=""/>
        <a href="{{route('admin.dashboard')}}">
            <b>
                {{Setting::get('site_name', 'Karakata')}}</b>
        </a>
    @else
        <a href="{{route('admin.dashboard')}}">
            <i class="circular inverted big teal shadowed search icon"></i>
            <b>
                {{Setting::get('site_name', 'Karakata')}}</b>
        </a>
    @endif


</div>

<a class="item" target="_blank" href="{{route('pages.homepage')}}">
    <i class="sign out icon"></i>{{trans('phrases.view_frontend')}}
</a>
<a class="item" href="{{route('admin.dashboard')}}">
    <i class="dashboard icon"></i> {{trans('phrases.admin_dashboard')}}
</a>

<div class="item">
    <div class="header">Content</div>
    <div class="menu">

        <a class="item" href="{{route('admin.users.index')}}">
            <i class="users icon"></i> {{trans('phrases.manage_users')}}
        </a>

        <a class="item" href="{{route('admin.items.index')}}">
            <i class="tags icon"></i> {{trans('phrases.manage_posted_items')}}
        </a>

        <a class="item" href="{{route('admin.reports.index')}}">
            <i class="warning circle icon"></i> {{trans('phrases.manage_abuse_reports')}}
        </a>

    </div>
</div>
<div class="item">
    <div class="header">Settings</div>
    <div class="menu">

        <a class="item" href="{{route('settings.edit')}}">
            <i class="settings icon"></i> {{trans('phrases.app_settings')}}
        </a>

        <a class="item" href="{{route('admin.locations.index')}}">
            <i class="marker icon"></i> {{trans('phrases.manage_locations')}}
        </a>

        <a class="item" href="{{URL::action('Admin\CategoriesController@getIndex')}}">
            <i class="sitemap icon"></i> {{trans('phrases.manage_categories')}}
        </a>

    </div>
</div>
<a class="item" href="{{route('sessions.destroy')}}">
    <i class="sign out icon"></i>{{trans('words.logout')}}
</a>
