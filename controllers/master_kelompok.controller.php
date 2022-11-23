<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_kelompok.class.php';
    require_once './controllers/master_kelompok.controller.generate.php';
    require_once './models/master_unit.class.php';
    require_once './controllers/master_unit.controller.php';
    require_once './models/master_department.class.php';
    require_once './controllers/master_department.controller.php';
    
    if (!isset($_SESSION)){
        session_start();
    }

    class master_kelompokController extends master_kelompokControllerGenerate
    {
        function showDataWhereQuery(){
            $user = $this->user;
            
            $m_user = new master_user();
            $m_userCtrl = new master_userController($m_user, $this->dbh);
            $user_info = $m_userCtrl->showDataByUser($user);
            $unit = $user_info->getUnitid();
            $dept = $user_info->getDepartmentid();
            
            $bsearch = isset($_REQUEST["search"]) ;
            $where = "";
            //if ($bsearch) {
               $search = isset($_REQUEST["search"]) ? $_REQUEST["search"]:"";
               $where .= " where (id like '%".$search."%'";
               $where .= "       or  unitid like '%".$search."%'";
               $where .= "       or  deptid like '%".$search."%'";
               $where .= "       or  kelompok like '%".$search."%')";
               $where .= " AND unitid=".$unit." AND deptid=".$dept;
            //}            
            $where .= " ORDER BY unitid,deptid,id";
            return $where;
        }
        
        function showDataByUnitByDept($unit,$dept){
            $sql = "SELECT * FROM master_kelompok WHERE unitid=".$unit." AND deptid=".$dept;
            $result = $this->createList($sql);
            
            return $result;
        }
        
        function showListKelompokByUnitByDept(){
            $unit = $_REQUEST['unit'];
            $dept = $_REQUEST['dept'];
            $kel = $_REQUEST['kel'];
            
            $listKelompok = $this->showDataByUnitByDept($unit, $dept);            
            echo '<option value="">Pilih Kelompok Belajar</option>';            
            foreach($listKelompok as $grup){        
                $selected = ($grup->getId()==$kel)?"selected":"";
                echo "<option value='".$grup->getId()."' ".$selected.">".$grup->getKelompok()."</option>";
            }
        }
    }
?>
