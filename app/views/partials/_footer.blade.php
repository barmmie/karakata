<div class="m-t-lg ">
    <div class="ui inverted vertical segment p-t-md">
        <div class="ui container">
            <div class="ui stackable inverted divided equal height stackable grid">
                <div class="three wide column">
                    <h4 class="ui inverted header"></h4>

                    <div class="ui inverted link list">
                        <a href="{{route('pages.sitemap')}}" class="item">{{trans('words.sitemap')}}</a>
                        <a href="{{route('pages.privacy_policy')}}" class="item">{{trans('phrases.privacy_policy')}}</a>
                        <a href="{{route('pages.terms_conditions')}}" class="item">{{trans('phrases.terms_conditions')}}</a>
                    </div>
                </div>

                <div class="three wide column">
                    <h4 class="ui inverted header"></h4>

                    <div class="ui inverted link list">
                        <a href="{{route('pages.about')}}" class="item">{{trans('phrases.about_us')}}</a>
                        <a href="{{route('users.login')}}" class="item">{{trans('words.login')}}</a>
                        <a href="{{route('users.register')}}" class="item">{{trans('words.signup')}}</a>
                    </div>
                </div>

                <div class="three wide column">
                    <h4 class="ui inverted header"></h4>

                    <div class="ui inverted link list">
                        <a href="{{route('pages.feed', 'rss')}}" class="item">RSS Feed</a>
                        <a href="{{route('pages.feed', 'atom')}}" class="item">Atom Feed</a>

                    </div>
                </div>

                <div class="seven wide column">
                    <h4 class="ui inverted header">{{Setting::get('site_name')}}</h4>

                    <p>Copyright © 2015 . {{Setting::get('site_name')}}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
