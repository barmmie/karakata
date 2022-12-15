@extends('layouts.public')

@section('title')
    {{trans('phrases.post_new_item')}}
@endsection

@section('styles')

    <link rel="stylesheet" href="{{asset('assets/css/jquery.classyedit.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/dropzone/dist/min/dropzone.min.css')}}"/>

@endsection

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="twelve wide column">
                <div class="ui segment">
                    <h3 class="ui dividing header">
                        <i class="add file icon"></i>
                        {{trans('phrases.post_new_item')}}

                    </h3>
                    @include('partials._form_errors')



                    {{Form::open(['route'=>'items.store', 'files' => true, 'class'=>'ui form attached p-lg', 'novalidate' => 'novalidate'])}}
                    <div class="ui error message"></div>

                    <div class="two fields">
                        <div class="required field">
                            <label for="">{{trans('phrases.choose_a_category')}}</label>

                            <div class="category ui dropdown button">
                                {{Form::hidden('category_id')}}
                                <span class="text">{{trans('phrases.choose_a_category')}}</span>
                                <i class="dropdown icon"></i>

                                <div class="menu">
                                    @foreach($categories as $category)
                                        <div class="item" data-value="{{$category->id}}">
                                            <i class="dropdown icon"></i>
                                            <span class="text">{{$category->label}}</span>

                                            <div class="menu">
                                                @foreach($category->children as $cat_child)
                                                    <div class="item"
                                                         data-value="{{$cat_child->id}}">{{$cat_child->label}}</div>
                                                @endforeach
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                        </div>


                        <div class="required field">
                            <label for="fruit">{{trans('phrases.ad_type')}}:</label>

                            {{trans('phrases.posting_as')}}
                            <div class="ui inline dropdown">
                                {{Form::hidden('type', 'personal')}}
                                <div class="text">{{trans('words.individual')}}</div>
                                <i class="dropdown icon"></i>

                                <div class="menu">
                                    <div class="header">{{trans('phrases.posting_as')}}</div>
                                    <div class="active item" data-text="{{trans('words.individual')}}"
                                         data-value="personal"><i class="male icon"></i> {{trans('words.individual')}}
                                    </div>
                                    <div class="item" data-text="{{trans('words.business')}}" data-value="business"><i
                                                class="suitcase icon"></i> {{trans('words.business')}}</div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="required field">

                        <label>{{trans('words.title')}}</label>
                        {{Form::text('title', null, ['placeholder'=> 'E.g Brand new google nexus 7 ', 'id'=>'title'])}}


                    </div>

                    <div class="field">
                        <label for="">{{Lang::choice('words.photo', 2)}}</label>

                        <div id="myDropZone" class="dropzone">
                            <div class="fallback">
                                <input name="files[]" type="file" multiple/>
                                <input name="multipart_upload" type="hidden" value="1"/>

                                <p>{{trans('phrases.choose_images')}}</p>

                            </div>
                        </div>
                        {{Form::hidden('pictures_id')}}
                    </div>


                    <div class="required field">
                        <label>{{trans('words.description')}}</label>
                        {{Form::textarea('description', null, ['class'=> 'classy-editor'])}}
                    </div>

                    <div class="field">
                        <label>{{trans('words.keywords')}}</label>
                        {{Form::text('keywords', null, ['placeholder'=> 'E.g phone, nexus, google', 'id'=>'keywords'])}}
                        <p>{{trans('phrases.keywords_help_search')}}</p>
                    </div>

                    <div class="two fields">
                        <div class="required ten wide   field">
                            <label for="">{{trans('words.amount')}}</label>

                            <div class="ui right action left icon input">
                                <i class="currency icon "></i>
                                {{Form::text('amount', null,  ['placeholder'=> trans('words.amount')])}}
                                <div class="ui dropdown button">
                                    {{Form::hidden('negotiable', true)}}
                                    <div class="text">{{trans('words.negotiable')}}?</div>
                                    <i class="dropdown icon"></i>

                                    <div class="menu">
                                        <div class="item" data-value="1">{{trans('words.negotiable')}}</div>
                                        <div class="item" data-value="0">{{trans('words.non_negotiable')}}</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="required six wide  field">
                            <label for="">{{Lang::choice('words.location', 1)}}</label>

                            <div class="ui fluid search selection dropdown">
                                {{Form::hidden('location_id')}}
                                <i class="dropdown icon"></i>

                                <div class="default text">{{trans('phrases.select_location')}}</div>
                                <div class="menu">
                                    @foreach($locations as $location)

                                        <div class="item" data-value="{{$location->id}}"><i
                                                    class="marker icon"></i>{{$location->name}}</div>

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ui accordion p-t-md p-b-md">
                        <div class="title">
                            <i class="icon dropdown"></i>
                            {{trans('phrases.use_different_contact')}}


                        </div>
                        <div class="content">
                            <div class="three fields">
                                <div class="required field">
                                    <label for="">{{trans('words.email')}}</label>
                                    {{Form::text('email', Auth::user()->email)}}

                                </div>
                                <div class="required field">
                                    <label for="">{{trans('phrases.seller_name')}}</label>
                                    {{Form::text('seller_name', Auth::user()->full_name)}}
                                </div>

                                <div class="required field">
                                    <label for="">{{trans('words.phone')}}</label>
                                    {{Form::text('phone', Auth::user()->phone)}}

                                </div>
                            </div>


                        </div>

                    </div>


                    <button class="ui teal button right labeled icon button" tabindex="0">
                        <i class="right arrow icon"></i>{{trans('phrases.create_my_item')}}</button>
                    {{Form::close()}}

                </div>
            </div>
            <div class="four wide column">
                @include('partials._how_to_sell_buy')
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script src="{{asset('assets/js/jquery.classyedit.js')}}"></script>
    <script src="{{asset('assets/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            var $picturesId = $("input[name='pictures_id']");

            Form = {

                getCurrentPicturesArray: function () {
                    current_pictures_array = []

                    var current_pictures_list = $picturesId.val();

                    if (current_pictures_list != "") var current_pictures_array = current_pictures_list.split(',');

                    current_pictures_array = current_pictures_array.map(function (val) {
                        return parseInt(val)
                    });

                    return current_pictures_array
                },
                addFileToPicturesArray: function (file) {
                    var current_pictures_array = this.getCurrentPicturesArray();
                    current_pictures_array.push(file._uuid)
                    $picturesId.val(current_pictures_array)
                },
                removeFileFromPicturesArray: function (file) {
                    var current_pictures_array = this.getCurrentPicturesArray();
                    current_pictures_array.sp
                    $picturesId.val(current_pictures_array)

                }
            }


            Dropzone.autoDiscover = false;

            dropzone = new Dropzone("div#myDropZone", {
                url: "{{route('pictures.store')}}",
                addRemoveLinks: true,
                maxFilesize: 3,
                maxFiles: 5,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=token]').attr("content")
                },

                acceptedFiles: 'image/*',
                dictDefaultMessage: "{{trans('phrases.add_more_photos')}}",

                maxfilesexceeded: function (file, rt) {
                    alertify.warning("{{trans('phrases.five_photos_upload_limit')}}")
                    this.removeFile(file);
                },
                success: function (file, response) {
                    file._uuid = response.picture.id;
                    file.isServerProcessed = true;
                    file.previewElement.classList.add('dz-complete');
                    file.previewElement.classList.add("dz-success");

                    Form.addFileToPicturesArray(file)
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
            });

            $('.classy-editor').ClassyEdit();

            $('.ui.accordion').accordion();

            $('.category.ui.dropdown')
                    .dropdown({
                        allowCategorySelection: true
                    });


            $('.ui.radio.checkbox.item_type').checkbox()

            $('.ui.form').form({
                fields: {
                    title: {
                        identifier: 'title',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'title'])}}'

                            },
                            {
                                type: 'length[10]',
                                prompt: '{{trans('validation.min.string', ['attribute' => 'title', 'min' => 10])}}'

                            }
                        ]
                    },
                    category: {
                        identifier: 'category_id',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'category'])}}'

                            }

                        ]
                    },

                    location: {
                        identifier: 'location_id',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'location'])}}'

                            }

                        ]
                    },
                    amount: {
                        identifier: 'amount',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'amount'])}}'

                            }

                        ]
                    },

                    description: {
                        identifier: 'description',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'description'])}}'


                            },
                            {
                                type: 'length[10]',
                                prompt: '{{trans('validation.min.string', ['attribute' => 'description', 'min' => 10])}}'

                            }
                        ]
                    },
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'email',
                                prompt: '{{trans('validation.email', ['attribute' => 'email'])}}'

                            }
                        ]
                    },
                    seller_name: {
                        identifier: 'seller_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'seller name'])}}'

                            },
                            {
                                type: 'length[6]',
                                prompt: '{{trans('validation.min.string', ['attribute' => 'seller name', 'min' => 6])}}'

                            }
                        ]
                    },
                    phone: {
                        identifier: 'phone',
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{trans('validation.required', ['attribute' => 'phone'])}}'

                            },

                            {
                                type: 'length[6]',
                                prompt: '{{trans('validation.min.string', ['attribute' => 'phone', 'min' => 6])}}'

                            }
                        ]
                    }

                }
            })
            ;


        });
    </script>



@endsection