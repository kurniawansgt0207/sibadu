<script type="text/javascript"> 
function deletedata(id, skip, search){ 
    var ask = confirm("Do you want to delete ID " + id + " ?");
    if (ask == true) {
        site = "index.php?model=aktifitas_belajar&action=deleteFormJQuery&skip=" + skip + "&search=" + search + "&id=" + id;
        target = "content";
        showMenu(target, site);
    }
}
function searchData() {
     var searchdata = document.getElementById("search").value;
     site =  'index.php?model=aktifitas_belajar&action=showAllJQuery&search='+searchdata;
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

<h1>AKTIFITAS BELAJAR</h1>
<div id="header_list">
</div>
<table width="95%" >
    <tr>
        <td align="left">
            <img alt="Move First"  src="./img/icon/icon_move_first.gif" onclick="showMenu('content', 'index.php?model=aktifitas_belajar&action=showAllJQuery&search=<?php echo $search ?>');" >
            <img alt="Move Previous" src="./img/icon/icon_move_prev.gif" onclick="showMenu('content', 'index.php?model=aktifitas_belajar&action=showAllJQuery&skip=<?php echo $previous ?>&search=<?php echo $search ?>');">
             Page <?php echo $pageactive ?> / <?php echo $pagecount ?> 
            <img alt="Move Next" src="./img/icon/icon_move_next.gif" onclick="showMenu('content', 'index.php?model=aktifitas_belajar&action=showAllJQuery&skip=<?php echo $next ?>&search=<?php echo $search ?>');" >
            <img alt="Move Last" src="./img/icon/icon_move_last.gif" onclick="showMenu('content', 'index.php?model=aktifitas_belajar&action=showAllJQuery&skip=<?php echo $last ?>&search=<?php echo $search ?>');">
            <a href="index.php?model=aktifitas_belajar&action=export&search=<?php echo $search ?>">Export</a>
            <a href="index.php?model=aktifitas_belajar&action=printdata&search=<?php echo $search ?>" target="_"><img src="./images/icon_print.png"/></a>
        </td>
        <td align="right">
            <input type="text" name="search" id="search" value="<?php echo $search ?>" >&nbsp;&nbsp;
            <input type="button" class="btn btn-info btn-sm" value="Cari Data" onclick="searchData()">
            <?php if($isadmin || $ispublic || $isentry){ ?>
            <input type="button" class="btn btn-warning btn-sm" value="Data Baru" name="new" onclick="showMenu('header_list', 'index.php?model=aktifitas_belajar&action=showFormJQuery')"> 
            <?php } ?>
        </td>
    </tr>
</table>
<table border="1" class="table-bordered1" cellpadding="2" style="border-collapse: collapse;" width="95%">
    <tr>
        <th>ID</th>
        <th>TGL BELAJAR</th>
        <th>YAYASAN</th>
        <th>KELAS</th>
        <th>KELOMPOK</th>
        <th>MODUL</th>
        <th>TOTAL PESERTA</th>
        <th>JML HADIR</th>
        <th>JML TIDAK HADIR</th>
        <th>#</th>
    </tr>
    <?php
        $no = 1;

        if ($aktifitas_belajar_list != "") { 
            foreach($aktifitas_belajar_list as $aktifitas_belajar){
                $pi = $no + 1;
                $bg = ($pi%2 != 0) ? "#E1EDF4" : "#F0F0F0";
                
                $m_dept = new master_department();
                $m_deptCtrl = new master_departmentController($m_dept, $this->dbh);
                $dept = $m_deptCtrl->showData($aktifitas_belajar->getDeptid());

                $m_unit = new master_unit();
                $m_unitCtrl = new master_unitController($m_unit, $this->dbh);
                $unit = $m_unitCtrl->showData($aktifitas_belajar->getUnitid());
                
                $m_kelompok = new master_kelompok();
                $m_kelompokCtrl = new master_kelompokController($m_kelompok, $this->dbh);
                $kelompok = $m_kelompokCtrl->showData($aktifitas_belajar->getKelompokid());
                
                $m_materi = new master_materi();
                $m_materiCtrl = new master_materiController($m_materi, $this->dbh);
                $materi = $m_materiCtrl->showData($aktifitas_belajar->getModulid());
                
                $m_anggota = new master_anggota();
                $m_anggotaCtrl = new master_anggotaController($m_anggota, $this->dbh);
                $peserta = $m_anggotaCtrl->showAnggotaByUnitByDepByKel($aktifitas_belajar->getUnitid(), $aktifitas_belajar->getDeptid(), $aktifitas_belajar->getKelompokid());
                $jmlPesertaKel = count($peserta);
    ?>
    <tr bgcolor="<?php echo $bg;?>">
        <td align="center"><a href='#' onclick="showMenu('header_list', 'index.php?model=aktifitas_belajar&action=showDetailJQuery&id=<?php echo $aktifitas_belajar->getId();?>')"><?php echo $aktifitas_belajar->getId();?></a> </td>
        <td align="center"><?php echo $aktifitas_belajar->getTgl_belajar();?></td>
        <td align="center"><?php echo $unit->getUnitname();?></td>
        <td align="center"><?php echo $dept->getDescription();?></td>
        <td align="center"><?php echo $kelompok->getKelompok();?></td>
        <td align="center"><?php echo $materi->getAlias_materi() ." (".$materi->getNama_materi().")";?></td>
        <td align="center"><?php echo $jmlPesertaKel;?></td>
        <td align="center"><?php echo $aktifitas_belajar->getJml_hadir();?></td>
        <td align="center"><?php echo $aktifitas_belajar->getJml_tdk_hadir();?></td>
        <td align="center" class="combobox">
            <?php if($isadmin || $ispublic || $isupdate){ ?>
            <a href='#' onclick="showMenu('header_list', 'index.php?model=aktifitas_belajar&action=showFormJQuery&id=<?php echo $aktifitas_belajar->getid();?>&skip=<?php echo $skip ?>&search=<?php echo $search ?>')">[Edit]</a> | 
            <?php } ?>
            <?php if($isadmin || $ispublic || $isdelete){ ?>
            <a href='#' onclick="deletedata('<?php echo $aktifitas_belajar->getId()?>','<?php echo $skip ?>','<?php echo $search ?>')">[Delete]</a>
            <?php } ?>
        </td>
    </tr>
    <?php
                $no++;
            }
        }
    ?>
</table>
<br>