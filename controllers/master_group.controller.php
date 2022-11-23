<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_group.class.php';
    require_once './models/master_group_detail.class.php';
    require_once './controllers/master_group.controller.generate.php';
    require_once './controllers/master_group_detail.controller.php';
    if (!isset($_SESSION)) {
        session_start();
    }
 
    class master_groupController extends master_groupControllerGenerate
    {
        function showPrevileges(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
            $this->master_group = $this->showData($id);
            
            $master_group_detail = new master_group_detail();
            $master_group_controller = new master_group_detailController($master_group_detail, $this->dbh);            
            $master_group_controller->showPrevileges($this->master_group);            
        }
        function showDetailJQuery(){
            $id = $_GET['id'];
            $master_group_ = $this->showData($id);
            require_once './views/master_group/master_group_jquery_detail.php';

            $master_group_detail = new master_group_detail();
            $master_group_detail_controller = new master_group_detailController($master_group_detail, $this->dbh);            
            $master_group_detail_controller->showPrevileges($master_group_);            
        }
        function showGroupNonAdmin(){
            $sql = "select * from master_group where groupcode<>'Admin'";
            return $this->createList($sql);
        }
        function showDataById($id){
            $sql = "SELECT * FROM master_group WHERE id = '".$this->toolsController->replacecharFind($id,$this->dbh)."'";

            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->master_group, $row);
            
            return $this->master_group;
        }
        function showDataDakwahPembinaan(){
            $sql = "SELECT * FROM master_group WHERE id in (4,5)";
            return $this->createList($sql);
        }
        function showDataDakwahPembinaanByGroup($groupid){
            $sql = "SELECT * FROM master_group WHERE IF('0'='$groupid',TRUE,id='$groupid')";
            return $this->createList($sql);
        }
        
    }
?>
