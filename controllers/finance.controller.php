<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/finance.class.php';
    require_once './controllers/finance.controller.generate.php';
    require_once './models/master_anggota.class.php';
    require_once './controllers/master_anggota.controller.php';
    require_once './models/master_unit.class.php';
    require_once './controllers/master_unit.controller.php';
    require_once './models/master_department.class.php';
    require_once './controllers/master_department.controller.php';
    require_once './models/master_status_keluarga.class.php';
    require_once './controllers/master_status_keluarga.controller.php';
    
    if (!isset($_SESSION)){
        session_start();
    }

    class financeController extends financeControllerGenerate
    {
        function showFormHeader(){
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
            
            include_once './views/finance/finance_jquery_header.php';
        }
        
        function showDataByUnitDept($unit, $dept){
            $sql = "SELECT a.* FROM finance a 
            LEFT JOIN master_anggota b ON a.`no_anggota`=b.`noAnggota`
            WHERE IF('$unit'='',TRUE,b.`unit`='$unit') AND IF('$dept'='',TRUE,b.`departemen`='$dept') 
            ORDER BY a.`no_anggota`";
            $rs = $this->createList($sql);            
            return $rs;
        }
        
        function showDataByPeriodByAnggota($month,$year,$noanggota){
            $sql = "SELECT * FROM finance a WHERE a.tahun=$year AND a.bulan=$month AND a.no_anggota='$noanggota'";
            $row = $this->dbh->query($sql)->fetch();
            $this->loadData($this->finance, $row);
            
            return $this->finance;
        }
        
        function showFormJQuery() {               
            $unit = isset($_REQUEST['parameter1'])?$_REQUEST['parameter1']:"";
            $dept = isset($_REQUEST['parameter2'])?$_REQUEST['parameter2']:"";
            $bulan = isset($_REQUEST['parameter3'])?$_REQUEST['parameter3']:"";
            $tahun = isset($_REQUEST['parameter4'])?$_REQUEST['parameter4']:"";
            
            $m_anggota = new master_anggota();
            $m_anggotaCtrl = new master_anggotaController($m_anggota, $this->dbh);
            $anggota = $m_anggotaCtrl->showAnggotaByUnitByDep($unit, $dept);
            
            $m_unit = new master_unit();
            $m_unitCtrl = new master_unitController($m_unit, $this->dbh);
            
            $m_dept = new master_department();
            $m_deptCtrl = new master_departmentController($m_dept, $this->dbh);
            
            $m_sts_klg = new master_status_keluarga();
            $m_sts_klgCtrl = new master_status_keluargaController($m_sts_klg, $this->dbh);            
                        
            require_once './views/finance/finance_jquery_form.php';
        }
        
        function simpanData(){
            $tahun = "2021";
            $bulan = "08";
            $id = $_REQUEST['id'];
            $no_anggota = $_REQUEST['noAnggota'];
            $nama_anggota = $_REQUEST['nmAnggota'];
            $infaq = $_REQUEST['infaq'];
            $zakat = $_REQUEST['zakat'];
            $external = $_REQUEST['external'];
            $created_date = isset($_POST['created_date'])?$_POST['created_date'] : date("Y-m-d H:i:s");
	    $created_by = isset($_POST['created_by'])?$_POST['created_by'] : $this->user;
	    $updated_date = isset($_POST['updated_date'])?$_POST['updated_date'] : date("Y-m-d H:i:s");
	    $updated_by = isset($_POST['updated_by'])?$_POST['updated_by'] : $this->user;
	    $ip_address = isset($_POST['ip_address'])?$_POST['ip_address'] : $this->ip;
            
	    $this->finance->setId($id);
	    $this->finance->setTahun($tahun);
	    $this->finance->setBulan($bulan);
	    $this->finance->setNo_anggota($no_anggota);
	    $this->finance->setNama_anggota($nama_anggota);
	    $this->finance->setInfaq($infaq);
	    $this->finance->setZakat($zakat);
	    $this->finance->setExternal($external);
	    $this->finance->setCreated_date($created_date);
	    $this->finance->setCreated_by($created_by);
	    $this->finance->setUpdated_date($updated_date);
	    $this->finance->setUpdated_by($updated_by);
	    $this->finance->setIp_address($ip_address);            
            $this->saveData();            
            $lastId = $this->lastID;
            if($lastId > 0){
                echo "Data Tersimpan";
            } else if($id > 0){
                echo "Data Terupdate";
            } else {
                echo "Gagal Tersimpan";
            }
        }
    }
?>
