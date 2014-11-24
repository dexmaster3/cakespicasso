/**
 * Created by dexter on 11/18/14.
 */

var clickHandler = (function () {

    var pub = {totalinfo : []};

    function saveClicks() {
        $(document).bind('mousedown.clickmap', function (evt) {
            var info = {
                x: evt.pageX,
                y: evt.pageY,
                location: document.location.pathname
            };
            pub.totalinfo.push(info);
        });
    }

    function postSaveClicks(async) {
        if (pub.totalinfo.length > 0) {
            $.ajax({
                async: async,
                url: "/Analytics/Analytics/postclicks",
                type: "POST",
                data: JSON.stringify({data: pub.totalinfo}),
                dataType: "json",
                contentType: "application/json; charset=UTF-8",
                success: function (data, status, xhr) {
                    pub.totalinfo = [];
                },
                error: function (xhr, status, error) {
                    console.log("PostClicks ajax error: " + error);
                }
            });
        }
    }

    function stopSaveClicks() {
        $(document).unbind('mousedown.clickmap');
    }

    function displayClicks(dataTable) {
        $('<div id="clickmap-overlay"></div>').appendTo('body');
        $('<div id="clickmap-loading"></div>').appendTo('body');
        $('<div id="clickmap-container"></div>').appendTo('body');
        var curr_table_data = dataTable.fnGetData();
        $.each(curr_table_data, function(index, curr_data) {
            $("#clickmap-container").append("<div style='left:" + curr_data.x + "px;top:"+ curr_data.y + "px;'></div>")
        });
        $('#clickmap-loading').remove();
        $("#clickmap-overlay").on('click', function(){
            removeClicks();
        })
    }
    function displayClickAnyPage() {
        $('<div id="clickmap-overlay"></div>').appendTo('body');
        $('<div id="clickmap-loading"></div>').appendTo('body');
        $('<div id="clickmap-container"></div>').appendTo('body');
        var displayQuery = {
            specificpage: true,
            pageurl: window.location.pathname,
            draw: 1
        };
        $.ajax({
            url: "/Analytics/Analytics/getnextclicks",
            method: "POST",
            data: displayQuery,
            success: function(data, status, xhr) {
                $.each(data.data, function(index, curr_data) {
                    $("#clickmap-container").append("<div style='left:" + curr_data.x + "px;top:"+ curr_data.y + "px;'></div>").fadeIn(500);
                });
                $('#clickmap-loading').remove();
                $("#clickmap-overlay").on('click', function(){
                    removeClicks();
                });
            }
        });
    }

    function removeClicks() {
        $('#clickmap-overlay').remove();
        $('#clickmap-container').remove();
    }

    pub.displayClickAnyPage = displayClickAnyPage;
    pub.displayClicks = displayClicks;
    pub.stopSaveClicks = stopSaveClicks;
    pub.postSaveClicks = postSaveClicks;
    pub.saveClicks = saveClicks;

    return pub;
}());

//Bind Events
clickHandler.saveClicks();
$(window).unload(function(){
    clickHandler.postSaveClicks(false);
});
setInterval(function(){
    clickHandler.postSaveClicks(true);
}, 5000);