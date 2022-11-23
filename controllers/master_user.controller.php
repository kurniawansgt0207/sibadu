<?php
    require_once './models/master_user.class.php';
    require_once './models/master_profil.class.php';
    require_once './models/master_user_detail.class.php';
    require_once './controllers/master_user.controller.generate.php';
    require_once './controllers/master_profil.controller.php';
    require_once './controllers/master_user_detail.controller.php';
    require_once './controllers/tools.controller.php';
    require_once './controllers/master_unit.controller.php';
    require_once './controllers/master_department.controller.php';
    require_once './controllers/master_group.controller.php';
    
    if (!isset($_SESSION)){
        session_start();
    }
 
    class master_userController extends master_userControllerGenerate
    {
        function checkDataByCbgRTShaff($user,$cbg,$rt,$shaff){
            echo $sql = "SELECT count(*) FROM master_user where user = '".$user."' and unitid=$cbg and departmentid=$rt and shaffid=$shaff";
            $row = $this->dbh->query($sql)->fetch();
            return $row[0];
        }
        
        public function saveData(){
            $user = $this->toolsController->replacecharSave($this->master_user->getUser(), $this->dbh);
            $cbg = $this->toolsController->replacecharSave($this->master_user->getUnitid(), $this->dbh);
            $rt = $this->toolsController->replacecharSave($this->master_user->getDepartmentid(), $this->dbh);
            $shaff = $this->toolsController->replacecharSave($this->master_user->getShaffid(), $this->dbh);
            
            $check = $this->checkDataByCbgRTShaff($user, $cbg, $rt, $shaff);
            if($check == 0){
                if ($this->ispublic || $this->isadmin || ($this->isread && $this->isentry)){
                    $this->insertData();
                    $last_id = $this->dbh->lastInsertId();
                    $this->setLastId($last_id);
                    //echo "Data is Inserted";
                }else{
                    echo "You cannot insert data this module";
                }
            } else {
                if ($this->ispublic || $this->isadmin || ($this->isread && $this->isupdate)){
                    $this->updateData();
                    //echo "Data is updated";
                }else{
                    echo "You cannot update this module";
                }
            }
        }
        
        function showDataByUser($user){
            $sql = "SELECT * FROM `master_user` WHERE `user`='$user'";
            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->master_user, $row);
            
            return $this->master_user;
        }
        
        function showDetailJQuery(){
            $id = $_GET['id'];
            $master_user_ = $this->showData($id);
            
            $master_unit = new master_unit();
            $master_unit_controller= new master_unitController($master_unit, $this->dbh);
            $master_unit_list=  $master_unit_controller->showData($master_user_->getUnitid());

            $master_department = new master_department();
            $master_department_controller = new master_departmentController($master_department, $this->dbh);
            $master_department_list = $master_department_controller->showData($master_user_->getDepartmentid());
            
            $master_user_detail = new master_user_detail();
            $master_user_detail_controller = new master_user_detailController($master_user_detail, $this->dbh);
            $master_user_detail_list = $master_user_detail_controller->showPrevileges($master_user_);
            
            require_once './views/master_user/master_user_jquery_detail.php';
        }
        
        function showFormJQuery(){
            
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $skip = isset($_REQUEST["skip"]) ? $_REQUEST["skip"] : 0;
            $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
            $master_user_ = $this->showData($id);

            $master_unit = new master_unit();
            $master_unit_controller= new master_unitController($master_unit, $this->dbh);
            $master_unit_list=  $master_unit_controller->showDataUnit();

            $master_department = new master_department();
            $master_department_controller = new master_departmentController($master_department, $this->dbh);
            $master_department_list = $master_department_controller->showDataDepartment();
            
            $master_user_detail = new master_user_detail();
            $master_user_detail_controller = new master_user_detailController($master_user_detail, $this->dbh);
            $master_user_detail_list = $master_user_detail_controller->showPrevileges($master_user_);            
            
            require_once './views/master_user/master_user_jquery_form.php';
        }
        
        public function saveFormJQuery() {
            $id = isset($_POST['id'])?$_POST['id'] : "";
            $idAnggota = isset($_POST['idanggota'])?$_POST['idanggota'] : "";
	    $user = isset($_POST['user'])?$_POST['user'] : "";
	    $description = isset($_POST['description'])?$_POST['description'] : "";
	    $password = isset($_POST['password'])? md5($_POST['password']) : "";
	    $defaultpassword = ($_POST['defaultpassword']<>$_POST['password'])? $_POST['password'] : $_POST['defaultpassword'];
	    $username = isset($_POST['username'])?$_POST['username'] : "";
	    $avatar = isset($_POST['avatar'])?$_POST['avatar'] : "";
	    $nik = isset($_POST['nik'])?$_POST['nik'] : "0";
	    $departmentid = isset($_POST['departmentid'])?$_POST['departmentid'] : "0";
	    $unitid = isset($_POST['unitid'])?$_POST['unitid'] : "0";
	    $shaffid = isset($_POST['shaffid'])?$_POST['shaffid'] : "0";
	    $this->master_user->setId($id);
	    $this->master_user->setUser($user);
	    $this->master_user->setDescription($description);
	    $this->master_user->setPassword($password);
	    $this->master_user->setUsername($username);
	    $this->master_user->setAvatar($avatar);
	    $this->master_user->setNik($nik);
	    $this->master_user->setDepartmentid($departmentid);
	    $this->master_user->setUnitid($unitid);            
	    $this->master_user->setShaffid($shaffid);  
	    $this->master_user->setIdanggota($idAnggota);  
	    $this->master_user->setDefaultpassword($defaultpassword);              
            $this->saveData();
            
            $master_user_detail = new master_user_detail();
            $master_user_detail_controller = new master_user_detailController($master_user_detail, $this->dbh);
            $master_user_detail_controller->savePrivileges();
        }
        
        
        function checkAdmin($user){
            $sql = "SELECT count(*) FROM master_user_detail mud WHERE `user` = '". $user ."' AND groupcode = 'admin';";            
            $row = $this->dbh->query($sql)->fetch();
            return $row[0];
        }
        
        function changePasswordForm(){
            require_once './views/master_user/master_user_change_password.php';            
        }
        
        function changePassword(){
            
            $oldpassword = isset($_POST['oldpassword']) ? $_POST['oldpassword'] : "";
            $newpassword = isset($_POST['newpassword']) ? $_POST['newpassword'] : "";
            $retypepassword = isset($_POST['retypepassword']) ? $_POST['retypepassword'] : "";
            
            $masteruser = isset($_SESSION[config::$LOGIN_USER])? unserialize($_SESSION[config::$LOGIN_USER]) : new master_user();
            $lengthNewPass = (int) strlen(trim($newpassword));
            if (md5($oldpassword) ==  $masteruser->getPassword()) {
                if ($newpassword == $retypepassword){
                    if (trim($newpassword) != "") {
                        if($lengthNewPass >= 8 ) {
                            $masteruser->setPassword(MD5($newpassword));
                            $masteruser->setDefaultpassword($newpassword);
                            $masterusercontroller = new master_userController($masteruser, $this->dbh);
                            $masterusercontroller->setIsadmin(true);
                            $masterusercontroller->saveData();
                            $_SESSION[config::$LOGIN_USER] = serialize($masteruser);  
                            echo "Data is updated";                            
                        }else{
                            echo "Panjang Sandi Minimal 8 Karakter";
                        }
                    }else{
                        echo "Sandi Baru Tidak Boleh Kosong";
                    }
                }else{
                    echo "Sandi Baru Tidak Sama Dengan Konfirmasi Sandi Baru";
                }
            }else {
                echo "Sandi Lama Tidak Sesuai";                
            }
                        
        }
        
        function deleteDataByIdAnggota($id){
            $sql = "DELETE FROM master_user WHERE idAnggota=".$id;
            $execute = $this->dbh->query($sql);
        }
        
        function showDataByIdAnggota($id){
            $sql = "select * FROM master_user WHERE idAnggota=".$id;
            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->master_user, $row);
            
            return $this->master_user;
        }
        
        function showDataByFullname($fullname){
            $sql = "select * FROM master_user WHERE username='".$this->toolsController->replacecharFind($fullname,$this->dbh)."'";
            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->master_user, $row);
            
            return $this->master_user;
        }
        
        function showDataUserByGroupSubgroup($user,$unit,$subunit,$levelid,$shaffid){
            $extQry = "";
            
            if($levelid==2){
                $extQry .= "AND a.username='$user'";
            } elseif($levelid==3){
                $extQry .= "";
            } elseif($levelid==4 || $levelid==5){
                $extQry .= "AND IF('0'='$levelid',TRUE,c.group_id='$levelid') ";
                $extQry .= "AND IF('0'='$shaffid',TRUE,c.shaff='$shaffid') ";
            }
            $sql = "SELECT a.* FROM master_user a "
            . "INNER JOIN master_user_detail b ON a.user=b.user "
            . "INNER JOIN master_anggota c ON a.`idanggota`=c.`id` "
            . "WHERE "
            . "IF('0'='$unit',TRUE,a.unitid=".$unit.") "
            . "AND IF('0'='$subunit',TRUE,a.departmentid=".$subunit.") "
            . $extQry
            . "AND b.groupcode NOT IN ('Admin','Admin_Group','Admin_Dakwah','Admin_Pembinaan') "
            . "ORDER BY a.id ASC";
            return $this->createList($sql);
        }
                
        function showDataAnggotaByGroupSubGroup($group,$subgroup){
            $sql = "SELECT * FROM master_user WHERE unitid=".$group." AND departmentid=".$subgroup;
            return $this->createList($sql);
        }
        
        function showDataAnggotaByGroupSubGroupNotAdmin($admin,$unit,$subunit,$levelid,$shaffid){                        
            $sql = "SELECT a.* FROM `master_user` a
            INNER JOIN master_user_detail b ON a.`user`=b.`user`
            INNER JOIN master_anggota c ON a.`idanggota`=c.`id`
            WHERE IF('0'='$unit',TRUE,a.`unitid`='$unit') AND IF('0'='$subunit',TRUE,a.`departmentid`='$subunit')
            AND IF('0'='$levelid',TRUE,c.`group_id`='$levelid') AND IF('0'='$shaffid',TRUE,c.`shaff`='$shaffid')";
            return $this->createList($sql);
        }
        
        function showKelasYayasan(){
            $master_user = new master_user();
            $master_userCtrl = new master_userController($master_user, $this->dbh);
            $user_list = $master_userCtrl->showData($this->user);
            
            $yayasan = ($_REQUEST['yayasan']!="") ? $_REQUEST['yayasan'] : 0;
            $sql = "SELECT * FROM `master_user` a 
            WHERE IF(0=".$yayasan.", TRUE, a.`unitid`=".$yayasan.") 
            AND IF(0=".$user_list->getDepartmentid().",TRUE,a.`departmentid`=".$user_list->getDepartmentid().") AND a.departmentid>0
            GROUP BY a.`departmentid` ORDER BY a.`departmentid`;";
            $kelas_list = $this->createList($sql);
            
            $master_kelas = new master_department();
            $master_kelasCtrl = new master_departmentController($master_kelas, $this->dbh);            
            
            $top = "<select class=\"form-control\" tabindex=\"2\" name=\"kelas\" id=\"kelas\" onchange=\"showKelompok()\">";
            $bottom = "</select>";
            $middle = (substr($user_list->getDescription(), 0, 5) == "Admin" || $user_list->getUnitid() > 0) ? "<option value=\"0\">[ Semua Kelas ]</option>" :  "<option value=\"\">[ Pilih Kelas ]</option>";
            $kelasQ = "";
            foreach($kelas_list as $kelas){
                $nama_kelas = $master_kelasCtrl->showData($kelas->getDepartmentid());
                $kelasQ .= "<option value='".$kelas->getDepartmentid()."'>".$nama_kelas->getDescription()."</option>";
            }
            
            $comboKelas = $top.$middle.$kelasQ.$bottom;
            echo $comboKelas;
        }
        
        function showKelompokYayasan(){
            $master_user = new master_user();
            $master_userCtrl = new master_userController($master_user, $this->dbh);
            $user_list = $master_userCtrl->showData($this->user);
            
            $yayasan = $_REQUEST['yayasan'];
            $kelas = ($_REQUEST['kelas']!="") ? $_REQUEST['kelas'] : 0;
            $sql = "SELECT * FROM `master_user` a 
            WHERE a.`unitid`=".$yayasan." AND a.`departmentid`=".$kelas."  
            AND IF(0=".$user_list->getShaffid().",TRUE,a.`shaffid`=".$user_list->getShaffid().") 
            AND a.shaffid>0
            GROUP BY a.`shaffid` ORDER BY a.`shaffid`;";
            $kelompok_list = $this->createList($sql);
            
            $master_shaff = new master_shaff();
            $master_shaffCtrl = new master_shaffController($master_shaff, $this->dbh);            
            
            $top = "<select class=\"form-control\" tabindex=\"2\" name=\"kelompok\" id=\"kelompok\" onchange=\"showAnggota()\">";
            $bottom = "</select>";
            $middle = ($user_list->getShaffid()==0) ? "<option value=\"0\">[ Semua Kelompok ]</option>" : "<option value=\"\">[ Pilih Kelompok ]</option>";
            $kelompokQ = "";
            foreach($kelompok_list as $kelompok){
                $nama_kelompok = $master_shaffCtrl->showData($kelompok->getShaffid());
                $kelompokQ .= "<option value='".$kelompok->getShaffid()."' >".$nama_kelompok->getNama_shaff()."</option>";
            }
            
            $comboKelompok = $top.$middle.$kelompokQ.$bottom;
            echo $comboKelompok;
            
        }
        
        function showAnggotaKelompok(){
            $master_user = new master_user();
            $master_userCtrl = new master_userController($master_user, $this->dbh);
            $user_list = $master_userCtrl->showData($this->user);
                        
            $extQry = substr($user_list->getDescription(),0,5)=='Admin' ? "" : " AND a.id=".$user_list->getId();
            $yayasan = ($_REQUEST['yayasan']>0) ? $_REQUEST['yayasan'] : $user_list->getUnitid();
            $ranting = $_REQUEST['ranting'];
            $kelompok = ($_REQUEST['kelompok']!="") ? $_REQUEST['kelompok'] : 0;
            $sql = "SELECT * FROM `master_user` a WHERE IF(0=$yayasan,TRUE,a.`unitid`=".$yayasan.") 
            AND IF(0=$ranting,TRUE, a.`departmentid`=".$ranting.") $extQry 
            AND a.`shaffid`=".$kelompok." AND a.`description` NOT LIKE 'Admin%'";
            $anggota_list = $this->createList($sql);
            $top = "<select class=\"form-control\" tabindex=\"2\" name=\"anggota\" id=\"anggota\">";
            $bottom = "</select>";
            $middle = ($user_list->getShaffid() == 0) ? "<option value=\"0\">[ Semua Anggota ]</option>" : "<option value=\"\">[ Pilih Anggota ]</option>";
            $anggotaQ = "";
            foreach($anggota_list as $anggota){
                $selected = ($anggota->getId()==$user_list->getId()) ? "selected" : "";
                $anggotaQ .= "<option value='".$anggota->getId()."' ".$selected.">".$anggota->getUsername()."</option>";
            }
            
            $comboAnggota = $top.$middle.$anggotaQ.$bottom;
            echo $comboAnggota;
        }
        
        function getUserDeptId(){
            $user = $this->user;
            $userInfo = $this->showDataByUser($user);
            $deptID = ($userInfo->getDepartmentid()==10 || $userInfo->getDepartmentid()==0) ? 99 : $userInfo->getDepartmentid();            
            
            return $deptID;
        }
        
        function getUserUnitId(){
            $user = $this->user;
            $userInfo = $this->showDataByUser($user);
            $unitID = ($userInfo->getUnitid()==0) ? 99 : $userInfo->getUnitid();
            
            return $unitID;
        }
    }
?>
