@extends('layouts.admin')


@section('content')
    <div class="main ui container">

        <div class="ui segments">
            <div class="ui segment">
                <h4 class="ui header">Manage Settings
                    <div class="sub header">
                        Click on a category name below to modify it. Drag to make it a sub-category or modify its position
                    </div>
                </h4>
            </div>
            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a class="active item" data-tab="first">Site details</a>
                    <a class="item" data-tab="second">Third party keys</a>
                    <a class="item" data-tab="third">Third</a>
                </div>

            </div>
            <div class="ui segment">
                {{Form::open(['route' => 'settings.update', 'class' => 'ui form'])}}

                <div class="ui  active tab segment" data-tab="first">

                        <h4 class="ui dividing header">Site details</h4>
                        <div class="field">

                            <label>Site name</label>

                            {{Form::text('site_name', Setting::get('site_name'))}}

                        </div>
                        <div class="field">
                            <label>Site description</label>
                            {{Form::textarea('site_description', Setting::get('site_description'))}}
                        </div>
                        <div class="field">
                            <div class="two fields">

                                <div class="field">
                                    <label>Currency</label>

                                    {{Form::text('currency', Setting::get('currency'))}}
                                </div>
                                <div class="field">
                                    <label for="">Slogan</label>
                                    {{Form::text('site_slogan')}}
                                </div>
                            </div>
                        </div>

                </div>
                <div class="ui  tab segment" data-tab="second">
                    Second
                </div>
                <div class="ui tab segment" data-tab="third">
                    Third
                </div>

                <button class="ui teal labeled icon button" tabindex="0" type="submit"><i class="save icon"></i> Save changes</button>
                {{Form::close()}}

            </div>
        </div>


    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $('.pointing .item')
                .tab()
        ;
    </script>

@endsection