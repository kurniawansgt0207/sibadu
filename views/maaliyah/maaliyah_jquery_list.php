<script type="text/javascript"> 
    function deletedata(id, skip, search){ 
        var ask = confirm("Do you want to delete ID " + id + " ?");
        if (ask == true) {
            site = "index.php?model=maaliyah&action=deleteFormJQuery&skip=" + skip + "&search=" + search + "&id=" + id;
            target = "content";
            showMenu(target, site);
        }
    }
    function searchData() {
         var searchdata = document.getElementById("search").value;
         site =  'index.php?model=maaliyah&action=showAllJQuery&search='+searchdata;
         target = "content";
         showMenu(target, site);
    }
    $(document).ready(function(){
        $('#search').keypress(function(e) {
                if(e.which == 13) {
                    searchData();
                }
        });
    });
    function showData(){
        var yayasan = document.getElementById('yayasan').value;
        var kelas = document.getElementById('kelas').value;
        var tahun = document.getElementById('tahun').value;
        var bulan = document.getElementById('bulan').value;
        var site = "index.php?model=maaliyah&action=showFormJquery&yayasan="+yayasan+"&kelas="+kelas+"&bulan="+bulan+"&tahun="+tahun;
        var container = "showData";
        showMenu(container,site);
    }
</script>

<h1>Penunaian Maaliyah Bulanan</h1>
<div id="header_list">
    <table>
        <tr>
            <td>Yayasan</td>
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
            <td>Kelas</td>
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
            <td>Bulan Penunaian</td>
            <td>
                <select name="bulan" id="bulan" class="form-control">
                    <?php
                        $blnNow = date("m");
                        $blnArr = array(1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",9=>"September",
                            10=>"Oktober",11=>"Nopember",12=>"Desember");
                        
                        for($bln=1; $bln<=12;$bln++){
                            $bulan = (strlen($bln) < 2) ? "0".$bln : $bln;
                            $selected = ($bln == $blnNow) ? "selected" : "";
                    ?>
                    <option value="<?php echo $bulan;?>" <?php echo $selected;?>><?php echo $blnArr[$bln];?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tahun Penunaian</td>
            <td>
                <select name="tahun" id="tahun" class="form-control">
                    <?php
                        $thnStart = date("Y");
                        $thnEnd = $thnStart+1;
                        
                        for($thn=$thnStart; $thn<=$thnEnd;$thn++){
                            $selected = ($thn == $thnStart) ? "selected" : "";
                    ?>
                    <option value="<?php echo $thn;?>" <?php echo $selected;?>><?php echo $thn;?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="button" value="Lihat Data" class="BtnBlue" onclick="showData()">
            </td>
        </tr>
    </table>
</div>
<div id="showData">
    <table width="95%" >
        <tr>
            <td align="left">
                <img alt="Move First"  src="./img/icon/icon_move_first.gif" onclick="showMenu('content', 'index.php?model=maaliyah&action=showAllJQuery&search=<?php echo $search ?>');" >
                <img alt="Move Previous" src="./img/icon/icon_move_prev.gif" onclick="showMenu('content', 'index.php?model=maaliyah&action=showAllJQuery&skip=<?php echo $previous ?>&search=<?php echo $search ?>');">
                 Page <?php echo $pageactive ?> / <?php echo $pagecount ?> 
                <img alt="Move Next" src="./img/icon/icon_move_next.gif" onclick="showMenu('content', 'index.php?model=maaliyah&action=showAllJQuery&skip=<?php echo $next ?>&search=<?php echo $search ?>');" >
                <img alt="Move Last" src="./img/icon/icon_move_last.gif" onclick="showMenu('content', 'index.php?model=maaliyah&action=showAllJQuery&skip=<?php echo $last ?>&search=<?php echo $search ?>');">
                <a href="index.php?model=maaliyah&action=export&search=<?php echo $search ?>">Export</a>
                <a href="index.php?model=maaliyah&action=printdata&search=<?php echo $search ?>" target="_"><img src="./images/icon_print.png"/></a>
            </td>
            <td align="right">
                <input type="text" name="search" id="search" value="<?php echo $search ?>" >&nbsp;&nbsp;<input type="button" class="btn btn-info btn-sm" value="find" onclick="searchData()">
                <?php if($isadmin || $ispublic || $isentry){ ?>
                <input type="button" class="btn btn-warning btn-sm" value="new" name="new" onclick="showMenu('header_list', 'index.php?model=maaliyah&action=showFormJQuery')"> 
                <?php } ?>
            </td>
        </tr>
    </table>
    <table border="1"  cellpadding="2" style="border-collapse: collapse;" width="95%">
        <tr>
            <th class="textBold">id</th>
            <th class="textBold">tahun</th>
            <th class="textBold">bulan</th>
            <th class="textBold">no_anggota</th>
            <th>&nbsp;</th>
        </tr>
        <?php

        $no = 1;

        if ($maaliyah_list != "") { 
            foreach($maaliyah_list as $maaliyah){
                $pi = $no + 1;
                $bg = ($pi%2 != 0) ? "#E1EDF4" : "#F0F0F0";
        ?>
        <tr bgcolor="<?php echo $bg;?>">
            <td><a href='#' onclick="showMenu('header_list', 'index.php?model=maaliyah&action=showDetailJQuery&id=<?php echo $maaliyah->getId();?>')"><?php echo $maaliyah->getId();?></a> </td>
            <td><?php echo $maaliyah->getTahun();?></td>
            <td><?php echo $maaliyah->getBulan();?></td>
            <td><?php echo $maaliyah->getNo_anggota();?></td>
            <td align="center" class="combobox">
                <?php if($isadmin || $ispublic || $isupdate){ ?>
                <a href='#' onclick="showMenu('header_list', 'index.php?model=maaliyah&action=showFormJQuery&id=<?php echo $maaliyah->getid();?>&skip=<?php echo $skip ?>&search=<?php echo $search ?>')">[Edit]</a> | 
                <?php } ?>
                <?php if($isadmin || $ispublic || $isdelete){ ?>
                <a href='#' onclick="deletedata('<?php echo $maaliyah->getId()?>','<?php echo $skip ?>','<?php echo $search ?>')">[Delete]</a>
                <?php } ?>
            </td>
        </tr>
        <?php
                $no++;
            }
        }
        ?>
    </table>
</div>
<br>