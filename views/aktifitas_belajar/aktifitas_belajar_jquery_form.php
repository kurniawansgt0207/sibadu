<script language="javascript" type="text/javascript">
        (function() {
            $('form').ajaxForm({
                beforeSubmit: function() {
                    if(document.getElementById('tgl_belajar').value==""){
                        alert("Tanggal Belajar Harus Diisi");
                        return false;
                    }
                    if(document.getElementById('unitid').value==""){
                        alert("Yayasan Harus Diisi");
                        return false;
                    }
                    if(document.getElementById('deptid').value==""){
                        alert("Kelas Harus Diisi");
                        return false;
                    }
                    if(document.getElementById('kelompokid').value==""){
                        alert("Kelompok Belajar Harus Diisi");
                        return false;
                    }
                    if(document.getElementById('pengajar').value==""){
                        alert("Pengajar Harus Diisi");
                        return false;
                    }
                    if(document.getElementById('modulid').value==""){
                        alert("Modul Belajar Harus Diisi");
                        return false;
                    }
                    if(document.getElementById('pembahasan').value==""){
                        alert("Detail Pembahasan Belajar Harus Diisi");
                        return false;
                    }                    
                },
                complete: function(xhr) {
                        alert($.trim(xhr.responseText));
                        showMenu('content', 'index.php?model=aktifitas_belajar&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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
    date_default_timezone_set("Asia/Bangkok");
?>
<form name="frmaktifitas_belajar" id="frmaktifitas_belajar" method="post" action="index.php?model=aktifitas_belajar&action=saveFormJQuery">
    <table >
        <tr> 
            <td class="textBold">ID</td> 
            <td><input type="text" class="form-control" style="text-align: right;" placeholder="Auto Generate" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $aktifitas_belajar_->getId();?>" size="5" ReadOnly  ></td>
        </tr>

        <tr> 
            <td class="textBold">Tanggal Belajar <font color="red">*</font></td> 
            <td>
                <input type="text" class="form-control"  name="tgl_belajar" id="tgl_belajar" value="<?php echo $aktifitas_belajar_->getTgl_belajar();?>" size="10">
                <script>
                $(function() {
                    $('#tgl_belajar').datepicker({
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
            <td class="textBold">Yayasan <font color="red">*</font></td> 
            <td>
                <select class="form-control" name="unitid" id="unitid">
                    <option value="">Pilih Yayasan</option>
                    <?php
                        $m_unit = new master_unit();
                        $m_unitCtrl = new master_unitController($m_unit, $this->dbh);
                        $unitList = $m_unitCtrl->showDataAll();
                        foreach($unitList as $unit){
                            $selected = ($unit->getUnitid()==$aktifitas_belajar_->getUnitid()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $unit->getUnitid();?>" <?php echo $selected;?>><?php echo $unit->getUnitname();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr> 
            <td class="textBold">Kelas <font color="red">*</font></td> 
            <td>
                <select class="form-control" name="deptid" id="deptid">
                    <option value="">Pilih Kelas</option>
                    <?php
                        $m_departemen = new master_department();
                        $m_departemenCtrl = new master_departmentController($m_departemen, $this->dbh);
                        $departemenList = $m_departemenCtrl->showDataAll();
                        foreach($departemenList as $departemen){
                            $selected = ($departemen->getDepartmentid()==$aktifitas_belajar_->getDeptid()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $departemen->getDepartmentid();?>" <?php echo $selected;?>><?php echo $departemen->getDescription();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
                
        <tr> 
            <td class="textBold">Kelompok Belajar <font color="red">*</font></td> 
            <td>
                <input type="hidden" name="kelBelajar" id="kelBelajar" value="<?php echo $aktifitas_belajar_->getKelompokid();?>">
                <select class="form-control" name="kelompokid" id="kelompokid">
                    <option value="">Pilih Kelompok Belajar</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="textBold">Peserta Belajar <font color="red">*</font></td> 
            <td>
                <div id="pesertalist"></div>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Jml Hadir</td> 
            <td><input type="text" class="form-control" style="text-align: right;" onkeypress="validate(event);" readonly name="jml_hadir" id="jml_hadir" value="<?php echo $aktifitas_belajar_->getJml_hadir();?>" size="2"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Jml Tidak Hadir</td> 
            <td><input type="text" class="form-control" style="text-align: right;" onkeypress="validate(event);" readonly name="jml_tdk_hadir" id="jml_tdk_hadir" value="<?php echo $aktifitas_belajar_->getJml_tdk_hadir();?>" size="2"   ></td>
        </tr>
        <tr> 
            <td class="textBold">Pengajar <font color="red">*</font></td> 
            <td><input type="text" class="form-control"  name="pengajar" id="pengajar" value="<?php echo $aktifitas_belajar_->getPengajar();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Modul <font color="red">*</font></td> 
            <td>                
                <select name="modulid" id="modulid" class="form-control">
                    <option value="">Pilih Modul Belajar</option>
                    <?php
                        $m_materi = new master_materi();
                        $m_materiCtrl = new master_materiController($m_materi, $this->dbh);
                        $materi_list = $m_materiCtrl->showDataAll();
                        foreach($materi_list as $materi){
                            $selected = ($materi->getId() == $aktifitas_belajar_->getModulid()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $materi->getId();?>" <?php echo $selected;?>><?php echo "(".$materi->getLevel().") ".$materi->getAlias_materi()." - ".$materi->getNama_materi();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Pembahasan <font color="red">*</font></td> 
            <td>
                <textarea rows="10" cols="72" name="pembahasan" id="pembahasan"><?php echo $aktifitas_belajar_->getPembahasan();?></textarea>
<!--                <script>
                    $(function(){ 
                        $('#pembahasan').htmlarea({css: 'jHtmlArea/style/jHtmlArea.Editor.css'});
                    });
                </script>-->
            </td>
        </tr>                       

        <tr> 
            <td class="textBold">Created Date</td> 
            <td>
                <input type="hidden" name="created_date" id="created_date" value="<?php echo ($aktifitas_belajar_->getId()>0) ? $aktifitas_belajar_->getCreated_date() : date("Y-m-d H:i:s");?>">
                <?php echo ($aktifitas_belajar_->getId()>0) ? $aktifitas_belajar_->getCreated_date() : date("Y-m-d H:i:s");?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Created By</td> 
            <td>
                <input type="hidden" name="created_by" id="created_by" value="<?php echo $aktifitas_belajar_->getCreated_by();?>">
                <?php echo $aktifitas_belajar_->getCreated_by();?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Updated Date</td> 
            <td>
                <input type="hidden" name="updated_date" id="updated_date" value="<?php echo ($aktifitas_belajar_->getUpdated_date()!=NULL) ? $aktifitas_belajar_->getUpdated_date() : date("Y-m-d H:i:s");?>">
                <?php echo ($aktifitas_belajar_->getUpdated_date()!=NULL) ? $aktifitas_belajar_->getUpdated_date() : date("Y-m-d H:i:s");?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Updated By</td> 
            <td>
                <input type="hidden" name="updated_by" id="updated_by" value="<?php echo ($aktifitas_belajar_->getUpdated_by()!=NULL) ? $aktifitas_belajar_->getUpdated_by() : $this->user;?>">
                <?php echo ($aktifitas_belajar_->getUpdated_by()!=NULL) ? $aktifitas_belajar_->getUpdated_by() : $this->user;?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">IP Address</td> 
            <td>
                <input type="hidden" name="ip_address" id="ip_address" value="<?php echo $aktifitas_belajar_->getIp_address();?>">
                <?php echo $aktifitas_belajar_->getIp_address();?>
            </td>            
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>
<script>
    //$("#pesertalist").load("index.php?model=aktifitas_belajar_detail&action=getPeserta&unitid="+document.getElementById('unitid').value+"&deptid="+document.getElementById('deptid').value+"&kelompokid="+document.getElementById('kelompokid').value);
    $("#kelompokid").load("index.php?model=master_kelompok&action=showListKelompokByUnitByDept&unit="+document.getElementById('unitid').value+"&dept="+document.getElementById('deptid').value+"&kel="+document.getElementById('kelBelajar').value);
    $("#pesertalist").load("index.php?model=aktifitas_belajar_detail&action=getPeserta&idaktifitas="+document.getElementById('id').value+"&unit="+document.getElementById('unitid').value+"&dept="+document.getElementById('deptid').value+"&kel="+document.getElementById('kelBelajar').value);
    
    $(document).ready(function() {
        $("#deptid").change(function() {            
            var postForm = {
                'dept': document.getElementById("deptid").value,
                'unit': document.getElementById("unitid").value,
                'kel': document.getElementById("kelompokid").value,
            };
            $.ajax({
                type: "post",
                url: "index.php?model=master_kelompok&action=showListKelompokByUnitByDept",
                data: postForm,
                success: function(data) {
                     $("#kelompokid").html(data);
                }
            });
        });
        
        $("#kelompokid").change(function() {            
            var postForm = {
                'dept': document.getElementById("deptid").value,
                'unit': document.getElementById("unitid").value,
                'kel': document.getElementById("kelompokid").value,
            };
            $.ajax({
                type: "post",
                url: "index.php?model=aktifitas_belajar_detail&action=getPeserta",
                data: postForm,
                success: function(data) {
                     $("#pesertalist").html(data);
                }
            });
        });
    });
</script>
<br>
<br>
