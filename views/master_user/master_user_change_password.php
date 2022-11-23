<script language="javascript" type="text/javascript">
    jQuery(function(){
        $("#changepassword").submit(function(){
            var post_data = $(this).serialize();
            var form_action = $(this).attr("action");
            var form_method = $(this).attr("method");
            $.ajax({
                 type : form_method,
                 url : form_action, 
                 cache: false, 
                 data : post_data,
                 success : function(x){
                    if(x.trim() == "Data is updated") {
                        alert("Perubahan Sandi Berhasil\nSilahkan Melakukan Proses Login Kembali Menggunakan Sandi Baru Anda.");
                        window.location = "index.php?model=login&action=logOut";
                    }else{
                        alert(x);
                    }
                 }, 
                 error : function(){
                    alert("Error");
                 }
            });
            return false;
         });
    });
</script>


<form name="changepassword" id="changepassword" method="post" action="index.php?model=master_user&action=changePassword">
    <table>
        <tr><td>Masukan Sandi Lama</td></tr>
        <tr><td><input type="password" class="form-control" name="oldpassword" id="oldpassword" value=""></td></tr>
        <tr><td>Masukan Sandi Baru (Minimal 8 Karakter)</td></tr>    
        <tr><td><input type="password" class="form-control" name="newpassword" id="newpassword"  value=""></td></tr>
        <tr><td>Konfirmasi Sandi Baru (Harus sama dengan Sandi Baru)</td></tr>
        <tr><td><input type="password" class="form-control" name="retypepassword" id="retypepassword" value=""></td></tr>
        <tr><td align="center"><input type="submit" class="btn-info btn" name="changepass" id="changepass" value="Simpan"></td></tr>    
    </table>
</form>
<br>
<br>



