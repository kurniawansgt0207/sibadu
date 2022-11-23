<?php
    class finance
    {
	var $id;
	var $tahun;
	var $bulan;
	var $no_anggota;
	var $nama_anggota;
	var $infaq;
	var $zakat;
	var $external;
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
	public function getTahun() {
	   return $this->tahun;
	}

	public function setTahun($tahun) {
	   $this->tahun = $tahun;
	}
	public function getBulan() {
	   return $this->bulan;
	}

	public function setBulan($bulan) {
	   $this->bulan = $bulan;
	}
	public function getNo_anggota() {
	   return $this->no_anggota;
	}

	public function setNo_anggota($no_anggota) {
	   $this->no_anggota = $no_anggota;
	}
	public function getNama_anggota() {
	   return $this->nama_anggota;
	}

	public function setNama_anggota($nama_anggota) {
	   $this->nama_anggota = $nama_anggota;
	}
	public function getInfaq() {
	   return $this->infaq;
	}

	public function setInfaq($infaq) {
	   $this->infaq = $infaq;
	}
	public function getZakat() {
	   return $this->zakat;
	}

	public function setZakat($zakat) {
	   $this->zakat = $zakat;
	}
	public function getExternal() {
	   return $this->external;
	}

	public function setExternal($external) {
	   $this->external = $external;
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
