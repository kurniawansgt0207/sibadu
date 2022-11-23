<script language="javascript" type="text/javascript">
        (function() {
            $('form').ajaxForm({
                beforeSubmit: function() {
                },
                complete: function(xhr) {
                        alert($.trim(xhr.responseText));
                        showMenu('content', 'index.php?model=master_kelompok&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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
<?php
    $user = $this->user;
            
    $m_user = new master_user();
    $m_userCtrl = new master_userController($m_user, $this->dbh);
    $user_info = $m_userCtrl->showDataByUser($user);
    $unit = $user_info->getUnitid();
    $dept = $user_info->getDepartmentid();
?>
<form name="frmmaster_kelompok" id="frmmaster_kelompok" method="post" action="index.php?model=master_kelompok&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">ID</td> 
            <td><input type="text" class="form-control" style="text-align: right;" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $master_kelompok_->getId();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">Yayasan</td> 
            <td>                
                <select name="unitid" id="unitid" class="form-control">
                    <option value="">Pilih Yayasan</option>
                    <?php
                        $m_unit = new master_unit();
                        $m_unitCtrl = new master_unitController($m_unit, $this->dbh);
                        $unitList = $m_unitCtrl->showDataAllByCabang($unit);
                        foreach($unitList as $unit){
                            $selected = ($unit->getUnitid()==$master_kelompok_->getUnitid()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $unit->getUnitid();?>" <?php echo $selected;?>><?php echo $unit->getUnitname();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Kelas</td> 
            <td>                
                <select class="form-control" name="deptid" id="deptid">
                    <option value="">Pilih Kelas</option>
                    <?php
                        $m_departemen = new master_department();
                        $m_departemenCtrl = new master_departmentController($m_departemen, $this->dbh);
                        $departemenList = $m_departemenCtrl->showDataAllByRanting($dept);
                        foreach($departemenList as $departemen){
                            $selected = ($departemen->getDepartmentid()==$master_kelompok_->getDeptid()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $departemen->getDepartmentid();?>" <?php echo $selected;?>><?php echo $departemen->getDescription();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Nama Kelompok</td> 
            <td><input type="text" class="form-control"  name="kelompok" id="kelompok" value="<?php echo $master_kelompok_->getKelompok();?>" size="40"   ></td>
        </tr>
        
        <tr> 
            <td class="textBold">Created Date</td> 
            <td>
                <input type="hidden" name="created_date" id="created_date" value="<?php echo $master_kelompok_->getCreated_date();?>">
                <?php echo $master_kelompok_->getCreated_date();?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Created By</td> 
            <td>
                <input type="hidden" name="created_by" id="created_by" value="<?php echo $master_kelompok_->getCreated_by();?>">
                <?php echo $master_kelompok_->getCreated_by();?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Updated Date</td> 
            <td>
                <input type="hidden" name="updated_date" id="updated_date" value="<?php echo ($master_kelompok_->getUpdated_date()!=NULL) ? $master_kelompok_->getUpdated_date() : date("Y-m-d H:i:s");?>">
                <?php echo ($master_kelompok_->getUpdated_date()!=NULL) ? $master_kelompok_->getUpdated_date() : date("Y-m-d H:i:s");?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Updated By</td> 
            <td>
                <input type="hidden" name="updated_by" id="updated_by" value="<?php echo ($master_kelompok_->getUpdated_by()!=NULL) ? $master_kelompok_->getUpdated_by() : $this->user;?>">
                <?php echo ($master_kelompok_->getUpdated_by()!=NULL) ? $master_kelompok_->getUpdated_by() : $this->user;?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">IP Address</td> 
            <td>
                <input type="hidden" name="ip_address" id="ip_address" value="<?php echo $master_kelompok_->getIp_address();?>">
                <?php echo $master_kelompok_->getIp_address();?>
            </td>            
        </tr>


        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>

<br>
<br>
