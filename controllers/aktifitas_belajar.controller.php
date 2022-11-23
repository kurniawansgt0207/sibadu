<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/aktifitas_belajar.class.php';
    require_once './controllers/aktifitas_belajar.controller.generate.php';
    require_once './models/master_anggota.class.php';
    require_once './controllers/master_anggota.controller.php';
    require_once './models/master_unit.class.php';
    require_once './controllers/master_unit.controller.php';
    require_once './models/master_department.class.php';
    require_once './controllers/master_department.controller.php';
    require_once './models/master_materi.class.php';
    require_once './controllers/master_materi.controller.php';
    require_once './models/aktifitas_belajar_detail.class.php';
    require_once './controllers/aktifitas_belajar_detail.controller.php';
    
    if (!isset($_SESSION)){
        session_start();
    }

    class aktifitas_belajarController extends aktifitas_belajarControllerGenerate
    {
        function showDataWhereQuery() {
            $user = $this->user;
            
            $m_user = new master_user();
            $m_userCtrl = new master_userController($m_user, $this->dbh);
            $user_info = $m_userCtrl->showDataByUser($user);
            $unit = $user_info->getUnitid();
            $dept = $user_info->getDepartmentid();
            
            $bsearch = isset($_REQUEST["search"]) ? $_REQUEST["search"]:'';
            $where = "";
            //if ($bsearch) {
               $search = isset($_REQUEST["search"])?$_REQUEST["search"]:"" ;
               $where .= " where (id like '%".$search."%' or tgl_belajar like '%".$search."%')";
               $where .= " AND unitid ='$unit' AND deptid ='$dept'";
            //}            
            
            return $where;
        }
        
        function saveFormPost() {
            parent::saveFormPost();
            
            $baseId = isset($_REQUEST['idaktifitas']) ? $_REQUEST['idaktifitas'] : $this->getLastId();
            
            $sql = "DELETE FROM aktifitas_belajar_detail WHERE baseId=".$baseId;
            $this->dbh->query($sql);
            
            $jmlDataPeserta = $_REQUEST['totPeserta'];
            $noAnggota = $_REQUEST['noAnggota'];
            $isHadir = $_REQUEST['isHadir'];
            $isTdkHadir = $_REQUEST['ketTdkHadir'];
            
            for($a=0;$a<$jmlDataPeserta;$a++){                
                $no_anggota = $noAnggota[$a];
                $hadir = $isHadir[$a];
                $tdkhadir = isset($isTdkHadir[$a])?$isTdkHadir[$a]:"-";
                echo "<br>".$no_anggota."---".$hadir."---".$tdkhadir;
                
                $sql = "INSERT INTO aktifitas_belajar_detail (baseId,noAnggota,isHadir,ketTdkHadir) VALUES ('$baseId','$no_anggota','$hadir','$tdkhadir');";
                $this->dbh->query($sql);
            }
        }
    }
?>
