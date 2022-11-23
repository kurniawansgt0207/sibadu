<?php
    class master_shaff
    {
	var $id;
	var $kode_shaff;
	var $nama_shaff;

        var $primarykey = "id";
        
	public function getId() {
	   return $this->id;
	}

	public function setId($id) {
	   $this->id = $id;
	}
	public function getKode_shaff() {
	   return $this->kode_shaff;
	}

	public function setKode_shaff($kode_shaff) {
	   $this->kode_shaff = $kode_shaff;
	}
	public function getNama_shaff() {
	   return $this->nama_shaff;
	}

	public function setNama_shaff($nama_shaff) {
	   $this->nama_shaff = $nama_shaff;
	}
         
    }
?>
