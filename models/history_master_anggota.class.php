<?php
    class history_master_anggota
    {
	var $id;
	var $noAnggota;
	var $nmAnggota;
	var $level_before;
	var $level_new;
	var $tglUpdateLevel;
	var $statusAnggota;
	var $createdDate;
	var $createdBy;
	var $updatedDate;
	var $updatedBy;
	var $ip_address;

        var $primarykey = "id";
        
	public function getId() {
	   return $this->id;
	}

	public function setId($id) {
	   $this->id = $id;
	}
	public function getNoAnggota() {
	   return $this->noAnggota;
	}

	public function setNoAnggota($noAnggota) {
	   $this->noAnggota = $noAnggota;
	}
	public function getNmAnggota() {
	   return $this->nmAnggota;
	}

	public function setNmAnggota($nmAnggota) {
	   $this->nmAnggota = $nmAnggota;
	}
	public function getLevel_before() {
	   return $this->level_before;
	}

	public function setLevel_before($level_before) {
	   $this->level_before = $level_before;
	}
	public function getLevel_new() {
	   return $this->level_new;
	}

	public function setLevel_new($level_new) {
	   $this->level_new = $level_new;
	}
	public function getTglUpdateLevel() {
	   return $this->tglUpdateLevel;
	}

	public function setTglUpdateLevel($tglUpdateLevel) {
	   $this->tglUpdateLevel = $tglUpdateLevel;
	}
	public function getStatusAnggota() {
	   return $this->statusAnggota;
	}

	public function setStatusAnggota($statusAnggota) {
	   $this->statusAnggota = $statusAnggota;
	}
	public function getCreatedDate() {
	   return $this->createdDate;
	}

	public function setCreatedDate($createdDate) {
	   $this->createdDate = $createdDate;
	}
	public function getCreatedBy() {
	   return $this->createdBy;
	}

	public function setCreatedBy($createdBy) {
	   $this->createdBy = $createdBy;
	}
	public function getUpdatedDate() {
	   return $this->updatedDate;
	}

	public function setUpdatedDate($updatedDate) {
	   $this->updatedDate = $updatedDate;
	}
	public function getUpdatedBy() {
	   return $this->updatedBy;
	}

	public function setUpdatedBy($updatedBy) {
	   $this->updatedBy = $updatedBy;
	}
	public function getIp_address() {
	   return $this->ip_address;
	}

	public function setIp_address($ip_address) {
	   $this->ip_address = $ip_address;
	}
         
    }
?>
