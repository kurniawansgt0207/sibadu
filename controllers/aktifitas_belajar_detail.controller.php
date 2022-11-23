<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/aktifitas_belajar_detail.class.php';
    require_once './controllers/aktifitas_belajar_detail.controller.generate.php';
    require_once './models/master_anggota.class.php';
    require_once './controllers/master_anggota.controller.php';
    require_once './models/master_unit.class.php';
    require_once './controllers/master_unit.controller.php';
    require_once './models/master_department.class.php';
    require_once './controllers/master_department.controller.php';
    
    if (!isset($_SESSION)){
        session_start();
    }

    class aktifitas_belajar_detailController extends aktifitas_belajar_detailControllerGenerate
    {
        function getPeserta(){
            $idAktifitas = isset($_REQUEST['idaktifitas'])?$_REQUEST['idaktifitas']:"";
            $unit = isset($_REQUEST['unit'])?$_REQUEST['unit']:"";
            $dept = isset($_REQUEST['dept'])?$_REQUEST['dept']:"";
            $kel = isset($_REQUEST['kel'])?$_REQUEST['kel']:"";
            $m_anggota = new master_anggota();
            $m_anggotaCtrl = new master_anggotaController($m_anggota, $this->dbh);
            $peserta_list = $m_anggotaCtrl->showAnggotaByUnitByDepByKel($unit, $dept, $kel);            
            
            require_once './views/aktifitas_belajar_detail/aktifitas_belajar_detail_peserta_list.php';
        }
        
        function getDataBelajar($idbelajar,$noanggota){
            $sql = "SELECT * FROM aktifitas_belajar_detail WHERE baseId=".$idbelajar." AND noAnggota='".$noanggota."'";            
            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->aktifitas_belajar_detail, $row);
            
            return $this->aktifitas_belajar_detail;
        }
    }
?>
