@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/dropzone/dist/min/dropzone.min.css')}}"/>
@endsection

@section('title')
    App settings
@endsection


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
                    <a class="item" data-tab="second">Third party api/keys</a>
                    <a class="item" data-tab="third">Third</a>
                </div>

            </div>
            <div class="ui segment">
                {{Form::open(['route' => 'settings.update', 'class' => 'ui form'])}}

                <div class="ui  active tab content p-md" data-tab="first">

                        <h4 class="ui dividing header">Site details</h4>

                    <div class="field">
                        <div class="two fields">
                            <div class="four wide field">
                                <label for="">Site logo</label>
                                <div id="myDropZone" class="dropzone">
                                    <div class="fallback">
                                        <input name="files" type="file" />
                                        <p>Upload logo</p>
                                    </div>
                                </div>
                                {{Form::hidden('logo_src', Setting::get('logo_src'))}}
                            </div>
                            <div class="twelve wide field">
                                <div class="field p-l-md">
                                    <label>Site name</label>
                                    {{Form::text('site_name', Setting::get('site_name'))}}
                                </div>


                                <div class="field p-md">
                                    <label for="">Slogan</label>
                                    {{Form::text('site_slogan', Setting::get('site_slogan'))}}
                                </div>

                                <div class="field p-md">
                                    <label>Currency</label>

                                    {{Form::text('currency', Setting::get('currency'))}}
                                </div>



                            </div>


                        </div>
                    </div>


                        <div class="field">
                            <label>Site description</label>
                            {{Form::textarea('site_description', Setting::get('site_description'))}}
                        </div>


                </div>
                <div class="ui  tab content p-md" data-tab="second">

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label for="">250 wide Ad banner  </label>
                                {{Form::textarea('ad_250', Setting::get('ad_250'))}}
                                <p>Ideally a 250 wide banner/ad</p>
                            </div>
                            <div class="field">
                                <label for="">Leaderboard banner</label>
                                {{Form::textarea('ad_leaderboard', Setting::get('ad_leaderboard'))}}
                                <p>Ideally a Leaderboard wide banner/ad</p>

                            </div>
                        </div>
                    </div>


                    <div class="field">
                        <label>Analytics code</label>
                        {{Form::textarea('analytics', Setting::get('analytics'))}}
                        <p>Paste your google analytics code here</p>
                    </div>
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
                dictDefaultMessage: 'Upload logo',
                maxfilesexceeded: function (file, rt) {
                    alertify.warning('Remove the current logo before uploading a new one')
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
                    alertify.warning('Could not upload ')
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