<script language="javascript" type="text/javascript">
        (function() {
            $('form').ajaxForm({
                beforeSubmit: function() {
                },
                complete: function(xhr) {
                        alert($.trim(xhr.responseText));
                        showMenu('content', 'index.php?model=master_pendidikan&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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


<form name="frmmaster_pendidikan" id="frmmaster_pendidikan" method="post" action="index.php?model=master_pendidikan&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">Id</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $master_pendidikan_->getId();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">Pendidikan</td> 
            <td><input type="text"  name="pendidikan" id="pendidikan" value="<?php echo $master_pendidikan_->getPendidikan();?>" size="20"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Created_date</td> 
            <td><input type="text"  name="created_date" id="created_date" value="<?php echo $master_pendidikan_->getCreated_date();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Created_by</td> 
            <td><input type="text"  name="created_by" id="created_by" value="<?php echo $master_pendidikan_->getCreated_by();?>" size="20"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Updated_date</td> 
            <td><input type="text"  name="updated_date" id="updated_date" value="<?php echo $master_pendidikan_->getUpdated_date();?>" size="10"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Updated_by</td> 
            <td><input type="text"  name="updated_by" id="updated_by" value="<?php echo $master_pendidikan_->getUpdated_by();?>" size="20"   ></td>
        </tr>


        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>

<br>
<br>
