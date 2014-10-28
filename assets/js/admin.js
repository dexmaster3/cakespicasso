/**
 * Created by dexter on 10/27/14.
 */
var createRendering = function() {

    function pieceDragStart(e) {
        this.style.opacity = '0.5';

        e.dataTransfer.effectAllowed = 'copy';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function pieceDragEnd(e) {
        [].forEach.call(layouts, function (layout) {
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
        var block = this.parentNode;
        $(block).fadeOut(400, function(){
            this.remove();
        });
    }

    function layoutDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }
        var insert = document.createElement('div');
        insert.innerHTML = '<div class="piece-remove">X</div>' + e.dataTransfer.getData("text/html");
        this.appendChild(insert);
        var removes = this.querySelectorAll('.piece-remove');
        var removebutton = removes[removes.length -1];
        removebutton.addEventListener('click', removePiece);
        this.classList.remove('over');
        return false;
    }

    var layouts = document.querySelectorAll('#drag-layouts .drag-layout');
    var layoutcontent = document.querySelector('#layout-output');
    [].forEach.call(layouts, function (layout) {
        layout.addEventListener('dragstart', pieceDragStart, false);
        layout.addEventListener('dragend', pieceDragEnd, false);
    });
    layoutcontent.addEventListener('drop', layoutDrop, false);
    layoutcontent.addEventListener('dragenter', layoutDragEnter, false);
    layoutcontent.addEventListener('dragover', layoutDragOver, false);
    layoutcontent.addEventListener('dragleave', layoutDragLeave, false);

};