<script type="text/javascript"> 
    function deletedata(id, skip, search){ 
        var ask = confirm("Do you want to delete ID " + id + " ?");
        if (ask == true) {
            site = "index.php?model=master_anggota&action=deleteFormJQuery&skip=" + skip + "&search=" + search + "&id=" + id;
            target = "content";
            showMenu(target, site);
        }
    }
    function searchData() {
         var searchdata = document.getElementById("search").value;
         site =  'index.php?model=master_anggota&action=showAllJQuery&search='+searchdata;
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
</script>

<h1>ANGGOTA</h1>
<div id="header_list"></div>
<table width="95%" >
    <tr>
        <td align="left">
            <img alt="Move First"  src="./img/icon/icon_move_first.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&search=<?php echo $search ?>');" >
            <img alt="Move Previous" src="./img/icon/icon_move_prev.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&skip=<?php echo $previous ?>&search=<?php echo $search ?>');">
             Page <?php echo $pageactive ?> / <?php echo $pagecount ?> 
            <img alt="Move Next" src="./img/icon/icon_move_next.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&skip=<?php echo $next ?>&search=<?php echo $search ?>');" >
            <img alt="Move Last" src="./img/icon/icon_move_last.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&skip=<?php echo $last ?>&search=<?php echo $search ?>');">
            <!--<a href="index.php?model=master_anggota&action=export&search=<?php echo $search ?>">Export</a>
            <a href="index.php?model=master_anggota&action=printdata&search=<?php echo $search ?>" target="_"><img src="./images/icon_print.png"/></a>-->
        </td>
        <td align="right" width="50%">
            Pencarian &nbsp;<input type="text" name="search" id="search" value="<?php echo $search ?>" style="width: 200px; padding-top: 3px; padding-bottom: 3px; padding-left: 2px;">&nbsp;&nbsp;
            <input type="button" class="btn btn-info btn-sm" value="Cari Data" onclick="searchData()">
            <?php if($isadmin || $ispublic || $isentry){ ?>
            <input type="button" class="btn btn-warning btn-sm" value="Data Baru" name="new" onclick="showMenu('header_list', 'index.php?model=master_anggota&action=showFormJQuery')"> 
            <?php } ?>
        </td>
    </tr>
</table>
<div class="table-responsive">
<table border="1" class="table-bordered1" cellpadding="2" style="border-collapse: collapse;" width="95%">
    <tr>
        <th width="3%" height="35" style="vertical-align: middle;text-transform: uppercase">No</th>
        <th width="7%" height="35" style="vertical-align: middle;text-transform: uppercase">No. Anggota</th>
        <th width="15%" height="35" style="vertical-align: middle;text-transform: uppercase">Nama Anggota</th>
        <th width="6%" height="35" style="vertical-align: middle;text-transform: uppercase">Tanggal Lahir</th>
        <th width="3%" height="35" style="vertical-align: middle;text-transform: uppercase">Usia</th>
        <th width="3%" height="35" style="vertical-align: middle;text-transform: uppercase">LK/PR</th>
        <th width="15%" height="35" style="vertical-align: middle;text-transform: uppercase">Wali</th>
        <th width="3%" height="35" style="vertical-align: middle;text-transform: uppercase">Level Terbaru</th>
        <th width="6%" height="35" style="vertical-align: middle;text-transform: uppercase">Tgl Update Level</th>
        <th width="5%" height="35" style="vertical-align: middle;text-transform: uppercase">Yayasan</th>
        <th width="5%" height="35" style="vertical-align: middle;text-transform: uppercase">Kelas</th>
        <th width="12%" height="35" style="vertical-align: middle;text-transform: uppercase">Kelompok Belajar</th>
        <th width="4%" height="35" style="vertical-align: middle;text-transform: uppercase">Pengurus</th>
        <th width="5%" height="35" style="vertical-align: middle;text-transform: uppercase">Status</th>
        <th width="5%" height="35" style="vertical-align: middle;text-transform: uppercase">Aksi</th>
    </tr>
    <?php    
    $no = 1;
    
    if ($master_anggota_list != "") { 
        foreach($master_anggota_list as $master_anggota){
            $pi = $no + 1;
            $bg = ($pi%2 != 0) ? "#E1EDF4" : "#F0F0F0";
            
            $m_dept = new master_department();
            $m_deptCtrl = new master_departmentController($m_dept, $this->dbh);
            $dept = $m_deptCtrl->showData($master_anggota->getDepartemen());
            
            $m_unit = new master_unit();
            $m_unitCtrl = new master_unitController($m_unit, $this->dbh);
            $unit = $m_unitCtrl->showData($master_anggota->getUnit());
            
            $m_level = new master_level();
            $m_levelCtrl = new master_levelController($m_level, $this->dbh);
            $level = $m_levelCtrl->showData($master_anggota->getLevel());
            
            $m_kelompok = new master_kelompok();
            $m_kelompokCtrl = new master_kelompokController($m_kelompok, $this->dbh);
            $kelompok = $m_kelompokCtrl->showData($master_anggota->getKelompok());
            
            $history_master_anggota = new history_master_anggota();
            $history_master_anggotaCtrl = new history_master_anggotaController($history_master_anggota, $this->dbh);            
            $cekData = $history_master_anggotaCtrl->showDataByNoAnggota($master_anggota->getNoAnggota());
            $tglUpdateLevel = $cekData->getTglUpdateLevel();
            
            $umur = ($master_anggota->getTglLahir() != null) ? $this->hitung_umur($master_anggota->getTglLahir()) : "";
            $pengurusRT = ($master_anggota->getIsPengurus()==1)?"Ya":"Tidak";
            
            $bgcolor = ($master_anggota->getStatusAnggota()=="Meninggal Dunia") ? "#faafaa" : $bg;
            $NamaPengurus = ($master_anggota->getIsPengurus()==1)? "<b>".$master_anggota->getNamaAnggota()."</b>" : $master_anggota->getNamaAnggota();
    ?>
    <tr bgcolor="<?php echo $bgcolor;?>">
        <td align="center"><?php echo $no;?></td>
        <td align="center"><?php echo $master_anggota->getNoAnggota();?></td>
        <td align="left"><?php echo $NamaPengurus;?></td>
        <td align="center"><?php echo $master_anggota->getTglLahir();?></td>
        <td align="center"><?php echo $umur;?></td>
        <td align="center"><?php echo $master_anggota->getJnsKelamin();?></td>
        <td align="left"><?php echo $master_anggota->getWali();?></td>
        <td align="center"><?php echo $level->getLevel();?></td>
        <td align="center"><?php echo $tglUpdateLevel;?></td>
        <td align="center"><?php echo $unit->getUnitname();?></td>
        <td align="center"><?php echo $dept->getDescription();?></td>
        <td align="center"><?php echo $kelompok->getKelompok();?></td>
        <td align="center">
            <?php 
                $ikonPengurus = $pengurusRT=="Ya" ? "icon-check.ico" : "icon-cross.png";
                $titlePengurus = $pengurusRT=="Ya" ? "Pengurus" : "Anggota";
            ?>
            <img src="./img/icon/<?php echo $ikonPengurus;?>" title="<?php echo $titlePengurus;?>" width="28" heigth="28">
        </td>
        <td align="center">
            <?php
                $paramStatus = ($master_anggota->getStatusAnggota()=="Aktif") ? 0 : 1;
                $ikonStatus = ($master_anggota->getStatusAnggota()=="Aktif") ? "switch-active.png" : "switch-inactive.png";
                $titleStatus = ($master_anggota->getStatusAnggota()=="Aktif") ? "Anggota Aktif" : "Anggota Tidak Aktif";                
            ?>
            <div id="toggleStatus<?php echo $no;?>">
            <a href="#toggleStatus" onclick="switchStatus('<?php echo $no;?>','<?php echo $paramStatus;?>','<?php echo $master_anggota->getNoAnggota();?>')" title="<?php echo $titleStatus;?>">
                <img src="./img/icon/<?php echo $ikonStatus;?>" width="40" heigth="20">
            </a>
            </div>
        </td>
        <td align="center" class="combobox">
            <?php if($isadmin || $ispublic || $isupdate){ ?>
            <a href='#' onclick="showMenu('header_list', 'index.php?model=master_anggota&action=showFormJQuery&id=<?php echo $master_anggota->getid();?>&skip=<?php echo $skip ?>&search=<?php echo $search ?>')">[Ubah]</a> 
            <?php } ?>
            <?php if($isadmin || $ispublic || $isdelete){ ?>
            <a href='#' onclick="deletedata('<?php echo $master_anggota->getId()?>','<?php echo $skip ?>','<?php echo $search ?>')">[Delete]</a>
            <?php } ?>
        </td>
    </tr>
    <?php
            $no++;
        }
    }
    ?>    
</table>
<table width="95%">
    <td align="right">
        <img alt="Move First"  src="./img/icon/icon_move_first.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&search=<?php echo $search ?>');" >
        <img alt="Move Previous" src="./img/icon/icon_move_prev.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&skip=<?php echo $previous ?>&search=<?php echo $search ?>');">
         Page <?php echo $pageactive ?> / <?php echo $pagecount ?> 
        <img alt="Move Next" src="./img/icon/icon_move_next.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&skip=<?php echo $next ?>&search=<?php echo $search ?>');" >
        <img alt="Move Last" src="./img/icon/icon_move_last.gif" onclick="showMenu('content', 'index.php?model=master_anggota&action=showAllJQuery&skip=<?php echo $last ?>&search=<?php echo $search ?>');">
        <!--<a href="index.php?model=master_anggota&action=export&search=<?php echo $search ?>">Export</a>
        <a href="index.php?model=master_anggota&action=printdata&search=<?php echo $search ?>" target="_"><img src="./images/icon_print.png"/></a>-->
    </td>
</table>    
</div>
<script>
    function switchStatus(line,flag,noanggota,ikon){
        var site =  'index.php?model=master_anggota&action=switchStatusAnggota&lineno='+line+'&flag='+flag+'&noanggota='+noanggota;
        var target = "toggleStatus"+line;
        showMenu(target, site);
    }
</script>
<br><br>