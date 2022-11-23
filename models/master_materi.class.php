<?php
    class master_materi
    {
	var $id;
	var $kode_materi;
	var $nama_materi;
	var $alias_materi;
	var $level;
	var $created_by;
	var $created_at;
	var $updated_by;
	var $updated_at;

        var $primarykey = "id";
        
	public function getId() {
	   return $this->id;
	}

	public function setId($id) {
	   $this->id = $id;
	}
	public function getKode_materi() {
	   return $this->kode_materi;
	}

	public function setKode_materi($kode_materi) {
	   $this->kode_materi = $kode_materi;
	}
	public function getNama_materi() {
	   return $this->nama_materi;
	}

	public function setNama_materi($nama_materi) {
	   $this->nama_materi = $nama_materi;
	}
	public function getAlias_materi() {
	   return $this->alias_materi;
	}

	public function setAlias_materi($alias_materi) {
	   $this->alias_materi = $alias_materi;
	}
	public function getLevel() {
	   return $this->level;
	}

	public function setLevel($level) {
	   $this->level = $level;
	}
	public function getCreated_by() {
	   return $this->created_by;
	}

	public function setCreated_by($created_by) {
	   $this->created_by = $created_by;
	}
	public function getCreated_at() {
	   return $this->created_at;
	}

	public function setCreated_at($created_at) {
	   $this->created_at = $created_at;
	}
	public function getUpdated_by() {
	   return $this->updated_by;
	}

	public function setUpdated_by($updated_by) {
	   $this->updated_by = $updated_by;
	}
	public function getUpdated_at() {
	   return $this->updated_at;
	}

	public function setUpdated_at($updated_at) {
	   $this->updated_at = $updated_at;
	}
         
    }
?>
