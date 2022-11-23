
<table width="100%" border="0" align="center" style="border-radius: 10px 10px 10px 10px; background-color: #ADD7F0">
    <tr>
        <td align="right">
            <image src="images/icon-close.png" onclick="showMenu('uploadphoto','blank.php')" title="Tutup Jendela" style="cursor: pointer">
        </td>
    </tr>
    <tr>
        <td>
            <form id="uploadphoto" action="index.php?model=master_profil&action=fileUpload" method="post" enctype="multipart/form-data">
                <p align="center">
                    <b>Pilih Foto/Gambar</b>
                <input type="file" class="btn-file" name="fileupload" id="fileupload">
                </p>
                <p align="center">
                <input type="submit" name="submit" class="btn" value="Upload">
                </p>
            </form>
            <div class="progress"></div>
            <div class="bar"></div>
            <div class="percent" style="text-align: center">0%</div>
            <div id="status"></div>
        </td>
    </tr>
</table>

<script>
    (function() {

        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        $('form').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
                showMenu('avatarprofile','index.php?model=master_profil&action=showAvatar');
                showMenu('content','index.php?model=master_profil&action=showProfileUser');
            }
        });
    })();
</script>
