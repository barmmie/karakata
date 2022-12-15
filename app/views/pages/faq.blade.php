@extends('layouts.public')

@section('title')
    {{trans('words.faq')}}
@endsection

@section('content')

    <div class="row padding-reset">
        <div class="column padding-reset">
            <div class="ui large message cta">
                <div class="p-md">
                    <h1 class="ui huge centered-text inverted header ">
                        {{trans('words.faq')}}
                        <div class="inverted sub header">
                            {{Setting::get('site_slogan')}}

                        </div>
                    </h1>
                </div>

            </div>
        </div>
    </div>



    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="ui two wide column">

            </div>
            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <div class="ui breadcrumb">
                            <a class="section" href="{{route('pages.homepage')}}">{{trans('words.home')}}</a>
                            <i class="right angle icon divider"></i>

                            <div class="active section"> {{trans('words.faq')}}</div>


                        </div>
                    </div>


                    <div class="ui padded segment">
                        {{--<h4 class="ui header">Page Font</h4>--}}
                        <p>A site can specify styles for page content.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel tincidunt eros, nec
                            venenatis ipsum. Nulla hendrerit urna ex, id sagittis mi scelerisque vitae. Vestibulum
                            posuere rutrum interdum. Sed ut ullamcorper odio, non pharetra eros. Aenean sed lacus sed
                            enim ornare vestibulum quis a felis. Sed cursus nunc sit amet mauris sodales tempus. Nullam
                            mattis, dolor non posuere commodo, sapien ligula hendrerit orci, non placerat erat felis vel
                            dui. Cras vulputate ligula ut ex tincidunt tincidunt. Maecenas eget gravida lorem. Nunc nec
                            facilisis risus. Mauris congue elit sit amet elit varius mattis. Praesent convallis placerat
                            magna, a bibendum nibh lacinia non.</p>

                        <p>Fusce mollis sagittis elit ut maximus. Nullam blandit lacus sit amet luctus euismod. Duis
                            luctus leo vel consectetur consequat. Phasellus ex ligula, pellentesque et neque vitae,
                            elementum placerat eros. Proin eleifend odio nec velit lacinia suscipit. Morbi mollis ante
                            nec dapibus gravida. In tincidunt augue eu elit porta, vel condimentum purus posuere.
                            Maecenas tincidunt, erat sed elementum sagittis, tortor erat faucibus tellus, nec molestie
                            mi purus sit amet tellus. Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Mauris a tincidunt metus. Fusce congue metus aliquam ex
                            auctor eleifend.</p>

                        <p>Ut imperdiet dignissim feugiat. Phasellus tristique odio eu justo dapibus, nec rutrum ipsum
                            luctus. Ut posuere nec tortor eu ullamcorper. Etiam pellentesque tincidunt tortor, non
                            sagittis nibh pretium sit amet. Sed neque dolor, blandit eu ornare vel, lacinia porttitor
                            nisi. Vestibulum sit amet diam rhoncus, consectetur enim sit amet, interdum mauris. Praesent
                            feugiat finibus quam, porttitor varius est egestas id.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.advanced_filter.accordion').accordion();
        });

        $('.ui.form').form();


    </script>
@endsection