@extends('layouts.admin')

@section('styles')

    <link rel="stylesheet" href="{{asset('assets/jqtree/jqtree.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/x-editable/dist/jquery-editable/css/jquery-editable.css')}}"/>

    <style>
        div.jqtree-element.jqtree_common {
            background-color: #FCFCF5;
            padding: 10px;
            margin-bottom: 3px;
        }

        li.jqtree_common{

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


    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/jqtree/tree.jquery.js')}}"></script>
    <script src="{{asset('assets/poshytip/src/jquery.poshytip.min.js')}}"></script>
    <script src="{{asset('assets/x-editable/dist/jquery-editable/js/jquery-editable-poshytip.js')}}"></script>



    <script type="text/javascript">
        var data = {{ $categoriesData }};
        var serverUrl = "{{ Request::url() }}";

        $(function () {

            // configure spinner
            $spinner = {
                toggle: function() {
                    $('div.categorielist').toggleClass('loading disabled')
                }
            };

            // configure editable
            $.fn.editableform.buttons = '<button type="submit" class="ui green icon button editable-submit"> <i class="save icon"></i> Save</button>'
            + '<button type="button" class="ui yellow icon button editable-cancel"><i class="cancel icon "></i> Cancel</button>'
            + '<button type="button" class="ui red icon button editable-delete"><i class="delete icon"></i> Delete</button>';
            $.fn.editable.defaults.mode = 'inline';

            $.fn.editableform.template = '<form class="form-inline editableform">'
            +'<div class="control-group">'
            +'<div><div class="ui input editable-input"></div><div class="editable-buttons"></div></div>'
            +'<div class="editable-error-block"></div>'
            +'</div>'
            +'</form>'

            // configure tree
            var $tree = $("#tree");
            var opts = {
                data: data,
                dragAndDrop: true,
                autoOpen: true,
                selectable: false,
                useContextMenu: false,
                onCreateLi: function (node, $li) {
                    var li = $li.find(".jqtree-title");
                    li
                            .attr("data-pk", node.id)
                            .attr("data-type", "text")
                            .addClass("editable-click editable-container")
                            .attr("data-name", node.name)
                }
            }
            function checkData() { if ($tree.find("ul").children().length === 0) $tree.html("You haven't setup any categories yet"); }
            $tree.bind("tree.init", checkData)

            // initialize tree
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
                e.preventDefault();
                alertify.prompt("Category name:", '', function (e, str) {
                    if (e) {
                        $spinner.toggle();
                        $.ajax(serverUrl, {
                            type: "POST",
                            data: {
                                "action": "addCategory",
                                "name": str
                            },
                            success: function (r) {
                                $spinner.toggle();
                                var root = $tree.tree("getTree");
                                $tree.tree(
                                        "appendNode", {
                                            name: str,
                                            id: r.id,
                                            parent_id: r.parent_id
                                        },
                                        root
                                );
                                alertify.success("Category '" + str + "' has been added")
                            },
                            error: function (r) {
                                $spinner.toggle();
                                alertify.error(r.statusText);
                            }
                        });
                    }
                });
            }) // END add

            // rename category
            $tree.editable({
                selector: "span.jqtree-title",
                url: serverUrl,
                params: function (params) {
                    var data = {};
                    data.action = "renameCategory";
                    data.id = params.pk;
                    data.name = params.value;
                    data.originalname = params.name;
                    return data;
                },
                success: function (r, v) {
                    var node = $tree.tree("getNodeById", $(this).attr("data-pk"));
                    node.name = v;
                    $(this).editable("option", "name", v)
                },
                error: function (r) {
                    alertify.error(r.statusText);
                }
            }) // END rename

            // delete category
            $(document).on("click", ".editable-delete", function () {
                var nodeId = $(this).closest(".jqtree-element").find("span:eq(0)").data("pk");
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