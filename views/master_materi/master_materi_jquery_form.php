<script language="javascript" type="text/javascript">
        (function() {
            $('form').ajaxForm({
                beforeSubmit: function() {
                },
                complete: function(xhr) {
                        alert($.trim(xhr.responseText));
                        showMenu('content', 'index.php?model=master_materi&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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


<form name="frmmaster_materi" id="frmmaster_materi" method="post" action="index.php?model=master_materi&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">Id</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $master_materi_->getId();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">Kode_materi</td> 
            <td><input type="text"  name="kode_materi" id="kode_materi" value="<?php echo $master_materi_->getKode_materi();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Nama_materi</td> 
            <td><input type="text"  name="nama_materi" id="nama_materi" value="<?php echo $master_materi_->getNama_materi();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Alias_materi</td> 
            <td><input type="text"  name="alias_materi" id="alias_materi" value="<?php echo $master_materi_->getAlias_materi();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Level</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="level" id="level" value="<?php echo $master_materi_->getLevel();?>" size="2"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Created_by</td> 
            <td><input type="text"  name="created_by" id="created_by" value="<?php echo $master_materi_->getCreated_by();?>" size="20"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Created_at</td> 
            <td><input type="text"  name="created_at" id="created_at" value="<?php echo $master_materi_->getCreated_at();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Updated_by</td> 
            <td><input type="text"  name="updated_by" id="updated_by" value="<?php echo $master_materi_->getUpdated_by();?>" size="20"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Updated_at</td> 
            <td><input type="text"  name="updated_at" id="updated_at" value="<?php echo $master_materi_->getUpdated_at();?>" size="10"   ></td>
        </tr>


        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>

<br>
<br>
