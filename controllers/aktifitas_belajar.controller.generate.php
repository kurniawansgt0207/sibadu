<?php
    require_once './models/aktifitas_belajar.class.php';
    require_once './models/master_module.class.php';
    require_once './controllers/master_module.controller.php';
    require_once './models/master_group_detail.class.php';
    require_once './controllers/master_group_detail.controller.php';
    require_once './models/report_query.class.php';
    require_once './controllers/report_query.controller.php';
    require_once './controllers/tools.controller.php';
    require_once './database/config.php';

    if (!isset($_SESSION)) {
        session_start();
    }
 
    class aktifitas_belajarControllerGenerate
    {
        protected $aktifitas_belajar;
        var $modulename = "aktifitas_belajar";
        var $dbh;
        var $limit = 20;
        var $user = "None";
        var $ip = "";
        var $isadmin = false;
        var $ispublic = false;
        var $isread = false;
        var $isconfirm = false;
        var $isentry = false;
        var $isupdate = false;
        var $isdelete = false;
        var $isprint = false;
        var $isexport = false;
        var $isimport = false;
        var $lastID = "";
        var $toolsController;
        function __construct($aktifitas_belajar, $dbh) {
            $this->modulename = strtoupper($this->modulename);
            $this->aktifitas_belajar = $aktifitas_belajar;
            $this->dbh = $dbh;            
                                     
            $user = isset($_SESSION[config::$LOGIN_USER])? unserialize($_SESSION[config::$LOGIN_USER]): new master_user() ;
            $this->user = $user->getUser();
            $this->ip =  $_SERVER['REMOTE_ADDR'];
            if ($this->modulename != "MASTER_MODULE") {
                $master_module = new master_module();
                $master_moduleController = new master_moduleController($master_module, $this->dbh);
                $master_module_list = $master_moduleController->showFindData("module", "=", $this->modulename);            
                if(count($master_module_list) == 0) {
                    $master_module_list[] = new master_module();
                }
            }else{
                $master_module_list = $this->showFindData("module", "=", $this->modulename);
            }
            foreach ($master_module_list as $master_module){
                $this->ispublic = $master_module->getPublic() > 0 ? true : false;                
            }            
            if(isset($_SESSION[config::$ISADMIN])) {
                $this->isadmin = unserialize($_SESSION[config::$ISADMIN]);
            }else{
                $this->isadmin = false;
            }

            $this->isadmin = isset($_SESSION[config::$ISADMIN]) ? unserialize($_SESSION[config::$ISADMIN]) : false;
            if(isset($_SESSION[config::$MASTER_GROUP_DETAIL_LIST]) ){
                $master_group_detail_list = unserialize($_SESSION[config::$MASTER_GROUP_DETAIL_LIST]);
            }else{
                $master_group_detail_list[] = new master_group_detail();
            }
            foreach($master_group_detail_list as $master_group_detail) {
                if($master_group_detail->getModule() == $this->modulename) {
                    $this->isread = $master_group_detail->getRead();
                    $this->isconfirm = $master_group_detail->getConfirm();
                    $this->isentry = $master_group_detail->getEntry();
                    $this->isupdate = $master_group_detail->getUpdate();
                    $this->isdelete = $master_group_detail->getDelete();
                    $this->isprint = $master_group_detail->getPrint();
                    $this->isexport = $master_group_detail->getExport();
                    $this->isimport = $master_group_detail->getImport();
                    break;
                }                
            }
            $this->toolsController = new toolsController();
        }
        
        function insertData(){
            $datetime = date("Y-m-d H:i:s");
            
            $sql = "INSERT INTO aktifitas_belajar ";
            $sql .= " ( ";
	    $sql .= "`id`,";
	    $sql .= "`tgl_belajar`,";
	    $sql .= "`unitid`,";
	    $sql .= "`deptid`,";
	    $sql .= "`kelompokid`,";
	    $sql .= "`pengajar`,";
	    $sql .= "`modulid`,";
	    $sql .= "`pembahasan`,";
	    $sql .= "`jml_hadir`,";
	    $sql .= "`jml_tdk_hadir`,";
	    $sql .= "`created_date`,";
	    $sql .= "`created_by`,";
	    $sql .= "`updated_date`,";
	    $sql .= "`updated_by`,";
	    $sql .= "`ip_address` ";
            $sql .= ") ";
            $sql .= " VALUES (";
	    $sql .= " null,";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getTgl_belajar(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getUnitid(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getDeptid(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getKelompokid(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getPengajar(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getModulid(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getPembahasan(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getJml_hadir(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getJml_tdk_hadir(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getCreated_date(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getCreated_by(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getUpdated_date(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getUpdated_by(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->aktifitas_belajar->getIp_address(), $this->dbh)."' ";

            $sql .= ")";
            $execute = $this->dbh->query($sql);
        }
        
        
        function updateData(){
            $datetime = date("Y-m-d H:i:s");
            $sql = "UPDATE aktifitas_belajar SET ";
	    $sql .= "`id` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getId(),$this->dbh)."',";
	    $sql .= "`tgl_belajar` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getTgl_belajar(),$this->dbh)."',";
	    $sql .= "`unitid` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getUnitid(),$this->dbh)."',";
	    $sql .= "`deptid` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getDeptid(),$this->dbh)."',";
	    $sql .= "`kelompokid` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getKelompokid(),$this->dbh)."',";
	    $sql .= "`pengajar` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getPengajar(),$this->dbh)."',";
	    $sql .= "`modulid` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getModulid(),$this->dbh)."',";
	    $sql .= "`pembahasan` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getPembahasan(),$this->dbh)."',";
	    $sql .= "`jml_hadir` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getJml_hadir(),$this->dbh)."',";
	    $sql .= "`jml_tdk_hadir` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getJml_tdk_hadir(),$this->dbh)."',";
	    $sql .= "`created_date` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getCreated_date(),$this->dbh)."',";
	    $sql .= "`created_by` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getCreated_by(),$this->dbh)."',";
	    $sql .= "`updated_date` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getUpdated_date(),$this->dbh)."',";
	    $sql .= "`updated_by` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getUpdated_by(),$this->dbh)."',";
	    $sql .= "`ip_address` = '".$this->toolsController->replacecharSave($this->aktifitas_belajar->getIp_address(),$this->dbh)."' ";
            $sql .= "WHERE id = '".$this->aktifitas_belajar->getId()."'";                
            $execute = $this->dbh->query($sql);
        }
        
        function deleteData($id){
            $sql = "DELETE FROM aktifitas_belajar WHERE id = '".$id."'";
            $execute = $this->dbh->query($sql);
        }
        
        function showData($id){
            $sql = "SELECT * FROM aktifitas_belajar WHERE id = '".$this->toolsController->replacecharFind($id,$this->dbh)."'";

            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->aktifitas_belajar, $row);
            
            return $this->aktifitas_belajar;
        }
        
        function checkData($id){
            $sql = "SELECT count(*) FROM aktifitas_belajar where id = '".$id."'";
            $row = $this->dbh->query($sql)->fetch();
            return $row[0];
        }
        
        function showDataAll(){
            $sql = $this->findDataWhere("");
            return $this->createList($sql);            
        }
        function showDataAllQuery(){
            return $this->findDataWhere($this->showDataWhereQuery());
        }
        function countDataAll(){            
            $sql = $this->findCountDataWhere($this->showDataWhereQuery());
            $row = $this->dbh->query($sql)->fetch();
            return $row[0];
        }

        function showDataWhereQuery(){
            $bsearch = isset($_REQUEST["search"]) ;
            $where = "";
            if ($bsearch) {
                $search = $_REQUEST["search"] ;
               $where .= " where id like '%".$search."%'";
               $where .= "       or  tgl_belajar like '%".$search."%'";
               $where .= "       or  unitid like '%".$search."%'";
               $where .= "       or  deptid like '%".$search."%'";

            }            
            return $where;
        }        
        function showDataAllLimit(){
            $sql = $this->showDataAllLimitQuery();
            return $this->createList($sql);            
        }

        function showDataAllLimitQuery(){            
            $skip = isset($_REQUEST["skip"]) ? $_REQUEST["skip"] : 0;
            $limit = isset($_REQUEST["limit"]) ? $_REQUEST["limit"] : 20;
            $sql = $this->showDataAllQuery();
            $sql .= " limit ". $skip . ", ". $limit;
            return $sql;
        }
        function showFindData($field, $operator ,$keyword){
            $sql = $this->findData($field, $operator ,$keyword);
            return $this->createList($sql);
        }
        
        function findData($field, $operator ,$keyword){
            $where = "WHERE (".$field." ". $operator ."  '$keyword')";
            return $this->findDataWhere($where);
        }
        function findDataWhere($where){
            $sql = "SELECT * FROM aktifitas_belajar  ".$where;
            $sql .= " ORDER BY id";
            return $sql;
        }
        function findCountDataWhere($where){
            $sql = "SELECT count(id)  FROM aktifitas_belajar  ".$where;
            $sql .= " ORDER BY id";
            return $sql;
        }
        function findDataSql($sql){
            return $this->createList($sql);            
        }

        function createList($sql){
            $aktifitas_belajar_List = array();
            foreach ($this->dbh->query($sql) as $row) {
                    $aktifitas_belajar_ = new aktifitas_belajar();
                    $this->loadData($aktifitas_belajar_, $row);
                    $aktifitas_belajar_List[] = $aktifitas_belajar_;
            }
            return $aktifitas_belajar_List;            
        }

                
        function loadData($aktifitas_belajar,$row){
	    $aktifitas_belajar->setId($row['id']);
	    $aktifitas_belajar->setTgl_belajar($row['tgl_belajar']);
	    $aktifitas_belajar->setUnitid($row['unitid']);
	    $aktifitas_belajar->setDeptid($row['deptid']);
	    $aktifitas_belajar->setKelompokid($row['kelompokid']);
	    $aktifitas_belajar->setPengajar($row['pengajar']);
	    $aktifitas_belajar->setModulid($row['modulid']);
	    $aktifitas_belajar->setPembahasan($row['pembahasan']);
	    $aktifitas_belajar->setJml_hadir($row['jml_hadir']);
	    $aktifitas_belajar->setJml_tdk_hadir($row['jml_tdk_hadir']);
	    $aktifitas_belajar->setCreated_date($row['created_date']);
	    $aktifitas_belajar->setCreated_by($row['created_by']);
	    $aktifitas_belajar->setUpdated_date($row['updated_date']);
	    $aktifitas_belajar->setUpdated_by($row['updated_by']);
	    $aktifitas_belajar->setIp_address($row['ip_address']);

        }

        function show(){
            $this->showAll();
        }
        
        function showAll(){
            if ($this->ispublic || $this->isadmin || $this->isread ){
                $last = $this->countDataAll();
                $limit = isset($_REQUEST["limit"]) ? $_REQUEST["limit"] : $this->limit;
                $skip = isset($_REQUEST["skip"]) ? $_REQUEST["skip"] : 0;
                $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";

                $sisa = $last % $limit;

                if ($sisa > 0) {
                    $last = $last - $sisa;
                }else if ($last - $limit < 0){
                    $last = 0;
                }else{
                    $last = $last -$limit;
                }

                $previous = $skip - $limit < 0 ? 0 : $skip - $limit ;

                if ($skip + $limit > $last) {
                    $next = $last;
                }else if($skip == 0 ) {
                    $next = $skip + $limit + 1;
                }else{
                    $next = $skip + $limit;
                }
                $first = 0;

                $pageactive = $last == 0 ? $sisa == 0 ? 0 : 1 : intval(($skip / $limit)) + 1;
                $pagecount = $last == 0 ? $sisa == 0 ? 0 : 1 : intval(($last / $limit)) + 1;

                $aktifitas_belajar_list = $this->showDataAllLimit();

                $isadmin = $this->isadmin;
                $ispublic = $this->ispublic;
                $isread = $this->isread;
                $isconfirm = $this->isconfirm;
                $isentry = $this->isentry;
                $isupdate = $this->isupdate;
                $isdelete = $this->isdelete;
                $isprint = $this->isprint;
                $isexport = $this->isexport ;
                $isimport = $this->isimport;

                require_once './views/aktifitas_belajar/aktifitas_belajar_list.php';
            }else{
                echo "You cannot access this module";
            }
        }
        function showAllJQuery(){
            if ($this->ispublic || $this->isadmin || $this->isread ){
                $last = $this->countDataAll();
                $limit = isset($_REQUEST["limit"]) ? $_REQUEST["limit"] : $this->limit;
                $skip = isset($_REQUEST["skip"]) ? $_REQUEST["skip"] : 0;
                $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";

                $sisa = intval($last % $limit);

                if ($sisa > 0) {
                    $last = $last - $sisa;
                }else if ($last - $limit < 0){
                    $last = 0;
                }else{
                    $last = $last -$limit;
                }

                $previous = $skip - $limit < 0 ? 0 : $skip - $limit ;

                if ($skip + $limit > $last) {
                    $next = $last;
                }else if($skip == 0 ) {
                    $next = $skip + $limit + 1;
                }else{
                    $next = $skip + $limit;
                }
                $first = 0;

                $pageactive = $last == 0 ? $sisa == 0 ? 0 : 1 : intval(($skip / $limit)) + 1;
                $pagecount = $last == 0 ? $sisa == 0 ? 0 : 1 : intval(($last / $limit)) + 1;

                $aktifitas_belajar_list = $this->showDataAllLimit();
                $isadmin = $this->isadmin;
                $ispublic = $this->ispublic;
                $isread = $this->isread;
                $isconfirm = $this->isconfirm;
                $isentry = $this->isentry;
                $isupdate = $this->isupdate;
                $isdelete = $this->isdelete;
                $isprint = $this->isprint;
                $isexport = $this->isexport ;
                $isimport = $this->isimport;
                require_once './views/aktifitas_belajar/aktifitas_belajar_jquery_list.php';
            }else{
                echo "You cannot access this module";
            }
        }
        
        function showDetail(){
            if ($this->ispublic || $this->isadmin || $this->isread ){
                $id = $_GET['id'];
                $aktifitas_belajar_ = $this->showData($id);
                require_once './views/aktifitas_belajar/aktifitas_belajar_detail.php';
            }else{
                echo "You cannot access this module";
            }
        }
        function showDetailJQuery(){
            if ($this->ispublic || $this->isadmin || $this->isread ){
                $id = $_GET['id'];
                $aktifitas_belajar_ = $this->showData($id);
                require_once './views/aktifitas_belajar/aktifitas_belajar_jquery_detail.php';
            }else{
                echo  "You cannot access this module";
            }
        }
        
        function showForm(){
            if ($this->ispublic || $this->isadmin || ($this->isread && $this->isupdate)){
                $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
                $aktifitas_belajar_ = $this->showData($id);
                require_once './views/aktifitas_belajar/aktifitas_belajar_form.php';
            }else{
                echo "You cannot access this module";
            }
        }

        function showFormJQuery(){
            if ($this->ispublic || $this->isadmin || ($this->isread && $this->isupdate)){
                $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
                $skip = isset($_REQUEST["skip"]) ? $_REQUEST["skip"] : 0;
                $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
                $aktifitas_belajar_ = $this->showData($id);
                require_once './views/aktifitas_belajar/aktifitas_belajar_jquery_form.php';
            }else{
                echo "You cannot access this module";
            }
        }        
        function deleteForm(){
            if ($this->ispublic || $this->isadmin || ($this->isread && $this->isdelete)){
                $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
                $this->deleteData($id);
                $this->showAll();
            }else{
                echo "You cannot access this module";
            }
        }
        function deleteFormJQuery(){
            if ($this->ispublic || $this->isadmin || ($this->isread && $this->isdelete)){
                $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
                $this->deleteData($id);
                $this->showAllJQuery();
            }else{
                echo "You cannot access this module";
            }
        }
        function saveFormJQuery(){
            $this->saveFormPost();
        }
        function saveForm(){
            $this->saveFormPost();
            $this->showAll();
        }                
        function saveFormPost(){
	    $id = isset($_POST['id'])?$_POST['id'] : "";
	    $tgl_belajar = isset($_POST['tgl_belajar'])?$_POST['tgl_belajar'] : "";
	    $unitid = isset($_POST['unitid'])?$_POST['unitid'] : "";
	    $deptid = isset($_POST['deptid'])?$_POST['deptid'] : "";
	    $kelompokid = isset($_POST['kelompokid'])?$_POST['kelompokid'] : "";
	    $pengajar = isset($_POST['pengajar'])?$_POST['pengajar'] : "";
	    $modulid = isset($_POST['modulid'])?$_POST['modulid'] : "";
	    $pembahasan = isset($_POST['pembahasan'])?$_POST['pembahasan'] : "";
	    $jml_hadir = isset($_POST['jml_hadir'])?$_POST['jml_hadir'] : "";
	    $jml_tdk_hadir = isset($_POST['jml_tdk_hadir'])?$_POST['jml_tdk_hadir'] : "";
	    $created_date = isset($_POST['created_date'])?$_POST['created_date'] : "";
	    $created_by = isset($_POST['created_by'])?$_POST['created_by'] : "";
	    $updated_date = isset($_POST['updated_date'])?$_POST['updated_date'] : "";
	    $updated_by = isset($_POST['updated_by'])?$_POST['updated_by'] : "";
	    $ip_address = isset($_POST['ip_address'])?$_POST['ip_address'] : "";
	    $this->aktifitas_belajar->setId($id);
	    $this->aktifitas_belajar->setTgl_belajar($tgl_belajar);
	    $this->aktifitas_belajar->setUnitid($unitid);
	    $this->aktifitas_belajar->setDeptid($deptid);
	    $this->aktifitas_belajar->setKelompokid($kelompokid);
	    $this->aktifitas_belajar->setPengajar($pengajar);
	    $this->aktifitas_belajar->setModulid($modulid);
	    $this->aktifitas_belajar->setPembahasan($pembahasan);
	    $this->aktifitas_belajar->setJml_hadir($jml_hadir);
	    $this->aktifitas_belajar->setJml_tdk_hadir($jml_tdk_hadir);
	    $this->aktifitas_belajar->setCreated_date($created_date);
	    $this->aktifitas_belajar->setCreated_by($created_by);
	    $this->aktifitas_belajar->setUpdated_date($updated_date);
	    $this->aktifitas_belajar->setUpdated_by($updated_by);
	    $this->aktifitas_belajar->setIp_address($ip_address);            
            $this->saveData();
        }
        public function saveData(){
            $check = $this->checkData($this->aktifitas_belajar->getId());
            if($check == 0){
                if ($this->ispublic || $this->isadmin || ($this->isread && $this->isentry)){
                    $this->insertData();
                    $last_id = $this->dbh->lastInsertId();
                    $this->setLastId($last_id);
                    echo "Data is Inserted";
                }else{
                    echo "You cannot insert data this module";
                }
            } else {
                if ($this->ispublic || $this->isadmin || ($this->isread && $this->isupdate)){
                    $this->updateData();
                    echo "Data is updated";
                }else{
                    echo "You cannot update this module";
                }
            }
        }
        public function export() {
            $sql = $this->findDataWhere($this->showDataWhereQuery());
            header("Content-Type:application/csv",false);
            header("Content-Disposition: attachment; filename=". $this->getModulename() .".csv");           
            if($this->getModulename() != "report_query"){
                $report_query = new report_query();
                $report_query_controller = new report_queryController($report_query, $this->dbh);
                echo $report_query_controller->exportcsv($sql);
            }else{
                echo $this->exportcsv($sql);                
            }
        }
        public function printdata() {
            $sql = $this->findDataWhere($this->showDataWhereQuery());
            echo "<html>";
            echo "<head>";
            echo "</head>";
            echo "<body onLoad=\"window.print();window.close()\">";
            echo "<H1>".$this->getModulename()."</H1>";
            if($this->getModulename() != "report_query"){
                $report_query = new report_query();
                $report_query_controller = new report_queryController($report_query, $this->dbh);
                echo $report_query_controller->generatetableview($sql);
            }else{
                echo $this->generatetableview($sql);                
            }
            echo "</body>";
            echo "</html>";
        }
        public function getAktifitas_belajar() {
            return $this->aktifitas_belajar;
        }
        public function setAktifitas_belajar($aktifitas_belajar) {
            $this->aktifitas_belajar = $aktifitas_belajar;
        }
        public function getDbh() {
            return $this->dbh;
        }
        public function setDbh($dbh) {
            $this->dbh = $dbh;
        }
        public function getModulename() {
            return $this->modulename;
        }

        public function setModulename($modulename) {
            $this->modulename = $modulename;
        }

        public function getLimit() {
            return $this->limit;
        }

        public function setLimit($limit) {
            $this->limit = $limit;
        }

        public function getUser() {
            return $this->user;
        }

        public function setUser($user) {
            $this->user = $user;
        }

        public function getIp() {
            return $this->ip;
        }

        public function setIp($ip) {
            $this->ip = $ip;
        }

        public function getIsadmin() {
            return $this->isadmin;
        }

        public function setIsadmin($isadmin) {
            $this->isadmin = $isadmin;
        }

        public function getIspublic() {
            return $this->ispublic;
        }

        public function setIspublic($ispublic) {
            $this->ispublic = $ispublic;
        }

        public function getIsread() {
            return $this->isread;
        }

        public function setIsread($isread) {
            $this->isread = $isread;
        }

        public function getIsconfirm() {
            return $this->isconfirm;
        }

        public function setIsconfirm($isconfirm) {
            $this->isconfirm = $isconfirm;
        }

        public function getIsentry() {
            return $this->isentry;
        }

        public function setIsentry($isentry) {
            $this->isentry = $isentry;
        }

        public function getIsupdate() {
            return $this->isupdate;
        }

        public function setIsupdate($isupdate) {
            $this->isupdate = $isupdate;
        }

        public function getIsdelete() {
            return $this->isdelete;
        }

        public function setIsdelete($isdelete) {
            $this->isdelete = $isdelete;
        }

        public function getIsprint() {
            return $this->isprint;
        }

        public function setIsprint($isprint) {
            $this->isprint = $isprint;
        }

        public function getIsexport() {
            return $this->isexport;
        }

        public function setIsexport($isexport) {
            $this->isexport = $isexport;
        }

        public function getIsimport() {
            return $this->isimport;
        }

        public function setIsimport($isimport) {
            $this->isimport = $isimport;
        }

        public function setLastId($id){
            $this->lastID = $id;
        }
        
        public function getLastId(){
            return $this->lastID;
        }
    }
?>
