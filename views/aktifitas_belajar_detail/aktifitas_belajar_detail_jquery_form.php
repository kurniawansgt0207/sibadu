<script language="javascript" type="text/javascript">
        (function() {
            $('form').ajaxForm({
                beforeSubmit: function() {
                },
                complete: function(xhr) {
                        alert($.trim(xhr.responseText));
                        showMenu('content', 'index.php?model=aktifitas_belajar_detail&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
                }
             });
        })();
        function validate(evt){
            var e = evt || window.event;
            var key = e.keyCode || e.which;
            if((key <48 || key >57) && !(key ==8 || key ==9 || key ==13  || key ==37  || key ==39 || key ==46)  ){
                e.returnValue = false;
                if(e.preventDefault)e.preventDefault();
            }
        }
</script>

<br>


<form name="frmaktifitas_belajar_detail" id="frmaktifitas_belajar_detail" method="post" action="index.php?model=aktifitas_belajar_detail&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">Id</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $aktifitas_belajar_detail_->getId();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">BaseId</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="baseId" id="baseId" value="<?php echo $aktifitas_belajar_detail_->getBaseId();?>" size="5"   ></td>
        </tr>

        <tr> 
            <td class="textBold">NoAnggota</td> 
            <td><input type="text"  name="noAnggota" id="noAnggota" value="<?php echo $aktifitas_belajar_detail_->getNoAnggota();?>" size="30"   ></td>
        </tr>

        <tr> 
            <td class="textBold">IsHadir</td> 
            <td><input type="text"  name="isHadir" id="isHadir" value="<?php echo $aktifitas_belajar_detail_->getIsHadir();?>" size="'0','1'"   ></td>
        </tr>

        <tr> 
            <td class="textBold">KetTdkHadir</td> 
            <td><input type="text"  name="ketTdkHadir" id="ketTdkHadir" value="<?php echo $aktifitas_belajar_detail_->getKetTdkHadir();?>" size="20"   ></td>
        </tr>


        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>

<br>
<br>
