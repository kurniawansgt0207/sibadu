<?php
    require_once './models/master_anggota.class.php';
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
 
    class master_anggotaControllerGenerate
    {
        protected $master_anggota;
        var $modulename = "master_anggota";
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
        function __construct($master_anggota, $dbh) {
            $this->modulename = strtoupper($this->modulename);
            $this->master_anggota = $master_anggota;
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
            
            $sql = "INSERT INTO master_anggota ";
            $sql .= " ( ";
	    $sql .= "`id`,";
	    $sql .= "`noAnggota`,";
	    $sql .= "`namaAnggota`,";
	    $sql .= "`tglLahir`,";
	    $sql .= "`jnsKelamin`,";
	    $sql .= "`level`,";
	    $sql .= "`stsKeluarga`,";
	    $sql .= "`pekerjaan`,";
	    $sql .= "`pendidikanAkhir`,";
	    $sql .= "`wali`,";
	    $sql .= "`departemen`,";
	    $sql .= "`unit`,";
	    $sql .= "`kelompok`,";
	    $sql .= "`statusAnggota`,";
	    $sql .= "`isPengurus`,";
	    $sql .= "`keterampilan`,";
	    $sql .= "`gol_darah`,";
	    $sql .= "`keterangan`,";
	    $sql .= "`postingdata`,";
	    $sql .= "`created_date`,";
	    $sql .= "`created_by`,";
	    $sql .= "`updated_date`,";
	    $sql .= "`updated_by`,";
	    $sql .= "`ip_address` ";
            $sql .= ") ";
            $sql .= " VALUES (";
	    $sql .= " null,";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getNoAnggota(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getNamaAnggota(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getTglLahir(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getJnsKelamin(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getLevel(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getStsKeluarga(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getPekerjaan(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getPendidikanAkhir(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getWali(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getDepartemen(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getUnit(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getKelompok(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getStatusAnggota(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getIsPengurus(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getKeterampilan(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getGol_darah(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getKeterangan(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getPostingdata(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getCreated_date(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getCreated_by(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getUpdated_date(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getUpdated_by(), $this->dbh)."',";
	    $sql .= "'".$this->toolsController->replacecharSave($this->master_anggota->getIp_address(), $this->dbh)."' ";

            $sql .= ")";
            $execute = $this->dbh->query($sql);
        }
        
        
        function updateData(){
            $datetime = date("Y-m-d H:i:s");
            $sql = "UPDATE master_anggota SET ";
	    $sql .= "`id` = '".$this->toolsController->replacecharSave($this->master_anggota->getId(),$this->dbh)."',";
	    $sql .= "`noAnggota` = '".$this->toolsController->replacecharSave($this->master_anggota->getNoAnggota(),$this->dbh)."',";
	    $sql .= "`namaAnggota` = '".$this->toolsController->replacecharSave($this->master_anggota->getNamaAnggota(),$this->dbh)."',";
	    $sql .= "`tglLahir` = '".$this->toolsController->replacecharSave($this->master_anggota->getTglLahir(),$this->dbh)."',";
	    $sql .= "`jnsKelamin` = '".$this->toolsController->replacecharSave($this->master_anggota->getJnsKelamin(),$this->dbh)."',";
	    $sql .= "`level` = '".$this->toolsController->replacecharSave($this->master_anggota->getLevel(),$this->dbh)."',";
	    $sql .= "`stsKeluarga` = '".$this->toolsController->replacecharSave($this->master_anggota->getStsKeluarga(),$this->dbh)."',";
	    $sql .= "`pekerjaan` = '".$this->toolsController->replacecharSave($this->master_anggota->getPekerjaan(),$this->dbh)."',";
	    $sql .= "`pendidikanAkhir` = '".$this->toolsController->replacecharSave($this->master_anggota->getPendidikanAkhir(),$this->dbh)."',";
	    $sql .= "`wali` = '".$this->toolsController->replacecharSave($this->master_anggota->getWali(),$this->dbh)."',";
	    $sql .= "`departemen` = '".$this->toolsController->replacecharSave($this->master_anggota->getDepartemen(),$this->dbh)."',";
	    $sql .= "`unit` = '".$this->toolsController->replacecharSave($this->master_anggota->getUnit(),$this->dbh)."',";
	    $sql .= "`kelompok` = '".$this->toolsController->replacecharSave($this->master_anggota->getKelompok(),$this->dbh)."',";
	    $sql .= "`statusAnggota` = '".$this->toolsController->replacecharSave($this->master_anggota->getStatusAnggota(),$this->dbh)."',";
	    $sql .= "`isPengurus` = '".$this->toolsController->replacecharSave($this->master_anggota->getIsPengurus(),$this->dbh)."',";
	    $sql .= "`keterampilan` = '".$this->toolsController->replacecharSave($this->master_anggota->getKeterampilan(),$this->dbh)."',";
	    $sql .= "`gol_darah` = '".$this->toolsController->replacecharSave($this->master_anggota->getGol_darah(),$this->dbh)."',";
	    $sql .= "`keterangan` = '".$this->toolsController->replacecharSave($this->master_anggota->getKeterangan(),$this->dbh)."',";
	    $sql .= "`postingdata` = '".$this->toolsController->replacecharSave($this->master_anggota->getPostingdata(),$this->dbh)."',";
	    $sql .= "`created_date` = '".$this->toolsController->replacecharSave($this->master_anggota->getCreated_date(),$this->dbh)."',";
	    $sql .= "`created_by` = '".$this->toolsController->replacecharSave($this->master_anggota->getCreated_by(),$this->dbh)."',";
	    $sql .= "`updated_date` = '".$this->toolsController->replacecharSave($this->master_anggota->getUpdated_date(),$this->dbh)."',";
	    $sql .= "`updated_by` = '".$this->toolsController->replacecharSave($this->master_anggota->getUpdated_by(),$this->dbh)."',";
	    $sql .= "`ip_address` = '".$this->toolsController->replacecharSave($this->master_anggota->getIp_address(),$this->dbh)."' ";
            $sql .= "WHERE id = '".$this->master_anggota->getId()."'";                
            $execute = $this->dbh->query($sql);
        }
        
        function deleteData($id){
            $sql = "DELETE FROM master_anggota WHERE id = '".$id."'";
            $execute = $this->dbh->query($sql);
        }
        
        function showData($id){
            $sql = "SELECT * FROM master_anggota WHERE id = '".$this->toolsController->replacecharFind($id,$this->dbh)."'";

            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->master_anggota, $row);
            
            return $this->master_anggota;
        }
        
        function checkData($id){
            $sql = "SELECT count(*) FROM master_anggota where id = '".$id."'";
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
               $where .= "       or  noAnggota like '%".$search."%'";
               $where .= "       or  namaAnggota like '%".$search."%'";
               $where .= "       or  tglLahir like '%".$search."%'";

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
            $sql = "SELECT * FROM master_anggota  ".$where;
            $sql .= " ORDER BY id";
            return $sql;
        }
        function findCountDataWhere($where){
            $sql = "SELECT count(id)  FROM master_anggota  ".$where;
            $sql .= " ORDER BY id";
            return $sql;
        }
        function findDataSql($sql){
            return $this->createList($sql);            
        }

        function createList($sql){
            $master_anggota_List = array();
            foreach ($this->dbh->query($sql) as $row) {
                    $master_anggota_ = new master_anggota();
                    $this->loadData($master_anggota_, $row);
                    $master_anggota_List[] = $master_anggota_;
            }
            return $master_anggota_List;            
        }

                
        function loadData($master_anggota,$row){
	    $master_anggota->setId($row['id']);
	    $master_anggota->setNoAnggota($row['noAnggota']);
	    $master_anggota->setNamaAnggota($row['namaAnggota']);
	    $master_anggota->setTglLahir($row['tglLahir']);
	    $master_anggota->setJnsKelamin($row['jnsKelamin']);
	    $master_anggota->setLevel($row['level']);
	    $master_anggota->setStsKeluarga($row['stsKeluarga']);
	    $master_anggota->setPekerjaan($row['pekerjaan']);
	    $master_anggota->setPendidikanAkhir($row['pendidikanAkhir']);
	    $master_anggota->setWali($row['wali']);
	    $master_anggota->setDepartemen($row['departemen']);
	    $master_anggota->setUnit($row['unit']);
	    $master_anggota->setKelompok($row['kelompok']);
	    $master_anggota->setStatusAnggota($row['statusAnggota']);
	    $master_anggota->setIsPengurus($row['isPengurus']);
	    $master_anggota->setKeterampilan($row['keterampilan']);
	    $master_anggota->setGol_darah($row['gol_darah']);
	    $master_anggota->setKeterangan($row['keterangan']);
	    $master_anggota->setPostingdata($row['postingdata']);
	    $master_anggota->setCreated_date($row['created_date']);
	    $master_anggota->setCreated_by($row['created_by']);
	    $master_anggota->setUpdated_date($row['updated_date']);
	    $master_anggota->setUpdated_by($row['updated_by']);
	    $master_anggota->setIp_address($row['ip_address']);

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

                $master_anggota_list = $this->showDataAllLimit();

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

                require_once './views/master_anggota/master_anggota_list.php';
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

                $master_anggota_list = $this->showDataAllLimit();
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
                require_once './views/master_anggota/master_anggota_jquery_list.php';
            }else{
                echo "You cannot access this module";
            }
        }
        
        function showDetail(){
            if ($this->ispublic || $this->isadmin || $this->isread ){
                $id = $_GET['id'];
                $master_anggota_ = $this->showData($id);
                require_once './views/master_anggota/master_anggota_detail.php';
            }else{
                echo "You cannot access this module";
            }
        }
        function showDetailJQuery(){
            if ($this->ispublic || $this->isadmin || $this->isread ){
                $id = $_GET['id'];
                $master_anggota_ = $this->showData($id);
                require_once './views/master_anggota/master_anggota_jquery_detail.php';
            }else{
                echo  "You cannot access this module";
            }
        }
        
        function showForm(){
            if ($this->ispublic || $this->isadmin || ($this->isread && $this->isupdate)){
                $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
                $master_anggota_ = $this->showData($id);
                require_once './views/master_anggota/master_anggota_form.php';
            }else{
                echo "You cannot access this module";
            }
        }

        function showFormJQuery(){
            if ($this->ispublic || $this->isadmin || ($this->isread && $this->isupdate)){
                $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
                $skip = isset($_REQUEST["skip"]) ? $_REQUEST["skip"] : 0;
                $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
                $master_anggota_ = $this->showData($id);
                require_once './views/master_anggota/master_anggota_jquery_form.php';
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
	    $noAnggota = isset($_POST['noAnggota'])?$_POST['noAnggota'] : "";
	    $namaAnggota = isset($_POST['namaAnggota'])?$_POST['namaAnggota'] : "";
	    $tglLahir = isset($_POST['tglLahir'])?$_POST['tglLahir'] : "";
	    $jnsKelamin = isset($_POST['jnsKelamin'])?$_POST['jnsKelamin'] : "";
	    $level = isset($_POST['level'])?$_POST['level'] : "";
	    $stsKeluarga = isset($_POST['stsKeluarga'])?$_POST['stsKeluarga'] : "";
	    $pekerjaan = isset($_POST['pekerjaan'])?$_POST['pekerjaan'] : "";
	    $pendidikanAkhir = isset($_POST['pendidikanAkhir'])?$_POST['pendidikanAkhir'] : "";
	    $wali = isset($_POST['wali'])?$_POST['wali'] : "";
	    $departemen = isset($_POST['departemen'])?$_POST['departemen'] : "";
	    $unit = isset($_POST['unit'])?$_POST['unit'] : "";
	    $kelompok = isset($_POST['kelompok'])?$_POST['kelompok'] : "";
	    $statusAnggota = isset($_POST['statusAnggota'])?$_POST['statusAnggota'] : "";
	    $isPengurus = isset($_POST['isPengurus'])?$_POST['isPengurus'] : "";
	    $keterampilan = isset($_POST['keterampilan'])?$_POST['keterampilan'] : "";
	    $gol_darah = isset($_POST['gol_darah'])?$_POST['gol_darah'] : "";
	    $keterangan = isset($_POST['keterangan'])?$_POST['keterangan'] : "";
	    $postingdata = isset($_POST['postingdata'])?$_POST['postingdata'] : "";
	    $created_date = isset($_POST['created_date'])?$_POST['created_date'] : "";
	    $created_by = isset($_POST['created_by'])?$_POST['created_by'] : "";
	    $updated_date = isset($_POST['updated_date'])?$_POST['updated_date'] : "";
	    $updated_by = isset($_POST['updated_by'])?$_POST['updated_by'] : "";
	    $ip_address = isset($_POST['ip_address'])?$_POST['ip_address'] : "";
	    $this->master_anggota->setId($id);
	    $this->master_anggota->setNoAnggota($noAnggota);
	    $this->master_anggota->setNamaAnggota($namaAnggota);
	    $this->master_anggota->setTglLahir($tglLahir);
	    $this->master_anggota->setJnsKelamin($jnsKelamin);
	    $this->master_anggota->setLevel($level);
	    $this->master_anggota->setStsKeluarga($stsKeluarga);
	    $this->master_anggota->setPekerjaan($pekerjaan);
	    $this->master_anggota->setPendidikanAkhir($pendidikanAkhir);
	    $this->master_anggota->setWali($wali);
	    $this->master_anggota->setDepartemen($departemen);
	    $this->master_anggota->setUnit($unit);
	    $this->master_anggota->setKelompok($kelompok);
	    $this->master_anggota->setStatusAnggota($statusAnggota);
	    $this->master_anggota->setIsPengurus($isPengurus);
	    $this->master_anggota->setKeterampilan($keterampilan);
	    $this->master_anggota->setGol_darah($gol_darah);
	    $this->master_anggota->setKeterangan($keterangan);
	    $this->master_anggota->setPostingdata($postingdata);
	    $this->master_anggota->setCreated_date($created_date);
	    $this->master_anggota->setCreated_by($created_by);
	    $this->master_anggota->setUpdated_date($updated_date);
	    $this->master_anggota->setUpdated_by($updated_by);
	    $this->master_anggota->setIp_address($ip_address);            
            $this->saveData();
        }
        public function saveData(){
            $check = $this->checkData($this->master_anggota->getId());
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
        public function getMaster_anggota() {
            return $this->master_anggota;
        }
        public function setMaster_anggota($master_anggota) {
            $this->master_anggota = $master_anggota;
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
