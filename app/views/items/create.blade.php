@extends('layouts.public')

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
                        Post free classified
                    </h3>
                    @include('partials._form_errors')



                    {{Form::open(['route'=>'items.store', 'class'=>'ui form attached p-lg', 'novalidate' => 'novalidate'])}}
                    <div class="ui error message"></div>

                    <div class="two fields">
                        <div class="required field">
                            <label for="">Item category</label>
                            <div class="category ui dropdown button">
                                {{Form::hidden('category_id')}}
                                <span class="text">Choose a category</span>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    @foreach($categories as $category)
                                        <div class="item">
                                            <i class="dropdown icon"></i>
                                            <span class="text">{{$category->label}}</span>
                                            <div class="menu">
                                                @foreach($category->children as $cat_child)
                                                <div class="item" data-value="{{$cat_child->id}}">{{$cat_child->label}}</div>
                                                @endforeach
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>


                        </div>



                        <div class="required field">
                            <label for="fruit">Ad type:</label>

                            I am posting this as a/an
                            <div class="ui inline dropdown">
                                {{Form::hidden('type', 'personal')}}
                                <div class="text">today</div>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="header">What user type</div>
                                    <div class="active item" data-text="Individual" data-value="personal"><i class="male icon"></i> Individual</div>
                                    <div class="item" data-text="Business" data-value="business"><i class="suitcase icon"></i> Business</div>
                                </div>
                            </div>



                        </div>
                    </div>


                    <div class="required field">

                        <label>Ad title</label>
                        {{Form::text('title', null, ['placeholder'=> 'E.g Brand new google nexus 7 ', 'id'=>'title'])}}


                    </div>

                    <div class="field">
                        <label for="">Photos</label>
                        <div id="myDropZone" class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                                <input name="fallback" type="hidden" value="1" />
                                <p>Choose images you want to attach to the item</p>
                            </div>
                        </div>
                        {{Form::hidden('pictures_id')}}
                    </div>



                    <div class="required field">
                        <label>Description</label>
                        {{Form::textarea('description', null, ['class'=> 'classy-editor'])}}
                    </div>

                    <div class="two fields">
                        <div class="required ten wide   field">
                            <label for="">Amount</label>

                            <div class="ui right action left icon input">
                                    <i class="currency icon "></i>
                                {{Form::text('amount', null,  ['placeholder'=> 'Amount'])}}
                                <div class="ui dropdown button">
                                    {{Form::hidden('negotiable', true)}}
                                    <div class="text">Negotiable?</div>
                                    <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <div class="item" data-value="1">Negotiable</div>
                                        <div class="item" data-value="0">Non-negotiable</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="required six wide  field">
                            <label for="">Location</label>
                            <div class="ui fluid search selection dropdown">
                                {{Form::hidden('location_id')}}
                                <i class="dropdown icon"></i>
                                <div class="default text">Select Country</div>
                                <div class="menu">
                                    @foreach($locations as $location)

                                    <div class="item" data-value="{{$location->id}}"><i class="marker icon"></i>{{$location->name}}</div>

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ui accordion p-t-md p-b-md">
                        <div class="title">
                            <i class="icon dropdown"></i>
                            I want to use a different contact details

                        </div>
                        <div class="content">
                            <div class="three fields">
                                <div class="required field">
                                    <label for="">Email</label>
                                    {{Form::text('email', Auth::user()->email)}}

                                </div>
                                <div class="required field">
                                    <label for="">Seller name</label>
                                    {{Form::text('seller_name', Auth::user()->full_name)}}
                                </div>

                                <div class="required field">
                                    <label for="">Phone</label>
                                    {{Form::text('phone', Auth::user()->phone)}}

                                </div>
                            </div>



                        </div>

                    </div>



                    {{--<div class="ui segment">--}}
                        {{--<div class="field">--}}
                            {{--<div class="ui teal toggle checkbox">--}}
                                {{--<input type="checkbox" name="terms" tabindex="0" class="hidden">--}}
                                {{--<label>I agree to the <a href="{{route('pages.terms')}}">Terms and--}}
                                        {{--conditions</a></label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <button class="ui teal button right labeled icon button" tabindex="0">
                        <i class="right arrow icon"></i>Create my ad</button>
                    {{Form::close()}}

                </div>
            </div>
            <div class="four wide column">
                <div class="ui content p-md">
                    <div class="ui center aligned icon header">
                        <i class="orange circular icon picture">

                        </i>
                        Post a Free Classified
                    </div>
                    <p>                            Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                </div>

                <div class="ui piled segment">
                    <h4 class="ui header">HOW TO SELL QUICKLY?</h4>
                    <div class="ui bulleted list">
                        <div class="item">Gaining Access</div>
                        <div class="item">Inviting Friends</div>
                        <div class="item">
                            <div>Benefits</div>
                            <div class="list">
                                <div class="item">Use Anywhere</div>
                                <div class="item">Rebates</div>
                                <div class="item">Discounts</div>
                            </div>
                        </div>
                        <div class="item">Warranty</div>
                    </div>
                </div>
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

                getCurrentPicturesArray: function() {
                    current_pictures_array = []

                    var current_pictures_list = $picturesId.val();

                    if(current_pictures_list!="") var current_pictures_array = current_pictures_list.split(',');

                    current_pictures_array = current_pictures_array.map(function(val){return parseInt(val)});

                    return current_pictures_array
                },
                addFileToPicturesArray: function(file) {
                    var current_pictures_array = this.getCurrentPicturesArray();
                    current_pictures_array.push(file._uuid)
                    $picturesId.val(current_pictures_array)
                },
                removeFileFromPicturesArray: function(file) {
                    var current_pictures_array = this.getCurrentPicturesArray();
                    current_pictures_array.sp
                    $picturesId.val(current_pictures_array)

                }
            }


            Dropzone.autoDiscover = false;

            dropzone = new Dropzone("div#myDropZone", {
                    url : "{{route('pictures.store')}}",
                    addRemoveLinks: true,
                    maxFilesize: 3,
                    maxFiles: 5,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=token]').attr("content")
                    },
                    acceptedFiles : 'image/*',
                    dictDefaultMessage: 'Add more photos and sell even faster',
                    maxfilesexceeded: function(file, rt) {
                        alertify.warning('You can\'t upload more than 5 images')
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
                        alertify.warning('Could not upload ')
                        file.previewElement.classList.add("dz-error");
                    }
                });


            dropzone.on('removedfile', function(file){
                if(file.isServerProcessed) {
                    //remove file._uuid from
                    //$("input[name='pictures_id[]']").val()
                    Form.removeFileFromPicturesArray(file)
                }
            });

            $('.classy-editor').ClassyEdit();

            $('.ui.accordion').accordion();

            $('.category .ui.dropdown')
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
                                        prompt: 'Please enter your title'
                                    },
                                    {
                                        type: 'length[10]',
                                        prompt: 'Your title should be at least 10 characters'
                                    }
                                ]
                            },
                            category: {
                                identifier: 'category_id',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please choose a category'
                                    }

                                ]
                            },

                            location: {
                                identifier: 'location_id',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please choose a location'
                                    }

                                ]
                            },
                            amount: {
                                identifier: 'amount',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter the item amount'
                                    }

                                ]
                            },

                            description: {
                                identifier: 'description',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter description'
                                    },
                                    {
                                        type: 'length[10]',
                                        prompt: 'Enter valid description, at least 10 characters'
                                    }
                                ]
                            },
                            email: {
                                identifier: 'email',
                                rules: [
                                    {
                                        type: 'email',
                                        prompt: 'Please enter a valid email'
                                    }
                                ]
                            },
                            seller_name: {
                                identifier: 'seller_name',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter the seller name'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: 'Your seller name must be at least 6 characters'
                                    }
                                ]
                            },
                            phone: {
                                identifier: 'phone',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter your phone'
                                    },

                                    {
                                        type: 'length[6]',
                                        prompt: 'Enter a valid phone number'
                                    }
                                ]
                            }

                        }
                    })
            ;




        });
    </script>



    @endsection