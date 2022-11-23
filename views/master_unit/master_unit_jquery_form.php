<script language="javascript" type="text/javascript">
        (function() {
            $('form').ajaxForm({
                beforeSubmit: function() {
                },
                complete: function(xhr) {
                        alert($.trim(xhr.responseText));
                        showMenu('content', 'index.php?model=master_unit&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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


<form name="frmmaster_unit" id="frmmaster_unit" method="post" action="index.php?model=master_unit&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">Unitid</td> 
            <td><input type="text" style="text-align: right;" onkeypress="validate(event);"  name="unitid" id="unitid" value="<?php echo $master_unit_->getUnitid();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">Unitname</td> 
            <td><input type="text"  name="unitname" id="unitname" value="<?php echo $master_unit_->getUnitname();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Description</td> 
            <td><input type="text"  name="description" id="description" value="<?php echo $master_unit_->getDescription();?>" size="40"   ></td>
        </tr>


        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>

<br>
<br>
