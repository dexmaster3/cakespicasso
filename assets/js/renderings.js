/**
 * Created by dexter on 11/12/14.
 */

var renderingHandler = (function(){

    var pub = {};

    function pieceDragStart(e) {
        this.style.opacity = '0.5';

        e.dataTransfer.effectAllowed = 'copy';
        e.dataTransfer.setData('text/html', this.innerHTML);
        e.dataTransfer.setData('class', this.classList);
        e.dataTransfer.setData('id', this.id);
    }

    function usedPieceDragStart(e) {
        this.style.opacity = '0.5';

        e.dataTransfer.effectAllowed = 'copy';
        e.dataTransfer.setData('text/html', this.innerHTML);
        e.dataTransfer.setData('class', this.classList);
        e.dataTransfer.setData('id', this.id);
        e.dataTransfer.setData('already_listed', true);
    }
    function usedPieceDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.dataTransfer.dropEffect = 'copy';
        return false;
    }
    function usedPieceDragEnter(e) {
        this.classList.add('used-over');
    }
    function usedPieceDragLeave(e) {
        this.classList.remove('used-over');
    }
    function usedPieceDragEnd(e) {
        this.classList.remove('used-over');
        this.remove();
    }
    function usedPieceDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }
        var insert = document.createElement('div');
        insert.setAttribute("class", e.dataTransfer.getData("class"));
        insert.setAttribute("id", e.dataTransfer.getData("id"));
        insert.setAttribute("draggable", "true");
        insert.innerHTML = e.dataTransfer.getData("text/html");
        $(this).after(insert);
        this.classList.remove('used-over');
        insert.addEventListener('dragstart', usedPieceDragStart, false);
        insert.addEventListener('dragover', usedPieceDragOver, false);
        insert.addEventListener('dragenter', usedPieceDragEnter, false);
        insert.addEventListener('dragleave', usedPieceDragLeave, false);
        insert.addEventListener('dragend', usedPieceDragEnd, false);
        insert.addEventListener('drop', usedPieceDrop, false);
        return false;
    }

    function pieceDragEnd(e) {
        [].forEach.call(pub.layouts, function (layout) {
            layout.classList.remove('over');
        });
        this.style.opacity = '1';
    }

    function layoutDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.dataTransfer.dropEffect = 'copy';
        return false;
    }

    function layoutDragEnter(e) {
        this.classList.add('over');
    }

    function layoutDragLeave(e) {
        this.classList.remove('over');
    }

    function removePiece(e) {
        $(this).fadeOut(400, function(){
            this.remove();
        });
    }

    function layoutDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }
        if (!e.dataTransfer.getData('already_listed')) {
            var insert = document.createElement('div');
            insert.setAttribute("class", e.dataTransfer.getData("class"));
            insert.setAttribute("id", e.dataTransfer.getData("id"));
            insert.setAttribute("draggable", "true");
            insert.innerHTML = e.dataTransfer.getData("text/html");
            this.appendChild(insert);
            this.classList.remove('over');
            insert.addEventListener('dragstart', usedPieceDragStart, false);
            insert.addEventListener('dragover', usedPieceDragOver, false);
            insert.addEventListener('dragenter', usedPieceDragEnter, false);
            insert.addEventListener('dragleave', usedPieceDragLeave, false);
            insert.addEventListener('dragend', usedPieceDragEnd, false);
            insert.addEventListener('drop', usedPieceDrop, false);
            return false;
        }
    }

    pub.layouts = document.querySelectorAll('#drag-layouts .drag-layout');
    pub.layoutcontent = document.querySelector('#layout-output');
    [].forEach.call(pub.layouts, function (layout) {
        layout.addEventListener('dragstart', pieceDragStart, false);
        layout.addEventListener('dragend', pieceDragEnd, false);
    });
    pub.layoutcontent.addEventListener('drop', layoutDrop, false);
    //pub.layoutcontent.addEventListener('drop', realtimeRenderings, false);
    pub.layoutcontent.addEventListener('dragenter', layoutDragEnter, false);
    pub.layoutcontent.addEventListener('dragover', layoutDragOver, false);
    pub.layoutcontent.addEventListener('dragleave', layoutDragLeave, false);

    var form =  $("#renderings-form");
    form.on('submit', function(ev){
        ev.preventDefault();
        $("#form-submitter").attr("disabled", "");
        $("#form-spinner").css("display", "inline");

        var info = {
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serializeArray()
        };

        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if (data.success) {
                setTimeout(function(){
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                $("#form-submitter").removeAttr("disabled");
                $("#form-spinner").css("display", "none");
            }
        })
    });

    return pub;
}());


var RenderingHandler = renderingHandler;