@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/dropzone/dist/min/dropzone.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/croppic.css')}}"/>
    <style>
        #cropContainerHeader {
            width: 200px;
            height: 150px;
            position:relative; /* or fixed or absolute */
        }
    </style>
@endsection

@section('title')
    {{trans('phrases.app_settings')}}
@endsection


@section('content')
    <div class="main ui container">
        {{Form::open(['route' => 'settings.update', 'class' => 'ui form'])}}

        <div class="ui segments">
            <div class="ui segment">
                <h4 class="ui header">   {{trans('phrases.app_settings')}}


                </h4>
            </div>
            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a class="active item" data-tab="first">{{trans('phrases.site_details')}}</a>
                    <a class="item" data-tab="second">{{trans('phrases.third_party_keys')}}</a>
                    <a class="item" data-tab="third">Payment settings</a>
                    <a class="item" data-tab="fourth">Email setup</a>
                    <a class="item" data-tab="fifth">Image storage setup</a>
                </div>

            </div>

            <div class="ui segment">

                <div class="ui  active tab content p-md" data-tab="first">

                    <h4 class="ui dividing header">{{trans('phrases.site_details')}}</h4>


                    <div class="field">
                        <div class="two fields">
                            <div class="four wide field">
                                <label for="">{{trans('phrases.site_logo')}}</label>

                                <div class="cropzone" data-ghost="false"
                                     data-width="250" data-height="250"
                                     data-resize="true" data-url="{{route('pictures.uploadLogo')}}"
                                     @if(Setting::get('logo_src','') !=''))
                                     data-image="{{asset(Setting::get('logo_src',''))}}"
                                     @endif
                                     >
                                    <input type="file" name="thumb" />
                                </div>
                                <p>You can resize and readjust your logo before clicking save</p>

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
                                    <label for="">Default language</label>
                                    <div class="ui fluid search selection dropdown">
                                        {{Form::hidden('default_locale', Setting::get('default_locale', 'en'))}}
                                        <i class="dropdown icon"></i>

                                        <div class="default text">Choose default language</div>
                                        <div class="menu">
                                            @foreach($available_langs as $key => $lang)

                                                <div class="item" data-value="{{$key}}"><i
                                                            class="world icon"></i>{{$lang}}</div>

                                            @endforeach

                                        </div>
                                    </div>
                                </div>



                            </div>



                        </div>
                    </div>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">RTL display</label>
                                {{Form::semanticCheckbox('rtl_display', '1', Setting::get('rtl_display', '0'))}}
                                <p><small>Use Right to left display</small></p>
                            </div>
                            <div class="field">
                                <label for="">Mask user's phone number</label>
                                {{Form::semanticCheckbox('mask_phone', '1', Setting::get('mask_phone', '0'))}}
                                <p><small>Initially hide sellers phone number on item page</small></p>
                            </div>

                        </div>
                    </div>

                    <div class="field ">
                        <div class="two fields">
                            <div class="field">
                                <label for="">Require email confirmation </label>
                                {{Form::semanticCheckbox('require_email_confirmation', '1', Setting::get('require_email_confirmation', '1'))}}
                                <p><small>When new users register do you want them to confirm emails?</small></p>
                            </div>
                            <div class="field">
                                <label for="">Require item verification on new item post</label>
                                {{Form::semanticCheckbox('require_item_verification', '1', Setting::get('require_email_confirmation', '1'))}}
                                <p><small>When new items are posted do you want it to be verified?</small></p>
                            </div>
                            </div>

                    </div>







                    <div class="field">
                        <label>{{trans('phrases.site_description')}}</label>
                        {{Form::textarea('site_description', Setting::get('site_description'))}}
                    </div>

                </div>
                <div class="ui  tab content p-md" data-tab="second">
                    <h4 class="ui dividing header">Social authentication</h4>
                    <div class="field">
                        <div class="three fields">
                            <div class="field">
                                <label for=""><i class="icon facebook"></i> Allow Facebook login</label>
                                {{Form::semanticCheckbox('allow_facebook_login', '1', Setting::get('allow_facebook_login', '0'))}}
                            </div>
                            <div class="field">
                                <label for=""> Facebook client id
                                </label>
                                {{Form::text('facebook_client_id', Setting::get('facebook_client_id'))}}

                            </div>
                            <div class="field">
                                <label for="">Facebook client secret</label>
                                {{Form::text('facebook_client_secret', Setting::get('facebook_client_secret'))}}

                            </div>
                        </div>
                        <p><small>Your facebook credentials can be gotten from here <a href="https://developers.facebook.com/apps/" target="_blank">https://developers.facebook.com/apps</a></small></p>
                    </div>

                    <div class="field p-t-md">
                        <div class="three fields">
                            <div class="field">
                                <label for=""><i class="icon google"></i> Allow Google login</label>
                                {{Form::semanticCheckbox('allow_google_login', '1', Setting::get('allow_google_login', '0'))}}
                            </div>
                            <div class="field">
                                <label for=""> Google client id
                                </label>
                                {{Form::text('google_client_id', Setting::get('google_client_id'))}}

                            </div>
                            <div class="field">
                                <label for="">Google client secret</label>
                                {{Form::text('google_client_secret', Setting::get('google_client_secret'))}}

                            </div>
                        </div>
                        <p><small>Your google credentials can be gotten from here <a href="https://console.developers.google.com/project" target="_blank">https://console.developers.google.com/project</a></small></p>
                    </div>

                   <h4 class="ui dividing header">Social sharing</h4>

                    <div class="field">
                        <label>Facebook app id</label>
                        {{Form::text('facebook_app_id', Setting::get('facebook_app_id'))}}
                        <p>You need a facebook app id to allow users share items to facebook</p>
                    </div>


                    <h4 class="ui dividing header">{{trans('phrases.third_party_keys')}}</h4>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">{{trans('phrases.250_wide_banner')}}</label>
                                {{Form::textarea('ad_250', Setting::get('ad_250'))}}
                                <p>Paste your google advert here</p>
                            </div>
                            <div class="field">
                                <label for="">{{trans('phrases.leaderboard_banner')}}</label>
                                {{Form::textarea('ad_leaderboard', Setting::get('ad_leaderboard'))}}
                                <p>paste your advert code here</p>

                            </div>
                        </div>
                    </div>


                    <div class="field">
                        <label>{{trans('phrases.analytics_code')}}</label>
                        {{Form::textarea('analytics', Setting::get('analytics'))}}
                        <p>{{trans('phrases.paste_analytics_code')}}</p>
                    </div>


                </div>

                <div class="ui tab content p-md" data-tab="third">

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

                    <h4 class="ui dividing header">{{trans('phrases.paypal_payment')}}</h4>

                    <div class="p-md">
                        <div class="field">
                            <div class="three fields">
                                <div class="field">
                                    <label for="">Allow paypal premium payment</label>
                                    {{Form::semanticCheckbox('allow_premium_payment', '1', Setting::get('allow_premium_payment', '0'))}}
                                </div>
                                <div class="field">
                                    <label for="">Paypal Testing mode</label>
                                    {{Form::semanticCheckbox('paypal_test_mode', '1', (Setting::get('paypal_test_mode', '1')== '1') )}}
                                </div>
                                <div class="field">
                                    <label for="">Paypal Currency e.g usd, gbp, eur</label>
                                    {{Form::text('paypal_currency', Setting::get('paypal_currency', 'USD'))}}
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
                            <p>NOTE: Not your paypal username / password : Your Payment Credentials can be obtained here <a href="https://developer.paypal.com/docs/classic/api/apiCredentials" target="_blank">https://developer.paypal.com/docs/classic/api/apiCredentials</a></p>
                        </div>

                        <div class="field">
                            <label for="">Paypal API signature</label>
                            {{Form::text('paypal_signature', Setting::get('paypal_signature'))}}
                        </div>

                    </div>





                    <h4 class="ui dividing header">Stripe payment settings</h4>
                    <div class="p-md">


                        <div class="field">
                            <div class="three fields">
                                <div class="field">
                                    <label for="">Allow stripe premium payment</label>
                                    {{Form::semanticCheckbox('allow_stripe_premium_payment', '1', Setting::get('allow_stripe_premium_payment', '0'))}}
                                </div>

                                <div class="field">
                                    <label for="">Stripe Testing mode</label>
                                    {{Form::semanticCheckbox('stripe_test_mode', '1', (Setting::get('stripe_test_mode', '1')== '1') )}}
                                </div>

                                <div class="field">
                                    <label for="">Stripe Currency e.g usd, gbp, eur</label>
                                    {{Form::text('stripe_currency', Setting::get('stripe_currency', 'USD'))}}
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">Stripe API secret key</label>
                                    {{Form::text('stripe_api_secret_key', Setting::get('stripe_api_secret_key'))}}
                                </div>
                                <div class="field">

                                    <label for="">Stripe API publishable key</label>
                                    {{Form::text('stripe_api_publishable_key', Setting::get('stripe_api_publishable_key'))}}
                                </div>
                            </div>
                        </div>


                    </div>



                </div>

                <div class="ui  tab content p-md" data-tab="fourth">
                    <h4 class="ui dividing header">Email setup</h4>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">Select email sending type/</label>
                                {{Form::select('mail_driver', ['mail' => 'PHP Mail', 'smtp' => 'SMTP Mail'], Setting::get('mail_driver', 'mail'), ['class' => 'ui dropdown'])}}
                                <p>Choose smtp for mailgun/mandrill or other smtp</p>
                            </div>
                        </div>

                    </div>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">{{trans('phrases.admin_email')}}</label>
                                {{Form::text('admin_email', Setting::get('admin_email'), ['placeholder' => 'e.g noreply@devcyber.com'])}}
                                <p><small>{{trans('phrases.admin_email_to_send')}}</small></p>
                            </div>
                            <div class="field">
                                <label for="">{{trans('phrases.email_from')}}</label>
                                {{Form::text('admin_email_from', Setting::get('admin_email_from'), ['placeholder' => 'e.g Support Team'])}}
                                <p><small>{{trans('phrases.admin_email_from')}}</small></p>

                            </div>
                        </div>
                    </div>

                    <div class="p-t-md">

                        <h4 class="ui horizontal divider header">**Settings below is only for smtp**</h4>



                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">SMTP mail host</label>
                                    {{Form::text('mail_host', Setting::get('mail_host', ''))}}
                                </div>
                                <div class="field">
                                    <label for="">SMTP mail port</label>
                                    {{Form::text('mail_port', Setting::get('mail_port', '587'))}}
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="two fields">
                                <div class="field">
                                    <label for="">SMTP mail username</label>
                                    {{Form::text('mail_username', Setting::get('mail_username', ''))}}
                                </div>
                                <div class="field">
                                    <label for="">SMTP mail password</label>
                                    {{Form::text('mail_password', Setting::get('mail_password', ''))}}

                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="ui  tab content p-md" data-tab="fifth">
                    <h4 class="ui dividing header">Image storage setup</h4>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">Where would you like to store the images</label>
                                {{Form::select('storage_connection', ['local' => 'Locally on this server', 'dropbox' => 'Dropbox', 'awss3' => 'Amazon S3'], Setting::get('storage_connection', 'local'), ['class' => 'ui storage dropdown'])}}
                                <p>Choose the storage mechanism you would like to store images on</p>
                            </div>
                        </div>

                    </div>

                    <div class="p-t-md">

                        <div id="awss3" {{Setting::get('storage_connection', 'local') == 'awss3'?'':'style="display: none;"'}}>
                            <h4 class="ui horizontal divider header"><i class="bitbucket icon"></i> Amazon s3 settings</h4>



                            <div class="field">
                                <div class="two fields">
                                    <div class="field">
                                        <label for="">S3 Bucket name</label>
                                        {{Form::text('storage_awss3_bucket', Setting::get('storage_awss3_bucket', ''))}}
                                    </div>


                                    <div class="field">
                                        <label for="">S3 region name key</label>
                                        {{Form::text('storage_awss3_region_name', Setting::get('storage_awss3_region_name', ''))}}
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label for="">S3 access key ID</label>
                                        {{Form::text('storage_awss3_access_key_id', Setting::get('storage_awss3_access_key_id', ''))}}
                                    </div>

                                    <div class="field">
                                        <label for="">S3 secret access key</label>
                                        {{Form::text('storage_awss3_secret_access_key', Setting::get('storage_awss3_secret_access_key', ''))}}
                                    </div>
                                </div>
                                <p><a href="https://transloadit.com/docs/how-to-set-up-an-amazon-s3-bucket/" target="_blank">How to get your amazon s3 token and credentials</a></p>

                            </div>
                        </div>

                        <div id="dropbox" {{Setting::get('storage_connection', 'local') == 'dropbox'?'':'style="display: none;"'}}>

                            <h4 class="ui horizontal divider header"><i class="dropbox icon"></i> Dropbox settings</h4>


                            <div class="field">
                                <div class="two fields">
                                    <div class="field">
                                        <label for="">Dropbox app name</label>
                                        {{Form::text('storage_dropbox_app_name', Setting::get('storage_dropbox_app_name', ''))}}
                                    </div>
                                    <div class="field">
                                        <label for="">Dropbox app token</label>
                                        {{Form::text('storage_dropbox_app_token', Setting::get('storage_dropbox_app_token', ''))}}

                                    </div>
                                </div>
                                <p><a href="http://www.iperiusbackup.net/en/create-dropbox-app-get-authentication-token/" target="_blank">How to get your dropbox token and credentials</a></p>
                            </div>
                        </div>




                    </div>


                </div>



            </div>
            <div class="ui secondary segment">
                <button class="ui teal labeled icon button" tabindex="0" type="submit"><i
                            class="save icon"></i> {{trans('phrases.save_changes')}}</button>
            </div>

        </div>
        {{Form::close()}}



    </div>
@endsection


@section('scripts')
    <script src="{{asset('assets/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/js/croppic.js')}}"></script>
    <script src="{{asset('assets/js/exif.js')}}"></script>
    <script src="{{asset('assets/js/canvas_resize.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.cropzone').html5imageupload({
                onAfterProcessImage: function() {
                    alertify.success('Logo updated successfully')
                }
            });

            var storage_settings_divs = ['awss3', 'dropbox']
            $('.pointing .item')
                    .tab()

            $('.ui.checkbox').checkbox()
            $('.ui.dropdown').dropdown()

            $('.ui.storage.dropdown').dropdown({
                action: 'activate',
                onChange: function(value, text, $selectedItem) {
                    console.log(value)
                    storage_settings_divs.map(function(val){
                        $('#'+val).hide()
                    })
                    $('#'+value).show()
                }
            })

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




        })
    </script>

@endsection