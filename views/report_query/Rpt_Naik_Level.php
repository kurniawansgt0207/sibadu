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
        var parameter3 = document.getElementById('level_lama').value;
        var parameter4 = document.getElementById('level_baru').value;
        var parameter5 = document.getElementById('gender').value;
        var parameter6 = document.getElementById('bulan').value;
        var parameter7 = document.getElementById('tahun').value;
        var parameter8 = document.getElementById('carinama').value;       
        var fileName = document.getElementById('filereport').value;
        var id = document.getElementById('idreport').value;
        
        var page = "index.php?model=report_query&action=showExportTableExcell&id="+id+"&parameter1=" + parameter1 + "&parameter2=" + parameter2 
        + "&parameter3=" + parameter3 + "&parameter4=" + parameter4 + "&parameter5=" + parameter5+ "&parameter6=" + parameter6 
        + "&parameter7=" + parameter7 + "&parameter8=" + parameter8 + "&filename=" + fileName;        
        window.open(page);        
    }
    
    function resultReport(){        
        var parameter1 = document.getElementById('yayasan').value;
        var parameter2 = document.getElementById('kelas').value;        
        var parameter3 = document.getElementById('level_lama').value;
        var parameter4 = document.getElementById('level_baru').value;
        var parameter5 = document.getElementById('gender').value;
        var parameter6 = document.getElementById('bulan').value;
        var parameter7 = document.getElementById('tahun').value;
        var parameter8 = document.getElementById('carinama').value;
        var id = document.getElementById('idreport').value;
        
        var page = "index.php?model=report_query&action=showGenerateTable&id="+id+"&parameter1=" + parameter1 + "&parameter2=" + parameter2
        + "&parameter3=" + parameter3 + "&parameter4=" + parameter4  + "&parameter5=" + parameter5  + "&parameter6=" + parameter6 
        + "&parameter7=" + parameter7 + "&parameter8=" + parameter8;
        showMenu("resultreport", page);
    }   
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
<table style="width: 30%">    
    <?php 
        $rpt_filename = ucwords(strtolower(str_replace("RPT","LAPORAN",str_replace("_", " ", $report_query->getReportname()))));
    ?>
    <input type="hidden" name="idreport" id="idreport" value="<?php echo $id;?>">
    <input type="hidden" name="filereport" id="filereport" value="<?php echo $rpt_filename;?>">
    <tr>
        <td class="label-form">Bulan</td> 
        <td class="label-form">:</td>
        <td>
            <select name="bulan" id="bulan" class="form-control">
                <option value="">-- Semua Bulan --</option>
                <?php
                    $blnArray = array(1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",
                        9=>"September",10=>"Oktober",11=>"Nopember",12=>"Desember");
                    
                    $blnNow = date("n");
                    for($bln=1;$bln<=12;$bln++){
                        $selected = ($blnNow==$bln) ? "selected" : "";
                ?>
                <option value="<?php echo $bln;?>" <?php echo $selected;?>><?php echo $blnArray[$bln];?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label-form">Tahun</td> 
        <td class="label-form">:</td>
        <td>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">-- Pilih Tahun --</option>
                <?php
                    $thnNow = date("Y");
                    $thnMax = $thnNow + 1;
                    for($thn=2021;$thn<=$thnMax;$thn++){
                        $selected = ($thn==$thnNow) ? "selected" : "";
                ?>
                <option value="<?php echo $thn;?>" <?php echo $selected;?>><?php echo $thn;?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
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
        <td class="label-form">Level Lama</td>
        <td class="label-form">:</td>
        <td>
            <select class="form-control" name="level_lama" id="level_lama">
                <option value="">Semua Level Lama</option>
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
        <td class="label-form">Level Baru</td>
        <td class="label-form">:</td>
        <td>
            <select class="form-control" name="level_baru" id="level_baru">
                <option value="">Semua Level Baru</option>
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
        <td class="label-form">Pencarian Nama</td>
        <td class="label-form">:</td>
        <td>
            <input type="text" class="form-control" name="carinama" id="carinama">
        </td>
    </tr>
</table>
<br>
<p>
    <input type="button" class="btn BtnBlue" value="Lihat Data" onclick="resultReport()">
    <input type="button" class="btn BtnGreen" value="Export Data" onclick="exportReportExcell()">
</p>
<br>
<div id="resultreport" style="overflow: auto; width: 95%;height: 30%;"></div>
<br>
<br>