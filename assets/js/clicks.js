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