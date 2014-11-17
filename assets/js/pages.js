/**
 * Created by dexter on 10/27/14.
 */

var renderingsPreview = (function(){
    var pub = {};

    function contentRenderFrames() {
        $.ajax({
            url: "/renderings/rendering/ajaxshow",
            type: "GET",
            dataType: "json"
        }).success(function(data, status, jqXHR) {
            var first = true;
            for (var i = 0; i < data.length; i++) {
                var node = document.createElement('iframe');
                node.setAttribute("src", "/display/display/rendering?id=" + data[i]['id']);
                node.setAttribute("id", "rendering-sample-" + data[i]['id']);
                node.setAttribute("data-id", data[i]['id']);
                node.setAttribute("class", "rendering-sample");
                if (first) {
                    node.setAttribute("style", "display:initial;");
                    node.classList.add("active");
                    first = false;
                } else {
                    node.setAttribute("style", "display:none;");
                }
                $("#renderings-modal-body").append(node);
                var paginate = document.createElement('li');
                paginate.innerHTML = "<a onclick='RenderingsPreview.changeiframe("+data[i]['id']+");'>" + (i + 1) + "</a>";
                $("ul.pagination.renderings").append(paginate);
                $("#renderings-modal .save").click(function(){
                    $("form #rendering_id").val($(".rendering-sample.active").attr("data-id"));
                    $("#renderings-modal").modal('hide');
                });
            }
        });
    }

    function changeiframe(iframeid) {
        var allframes = document.getElementsByClassName("rendering-sample");
        [].forEach.call(allframes, function(frame) {
            frame.setAttribute("style", "display:none;");
            frame.classList.remove("active");
        });
        var iframe = document.getElementById("rendering-sample-" + iframeid);
        iframe.setAttribute("style", "display:initial;");
        iframe.classList.add("active");
    }
    function showRenderingsModal() {
        $("#renderings-modal").modal('show');
    }

    pub.showRenderingsModal = showRenderingsModal;
    pub.contentRenderFrames = contentRenderFrames;
    pub.changeiframe = changeiframe;

    return pub;
}());

var formsPreview = (function(){
    var pub = {};

    function contentRenderForms() {
        $.ajax({
            url: "/forms/form/ajaxshow",
            type: "GET",
            dataType: "json"
        }).success(function(data, status, jqXHR) {
            var first = true;
            for (i = 0; i < data.length; i++) {
                var node = document.createElement('div');
                node.setAttribute("id", "forms-sample-" + data[i]['id']);
                node.setAttribute("data-id", data[i]['id']);
                node.setAttribute("class", "forms-sample");
                node.innerHTML = data[i]['form_html'];
                if (first) {
                    node.setAttribute("style", "display:initial;");
                    node.classList.add("active");
                    first = false;
                } else {
                    node.setAttribute("style", "display:none;");
                }
                $("#forms-modal-body").append(node);
                var paginate = document.createElement('li');
                paginate.innerHTML = "<a onclick='FormsPreview.changeforms("+data[i]['id']+");'>" + (i + 1) + "</a>";
                $("ul.pagination.forms").append(paginate);
                $("#forms-modal .save").click(function(){
                    $("form #form_id").val($(".forms-sample.active").attr("data-id"));
                    $("#forms-modal").modal('hide');
                });
            }
        });
    }

    function changeforms(iframeid) {
        var allframes = document.getElementsByClassName("forms-sample");
        [].forEach.call(allframes, function(frame) {
            frame.setAttribute("style", "display:none;");
            frame.classList.remove("active");
        });
        var iframe = document.getElementById("forms-sample-" + iframeid);
        iframe.setAttribute("style", "display:initial;");
        iframe.classList.add("active");
    }
    function showFormsModal(){
        $("#forms-modal").modal('show');
    }

    pub.changeforms = changeforms;
    pub.showFormsModal = showFormsModal;
    pub.contentRenderForms = contentRenderForms;

    return pub;
}());

var pageFormSubmit = (function(){
   var pub = {};

    var form = $("#pages-form-create");

    form.submit(function(ev){
        ev.preventDefault();
        $("#page-submit-btn").attr("disabled", "");
        $("#page-submit-img").css("display", "inline");
        var action = form.attr('action');
        var method = form.attr('method');
        var data = form.serializeArray();
        var info = {
            url: action,
            method: method,
            data: data
        };
        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if (data.success) {
                setTimeout(function(){
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                $("#page-submit-btn").removeAttr("disabled");
                $("#page-submit-img").css("display", "none");
            }
        });
    });

    return pub;
}());

var PageFormSubmit = pageFormSubmit;
var RenderingsPreview = renderingsPreview;
var FormsPreview = formsPreview;