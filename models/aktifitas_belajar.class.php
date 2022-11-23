<?php
    class aktifitas_belajar
    {
	var $id;
	var $tgl_belajar;
	var $unitid;
	var $deptid;
	var $kelompokid;
	var $pengajar;
	var $modulid;
	var $pembahasan;
	var $jml_hadir;
	var $jml_tdk_hadir;
	var $created_date;
	var $created_by;
	var $updated_date;
	var $updated_by;
	var $ip_address;

        var $primarykey = "id";
        
	public function getId() {
	   return $this->id;
	}

	public function setId($id) {
	   $this->id = $id;
	}
	public function getTgl_belajar() {
	   return $this->tgl_belajar;
	}

	public function setTgl_belajar($tgl_belajar) {
	   $this->tgl_belajar = $tgl_belajar;
	}
	public function getUnitid() {
	   return $this->unitid;
	}

	public function setUnitid($unitid) {
	   $this->unitid = $unitid;
	}
	public function getDeptid() {
	   return $this->deptid;
	}

	public function setDeptid($deptid) {
	   $this->deptid = $deptid;
	}
	public function getKelompokid() {
	   return $this->kelompokid;
	}

	public function setKelompokid($kelompokid) {
	   $this->kelompokid = $kelompokid;
	}
	public function getPengajar() {
	   return $this->pengajar;
	}

	public function setPengajar($pengajar) {
	   $this->pengajar = $pengajar;
	}
	public function getModulid() {
	   return $this->modulid;
	}

	public function setModulid($modulid) {
	   $this->modulid = $modulid;
	}
	public function getPembahasan() {
	   return $this->pembahasan;
	}

	public function setPembahasan($pembahasan) {
	   $this->pembahasan = $pembahasan;
	}
	public function getJml_hadir() {
	   return $this->jml_hadir;
	}

	public function setJml_hadir($jml_hadir) {
	   $this->jml_hadir = $jml_hadir;
	}
	public function getJml_tdk_hadir() {
	   return $this->jml_tdk_hadir;
	}

	public function setJml_tdk_hadir($jml_tdk_hadir) {
	   $this->jml_tdk_hadir = $jml_tdk_hadir;
	}
	public function getCreated_date() {
	   return $this->created_date;
	}

	public function setCreated_date($created_date) {
	   $this->created_date = $created_date;
	}
	public function getCreated_by() {
	   return $this->created_by;
	}

	public function setCreated_by($created_by) {
	   $this->created_by = $created_by;
	}
	public function getUpdated_date() {
	   return $this->updated_date;
	}

	public function setUpdated_date($updated_date) {
	   $this->updated_date = $updated_date;
	}
	public function getUpdated_by() {
	   return $this->updated_by;
	}

	public function setUpdated_by($updated_by) {
	   $this->updated_by = $updated_by;
	}
	public function getIp_address() {
	   return $this->ip_address;
	}

	public function setIp_address($ip_address) {
	   $this->ip_address = $ip_address;
	}
         
    }
?>
