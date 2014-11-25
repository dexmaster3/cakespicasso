/**
 * Created by dexter on 11/25/14.
 */
var LayoutDragHandler = (function () {

    var pub = {};

    function bindDraggableElement(element) {
        element.addEventListener('dragstart', function (e) {
            this.style.opacity = '0.5';
            e.dataTransfer.setData('text', this.dataset.text);
        });
        element.addEventListener('dragend', function (e) {
            this.style.opacity = '';
        });
    }

    function bindDropzone(e) {
        e.addEventListener('dragover', function (e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.dataTransfer.dropEffect = 'copy';
            return false;
        }, false);
        e.addEventListener('drop', function (e) {
            e.dataTransfer.effectAllowed = 'copy';

            $(this).append(e.dataTransfer.getData('text'));
            $(this).children(".form-item:last").data('id', pub.fieldNumber);
        }, false);
    }

    //Bind all form element types to drag
    [].forEach.call($(".tag-drag"), function (element) {
        bindDraggableElement(element);
    });

    //Bind dropzone to be droppable
    bindDropzone(document.getElementById('layout_content'));

    return pub;
}());

var layoutDragHandler = LayoutDragHandler;