<script language="javascript" type="text/javascript">
    (function() {
        $('form').ajaxForm({
            beforeSubmit: function() {
            },
            complete: function(xhr) {
                    alert($.trim(xhr.responseText));
                    showMenu('content', 'index.php?model=maaliyah&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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


<form name="frmmaaliyah" id="frmmaaliyah" method="post" action="index.php?model=maaliyah&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">Id</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $maaliyah_->getId();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">Tahun</td> 
            <td><input type="text"  name="tahun" id="tahun" value="<?php echo $maaliyah_->getTahun();?>" size="4"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Bulan</td> 
            <td><input type="text"  name="bulan" id="bulan" value="<?php echo $maaliyah_->getBulan();?>" size="2"   ></td>
        </tr>

        <tr> 
            <td class="textBold">No_anggota</td> 
            <td><input type="text"  name="no_anggota" id="no_anggota" value="<?php echo $maaliyah_->getNo_anggota();?>" size="20"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Nama_anggota</td> 
            <td><input type="text"  name="nama_anggota" id="nama_anggota" value="<?php echo $maaliyah_->getNama_anggota();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Infaq</td> 
            <td><input type="text"  name="infaq" id="infaq" value="<?php echo $maaliyah_->getInfaq();?>" size="'Y','T'"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Zakat</td> 
            <td><input type="text"  name="zakat" id="zakat" value="<?php echo $maaliyah_->getZakat();?>" size="'Y','T'"   ></td>
        </tr>

        <tr> 
            <td class="textBold">External</td> 
            <td><input type="text"  name="external" id="external" value="<?php echo $maaliyah_->getExternal();?>" size="'Y','T'"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Created_date</td> 
            <td><input type="text"  name="created_date" id="created_date" value="<?php echo $maaliyah_->getCreated_date();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Created_by</td> 
            <td><input type="text"  name="created_by" id="created_by" value="<?php echo $maaliyah_->getCreated_by();?>" size="20"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Updated_date</td> 
            <td><input type="text"  name="updated_date" id="updated_date" value="<?php echo $maaliyah_->getUpdated_date();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Updated_by</td> 
            <td><input type="text"  name="updated_by" id="updated_by" value="<?php echo $maaliyah_->getUpdated_by();?>" size="20"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Ip_address</td> 
            <td><input type="text"  name="ip_address" id="ip_address" value="<?php echo $maaliyah_->getIp_address();?>" size="30"   ></td>
        </tr>


        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>

<br>
<br>
