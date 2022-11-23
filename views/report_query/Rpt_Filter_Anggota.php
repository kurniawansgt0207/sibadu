<script type="text/javascript" >
      $(function() {
        $('#datesales1,#datesales2').datepicker({
                altFormat: 'd/m/yy',
                dateFormat: 'yy-mm-dd',
                yearRange: '-20:+20',
                changeYear: true,
                changeMonth: true
        });	
    });
    function exportReportExcell(){
        var parameter1 = document.getElementById('yayasan').value;
        var parameter2 = document.getElementById('kelas').value;
        var parameter3 = document.getElementById('gender').value;
        var parameter4 = $('#level').val() != "" ? $('#level').val() : 0;
        var parameter5 = document.getElementById('usia_awal').value;
        var parameter6 = document.getElementById('usia_akhir').value;
        var parameter7 = document.getElementById('carinama').value;
        var parameter8 = $('#status').val();
        var parameter9 = document.getElementById('pengurus').value;
        var parameter10 = document.getElementById('gol_darah').value;
        var parameter11 = document.getElementById('kelompok').value;  
        var parameter12 = (parameter8 != "'0'") ? 1 : 0;
        var parameter13 = (parameter4 != "") ? 1 : 0;
        var fileName = document.getElementById('filereport').value;
        var id = document.getElementById('idreport').value;
        
        var page = "index.php?model=report_query&action=showExportTableExcell&id="+id+"&parameter1=" + parameter1 + "&parameter2=" + parameter2 
        + "&parameter3=" + parameter3 + "&parameter4=" + parameter4 + "&parameter5=" + parameter5 + "&parameter6=" + parameter6 + "&parameter7=" + parameter7 
        + "&parameter8=" + parameter8 + "&parameter9=" + parameter9 + "&parameter10=" + parameter10 + "&parameter11=" + parameter11 + "&parameter12=" + parameter12
        + "&parameter13=" + parameter13 + "&filename=" + fileName;        
        window.open(page);        
    }
    
    function resultReport(){        
        var parameter1 = document.getElementById('yayasan').value;
        var parameter2 = document.getElementById('kelas').value;
        var parameter3 = document.getElementById('gender').value;
        var parameter4 = $('#level').val() != "" ? $('#level').val() : 0;
        var parameter5 = document.getElementById('usia_awal').value;
        var parameter6 = document.getElementById('usia_akhir').value;
        var parameter7 = document.getElementById('carinama').value;
        var parameter8 = $('#status').val();
        var parameter9 = document.getElementById('pengurus').value;
        var parameter10 = document.getElementById('gol_darah').value;
        var parameter11 = document.getElementById('kelompok').value;        
        var parameter12 = (parameter8 != "'0'") ? 1 : 0;
        var parameter13 = (parameter4 != "") ? 1 : 0;
        var parameter14 = document.getElementById('postingdata').value;
        var id = document.getElementById('idreport').value;
        
        var page = "index.php?model=report_query&action=showGenerateTable&id="+id+"&parameter1=" + parameter1 + "&parameter2=" + parameter2
        + "&parameter3=" + parameter3 + "&parameter4=" + parameter4 + "&parameter5=" + parameter5+ "&parameter6=" + parameter6 + "&parameter7=" + parameter7 
        + "&parameter8=" + parameter8 + "&parameter9=" + parameter9 + "&parameter10=" + parameter10 + "&parameter11=" + parameter11 + "&parameter12=" + parameter12
        + "&parameter13=" + parameter13 + "&parameter14=" + parameter14;
        showMenu("resultreport", page);
    }   
    
    $(document).ready(function() {
        $('#level').select2();
        $('#status').select2();
    });
</script>
<style>
    .dropdown-form {
        width: 35%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555555;
        vertical-align: middle;
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #cccccc;
        border-radius: 4px;
        -webkit-border-radius: 0px !important;
        -moz-border-radius: 0px !important;
        border-radius: 0px !important;
        box-shadow: none;
    }
</style>
<div>
<table>    
    <?php 
        $rpt_filename = ucwords(strtolower(str_replace("RPT","LAPORAN",str_replace("_", " ", $report_query->getReportname()))));
    ?>
    <input type="hidden" name="idreport" id="idreport" value="<?php echo $id;?>">
    <input type="hidden" name="filereport" id="filereport" value="<?php echo $rpt_filename;?>">
    <tr>
        <td class="label-form">Yayasan</td> 
        <td class="label-form">:</td>
        <td>
            <select name="yayasan" id="yayasan" class="form-control">
                <?php if($userUnitId == 99){ ?><option value="">Semua Yayasan</option><?php } ?>
                <?php                    
                    foreach($yayasan_list_ as $yayasan){  
                        $selected = ($yayasan->getUnitid()==$userUnitId) ? "selected" : "";
                ?>
                <option value="<?php echo $yayasan->getUnitid();?>" <?php echo $selected;?>><?php echo $yayasan->getUnitname();?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Kelas</td> 
        <td class="label-form">:</td>
        <td>
            <select name="kelas" id="kelas" class="form-control">
                <?php if($userDeptId == 99){ ?><option value="">Semua Kelas</option><?php } ?>
                <?php                    
                    foreach($kelas_list_ as $kelas){
                        $selected = ($kelas->getDepartmentid()==$userDeptId) ? "selected" : "";
                ?>
                <option value="<?php echo $kelas->getDepartmentid();?>" <?php echo $selected;?>><?php echo $kelas->getDescription();?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>    
    <tr>
        <td class="label-form">LK / PR</td>
        <td class="label-form">:</td>
        <td>
            <select class="form-control" name="gender" id="gender">
                <option value="">Semua Data</option>
                <option value="LK">Laki-laki</option>
                <option value="PR">Perempuan</option>
            </select>
        </td>
    </tr> 
    <tr>
        <td class="label-form">Golongan Darah</td>
        <td class="label-form">:</td>
        <td>
            <select class="form-control" name="gol_darah" id="gol_darah">
                <option value="">Semua Golongan Darah</option>
                <option value="A (Rh+)">A (Rhesus +)</option>
                <option value="A (Rh-)">A (Rhesus -)</option>
                <option value="B (Rh+)">B (Rhesus +)</option>
                <option value="B (Rh-)">B (Rhesus -)</option>
                <option value="AB (Rh+)">AB (Rhesus +)</option>
                <option value="AB (Rh-)">AB (Rhesus -)</option>
                <option value="O (Rh+)">O (Rhesus +)</option>
                <option value="O (Rh-)">O (Rhesus -)</option>
            </select>
        </td>
    </tr> 
    <tr>
        <td class="label-form">Level</td>
        <td class="label-form">:</td>
        <td>
            <select class="form-control" style="height:116px" name="level[]" id="level" multiple="multiple">
                <option value="" selected>Semua Level</option>
                <?php
                    foreach($level_list_ as $level){
                ?>
                <option value="<?php echo $level->getId();?>"><?php echo $level->getLevel();?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Kelompok Usia</td>
        <td class="label-form">:</td>
        <td>            
            <select class="dropdown-form" style="display: inline-block" name="usia_awal" id="usia_awal">                
                <?php
                    for($i=0;$i<=100;$i++){
                        $selected = ($i == 12) ? "selected" : "";
                ?>
                <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
                <?php
                    }
                ?>
            </select>&nbsp; s/d &nbsp;
            <select class="dropdown-form" style="display: inline-block" name="usia_akhir" id="usia_akhir">                
                <?php
                    for($i=0;$i<=100;$i++){
                        $selected = ($i == 25) ? "selected" : "";
                ?>
                <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Kelompok Belajar</td>
        <td class="label-form">:</td>
        <td>
            <select name="kelompok" id="kelompok" class="form-control">
                <option value="">Semua Kelompok</option>
                <?php
                    foreach($kelompok_list_ as $grup){
                ?>
                <option value="<?php echo $grup->getId();?>"><?php echo $grup->getKelompok();?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Status Anggota</td>
        <td class="label-form">:</td>
        <td>
            <select name="status[]" id="status" class="form-control" multiple="multiple">
                <option value="'0'">Semua Status</option>
                <option value="'Aktif'" selected>AKTIF</option>
                <option value="'Tidak Aktif'">TIDAK AKTIF</option>
                <option value="'Meninggal Dunia'">MENINGGAL DUNIA</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Pengurus</td>
        <td class="label-form">:</td>
        <td>
            <select name="pengurus" id="pengurus" class="form-control">
                <option value="">Semua Data</option>
                <option value="1">YA</option>
                <option value="0">TIDAK</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Posting Data</td>
        <td class="label-form">:</td>
        <td>
            <select name="postingdata" id="postingdata" class="form-control">                
                <option value="1">YA</option>
                <option value="0">TIDAK</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Pencarian Nama</td>
        <td class="label-form">:</td>
        <td>
            <input type="text" class="form-control" name="carinama" id="carinama">
        </td>
    </tr>
</table>
</div>
<br>
<p>
    <input type="button" class="btn BtnBlue" value="Lihat Data" onclick="resultReport()">
    <input type="button" class="btn BtnGreen" value="Export Data" onclick="exportReportExcell()">
</p>
<br>
<div id="resultreport" style="overflow: auto; width: 95%;height: 30%;"></div>
<br>
<br>