<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_unit.class.php';
    require_once './controllers/master_unit.controller.generate.php';
    if (!isset($_SESSION)){
        session_start();
    }

    class master_unitController extends master_unitControllerGenerate
    {
        function showDataUnit(){
            $sql = "select * from master_unit ";
            return $this->createList($sql);            
        }
        
        function showDataAllByCabang($cabangid){
            $sql = "SELECT * FROM master_unit WHERE IF('99'='$cabangid',TRUE,unitid='$cabangid')";
            return $this->createList($sql);
        }
    }
?>
