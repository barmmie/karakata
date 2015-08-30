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
                    <a class="active item" data-tab="first">{{trans('phrases.site_detail')}}</a>
                    <a class="item" data-tab="second">{{trans('phrases.third_party_keys')}}</a>
                </div>

            </div>
            <div class="ui segment">
                {{Form::open(['route' => 'settings.update', 'class' => 'ui form'])}}

                <div class="ui  active tab content p-md" data-tab="first">

                        <h4 class="ui dividing header">{{trans('phrases.site_detail')}}</h4>

                    <div class="field">
                        <div class="two fields">
                            <div class="four wide field">
                                <label for="">{{trans('phrases.site_logo')}}</label>
                                <div id="myDropZone" class="dropzone">
                                    <div class="fallback">
                                        <input name="files" type="file" />
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



                            </div>


                        </div>
                    </div>


                        <div class="field">
                            <label>{{trans('phrases.site_description')}}</label>
                            {{Form::textarea('site_description', Setting::get('site_description'))}}
                        </div>


                </div>
                <div class="ui  tab content p-md" data-tab="second">
                    <h4 class="ui dividing header">{{trans('phrases.third_party_key')}}</h4>

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
                                <p>Ideally a {{trans('phrases.250_wide_banner')}}</p>

                            </div>
                        </div>
                    </div>


                    <div class="field">
                        <label>{{trans('phrases.analytics_code')}}</label>
                        {{Form::textarea('analytics', Setting::get('analytics'))}}
                        <p>{{trans('phrases.paste_analytics_code')}}</p>
                    </div>
                </div>

                <button class="ui teal labeled icon button" tabindex="0" type="submit"><i class="save icon"></i> {{trans('phrases.save_changes')}}</button>
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

            Dropzone.autoDiscover = false;

            dropzone = new Dropzone("div#myDropZone", {
                init: function() {
                    var mockFile = { name: "logo", size: 12345 };

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