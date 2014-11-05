/**
 * Created by dexter on 11/4/14.
 */
function dragFormHandler () {
    var fieldNumber = 0;
    var fieldData = {};

    function bindPopover(e) {
        $("#popover-save").click(onSaveClick);
        $("#popover-delete").click(onDeleteClick);
        $("#popover-cancel").click(function(e){
            document.getElementById("popover-window").style.display = "none";
        });
        $(e).click(function(e) {e.stopPropagation();});

        function onDeleteClick(e) {
            e.stopPropagation();
            var curr_id = $("#popover-window").data('id');
            delete fieldData[curr_id];
            $.each($(".form-item"), function(i, data) {
                if ($(data).data('id') == curr_id) {
                    $(data).remove();
                }
            });
            console.log(fieldData);
        }

        function onSaveClick(e) {
            e.stopPropagation();
            var curr_id = $("#popover-window").data('id');
            var curr_data = $("#popover-window input").serializeArray();
            $.each(curr_data, function(i, data){
                fieldData[curr_id][data['name']] = data['value'];
            });
            console.log(fieldData);
        }
    }

    function bindAddedField(e) {
        e.addEventListener('click', onclick, false);

        function onclick(e) {
            e.stopPropagation();
            var data_now = fieldData[$(this).data('id')];
            var popover = $("#popover-window");
            popover.show();
            popover.css({position: "absolute", "top": e.pageY - 180, "left": e.pageX + 100});
            $(".pop-name#name").val(data_now['name']);
            $(".pop-label#label").val(data_now['label']);
            $(".pop-placeholder#placeholder").val(data_now['placeholder']);
            popover.data(fieldData[$(this).data('id')]);

        }
    }
    function bindDraggableElement(element) {
        element.addEventListener('dragstart', dragStart, false);
        element.addEventListener('dragend', dragEnd, false);

        function dragStart(e) {
            this.style.opacity = '0.5';
            e.dataTransfer.effectAllowed = 'copy';
            e.dataTransfer.setData('text/html', this.dataset.view);
            e.dataTransfer.setData('name', this.dataset.name);
            e.dataTransfer.setData('label', this.dataset.label);
            e.dataTransfer.setData('type', this.dataset.type);
            e.dataTransfer.setData('placeholder', this.dataset.placeholder);
        }
        function dragEnd(e) {
            this.style.opacity = '';
        }
    }
    function bindDropzone(e) {
        e.addEventListener('dragover', over, false);
        e.addEventListener('drop', drop, false);

        function drop(e) {
            e.dataTransfer.effectAllowed = 'copy';
            fieldNumber += 1;
            var inptype = e.dataTransfer.getData('type');
            var label = e.dataTransfer.getData('label');
            var name = e.dataTransfer.getData('name');
            var placeholder = e.dataTransfer.getData('placeholder');

            $(this).append(e.dataTransfer.getData('text/html'));
            $(this).children(".form-item:last").data('id', fieldNumber);
            fieldData[fieldNumber] = {"id": fieldNumber, "label": label, "type": inptype, "name": name, "placeholder": placeholder};
            bindAddedField($(".form-item:last", this).get(0));
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
    $(document).click(function(){
        document.getElementById("popover-window").style.display = "none";
    });
    //Bind all form element types to drag
    [].forEach.call($(".form-items li"), function(element){
        bindDraggableElement(element);
    });
    //Bind dropzone to be droppable
    bindDropzone(document.getElementById('form-preview'));
    //Bind popover to save/delete
    bindPopover(document.getElementById('popover-window'));
}

dragFormHandler();