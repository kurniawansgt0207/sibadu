<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_anggota.class.php';
    require_once './controllers/master_anggota.controller.generate.php';
    require_once './models/master_department.class.php';
    require_once './controllers/master_department.controller.php';
    require_once './models/master_level.class.php';
    require_once './controllers/master_level.controller.php';
    require_once './models/master_pekerjaan.class.php';
    require_once './controllers/master_pekerjaan.controller.php';
    require_once './models/master_pendidikan.class.php';
    require_once './controllers/master_pendidikan.controller.php';
    require_once './models/master_status_keluarga.class.php';
    require_once './controllers/master_status_keluarga.controller.php';
    require_once './models/history_master_anggota.class.php';
    require_once './controllers/history_master_anggota.controller.php';
    require_once './models/master_kelompok.class.php';
    require_once './controllers/master_kelompok.controller.php';
    
    if (!isset($_SESSION)){
        session_start();
    }

    class master_anggotaController extends master_anggotaControllerGenerate
    {
        function showDataWhereQuery(){
            $bsearch = isset($_REQUEST["search"]) ;
            $user = $this->user;
            
            $m_user = new master_user();
            $m_userCtrl = new master_userController($m_user, $this->dbh);
            $userInfo = $m_userCtrl->showDataByUser($user);
            $unitID = ($userInfo->getUnitid()==0) ? 99 : $userInfo->getUnitid();
            $deptID = ($userInfo->getDepartmentid()==10 || $userInfo->getDepartmentid()==0) ? 99 : $userInfo->getDepartmentid();
            
            $where = " WHERE IF('99'='".$unitID."',TRUE,unit=".$unitID.")";
            $where .= " AND IF('99'='".$deptID."',TRUE,departemen=".$deptID.")";
            if ($bsearch) {
                $search = $_REQUEST["search"] ;
                $where .= " AND (id like '%".$search."%'";
                $where .= " OR  noAnggota like '%".$search."%'";
                $where .= " OR  namaAnggota like '%".$search."%'";
                $where .= " OR  wali like '%".$search."%'";
                $where .= " OR  tglLahir like '%".$search."%')";                
            } 
            //$where .= " ORDER BY noAnggota";            
            return $where;
        }
        
        function getLastNoAnggota($unit,$dept){
            $sql = "SELECT RIGHT(a.`noAnggota`,4) nourut FROM master_anggota a 
            WHERE a.`departemen`=$dept AND a.`unit`=$unit ORDER BY a.`id` DESC LIMIT 1";
            $getLastNoUrut = $this->dbh->query($sql)->fetch();
            $lastNoUrut = ($getLastNoUrut['nourut']+1);
            if(strlen($lastNoUrut) == 3){
                $NoUrutNew = "0".$lastNoUrut;
            } elseif(strlen($lastNoUrut) == 2){
                $NoUrutNew = "00".$lastNoUrut;
            } else {
                $NoUrutNew = $lastNoUrut;
            }
            
            return $NoUrutNew;
        }
        
        function hitung_umur($tanggal_lahir){
            $birthDate = new DateTime($tanggal_lahir);
            $today = new DateTime("today");
            if ($birthDate > $today) { 
                //exit("0 tahun 0 bulan 0 hari");
            }
            $y = $today->diff($birthDate)->y;
            $m = $today->diff($birthDate)->m;
            $d = $today->diff($birthDate)->d;
            return $y;
        }
        
        function saveFormJQuery() {
            parent::saveFormJQuery();
                        
            $history_anggota = new history_master_anggota();
            $history_anggotaCtrl = new history_master_anggotaController($history_anggota, $this->dbh);
                        
            $no_anggota = $_REQUEST['noAnggota'];
            $nm_anggota = $_REQUEST['namaAnggota'];
            $new_level = $_REQUEST['level'];
            $old_level = $_REQUEST['levelOld'];
            $tgl_update = $_REQUEST['tglUpdateLevel'];
            $status_anggota = $_REQUEST['statusAnggota'];
            $now_date = date("Y-m-d H:i:s");
            $user = $this->user;
            $ip = $this->ip;
            
            if($status_anggota == "Aktif"){
                if($new_level > $old_level){
                    $history_anggota->setNoAnggota($no_anggota);
                    $history_anggota->setNmAnggota($nm_anggota);
                    $history_anggota->setLevel_before($old_level);
                    $history_anggota->setLevel_new($new_level);
                    $history_anggota->setTglUpdateLevel($tgl_update);
                    $history_anggota->setStatusAnggota($status_anggota);
                    $history_anggota->setCreatedBy($user);
                    $history_anggota->setCreatedDate($now_date);
                    $history_anggota->setUpdatedBy($user);
                    $history_anggota->setUpdatedDate($now_date);
                    $history_anggota->setIp_address($ip);
                    
                    $history_anggotaCtrl->isentry = true;
                    $history_anggotaCtrl->isread = true;
                    $history_anggotaCtrl->isupdate = true;
                    $history_anggotaCtrl->saveData();
                }
            }
        }
        
        function showAnggotaByUnitByDep($unit,$dept){
            $sql = "SELECT * FROM master_anggota a
            WHERE IF('$unit'='',TRUE,a.`unit`='$unit') 
            AND IF('$dept'='',TRUE,a.`departemen`='$dept') 
            AND a.`statusAnggota`='Aktif'
            ORDER BY a.`noAnggota`";
            $rs = $this->createList($sql);
            return $rs;
        }
        
        function showAnggotaByUnitByDepByKel($unit,$dept,$kel){
            $sql = "SELECT * FROM master_anggota a
            WHERE a.`unit`='$unit'
            AND a.`departemen`='$dept'
            AND a.`kelompok`='$kel'
            AND a.`statusAnggota`='Aktif'
            ORDER BY a.`noAnggota`";
            $rs = $this->createList($sql);
            return $rs;
        }
        
        function switchStatusAnggota(){
            $lineno = $_REQUEST['lineno'];
            $paramStatus = $_REQUEST['flag'];
            $flag = ($paramStatus==1)?"Aktif":"Tidak Aktif";
            $noAnggota = $_REQUEST['noanggota'];            
            
            $sql = "UPDATE master_anggota SET statusAnggota='".$flag."' WHERE noAnggota='".$noAnggota."'";
            $this->dbh->query($sql);
            
            $cekAnggota = $this->showFindData("noAnggota", "=", $noAnggota);
            $newStatus = $cekAnggota[0]->getStatusAnggota();
            
            $statusNew = ($newStatus=="Aktif") ? 0 : 1;
            $ikonStatus = ($newStatus=="Aktif") ? "switch-active.png" : "switch-inactive.png";
            $titleStatus = ($newStatus=="Aktif") ? "Anggota Aktif" : "Anggota Tidak Aktif";                
                        
            echo "<a href=\"#toggleStatus".$lineno."\" onclick=\"switchStatus('".$lineno."','".$statusNew."','".$noAnggota."')\" title=\"".$titleStatus."\">
                <img src=\"./img/icon/".$ikonStatus."\" width=\"40\" heigth=\"20\">
            </a>";
        }
    }
?>
