<table class="table-bordered1" width="100%">
    <tr>
        <th>No</th>        
        <th>Nama Anggota</th>
        <th>Hadir</th>
        <th>Tidak Hadir</th>
    </tr>
    <?php        
        $no=1;
        if(count($peserta_list)>0){
        foreach($peserta_list as $peserta){            
            $rsDetail = $this->getDataBelajar($idAktifitas,$peserta->getNoAnggota());
            $flag = ($rsDetail->getIsHadir()=="1" ) ? "checked" : "";
            $valChk = ($rsDetail->getIsHadir()=="1" ) ? 1 : 0;
    ?>
    <tr>
        <td align="center"><?php echo $no;?></td>        
        <input type="hidden" name="noAnggota[]" id="noAnggota<?php echo $peserta->getNoAnggota();?>" value="<?php echo $peserta->getNoAnggota();?>">
        <td><?php echo $peserta->getNamaAnggota();?></td>
        <td align="center">
            <input type="checkbox" class="chkhadir" <?php echo $flag;?> name="hadirchk" id="hadirchk<?php echo $peserta->getNoAnggota();?>" style="cursor: pointer" onclick="setCheck('<?php echo $peserta->getNoAnggota();?>')">
            <input type="hidden" id="isHadir<?php echo $peserta->getNoAnggota();?>" name="isHadir[]" value="<?php echo $valChk;?>">               
        </td>
        <td align="center">
            <select name="ketTdkHadir[]" id="ketTdkHadir<?php echo $peserta->getNoAnggota();?>">
                <option value="">Keterangan</option>
                <option value="Sakit" <?php echo ($rsDetail->getKetTdkHadir()=="Sakit") ? "selected" : "";?>>Sakit</option>
                <option value="Bekerja" <?php echo ($rsDetail->getKetTdkHadir()=="Bekerja") ? "selected" : "";?>>Bekerja</option>
                <option value="Lain-lain" <?php echo ($rsDetail->getKetTdkHadir()=="Lain-lain") ? "selected" : "";?>>Lain-lain</option>
                <option value="Tanpa Keterangan" <?php echo ($rsDetail->getKetTdkHadir()=="Tanpa Keterangan") ? "selected" : "";?>>Tanpa Keterangan</option>
            </select>
        </td>
    </tr>
    <?php
            $no++;
        }
        } else {
            echo "<tr><td colspan=\"4\" align=\"center\">Data Peserta Tidak Tersedia</tr></td>";
        }
    ?>
    <input type="hidden" name="totPeserta" id="totPeserta" value="<?php echo count($peserta_list);?>">
    <input type="hidden" name="idaktifitas" id="idaktifitas" value="<?php echo $idAktifitas;?>">
</table>
<script>
    function setCheck(no){
        var chkElement = document.getElementById('hadirchk'+no);
        
        if(chkElement.checked){
            document.getElementById('isHadir'+no).value = 1;
            document.getElementById('ketTdkHadir'+no).disabled=true;
            document.getElementById('ketTdkHadir'+no).value = "";
        } else {
            document.getElementById('isHadir'+no).value = 0;
            document.getElementById('ketTdkHadir'+no).disabled=false;
        }
    }
    
    $(document).ready(function() {
        $('.chkhadir').click(function() {
            var checkboxes = $('input:checkbox:checked').length;
            var totPeserta = document.getElementById('totPeserta').value;
            document.getElementById('jml_hadir').value = checkboxes;
            document.getElementById('jml_tdk_hadir').value = (totPeserta*1) - (checkboxes*1);
        })
    });
</script>