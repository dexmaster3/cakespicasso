/**
 * Created by dexter on 11/26/14.
 */

var MediaUploader = (function(){
    var pub = {};
    var holder = document.getElementById("media-upload");
    var uploadinput = document.getElementById("fallback-upload");
    var tests = {
        filereader: typeof FileReader != 'undefined',
        dnd: 'draggable' in document.createElement('span'),
        formdata: !!window.FormData,
        progress: "upload" in new XMLHttpRequest
    };
    var acceptedTypes = {
        'image/png': true,
        'image/jpeg': true,
        'image/gif': true
    };

    function filePreview(file) {
        if (tests.filereader === true && acceptedTypes[file.type] === true) {
            var reader = new FileReader();
            reader.onload = function(ev) {
                var image = new Image();
                image.src = event.target.result;
                $(holder).append('<div class="col-md-3 uploaded-preview"><img style="max-height: 100%;max-width: 100%;" src="' + image.src + '"></div>');
            };
            reader.readAsDataURL(file);
        } else {
            $(holder).append('<div class="col-md-3">Uploaded ' + file.name + " " + (file.size ? (file.size/1024|0) + " KB" : "") + "</div>");
        }
        $("#media-upload .backtext").remove();
    }

    function readfiles(files) {
        var formData = tests.formdata ? new FormData() : null;
        for (var i = 0; i < files.length; i++) {
            if (tests.formdata) {
                formData.append('file', files[i]);
            }
            filePreview(files[i]);
        }
        $.ajax({
            url: "/media/media/upload",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(data, xhr, status) {
                $.notify(data.message, data.type);
            },
            error: function(status, xhr, error) {
                $.notify(error, "error");
            }
        })
    }

    if (tests.dnd) {
        holder.onclick = function(e) {
            uploadinput.click();
        };
        holder.ondragover = function () { this.className = 'hover'; return false; };
        holder.ondragend = function () { this.className = ''; return false; };
        holder.ondragleave = function () { this.className = ''; return false; };
        holder.ondrop = function (e) {
            this.className = '';
            e.preventDefault();
            readfiles(e.dataTransfer.files);
        };
        uploadinput.onchange = function(ev) {
            this.className = '';
            ev.preventDefault();
            readfiles(ev.target.files);
        }
    } else {
        fileupload.className = 'hidden';
        fileupload.querySelector('input').onchange = function () {
            readfiles(this.files);
        };
    }

    return pub;
}());

var mediaUploader = MediaUploader;