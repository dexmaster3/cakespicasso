{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Profile
                    <small>Avatar</small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li>
                        <i class="fa fa-edit"></i> <a href="/user/profile">User</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> <a href="/user/profile/avatar">Avatar</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="img-container" style="width: 500px;">
                    <img src="/assets/upload/<?= $this->data->user['avatar'] ?>">
                </div>
                <div class="img-preview"></div>
                <button class="btn btn-success" onclick="saveAvatar();">Save</button>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}
<link href="/assets/css/plugins/cropper.css" rel="stylesheet" type="text/css">
<script src="/assets/js/plugins/cropper/cropper.min.js"></script>
<script>
    var avatarCropper = $(".img-container > img").cropper({
        aspectRatio: 1
    });
    function saveAvatar() {
        var imgbase = avatarCropper.cropper("getDataURL", {width:200, height: 200}, "image/jpeg", 0.8);
        var info = {
            url: "/users/profile/postavatar",
            method: "POST",
            data: {
                image: imgbase
            }
        };
        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if (data.success) {
                setTimeout(function() {
                    window.location.href = data.redirect;
                }, 1500);
            }
        });
    }
</script>

{{/scripts}}