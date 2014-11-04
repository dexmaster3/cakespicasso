/**
 * Created by dexter on 11/4/14.
 */
function dragFormHandler (elements, dropzone) {
    function dragStart(e) {
        this.style.opacity = '0.5';

        e.dataTransfer.effectAllowed = 'copy';
        e.dataTransfer.setData('text/html', this.dataset.view);
        console.log(this.dataset);
        e.dataTransfer.setData('class', this.classList);
        e.dataTransfer.setData('id', this.id);
    }

    function drop(e) {
        e.dataTransfer.effectAllowed = 'copy';
        $(this).append(e.dataTransfer.getData('text/html'));
        console.log(e.dataTransfer.getData('text/html'));
    }
    function over(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.dataTransfer.dropEffect = 'copy';
        return false;
    }
    function bindElement(element) {
        element.addEventListener('dragstart', dragStart, false);/*
        insert.addEventListener('dragover', usedPieceDragOver, false);
        insert.addEventListener('dragenter', usedPieceDragEnter, false);
        insert.addEventListener('dragleave', usedPieceDragLeave, false);
        insert.addEventListener('dragend', usedPieceDragEnd, false);
        insert.addEventListener('drop', usedPieceDrop, false);*/
    }
    function bindDropzone(e) {
        e.addEventListener('dragover', over, false);
        e.addEventListener('drop', drop, false);
    }


    [].forEach.call(elements, function(element){
        bindElement(element);
    });
    bindDropzone(dropzone);
}

dragFormHandler($(".form-items li"), $("div.form-preview").get(0));