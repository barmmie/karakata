@extends('layouts.admin')

@section('title')
    Manage categories
@endsection

@section('styles')


    <link rel="stylesheet" href="{{asset('assets/jqtree/jqtree.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/fontIconPicker/css/jquery.fonticonpicker.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/fontIconPicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/x-editable/dist/jquery-editable/css/jquery-editable.css')}}"/>

    <style>
        div.jqtree-element.jqtree_common {
            background-color: #FCFCF5;
            padding: 10px;
            margin-bottom: 3px;
        }

        span.jqtree-title{
            border-bottom: dashed 1px #0088cc;
        }

        li.jqtree_common.jqtree-moving {
            border: 2px solid #001F3F;
        }

    </style>
@endsection

@section('content')
    <div class="main ui container">

            <div class="ui segments">
                <div class="ui segment">
                    <h4 class="ui header">Manage Categories
                    <div class="sub header">
                        Click on a category name below to modify it. Drag to make it a sub-category or modify its position
                    </div>
                    </h4>


                </div>
                <div class="ui clearing segment ">

                    <button class="ui right floated icon button newCategory">
                        <i class="icon add"></i> Add new category
                    </button>

                </div>
                <div class="ui segment padded categorielist">
                    <div id="tree"></div>
                </div>
            </div>

        <div class="ui modal">
            <i class="close icon"></i>
            <div class="header">

            </div>
            <div class="content">
                <form class="ui form">
                    <h4 class="ui dividing header">Category details</h4>
                    <div class="ui error message"></div>

                    <div class="field">
                        <div class="two fields">
                            <input type="hidden" name="id"/>
                            <input type="hidden" name="action"/>
                            <div class="twelve wide field">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Category Name">
                            </div>
                            <div class="four wide field">
                                <label for="">Icon</label>
                                <input type="text" name="icon" id="myiconPicker" />
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="actions">
                <div class="ui default deny button">
                    Close
                </div>
                <div class="ui positive right labeled icon button">
                    Save
                    <i class="checkmark icon"></i>
                </div>

            </div>
        </div>


    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/jqtree/tree.jquery.js')}}"></script>
    <script src="{{asset('assets/fontIconPicker/jquery.fonticonpicker.js')}}"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            cache: false,
            headers: {'X-CSRF-TOKEN' : $('meta[name=token]').attr("content")}
        });
        var data = {{ $categories }};
        var serverUrl = "{{ Request::url() }}";

        $(function () {

            var iconPicker = $('#myiconPicker').fontIconPicker({
                source:    ['alarm', 'search', 'user', 'tag', 'help'],
                emptyIcon: true,
                hasSearch: true
            });

            $spinner = {
                toggle: function() {
                    $('div.categorielist').toggleClass('loading disabled')
                }
            };

            $modal = $('.ui.modal')

            var $tree = $("#tree");
            var opts = {
                data: data,
                dragAndDrop: true,
                autoOpen: false,
                selectable: false,
                useContextMenu: false,
                onCreateLi: function (node, $li) {
                    var li = $li.find(".jqtree-title");
                    li
                            .attr("data-pk", node.id)
                            .attr("data-type", "text")
                            .attr("data-name", node.name)
                            .attr("data-icon", node.icon)

                    li.prepend('<i class="icon '+ node.icon +'"></i>')
                    li.parent().append('<a class="node-delete" style="float: right;" data-pk="' + node.id +'"><i class="red big cancel icon "></i></a>')
                }
            }
            function checkData() { if ($tree.find("ul").children().length === 0) $tree.html("You haven't setup any categories yet"); }
            $tree.bind("tree.init", checkData)

            $tree.tree(opts)
            // move category
            $tree.bind("tree.move", function (e) {
                $spinner.toggle();
                e.preventDefault();
                $.ajax(serverUrl, {
                    type: "POST",
                    data: {
                        "action": "moveCategory",
                        "id": e.move_info.moved_node.id,
                        "parent_id": e.move_info.moved_node.parent_id,
                        "to": e.move_info.target_node.id,
                        "name": e.move_info.moved_node.name,
                        "direction": e.move_info.position
                    },
                    success: function () {
                        $spinner.toggle();
                        e.move_info.do_move();
                        e.move_info.moved_node["parent_id"] = (e.move_info.position == "inside") ? e.move_info.target_node["id"] : e.move_info.target_node["parent_id"];
                    },
                    error: function (r) {
                        $spinner.toggle();
                        alertify.error(r.statusText);
                    }
                });
            }) // END move

            // add category
            $(".newCategory").click(function (e) {

                $('input[name="name"]').val('')
                $('input[name="icon"]').val('')
                $('input[name="id"]').val('')
                $('input[name="action"]').val('addCategory')
                iconPicker.refreshPicker()
                $modal.find('div.header').html('New category')
                showModal();

            }) // END add

            $(document).on( "click", 'span.jqtree-title',function(e) {

                $('input[name="name"]').val(this.dataset.name)
                $('input[name="icon"]').val(this.dataset.icon)
                $('input[name="id"]').val(this.dataset.pk)
                $('input[name="action"]').val('renameCategory')
                iconPicker.refreshPicker()
                $modal.find('div.header').html('Edit category - ' + this.dataset.name)
                showModal();
            });

            $catform = $('.ui.form')

            $catform.form({
                fields: {
                    name: {
                        identifier: 'name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your category name'
                            }

                        ]
                    }

                }
            })
            ;


            function showModal()
            {
                $modal.modal('setting', 'transition', 'fade up')
                        .modal('setting', 'autofocus', 'true')
                        .modal({
                            onApprove: function () {
                                $catform.form('validate form')

                                if($catform.form('is valid')) {
                                    var form_values = $catform.form('get values')

                                    $catform.addClass('loading')
                                    $.ajax({
                                        method: 'POST',
                                        data: form_values,
                                        url: serverUrl,
                                        success: function(response) {
                                            $catform.removeClass('loading')
                                            $catform.form('reset');
                                            $modal.modal('hide');

                                            if(form_values.action == 'renameCategory') {

                                                var node = $tree.tree("getNodeById", form_values.id);
                                                $tree.tree('updateNode', node, form_values)
                                                $tree.tree('scrollToNode', node);
                                                alertify.success("Category '" + form_values.name + "' has been updated")


                                            } else {
                                                var root = $tree.tree("getTree");
                                                $tree.tree(
                                                        "appendNode", {
                                                            name: form_values.name,
                                                            id: response.id,
                                                            icon: form_values.icon,
                                                            parent_id: null
                                                        },
                                                        root
                                                );
                                                var node = $tree.tree('getNodeById', form_values.id);
                                                $tree.tree('scrollToNode', node);
                                                alertify.success("Category '" + form_values.name + "' has been added")
                                            }

                                        },
                                        error: function(xhr) {
                                            $catform.removeClass('loading')
                                            alertify.error(xhr.responseJSON.message)
                                            $catform.form('add errors', [xhr.responseJSON.message]);
                                            return false;
                                        }
                                    })
                                }

                                return false;
                            }
                        })

                        .modal('show');

            }
            // delete category
            $(document).on("click", ".node-delete", function () {
                var nodeId = $(this).data("pk");
                var node = $tree.tree("getNodeById", nodeId)
//                alertify.set({ buttonFocus: "cancel", buttonReverse: true });
                alertify.confirm("Are you sure you want to delete this category?", function (e) {
                    if (e) {
                        $spinner.toggle();
                        $.ajax(serverUrl, {
                            type: "POST",
                            data: {
                                "action": "deleteCategory",
                                "id": node.id,
                                "name": node.name
                            },
                            success: function (d) {
                                $spinner.toggle();
                                $tree.tree("removeNode", node);
                                checkData();
                                alertify.success('Category has been removed')
                            },
                            error: function (r) {
                                $spinner.toggle();
                                alertify.error(r.statusText);
                            }
                        });
                    }
                });
            }); // END delete

        });

    </script>


@endsection