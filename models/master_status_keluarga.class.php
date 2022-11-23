<?php
    class master_status_keluarga
    {
	var $id;
	var $status_keluarga;
	var $created_date;
	var $created_by;
	var $updated_date;
	var $updated_by;

        var $primarykey = "id";
        
	public function getId() {
	   return $this->id;
	}

	public function setId($id) {
	   $this->id = $id;
	}
	public function getStatus_keluarga() {
	   return $this->status_keluarga;
	}

	public function setStatus_keluarga($status_keluarga) {
	   $this->status_keluarga = $status_keluarga;
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
         
    }
?>
