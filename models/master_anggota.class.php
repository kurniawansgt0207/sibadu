<?php
    class master_anggota
    {
	var $id;
	var $noAnggota;
	var $namaAnggota;
	var $tglLahir;
	var $jnsKelamin;
	var $level;
	var $stsKeluarga;
	var $pekerjaan;
	var $pendidikanAkhir;
	var $wali;
	var $departemen;
	var $unit;
	var $kelompok;
	var $statusAnggota;
	var $isPengurus;
	var $keterampilan;
	var $gol_darah;
	var $keterangan;
	var $postingdata;
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
	public function getNoAnggota() {
	   return $this->noAnggota;
	}

	public function setNoAnggota($noAnggota) {
	   $this->noAnggota = $noAnggota;
	}
	public function getNamaAnggota() {
	   return $this->namaAnggota;
	}

	public function setNamaAnggota($namaAnggota) {
	   $this->namaAnggota = $namaAnggota;
	}
	public function getTglLahir() {
	   return $this->tglLahir;
	}

	public function setTglLahir($tglLahir) {
	   $this->tglLahir = $tglLahir;
	}
	public function getJnsKelamin() {
	   return $this->jnsKelamin;
	}

	public function setJnsKelamin($jnsKelamin) {
	   $this->jnsKelamin = $jnsKelamin;
	}
	public function getLevel() {
	   return $this->level;
	}

	public function setLevel($level) {
	   $this->level = $level;
	}
	public function getStsKeluarga() {
	   return $this->stsKeluarga;
	}

	public function setStsKeluarga($stsKeluarga) {
	   $this->stsKeluarga = $stsKeluarga;
	}
	public function getPekerjaan() {
	   return $this->pekerjaan;
	}

	public function setPekerjaan($pekerjaan) {
	   $this->pekerjaan = $pekerjaan;
	}
	public function getPendidikanAkhir() {
	   return $this->pendidikanAkhir;
	}

	public function setPendidikanAkhir($pendidikanAkhir) {
	   $this->pendidikanAkhir = $pendidikanAkhir;
	}
	public function getWali() {
	   return $this->wali;
	}

	public function setWali($wali) {
	   $this->wali = $wali;
	}
	public function getDepartemen() {
	   return $this->departemen;
	}

	public function setDepartemen($departemen) {
	   $this->departemen = $departemen;
	}
	public function getUnit() {
	   return $this->unit;
	}

	public function setUnit($unit) {
	   $this->unit = $unit;
	}
	public function getKelompok() {
	   return $this->kelompok;
	}

	public function setKelompok($kelompok) {
	   $this->kelompok = $kelompok;
	}
	public function getStatusAnggota() {
	   return $this->statusAnggota;
	}

	public function setStatusAnggota($statusAnggota) {
	   $this->statusAnggota = $statusAnggota;
	}
	public function getIsPengurus() {
	   return $this->isPengurus;
	}

	public function setIsPengurus($isPengurus) {
	   $this->isPengurus = $isPengurus;
	}
	public function getKeterampilan() {
	   return $this->keterampilan;
	}

	public function setKeterampilan($keterampilan) {
	   $this->keterampilan = $keterampilan;
	}
	public function getGol_darah() {
	   return $this->gol_darah;
	}

	public function setGol_darah($gol_darah) {
	   $this->gol_darah = $gol_darah;
	}
	public function getKeterangan() {
	   return $this->keterangan;
	}

	public function setKeterangan($keterangan) {
	   $this->keterangan = $keterangan;
	}
	public function getPostingdata() {
	   return $this->postingdata;
	}

	public function setPostingdata($postingdata) {
	   $this->postingdata = $postingdata;
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
