/**
 * Created by dexter on 11/4/14.
 */
var DragFormHandler = (function () {

    var pub = {};
    pub.fieldData = {};
    pub.fieldNumber = 0;
    pub.htmlData = '';
    pub.formName = '';

    function makeReadable(oldCode) {
        var readableHTML = oldCode;
        var lb = '\r\n';
        var htags = ["<html", "</html>", "</head>", "<title", "</title>", "<meta", "<link", "<style", "</style>", "</body>"];
        for (i = 0; i < htags.length; ++i) {
            var hhh = htags[i];
            readableHTML = readableHTML.replace(new RegExp(hhh, 'gi'), lb + hhh);
        }
        var btags = ["</div>", "</span>", "</form>", "</fieldset>", "<br>", "<br />", "<hr", "<pre", "</pre>", "<blockquote", "</blockquote>", "<ul", "</ul>", "<ol", "</ol>", "<li", "<dl", "</dl>", "<dt", "</dt>", "<dd", "</dd>", "<\!--", "<table", "</table>", "<caption", "</caption>", "<th", "</th>", "<tr", "</tr>", "<td", "</td>", "<script", "</script>", "<noscript", "</noscript>"];
        for (i = 0; i < btags.length; ++i) {
            var bbb = btags[i];
            readableHTML = readableHTML.replace(new RegExp(bbb, 'gi'), lb + bbb);
        }
        var ftags = ["<label", "</label>", "<legend", "</legend>", "<object", "</object>", "<embed", "</embed>", "<select", "</select>", "<option", "<option", "<input", "<textarea", "</textarea>"];
        for (i = 0; i < ftags.length; ++i) {
            var fff = ftags[i];
            readableHTML = readableHTML.replace(new RegExp(fff, 'gi'), lb + fff);
        }
        var xtags = ["<body", "<head", "<div", "<span", "<p", "<form", "<fieldset"];
        for (i = 0; i < xtags.length; ++i) {
            var xxx = xtags[i];
            readableHTML = readableHTML.replace(new RegExp(xxx, 'gi'), lb + lb + xxx);
        }
        return readableHTML;
    }

    function updateHtmlTranslation(callback) {
        var html_frame = $("#form_html");
        var current_html = $("#form-preview").html();
        current_html = makeReadable(current_html.trim());
        current_html = current_html.replace(/^[\r\n]+|\.|[\r\n]+$/, '');
        current_html = current_html.replace('type="button"', 'type="submit"');
        html_frame.val(current_html);
        pub.htmlData = current_html;
        pub.formName = $("#form_name").val();
        if (callback) {
            callback();
        }
    }

    function wrapForm(callback) {
        var formstart = "<form action='/display/formdata/post' method='post'><span style='display:none;'>{{form_id_replace}}{{form_hidden_author_input}}</span>";
        var formend = "</form>";
        pub.htmlData = formstart + pub.htmlData + formend;
        if (callback) {
            callback();
        }
    }

    function bindPopover(e) {
        $("#popover-save").click(function (e) {
            e.stopPropagation(e);
            var curr_id = $("#popover-window").data('id');
            var curr_data = $(".cereal").serializeArray();
            var form_item = $(".form-item");
            var clear = true;
            //Set new data to field object first - fill the popover window
            $.each(curr_data, function (i, data) {
                pub.fieldData[curr_id][data['name']] = data['value'];
            });
            if (pub.fieldData[curr_id]['type'] == 'radio') {
                var options = pub.fieldData[curr_id]['choices'].split("\n");
                var opt_name = pub.fieldData[curr_id]['name'];
                $.each(options, function (i, option) {
                    var html = "<label><input name='" + opt_name + "' type='radio' value='" + option + "'>" + option + "</label>";
                    $.each($(".form-item"), function (i, data) {
                        if ($(data).data('id') == curr_id) {
                            if (clear) {
                                $(data).empty();
                                clear = false;
                            }
                            $(data).append(html);
                        }
                    });
                });
            } else if (pub.fieldData[curr_id]['type'] == 'select') {
                var options = pub.fieldData[curr_id]['choices'].split("\n");
                var html = "<label>Select Input</label><select class='form-control'>";
                $.each(options, function (i, option) {
                    html += "<option>" + option + "</option>";
                });
                html += "</select>";
                $.each(form_item, function (i, data) {
                    if ($(data).data('id') == curr_id) {
                        if (clear) {
                            $(data).empty();
                            clear = false;
                        }
                        $(data).append(html);
                    }
                });
                $.each(form_item, function (i, data) {
                    if ($(data).data('id') == curr_id) {
                        $(data).find("label").html(pub.fieldData[curr_id]['label']);
                        $(data).find("select").attr('name', pub.fieldData[curr_id]['name']);
                    }
                });
            } else if (pub.fieldData[curr_id]['type'] == 'text') {
                $.each(form_item, function (i, data) {
                    if ($(data).data('id') == curr_id) {
                        $(data).find("label").html(pub.fieldData[curr_id]['label']);
                        $(data).find("input").attr('placeholder', pub.fieldData[curr_id]['placeholder']);
                        $(data).find("input").attr('name', pub.fieldData[curr_id]['name']);
                    }
                });
            } else if (pub.fieldData[curr_id]['type'] == 'textarea') {
                $.each(form_item, function (i, data) {
                    if ($(data).data('id') == curr_id) {
                        $(data).find("label").html(pub.fieldData[curr_id]['label']);
                        $(data).find("textarea").html(pub.fieldData[curr_id]['placeholder']);
                        $(data).find("textarea").attr('name', pub.fieldData[curr_id]['name']);
                    }
                });
            } else if (pub.fieldData[curr_id]['type'] == 'button') {
                $.each(form_item, function (i, data) {
                    if ($(data).data('id') == curr_id) {
                        $(data).find("button").html(pub.fieldData[curr_id]['label']);
                    }
                });
            }
            updateHtmlTranslation();
        });
        $("#popover-delete").click(function () {
            e.stopPropagation();
            var curr_id = $("#popover-window").data('id');
            delete pub.fieldData[curr_id];
            $.each($(".form-item"), function (i, data) {
                if ($(data).data('id') == curr_id) {
                    $(data).remove();
                }
            });
            updateHtmlTranslation();
        });
        $("#popover-cancel").click(function (e) {
            document.getElementById("popover-window").style.display = "none";
        });
        $(e).click(function (e) {
            e.stopPropagation();
        });

    }

    function bindAddedField(e) {
        $(e).click(function (e) {
            e.stopPropagation();
            var data_now = pub.fieldData[$(this).data('id')];
            var popover = $("#popover-window");
            popover.show();
            popover.css({position: "absolute", "top": e.pageY - 180, "left": e.pageX + 100});
            $(".pop-name#name").val(data_now['name']);
            $(".pop-label#label").val(data_now['label']);
            $(".pop-choices#choices").val(data_now['choices']);
            $(".pop-placeholder#placeholder").val(data_now['placeholder']);
            popover.data(pub.fieldData[$(this).data('id')]);
            $(".popover-title").html(data_now['type']);
            if (data_now['type'] == 'text' || data_now['type'] == 'textarea') {
                $("#label-placeholder").show();
                $("#label-choices").hide();
                $("#label-name").show();
            } else if (data_now['type'] == 'radio' || data_now['type'] == 'select') {
                $("#label-placeholder").hide();
                $("#label-choices").show();
                $("#label-name").show();
            } else if (data_now['type'] == 'button') {
                $("#label-placeholder").hide();
                $("#label-choices").hide();
                $("#label-name").hide();
            }
        });
    }

    function bindDraggableElement(element) {
        element.addEventListener('dragstart', function (e) {
            this.style.opacity = '0.5';
            e.dataTransfer.setData('text/html', this.dataset.view);
            e.dataTransfer.setData('name', this.dataset.name);
            e.dataTransfer.setData('label', this.dataset.label);
            e.dataTransfer.setData('type', this.dataset.type);
            e.dataTransfer.setData('placeholder', this.dataset.placeholder);
        });
        element.addEventListener('dragend', function (e) {
            this.style.opacity = '';
        });
    }

    function bindDropzone(e) {
        e.addEventListener('dragover', over, false);
        e.addEventListener('drop', dropOn, false);

        function dropOn(e) {
            e.dataTransfer.effectAllowed = 'copy';
            pub.fieldNumber += 1;
            var inptype = e.dataTransfer.getData('type');
            var label = e.dataTransfer.getData('label');
            var name = e.dataTransfer.getData('name');
            var placeholder = e.dataTransfer.getData('placeholder');

            $(this).append(e.dataTransfer.getData('text/html'));
            $(this).children(".form-item:last").data('id', pub.fieldNumber);
            pub.fieldData[pub.fieldNumber] = {
                "id": pub.fieldNumber,
                "label": label,
                "type": inptype,
                "name": name,
                "placeholder": placeholder,
                "choices": null
            };
            bindAddedField($(".form-item:last", this).get(0));
            updateHtmlTranslation();
        }

        function over(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.dataTransfer.dropEffect = 'copy';
            return false;
        }
    }


    //Remove our popup unless clicked on relevant fields
    $(document).click(function () {
        document.getElementById("popover-window").style.display = "none";
    });

    //Bind all form element types to drag
    [].forEach.call($(".form-items li"), function (element) {
        bindDraggableElement(element);
    });

    //Bind dropzone to be droppable
    bindDropzone(document.getElementById('form-preview'));

    //Bind popover to save/delete
    bindPopover(document.getElementById('popover-window'));

    //Bind submit event ajax
    var form = $("#forms-create-form");

    form.submit(function(ev){
        ev.preventDefault();
        updateHtmlTranslation(function() {
            wrapForm(function () {
                var info = {
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: {
                        form_html: pub.htmlData,
                        form_name: pub.formName
                    }
                };
                ajaxhandle(info, function(data){
                    $.notify(data.message, data.type);
                    if (data.success) {
                        setTimeout(function () {
                            window.location.href = data.redirect;
                        }, 1800);
                    }
                });
            });
        });
    });

    return pub;
}());

var dragFormHandler = DragFormHandler;