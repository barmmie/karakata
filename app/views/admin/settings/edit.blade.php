@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/dropzone/dist/min/dropzone.min.css')}}"/>
@endsection

@section('title')
    {{trans('phrases.app_settings')}}
@endsection


@section('content')
    <div class="main ui container">

        <div class="ui segments">
            <div class="ui segment">
                <h4 class="ui header">   {{trans('phrases.app_settings')}}


                </h4>
            </div>
            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a class="active item" data-tab="first">{{trans('phrases.site_details')}}</a>
                    <a class="item" data-tab="second">{{trans('phrases.third_party_keys')}}</a>
                    <a class="item" data-tab="third">{{trans('phrases.paypal_payment')}}</a>
                </div>

            </div>
            <div class="ui segment">
                {{Form::open(['route' => 'settings.update', 'class' => 'ui form'])}}

                <div class="ui  active tab content p-md" data-tab="first">

                    <h4 class="ui dividing header">{{trans('phrases.site_details')}}</h4>


                    <div class="field">
                        <div class="two fields">
                            <div class="four wide field">
                                <label for="">{{trans('phrases.site_logo')}}</label>

                                <div id="myDropZone" class="dropzone">
                                    <div class="fallback">
                                        <input name="files" type="file"/>

                                        <p>{{trans('phrases.upload_logo')}}</p>
                                    </div>
                                </div>
                                {{Form::hidden('logo_src', Setting::get('logo_src'))}}
                            </div>
                            <div class="twelve wide field">
                                <div class="field p-l-md">
                                    <label>{{trans('phrases.site_name')}}</label>
                                    {{Form::text('site_name', Setting::get('site_name'))}}
                                </div>


                                <div class="field p-md">
                                    <label for="">{{trans('words.slogan')}}</label>
                                    {{Form::text('site_slogan', Setting::get('site_slogan'))}}
                                </div>

                                <div class="field p-md">
                                    <label>{{trans('words.currency')}}</label>

                                    {{Form::text('currency', Setting::get('currency'))}}
                                </div>

                                <div class="field p-md">
                                    <div class="two fields">
                                        <div class="field">
                                            <label for="">RTL display</label>
                                            {{Form::semanticCheckbox('rtl_display', '1', Setting::get('rtl_display', '0'))}}
                                        </div>
                                        <div class="field">
                                            <label for="">Mask user's phone numer</label>
                                            {{Form::semanticCheckbox('mask_phone', '1', Setting::get('mask_phone', '0'))}}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">{{trans('phrases.admin_email')}}</label>
                                {{Form::text('admin_email', Setting::get('admin_email'))}}
                                <p>{{trans('phrases.admin_email_to_send')}}</p>
                            </div>
                            <div class="field">
                                <label for="">{{trans('phrases.email_from')}}</label>
                                {{Form::text('email_from', Setting::get('email_from'))}}
                                <p>{{trans('phrases.admin_email_from')}}</p>

                            </div>
                        </div>
                    </div>



                    <div class="field">
                        <label>{{trans('phrases.site_description')}}</label>
                        {{Form::textarea('site_description', Setting::get('site_description'))}}
                    </div>

                </div>
                <div class="ui  tab content p-md" data-tab="second">
                    <h4 class="ui dividing header">{{trans('phrases.third_party_keys')}}</h4>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">{{trans('phrases.250_wide_banner')}}</label>
                                {{Form::textarea('ad_250', Setting::get('ad_250'))}}
                                <p>Ideally a {{trans('phrases.250_wide_banner')}}</p>
                            </div>
                            <div class="field">
                                <label for="">{{trans('phrases.leaderboard_banner')}}</label>
                                {{Form::textarea('ad_leaderboard', Setting::get('ad_leaderboard'))}}
                                <p>Ideally a {{trans('phrases.leaderboard_banner')}}</p>

                            </div>
                        </div>
                    </div>


                    <div class="field">
                        <label>{{trans('phrases.analytics_code')}}</label>
                        {{Form::textarea('analytics', Setting::get('analytics'))}}
                        <p>{{trans('phrases.paste_analytics_code')}}</p>
                    </div>


                </div>

                <div class="ui  tab content p-md" data-tab="third">
                    <h4 class="ui dividing header">{{trans('phrases.paypal_payment')}}</h4>

                    <div class="field">
                        <label for="">Allow premium payment</label>
                        {{Form::semanticCheckbox('allow_premium_payment', '1', Setting::get('allow_premium_payment', '0'))}}
                    </div>

                    <div>


                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">Amount for premium</label>
                                    {{Form::text('premium_amount', Setting::get('premium_amount', 40))}}
                                </div>
                                <div class="field">
                                    <label for="">No of days</label>
                                    {{Form::text('premium_days', Setting::get('premium_days', 40))}}
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">Paypal Currency</label>
                                    {{Form::text('paypal_currency', Setting::get('paypal_currency', 'USD'))}}
                                    <p>Example: USD, GBP</p>
                                </div>
                                <div class="field">
                                    <label for="">Paypal Testing mode</label>
                                    {{Form::semanticCheckbox('paypal_test_mode', '1', (Setting::get('paypal_test_mode', '1')== '1') )}}
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">Paypal API username</label>
                                    {{Form::text('paypal_username', Setting::get('paypal_username'))}}

                                </div>
                                <div class="field">
                                    <label for="">Paypal API password</label>
                                    {{Form::text('paypal_password', Setting::get('paypal_password'))}}

                                </div>
                            </div>
                            <p>NOTE: Not your paypal username / password : Your Payment Credentials can be obtained here <a href="https://developer.paypal.com/docs/classic/api/apiCredentials">https://developer.paypal.com/docs/classic/api/apiCredentials</a></p>
                        </div>

                        <div class="field">
                            <label for="">Paypal API signature</label>
                            {{Form::text('paypal_signature', Setting::get('paypal_signature'))}}
                        </div>
                    </div>


                </div>

                <button class="ui teal labeled icon button" tabindex="0" type="submit"><i
                            class="save icon"></i> {{trans('phrases.save_changes')}}</button>
                {{Form::close()}}

            </div>
        </div>


    </div>
@endsection


@section('scripts')
    <script src="{{asset('assets/dropzone/dist/min/dropzone.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {

            $('.pointing .item')
                    .tab()

            $('.ui.checkbox').checkbox()

            Dropzone.autoDiscover = false;

            dropzone = new Dropzone("div#myDropZone", {
                init: function () {
                    var mockFile = {name: "logo", size: 12345};

                    this.emit("addedfile", mockFile);

                    this.emit("thumbnail", mockFile, "{{Setting::get('logo_src')}}");

                    this.emit("complete", mockFile);

                    var existingFileCount = 1; // The number of files already uploaded
                    this.options.maxFiles = this.options.maxFiles - existingFileCount;
                },
                url: "{{route('pictures.store')}}",
                addRemoveLinks: true,
                maxFilesize: 3,
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=token]').attr("content")
                },

                acceptedFiles: 'image/*',
                dictDefaultMessage: "{{trans('phrases.upload_logo')}}",
                maxfilesexceeded: function (file, rt) {
                    alertify.warning("{{trans('phrases.remove_logo_before_upload')}}")
                    this.removeFile(file);
                },
                success: function (file, response) {
                    file._uuid = response.picture.id;
                    file.isServerProcessed = true;
                    file.previewElement.classList.add('dz-complete');
                    file.previewElement.classList.add("dz-success");

                    $('input[name="logo_src"]').val(response.picture.thumbnail_src)

                },
                error: function (file, response) {
                    alertify.warning("{{trans('phrases.could_not_upload')}}")
                    file.previewElement.classList.add("dz-error");
                }
            });


            dropzone.on('removedfile', function (file) {
                if (file.isServerProcessed) {
                    //remove file._uuid from
                    //$("input[name='pictures_id[]']").val()
                    Form.removeFileFromPicturesArray(file)
                }
                this.options.maxFiles = this.options.maxFiles + 1
            });

        })
    </script>

@endsection