<script language="javascript" type="text/javascript">
    (function() {
        $('form').ajaxForm({
            beforeSubmit: function() {
                if(document.getElementById('namaAnggota').value==""){
                    alert("Nama Anggota Harus Diisi");
                    return false;
                }
                if(document.getElementById('tglLahir').value==""){
                    alert("Tanggal Lahir Harus Diisi");
                    return false;
                }
                if(document.getElementById('jnsKelamin').value==""){
                    alert("Jenis Kelamin Harus Diisi");
                    return false;
                }
                if(document.getElementById('level').value==""){
                    alert("Level Terbaru Harus Diisi");
                    return false;
                }
                if(document.getElementById('stsKeluarga').value==""){
                    alert("Status di Keluarga Harus Diisi");
                    return false;
                }
                if(document.getElementById('wali').value==""){
                    alert("Wali Harus Diisi");
                    return false;
                }
                if(document.getElementById('unit').value==""){
                    alert("Yayasan Harus Diisi");
                    return false;
                }
                if(document.getElementById('departemen').value==""){
                    alert("Kelas Harus Diisi");
                    return false;
                }
                if(document.getElementById('kelompok').value==""){
                    alert("Kelompok Belajar Harus Diisi");
                    return false;
                }
                if(document.getElementById('statusAnggota').value==""){
                    alert("Status Anggota Harus Diisi");
                    return false;
                }
                if(document.getElementById('isPengurus').value==""){
                    alert("Pengurus atau Bukan Harus Diisi");
                    return false;
                }
            },
            complete: function(xhr) {
                    alert($.trim(xhr.responseText));
                    showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
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
    $m_user = new master_user();
    $m_userCtrl = new master_userController($m_user, $this->dbh);    
    $userDeptId = strlen($m_userCtrl->getUserDeptId()) == 1 ? "0".$m_userCtrl->getUserDeptId() : $m_userCtrl->getUserDeptId();
    $userUnitId = strlen($m_userCtrl->getUserUnitId()) == 1 ? "0".$m_userCtrl->getUserUnitId() : $m_userCtrl->getUserUnitId();
    
    $newNoUrut = $this->getLastNoAnggota($userUnitId,$userDeptId);
    
    $prefix = "RT";
    $nowYear = date("y");
    $newNoAnggota = $prefix.$userDeptId.$userUnitId.$nowYear.$newNoUrut;
?>
<form name="frmmaster_anggota" id="frmmaster_anggota" method="post" action="index.php?model=master_anggota&action=saveFormJQuery">
    <table>
        <tr> 
            <td class="textBold">ID</td> 
            <td>
                <input type="hidden" style="text-align: right;" onkeypress="validate(event);"  name="id" id="id" value="<?php echo $master_anggota_->getId();?>">
                <?php echo $master_anggota_->getId();?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">No. Anggota</td> 
            <td>
                <input type="hidden" name="noAnggota" id="noAnggota" value="<?php echo ($master_anggota_->getId()!="") ? $master_anggota_->getNoAnggota() : $newNoAnggota;?>" size="30">
                <?php echo ($master_anggota_->getId()!="") ? $master_anggota_->getNoAnggota() : $newNoAnggota;?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Nama Anggota <font color="red">*</font></td> 
            <td><input type="text" class="form-control" name="namaAnggota" id="namaAnggota" value="<?php echo $master_anggota_->getNamaAnggota();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Tanggal Lahir <font color="red">*</font></td> 
            <td><input type="text" class="form-control" name="tglLahir" id="tglLahir" value="<?php echo $master_anggota_->getTglLahir();?>" size="10" readonly >
            <script>
                $(function() {
                    $('#tglLahir').datepicker({
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
            <td class="textBold">Jenis Kelamin <font color="red">*</font></td> 
            <td>                
                <select class="form-control" name="jnsKelamin" id="jnsKelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="LK" <?php if($master_anggota_->getJnsKelamin()=="LK") echo "selected";?>>Laki-laki</option>
                    <option value="PR" <?php if($master_anggota_->getJnsKelamin()=="PR") echo "selected";?>>Perempuan</option>
                </select>
            </td>
        </tr>
        
        <tr> 
            <td class="textBold">Golongan Darah</td> 
            <td>                
                <select class="form-control" name="gol_darah" id="gol_darah">
                    <option value="">Pilih Golongan Darah</option>
                    <option value="A (Rh+)" <?php if($master_anggota_->getGol_darah()=="A (Rh+)") echo "selected";?>>A (Rhesus +)</option>
                    <option value="A (Rh-)" <?php if($master_anggota_->getGol_darah()=="A (Rh-)") echo "selected";?>>A (Rhesus -)</option>
                    <option value="B (Rh+)" <?php if($master_anggota_->getGol_darah()=="B (Rh+)") echo "selected";?>>B (Rhesus +)</option>
                    <option value="B (Rh-)" <?php if($master_anggota_->getGol_darah()=="B (Rh-)") echo "selected";?>>B (Rhesus -)</option>
                    <option value="AB (Rh+)" <?php if($master_anggota_->getGol_darah()=="AB (Rh+)") echo "selected";?>>AB (Rhesus +)</option>
                    <option value="AB (Rh-)" <?php if($master_anggota_->getGol_darah()=="AB (Rh-)") echo "selected";?>>AB (Rhesus -)</option>
                    <option value="O (Rh+)" <?php if($master_anggota_->getGol_darah()=="O (Rh+)") echo "selected";?>>O (Rhesus +)</option>
                    <option value="O (Rh-)" <?php if($master_anggota_->getGol_darah()=="O (Rh-)") echo "selected";?>>O (Rhesus -)</option>
                </select>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Level Terbaru <font color="red">*</font></td> 
            <td>
                <select class="form-control" name="level" id="level">
                    <option value="">Pilih Level Terbaru</option>
                    <?php
                        $m_level = new master_level();
                        $m_levelCtrl = new master_levelController($m_level, $this->dbh);
                        $levelList = $m_levelCtrl->showDataAll();
                        foreach($levelList as $level){
                            $selected = ($level->getId()==$master_anggota_->getLevel()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $level->getId();?>" <?php echo $selected;?>><?php echo $level->getLevel();?></option>
                    <?php
                        }
                    ?>
                </select>
                <input type="hidden" name="levelOld" id="levelOld" value="<?php echo $master_anggota_->getLevel();?>">
            </td>
        </tr>
        <?php
            $history_master_anggota = new history_master_anggota();
            $history_master_anggotaCtrl = new history_master_anggotaController($history_master_anggota, $this->dbh);
            $cekData = $history_master_anggotaCtrl->showDataByNoAnggota($master_anggota_->getNoAnggota());
            $tglUpdateLevel = $cekData->getTglUpdateLevel();
        ?>
        <tr> 
            <td class="textBold">Tanggal Update Level</td> 
            <td><input type="text" class="form-control" name="tglUpdateLevel" id="tglUpdateLevel" value="<?php echo $tglUpdateLevel;?>" size="10" readonly >
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
            <td class="textBold">Status di Keluarga <font color="red">*</font></td> 
            <td>
                <select class="form-control" name="stsKeluarga" id="stsKeluarga">
                    <option value="">Pilih Status di Keluarga</option>
                    <?php
                        $m_sts_keluarga = new master_status_keluarga();
                        $m_sts_keluargaCtrl = new master_status_keluargaController($m_sts_keluarga, $this->dbh);
                        $stsKeluargaList = $m_sts_keluargaCtrl->showDataAll();
                        foreach($stsKeluargaList as $stsKeluarga){
                            $selected = ($stsKeluarga->getId()==$master_anggota_->getStsKeluarga()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $stsKeluarga->getId();?>" <?php echo $selected;?>><?php echo $stsKeluarga->getStatus_keluarga();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Pekerjaan</td> 
            <td>
                <select class="form-control" name="pekerjaan" id="pekerjaan">
                    <option value="">Pilih Pekerjaan</option>
                    <?php
                        $m_pekerjaan = new master_pekerjaan();
                        $m_pekerjaanCtrl = new master_pekerjaanController($m_pekerjaan, $this->dbh);
                        $pekerjaanList = $m_pekerjaanCtrl->showDataAll();
                        foreach($pekerjaanList as $pekerjaan){
                            $selected = ($pekerjaan->getId()==$master_anggota_->getPekerjaan()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $pekerjaan->getId();?>" <?php echo $selected;?>><?php echo $pekerjaan->getPekerjaan();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        
        <tr> 
            <td class="textBold">Keterampilan</td> 
            <td>
                <input type="text" class="form-control" name="keterampilan" id="keterampilan" value="<?php echo $master_anggota_->getKeterampilan();?>">
            </td>
        </tr>

        <tr> 
            <td class="textBold">Pendidikan Terakhir</td> 
            <td>
                <select class="form-control" name="pendidikanAkhir" id="pendidikanAkhir">
                    <option value="">Pilih Pendidikan Terakhir</option>
                    <?php
                        $m_pendidikan = new master_pendidikan();
                        $m_pendidikanCtrl = new master_pendidikanController($m_pendidikan, $this->dbh);
                        $pendidikanList = $m_pendidikanCtrl->showDataAll();
                        foreach($pendidikanList as $pendidikan){
                            $selected = ($pendidikan->getId()==$master_anggota_->getPendidikanAkhir()) ? "selected" : "";
                    ?>
                    <option value="<?php echo $pendidikan->getId();?>" <?php echo $selected;?>><?php echo $pendidikan->getPendidikan();?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Wali <font color="red">*</font></td> 
            <td><input type="text" class="form-control" name="wali" id="wali" value="<?php echo $master_anggota_->getWali();?>" size="40"   ></td>
        </tr>

        <tr> 
            <td class="textBold">Yayasan <font color="red">*</font></td> 
            <td>
                <select class="form-control" name="unit" id="unit">
                    <option value="">Pilih Yayasan</option>
                    <?php
                        $m_unit = new master_unit();
                        $m_unitCtrl = new master_unitController($m_unit, $this->dbh);
                        $unitList = $m_unitCtrl->showDataAll();
                        foreach($unitList as $unit){
                            $selected = ($unit->getUnitid()==$master_anggota_->getUnit()) ? "selected" : "";
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
                <select class="form-control" name="departemen" id="departemen">
                    <option value="">Pilih Kelas</option>
                    <?php
                        $m_departemen = new master_department();
                        $m_departemenCtrl = new master_departmentController($m_departemen, $this->dbh);
                        $departemenList = $m_departemenCtrl->showDataAll();
                        foreach($departemenList as $departemen){
                            $selected = ($departemen->getDepartmentid()==$master_anggota_->getDepartemen()) ? "selected" : "";
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
                <input type="hidden" name="kelBelajar" id="kelBelajar" value="<?php echo $master_anggota_->getKelompok();?>">
                <select class="form-control" name="kelompok" id="kelompok">
                    <option value="">Pilih Kelompok Belajar</option>
                </select>
            </td>
        </tr>
        
        <tr> 
            <td class="textBold">Status Anggota <font color="red">*</font></td> 
            <td>
                <select class="form-control" name="statusAnggota" id="statusAnggota">
                    <option value="">Pilih Status</option>
                    <option value="Aktif" <?php if($master_anggota_->getStatusAnggota()=='Aktif') echo "selected";?>>AKTIF</option>
                    <option value="Tidak Aktif" <?php if($master_anggota_->getStatusAnggota()=='Tidak Aktif') echo "selected";?>>TIDAK AKTIF</option>
                    <option value="Meninggal Dunia" <?php if($master_anggota_->getStatusAnggota()=='Meninggal Dunia') echo "selected";?>>MENINGGAL DUNIA</option>
                </select>
            </td>
        </tr>
        
        <tr> 
            <td class="textBold">Keterangan Lain</td> 
            <td><textarea class="form-control" name="keterangan" id="keterangan" rows="4"><?php echo $master_anggota_->getKeterangan();?></textarea></td>
        </tr>
        
        <tr> 
            <td class="textBold">Pengurus <font color="red">*</font></td> 
            <td>
                <select class="form-control" name="isPengurus" id="isPengurus">
                    <option value="0" <?php if($master_anggota_->getIsPengurus()==0) echo "selected";?>>Tidak</option>
                    <option value="1" <?php if($master_anggota_->getIsPengurus()==1) echo "selected";?>>Iya</option>
                </select>
            </td>
        </tr>
        
        <tr> 
            <td class="textBold">Posting Data<font color="red">*</font></td> 
            <td>
                <select class="form-control" name="postingdata" id="postingdata">
                    <option value="0" <?php if($master_anggota_->getPostingdata()==0) echo "selected";?>>Pending</option>
                    <option value="1" <?php if($master_anggota_->getPostingdata()==1) echo "selected";?>>Posting</option>
                </select>
            </td>
        </tr>
        <tr> 
            <td class="textBold"></td> 
            <td>                
                <i>Pending = Anggota belum masuk dalam perhitungan data</i>
                <br><i>Posting = Anggota sudah masuk dalam perhitungan data</i>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Created Date</td> 
            <td>
                <input type="hidden" name="created_date" id="created_date" value="<?php echo $master_anggota_->getCreated_date();?>">
                <?php echo $master_anggota_->getCreated_date();?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Created By</td> 
            <td>
                <input type="hidden" name="created_by" id="created_by" value="<?php echo $master_anggota_->getCreated_by();?>">
                <?php echo $master_anggota_->getCreated_by();?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Updated Date</td> 
            <td>
                <input type="hidden" name="updated_date" id="updated_date" value="<?php echo ($master_anggota_->getUpdated_date()!=NULL) ? $master_anggota_->getUpdated_date() : date("Y-m-d H:i:s");?>">
                <?php echo ($master_anggota_->getUpdated_date()!=NULL) ? $master_anggota_->getUpdated_date() : date("Y-m-d H:i:s");?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">Updated By</td> 
            <td>
                <input type="hidden" name="updated_by" id="updated_by" value="<?php echo ($master_anggota_->getUpdated_by()!=NULL) ? $master_anggota_->getUpdated_by() : $this->user;?>">
                <?php echo ($master_anggota_->getUpdated_by()!=NULL) ? $master_anggota_->getUpdated_by() : $this->user;?>
            </td>
        </tr>

        <tr> 
            <td class="textBold">IP Address</td> 
            <td>
                <input type="hidden" name="ip_address" id="ip_address" value="<?php echo $master_anggota_->getIp_address();?>">
                <?php echo $master_anggota_->getIp_address();?>
            </td>            
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-danger btn-sm" ></td>
        </tr>
    </table>
</form>
<script>
    $("#kelompok").load("index.php?model=master_kelompok&action=showListKelompokByUnitByDept&dept="+document.getElementById('departemen').value+"&unit="+document.getElementById('unit').value+"&kel="+document.getElementById('kelBelajar').value);
    
    $(document).ready(function() {
        $("#departemen").change(function() {            
            var postForm = {
                'dept': document.getElementById("departemen").value,
                'unit': document.getElementById("unit").value,
                'kel': document.getElementById("kelBelajar").value,
            };
            $.ajax({
                type: "post",
                url: "index.php?model=master_kelompok&action=showListKelompokByUnitByDept",
                data: postForm,
                success: function(data) {
                     $("#kelompok").html(data);
                }
            });
        });
    });
</script>
<br>
<br>
