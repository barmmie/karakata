@extends('layouts.navless')

@section('title')
    Installation
@endsection

@section('content')
    <div class="ui middle aligned center aligned text container p-t-lg">
        <div class="column">
            <h2 class="ui teal center aligned icon header">
                <i class="large desktop icon"></i>

                <div class="content">
                    Installing {{Setting::get('site_name', 'Karakata')}}

                </div>
            </h2>
            <div class="ui stacked segments">


                @if($conditions_satisfied)
                    <div class="ui segment">

                        {{Form::open(['route' => 'installers.store', 'class'=> 'ui form left-align'])}}
                        @include('partials._form_errors')
                        <div class="ui error message"></div>

                        <h4 class="ui dividing header">Administration information</h4>

                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">Administrator email</label>

                                    <div class="ui left icon input">
                                        <i class="mail icon"></i>
                                        {{Form::email('email', null, ['placeholder'=>"E-mail address"])}}
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="">Administrator password</label>

                                    <div class="ui left icon input">
                                        <i class="lock icon"></i>
                                        {{Form::password('password', ['placeholder'=>"Password"])}}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4 class="ui dividing header">App information</h4>

                        <div class="field">
                            <div class="two fields">
                                <div class="field ">
                                    <label>{{trans('phrases.site_name')}}</label>
                                    {{Form::text('site_name', Setting::get('site_name'))}}
                                </div>

                                <div class="field ">
                                    <label>{{trans('words.currency')}}</label>

                                    {{Form::text('currency', Setting::get('currency', '$'))}}
                                </div>
                            </div>
                        </div>


                        <div class="field">
                            <label for="">{{trans('words.slogan')}}</label>
                            {{Form::text('site_slogan', Setting::get('site_slogan'))}}
                        </div>


                        <h4 class="ui dividing header">Envato information</h4>

                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">Envato username</label>

                                    <div class="ui left icon input">
                                        <i class="user icon"></i>
                                        {{Form::text('envato_username', null, ['placeholder'=>"Envato username"])}}
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="">Envato purchase code</label>

                                    <div class="ui left icon input">
                                        <i class="key icon"></i>
                                        {{Form::text('envato_purchase_code', null, ['placeholder'=>"Purchase code"])}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="ui fluid large teal submit button"><i
                                    class="arrow circle down icon"></i> Install
                        </button>



                        {{Form::close()}}
                    </div>

                @else
                    <div class="ui secondary segment">
                        <div class="ui header">
                            <i class="warning icon">
                            </i>
                            One or more installation requirement was not met.

                        </div>
                    </div>
                    <div class="ui segment">
                        <div class="ui icon {{$db_status? 'positive' : 'negative'}} message">
                            <i class="{{$db_status ? 'thumbs up': 'cancel'}} icon"></i>

                            <div class="ui content">
                                <div class="header">
                                    Database connection
                                </div>
                                @if($db_status)
                                    <p>Connected to db: <code>{{$db_name}}</code></p>
                                @else
                                    <p>Could not connect to DB: <code>{{$db_name}}</code></p>
                                @endif
                            </div>


                        </div>

                        <div class="ui icon {{$curl_status? 'positive' : 'negative'}} message">
                            <i class="{{$curl_status ? 'thumbs up': 'cancel'}} icon"></i>

                            <div class="ui content">
                                <div class="header">
                                    Curl Extension
                                </div>
                                @if($curl_status)
                                    <p>Curl extension was found: </p>
                                @else
                                    <p><code>curl</code> Required! Please enable curl extension.</p>
                                @endif
                            </div>

                        </div>


                        <div class="ui icon {{$php_version_status? 'positive' : 'negative'}} message">
                            <i class="{{$php_version_status ? 'thumbs up': 'cancel'}} icon"></i>

                            <div class="ui content">
                                <div class="header">
                                    PHP Version
                                </div>
                                @if($php_version_status)
                                    <p>PHP version was met: <code>{{phpversion()}}</code></p>
                                @else
                                    <p>Minimum PHP version required is PHP5 and above: <code>{{phpversion()}}</code></p>
                                @endif
                            </div>

                        </div>

                        <div class="ui icon {{$php_version_status? 'positive' : 'negative'}} message">
                            <i class="{{$php_version_status ? 'thumbs up': 'cancel'}} icon"></i>

                            <div class="ui content">
                                <div class="header">
                                    Storage write permission
                                </div>
                                @if($php_version_status)
                                    <p>Storage folder is writeable <code>{{storage_path()}}</code></p>
                                @else
                                    <p>Please allow write permisions on this folder<code>{{storage_path()}}</code></p>
                                @endif
                            </div>

                        </div>

                    </div>






                @endif
            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            $('.ui.checkbox')
                    .checkbox();

            $form = $('.ui.form')

            var installation_url = "{{route('installers.store')}}"

            $form.form({

                fields: {
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: '{{trans('validation.email', ['attribute' => 'email'])}}'
                            }
                        ]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'password'])}}'
                            }
                        ]
                    },

                    site_name: {
                        identifier: 'site_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'site name'])}}'
                            }
                        ]
                    },
                    envato_username: {
                        identifier: 'envato_username',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'envato username'])}}'
                            }
                        ]
                    },
                    envato_purchase_code: {
                        identifier: 'envato_purchase_code',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'envato purchase code'])}}'
                            }
                        ]
                    }
                }
            });
        });
    </script>
@endsection
