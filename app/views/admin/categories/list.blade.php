@extends('layouts.admin')

@section('title')
    {{trans('phrases.manage_categories')}}
@endsection

@section('styles')


    <link rel="stylesheet" href="{{asset('assets/jqtree/jqtree.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/fontIconPicker/css/jquery.fonticonpicker.min.css')}}"/>
    <link rel="stylesheet"
          href="{{asset('assets/fontIconPicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/x-editable/dist/jquery-editable/css/jquery-editable.css')}}"/>

    <style>
        div.jqtree-element.jqtree_common {
            background-color: #FCFCF5;
            padding: 10px;
            margin-bottom: 3px;
        }

        span.jqtree-title {
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
                <h4 class="ui header">   {{trans('phrases.manage_categories')}}

                    <div class="sub header">
                        {{trans('phrases.manage_categories_subheading')}}
                    </div>
                </h4>


            </div>
            <div class="ui clearing segment ">

                <button class="ui right floated icon button newCategory">
                    <i class="icon add"></i> {{trans('phrases.add_new_category')}}
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
                    <h4 class="ui dividing header">{{trans('phrases.category_details')}}</h4>

                    <div class="ui error message"></div>

                    <div class="field">
                        <div class="two fields">
                            <input type="hidden" name="id"/>
                            <input type="hidden" name="action"/>

                            <div class="twelve wide field">
                                <label for="">{{trans('words.name')}}</label>
                                <input type="text" name="name" placeholder="Category Name">
                            </div>
                            <div class="four wide field">
                                <label for="">{{trans('words.icon')}}</label>
                                <input type="text" name="icon" id="myiconPicker"/>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="actions">
                <div class="ui default deny button">
                    {{trans('words.close')}}
                </div>
                <div class="ui positive right labeled icon button">
                    {{trans('words.save')}}
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
            headers: {'X-CSRF-TOKEN': $('meta[name=token]').attr("content")}
        });
        var data = {{ $categories }};
        var serverUrl = "{{ Request::url() }}";

        $(function () {


            var iconPicker = $('#myiconPicker').fontIconPicker({
                source: ["alarm ", "alarm slash ", "alarm outline ", "alarm slash outline ", "at ", "browser ", "bug ", "calendar outline ", "calendar ", "cloud ", "code ", "comment ", "comments ", "comment outline ", "comments outline ", "copyright ", "dashboard ", "dropdown ", "external square ", "external ", "eyedropper ", "feed ", "find ", "heartbeat ", "history ", "home ", "idea ", "inbox ", "lab ", "mail ", "mail outline ", "mail square ", "map ", "options ", "paint brush ", "payment ", "phone ", "phone square ", "privacy ", "protect ", "search ", "setting ", "settings ", "shop ", "sidebar ", "signal ", "sitemap ", "tag ", "tags ", "tasks ", "terminal ", "text telephone ", "ticket ", "trophy ", "wifi",
                    "building ", "building outline ",
                    "car ",
                    "coffee ",
                    "emergency ",
                    "first aid ",
                    "food ",
                    "h ",
                    "hospital ",
                    "location arrow ",
                    "marker ",
                    "military ",
                    "paw ",
                    "space shuttle ",
                    "spoon ",
                    "taxi ",
                    "tree ",
                    "university ",
                    "adjust ",
                    "add user ",
                    "add to cart ",
                    "archive ",
                    "ban ",
                    "bookmark ",
                    "call ",
                    "call square ",
                    "cloud download ",
                    "cloud upload ",
                    "compress ",
                    "configure ",
                    "download ",
                    "edit ",
                    "erase ",
                    "exchange ",
                    "external share ",
                    "expand ",
                    "filter ",
                    "flag ",
                    "flag outline ",
                    "forward mail ",
                    "hide ",
                    "in cart ",
                    "lock ",
                    "pin ",
                    "print ",
                    "random ",
                    "recycle ",
                    "refresh ",
                    "remove bookmark ",
                    "remove user ",
                    "repeat ",
                    "reply all ",
                    "reply ",
                    "retweet ",
                    "send ",
                    "send outline ",
                    "share alternate ",
                    "share alternate square ",
                    "share ",
                    "share square ",
                    "sign in ",
                    "sign out ",
                    "theme ",
                    "translate ",
                    "undo ",
                    "unhide ",
                    "unlock alternate ",
                    "unlock ",
                    "upload ",
                    "wait ",
                    "wizard ",
                    "write ",
                    "write square ",
                    "announcement ",
                    "birthday ",
                    "help ",
                    "help circle ",
                    "info ",
                    "info circle ",
                    "warning ",
                    "warning circle ",
                    "warning sign ",
                    "child ",
                    "doctor ",
                    "handicap ",
                    "spy ",
                    "student ",
                    "user ",
                    "users ",
                    "female ",
                    "gay ",
                    "heterosexual ",
                    "intergender ",
                    "lesbian ",
                    "male ",
                    "man ",
                    "neuter ",
                    "non binary transgender ",
                    "transgender ",
                    "other gender ",
                    "other gender horizontal ",
                    "other gender vertical ",
                    "woman ",
                    "grid layout ",
                    "list layout ",
                    "block layout ",
                    "zoom ",
                    "zoom out ",
                    "resize vertical ",
                    "resize horizontal ",
                    "maximize ",
                    "crop ",
                    "anchor ",
                    "bar ",
                    "bomb ",
                    "book ",
                    "bullseye ",
                    "calculator ",
                    "checkered flag ",
                    "cocktail ",
                    "diamond ",
                    "fax ",
                    "fire extinguisher ",
                    "fire ",
                    "gift ",
                    "leaf ",
                    "legal ",
                    "lemon ",
                    "life ring ",
                    "lightning ",
                    "magnet ",
                    "money ",
                    "moon ",
                    "plane ",
                    "puzzle ",
                    "rain ",
                    "road ",
                    "rocket ",
                    "shipping ",
                    "soccer ",
                    "suitcase ",
                    "sun ",
                    "travel ",
                    "treatment ",
                    "world ",
                    "asterisk ",
                    "certificate ",
                    "circle ",
                    "circle notched ",
                    "circle thin ",
                    "crosshairs ",
                    "cube ",
                    "cubes ",
                    "ellipsis horizontal ",
                    "ellipsis vertical ",
                    "quote left ",
                    "quote right ",
                    "spinner ",
                    "square ",
                    "square outline ",
                    "desktop ", "disk outline ", "file archive outline ", "file audio outline ", "file code outline ", "file excel outline ", "file ", "file image outline ", "file outline ", "file pdf outline ", "file powerpoint outline ", "file text ", "file text outline ", "file video outline ", "file word outline ", "folder ", "folder open ", "folder open outline ", "folder outline ", "game ", "keyboard ", "laptop ", "level down ", "level up ", "mobile ", "power ", "plug ", "tablet ", "trash ", "trash outline ", "area chart ",
                    "bar chart ",
                    "camera retro ",
                    "newspaper ",
                    "film ",
                    "line chart ",
                    "photo ",
                    "pie chart ",
                    "sound "
                ],
                emptyIcon: true,
                hasSearch: true
            });

            $spinner = {
                toggle: function () {
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
                            .attr("data-", node.icon)

                    li.prepend('<i class="icon ' + node.icon + '"></i>')
                    li.parent().append('<a class="node-delete" style="float: right;" data-pk="' + node.id + '"><i class="red big cancel icon "></i></a>')
                }
            }

            function checkData() {
                if ($tree.find("ul").children().length === 0) $tree.html("{{trans('phrases.categories_not_setup')}}");
            }

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

            $(document).on("click", 'span.jqtree-title', function (e) {

                $('input[name="name"]').val(this.dataset.name)
                $('input[name="icon"]').val(this.dataset.icon)
                $('input[name="id"]').val(this.dataset.pk)
                $('input[name="action"]').val('renameCategory')
                iconPicker.refreshPicker()
                $modal.find('div.header').html("{{trans('phrases.edit_category')}} - " + this.dataset.name)
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
                                prompt: '{{trans('validation.required', ['attribute' => 'name'])}}'

                            }

                        ]
                    }

                }
            })
            ;


            function showModal() {
                $modal.modal('setting', 'transition', 'fade up')
                        .modal('setting', 'autofocus', 'true')
                        .modal({
                            onApprove: function () {
                                $catform.form('validate form')

                                if ($catform.form('is valid')) {
                                    var form_values = $catform.form('get values')

                                    $catform.addClass('loading')
                                    $.ajax({
                                        method: 'POST',
                                        data: form_values,
                                        url: serverUrl,
                                        success: function (response) {
                                            $catform.removeClass('loading')
                                            $catform.form('reset');
                                            $modal.modal('hide');

                                            if (form_values.action == 'renameCategory') {

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
                                        error: function (xhr) {
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
                alertify.confirm("{{trans('phrases.confirm_delete')}}", function (e) {
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
                                alertify.success("{{trans('phrases.category_removed')}}")
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


