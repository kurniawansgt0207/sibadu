<table>
    <tr>
        <td class="label-form">Bulan</td> 
        <td class="label-form">:</td>
        <td>
            <select name="bulan" id="bulan" class="form-control">
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
</table>
<p><input type="button" class="btn BtnBlue" value="Lihat Data" onclick="showData()"></p>
<br>
<div id="resultdata" style="overflow: auto; width: 98%;height: 30%;"></div>
<br><br>
<script>
    function showData(){
        var bulan = document.getElementById('bulan').value;
        var tahun = document.getElementById('tahun').value;
        var yayasan = document.getElementById('yayasan').value;
        var kelas = document.getElementById('kelas').value;
        
        var page = "index.php?model=finance&action=showFormJQuery&parameter1=" + yayasan + "&parameter2=" + kelas + "&parameter3=" + bulan + "&parameter4=" + tahun;
        showMenu("resultdata", page);
    }
</script>