<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/maaliyah.class.php';
    require_once './controllers/maaliyah.controller.generate.php';
    require_once './models/master_department.class.php';
    require_once './controllers/master_department.controller.php';
    require_once './models/master_unit.class.php';
    require_once './controllers/master_unit.controller.php';
    
    if (!isset($_SESSION)){
        session_start();
    }

    class maaliyahController extends maaliyahControllerGenerate
    {
        function showAllJQuery(){            
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
            
            $user = $this->user;
            
            $m_user = new master_user();
            $m_userCtrl = new master_userController($m_user, $this->dbh);
            $userDeptId = $m_userCtrl->getUserDeptId();
            $userUnitId = $m_userCtrl->getUserUnitId();
            
            $master_yayasan = new master_unit();
            $master_yayasanCtrl = new master_unitController($master_yayasan, $this->dbh);
            $yayasan_list_ = $master_yayasanCtrl->showDataAllByCabang($userUnitId);
            
            $master_kelas = new master_department();
            $master_kelasCtrl = new master_departmentController($master_kelas, $this->dbh);
            $kelas_list_ = $master_kelasCtrl->showDataAllByRanting($userDeptId);

            $maaliyah_list = $this->showDataAllLimit();
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
            require_once './views/maaliyah/maaliyah_jquery_list.php';
        }
        
        function showFormJQuery() {
            $yayasan = $_REQUEST['yayasan'];
            $kelas = $_REQUEST['kelas'];
            $bulan = $_REQUEST['bulan'];
            $tahun = $_REQUEST['tahun'];
            
            
        }
        
        function getDataMaaliyah($yayasan,$kelas,$bulan,$tahun){
            $sql = "SELECT * FROM ";
        }
    }
?>
