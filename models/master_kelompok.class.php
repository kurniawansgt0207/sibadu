<?php
    class master_kelompok
    {
	var $id;
	var $unitid;
	var $deptid;
	var $kelompok;
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
	public function getKelompok() {
	   return $this->kelompok;
	}

	public function setKelompok($kelompok) {
	   $this->kelompok = $kelompok;
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
