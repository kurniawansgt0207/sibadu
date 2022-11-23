<?php
    class report_query
    {
	var $id;
	var $reportname;
	var $style;
	var $header;
	var $query;
	var $crosstab;
	var $total;
	var $subtotal;
	var $order_concat;
	var $order_by_col_1;
	var $order_by_col_2;
	var $order_by_col_3;
	var $entrytime;
	var $entryuser;
	var $entryip;
	var $updatetime;
	var $updateuser;
	var $updateip;

        var $primarykey = "id";
        
	public function getId() {
	   return $this->id;
	}

	public function setId($id) {
	   $this->id = $id;
	}
	public function getReportname() {
	   return $this->reportname;
	}

	public function setReportname($reportname) {
	   $this->reportname = $reportname;
	}
	public function getStyle() {
	   return $this->style;
	}

	public function setStyle($style) {
	   $this->style = $style;
	}
	public function getHeader() {
	   return $this->header;
	}

	public function setHeader($header) {
	   $this->header = $header;
	}
	public function getQuery() {
	   return $this->query;
	}

	public function setQuery($query) {
	   $this->query = $query;
	}
	public function getCrosstab() {
	   return $this->crosstab;
	}

	public function setCrosstab($crosstab) {
	   $this->crosstab = $crosstab;
	}
	public function getTotal() {
	   return $this->total;
	}

	public function setTotal($total) {
	   $this->total = $total;
	}
	public function getSubtotal() {
	   return $this->subtotal;
	}

	public function setSubtotal($subtotal) {
	   $this->subtotal = $subtotal;
	}
	public function getOrder_concat() {
	   return $this->order_concat;
	}

	public function setOrder_concat($order_concat) {
	   $this->order_concat = $order_concat;
	}
	public function getOrder_by_col_1() {
	   return $this->order_by_col_1;
	}

	public function setOrder_by_col_1($order_by_col_1) {
	   $this->order_by_col_1 = $order_by_col_1;
	}
	public function getOrder_by_col_2() {
	   return $this->order_by_col_2;
	}

	public function setOrder_by_col_2($order_by_col_2) {
	   $this->order_by_col_2 = $order_by_col_2;
	}
	public function getOrder_by_col_3() {
	   return $this->order_by_col_3;
	}

	public function setOrder_by_col_3($order_by_col_3) {
	   $this->order_by_col_3 = $order_by_col_3;
	}
	public function getEntrytime() {
	   return $this->entrytime;
	}

	public function setEntrytime($entrytime) {
	   $this->entrytime = $entrytime;
	}
	public function getEntryuser() {
	   return $this->entryuser;
	}

	public function setEntryuser($entryuser) {
	   $this->entryuser = $entryuser;
	}
	public function getEntryip() {
	   return $this->entryip;
	}

	public function setEntryip($entryip) {
	   $this->entryip = $entryip;
	}
	public function getUpdatetime() {
	   return $this->updatetime;
	}

	public function setUpdatetime($updatetime) {
	   $this->updatetime = $updatetime;
	}
	public function getUpdateuser() {
	   return $this->updateuser;
	}

	public function setUpdateuser($updateuser) {
	   $this->updateuser = $updateuser;
	}
	public function getUpdateip() {
	   return $this->updateip;
	}

	public function setUpdateip($updateip) {
	   $this->updateip = $updateip;
	}
         
    }
?>
