<script language="javascript" type="text/javascript">
        (function() {
            $('form').ajaxForm({
                beforeSubmit: function() {
                },
                complete: function(xhr) {
                        alert($.trim(xhr.responseText));
                        showMenu('content', 'index.php?model=history_master_anggota&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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


<form name="frmhistory_master_anggota" id="frmhistory_master_anggota" method="post" action="index.php?model=history_master_anggota&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">Id</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $history_master_anggota_->getId();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">NoAnggota</td> 
            <td><input type="text"  name="noAnggota" id="noAnggota" value="<?php echo $history_master_anggota_->getNoAnggota();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">NmAnggota</td> 
            <td><input type="text"  name="nmAnggota" id="nmAnggota" value="<?php echo $history_master_anggota_->getNmAnggota();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Level_before</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="level_before" id="level_before" value="<?php echo $history_master_anggota_->getLevel_before();?>" size="5"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Level_new</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="level_new" id="level_new" value="<?php echo $history_master_anggota_->getLevel_new();?>" size="5"   ></td>
        </tr>

        <tr> 
            <td class="textBold">TglUpdateLevel</td> 
            <td><input type="text" name="tglUpdateLevel" id="tglUpdateLevel" value="<?php echo $history_master_anggota_->getTglUpdateLevel();?>" size="10" readonly >
            <script>
                $(function() {
                    $('#tglUpdateLevel').datepicker({
                        dateFormat: 'yy-mm-dd',
                        yearRange: '-100:+20',
                        changeYear: true,
                        changeMonth: true
                    });
                });
            </script>
            </td> 
        </tr>

        <tr> 
            <td class="textBold">CreatedDate</td> 
            <td><input type="text"  name="createdDate" id="createdDate" value="<?php echo $history_master_anggota_->getCreatedDate();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">CreatedBy</td> 
            <td><input type="text"  name="createdBy" id="createdBy" value="<?php echo $history_master_anggota_->getCreatedBy();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">UpdatedDate</td> 
            <td><input type="text"  name="updatedDate" id="updatedDate" value="<?php echo $history_master_anggota_->getUpdatedDate();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">UpdatedBy</td> 
            <td><input type="text"  name="updatedBy" id="updatedBy" value="<?php echo $history_master_anggota_->getUpdatedBy();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Ip_address</td> 
            <td><input type="text"  name="ip_address" id="ip_address" value="<?php echo $history_master_anggota_->getIp_address();?>" size="40"   ></td>
        </tr>


        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>

<br>
<br>
