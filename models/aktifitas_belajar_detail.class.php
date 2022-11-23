<?php
    class aktifitas_belajar_detail
    {
	var $id;
	var $baseId;
	var $noAnggota;
	var $isHadir;
	var $ketTdkHadir;

        var $primarykey = "id";
        
	public function getId() {
	   return $this->id;
	}

	public function setId($id) {
	   $this->id = $id;
	}
	public function getBaseId() {
	   return $this->baseId;
	}

	public function setBaseId($baseId) {
	   $this->baseId = $baseId;
	}
	public function getNoAnggota() {
	   return $this->noAnggota;
	}

	public function setNoAnggota($noAnggota) {
	   $this->noAnggota = $noAnggota;
	}
	public function getIsHadir() {
	   return $this->isHadir;
	}

	public function setIsHadir($isHadir) {
	   $this->isHadir = $isHadir;
	}
	public function getKetTdkHadir() {
	   return $this->ketTdkHadir;
	}

	public function setKetTdkHadir($ketTdkHadir) {
	   $this->ketTdkHadir = $ketTdkHadir;
	}
         
    }
?>
