<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/history_master_anggota.class.php';
    require_once './controllers/history_master_anggota.controller.generate.php';
    if (!isset($_SESSION)){
        session_start();
    }

    class history_master_anggotaController extends history_master_anggotaControllerGenerate
    {
        function showDataByNoAnggota($noAnggota){
            $sql = "select * from history_master_anggota where noAnggota='$noAnggota' order by id desc limit 1";
            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->history_master_anggota, $row);
            
            return $this->history_master_anggota;
        }
    }
?>
