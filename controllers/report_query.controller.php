<?php
    //ini_set("display_errors", 1);
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/report_query.class.php';
    require_once './controllers/report_query.controller.generate.php';
    require_once './controllers/CrossTab.php';
    require_once './models/master_unit.class.php';
    require_once './controllers/master_unit.controller.php';
    require_once './models/master_department.class.php';
    require_once './controllers/master_department.controller.php';
    require_once './models/master_level.class.php';
    require_once './controllers/master_level.controller.php';
    require_once './models/master_kelompok.class.php';
    require_once './controllers/master_kelompok.controller.php';
    
    if (!isset($_SESSION)) {
        session_start();
    }

    class report_queryController extends report_queryControllerGenerate
    {
        
        function showGenerateTable(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $report_query = $this->showData($id);
            $query = $this->getQueryGenerate($report_query);
            echo $this->generatetableview($query,$report_query->getTotal(),$report_query->getSubtotal());   
        }
        
        function showExportTable(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $report_query = $this->showData($id);
            $query = $this->getQueryGenerate($report_query);

            //echo $query;
            header("Content-Type:application/csv");                
            header('Content-Disposition: attachment; filename="sample_export_data.csv"');
            
            echo $this->exportcsv($query,1);            
            
        }
        function showExportTableExcell(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $fileName = isset($_REQUEST['filename']) ? $_REQUEST['filename'] : "Export_Data";
            $report_query = $this->showData($id);
            $query = $this->getQueryGenerate($report_query);

            //echo $query;
            header("Content-Type:application/vnd.ms-excell",true);                
            header("Content-Disposition: attachment; filename=\"$fileName.xls\"");
            
            echo $this->generatetableviewExcel($query,$report_query->getTotal(),$report_query->getSubtotal());   
            
        }
        
        function getQueryGenerate($report_query,$param1="") {
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $parameter1 = isset($_REQUEST['parameter1']) ?  $_REQUEST['parameter1'] : $param1;
            $parameter2 = isset($_REQUEST['parameter2']) ?  $_REQUEST['parameter2'] : "";
            $parameter3 = isset($_REQUEST['parameter3']) ?  $_REQUEST['parameter3'] : "";
            $parameter4 = isset($_REQUEST['parameter4']) ?  $_REQUEST['parameter4'] : "";
            $parameter5 = isset($_REQUEST['parameter5']) ?  $_REQUEST['parameter5'] : "";
            $parameter6 = isset($_REQUEST['parameter6']) ?  $_REQUEST['parameter6'] : "";
            $parameter7 = isset($_REQUEST['parameter7']) ?  $_REQUEST['parameter7'] : "";
            $parameter8 = isset($_REQUEST['parameter8']) ?  $_REQUEST['parameter8'] : "";
            $parameter9 = isset($_REQUEST['parameter9']) ?  $_REQUEST['parameter9'] : "";
            $parameter10 = isset($_REQUEST['parameter10']) ?  $_REQUEST['parameter10'] : "";            
            $parameter11 = isset($_REQUEST['parameter11']) ?  $_REQUEST['parameter11'] : "";            
            $parameter12 = isset($_REQUEST['parameter12']) ?  $_REQUEST['parameter12'] : "";            
            $parameter13 = isset($_REQUEST['parameter13']) ?  $_REQUEST['parameter13'] : "";            
            $parameter14 = isset($_REQUEST['parameter14']) ?  $_REQUEST['parameter14'] : "";            
            $parameter15 = isset($_REQUEST['parameter15']) ?  $_REQUEST['parameter15'] : "";            
            
            $query = $report_query->getQuery();
            
            $query = str_replace("<<parameter1>>", $parameter1, $query);
            $query = str_replace("<<parameter2>>", $parameter2, $query);
            $query = str_replace("<<parameter3>>", $parameter3, $query);
            $query = str_replace("<<parameter4>>", $parameter4, $query);
            $query = str_replace("<<parameter5>>", $parameter5, $query);
            $query = str_replace("<<parameter6>>", $parameter6, $query);
            $query = str_replace("<<parameter7>>", $parameter7, $query);
            $query = str_replace("<<parameter8>>", $parameter8, $query);
            $query = str_replace("<<parameter9>>", $parameter9, $query);
            $query = str_replace("<<parameter10>>", $parameter10, $query);
            $query = str_replace("<<parameter11>>", $parameter11, $query);
            $query = str_replace("<<parameter12>>", $parameter12, $query);
            $query = str_replace("<<parameter13>>", $parameter13, $query);
            $query = str_replace("<<parameter14>>", $parameter14, $query);
            $query = str_replace("<<parameter15>>", $parameter15, $query);
            
            $order_concat = ''; //$report_query->getOrder_concat();
            $order_by_col_1 = ''; //$report_query->getOrder_by_col_1();
            $order_by_col_2 = ''; //$report_query->getOrder_by_col_2();
            $order_by_col_3 = ''; //$report_query->getOrder_by_col_3();
            if($report_query->getCrosstab() == 1){
                $ct = new CrossTab($this->dbh);
                $fields = $ct->getFields($query);
                $query = $ct->getCrossTab($fields, $query, $report_query->getStyle(), $order_concat, $order_by_col_1, $order_by_col_2, $order_by_col_3) ;
            }
            echo $query;
            return $query;
        }
        
        function showHeader(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $report_query = $this->showData($id);
                        
            $m_user = new master_user();
            $m_userCtrl = new master_userController($m_user, $this->dbh);
            $userDeptId = $m_userCtrl->getUserDeptId();
            $userUnitId = $m_userCtrl->getUserUnitId();
            
            $master_user_detail = new master_user_detail();
            $master_user_detailCtrl = new master_user_detailController($master_user_detail, $this->dbh);
            $user_detail_list = $master_user_detailCtrl->showDataByUser($this->user);
            
            $master_group = new master_group();
            $master_groupCtrl = new master_groupController($master_group, $this->dbh);
            $group_list_ = $master_groupCtrl->showData($user_detail_list->getGroupcode());
            
            $master_yayasan = new master_unit();
            $master_yayasanCtrl = new master_unitController($master_yayasan, $this->dbh);
            $yayasan_list_ = $master_yayasanCtrl->showDataAllByCabang($userUnitId);
            
            $master_kelas = new master_department();
            $master_kelasCtrl = new master_departmentController($master_kelas, $this->dbh);
            $kelas_list_ = $master_kelasCtrl->showDataAllByRanting($userDeptId);
            
            $master_kelompok = new master_kelompok();
            $master_kelompokCtrl = new master_kelompokController($master_kelompok, $this->dbh);
            $kelompok_list_ = $master_kelompokCtrl->showDataByUnitByDept($userUnitId, $userDeptId);
            
            $master_level = new master_level();
            $master_levelCtrl = new master_levelController($master_level, $this->dbh);
            $level_list_ = $master_levelCtrl->showDataAll();
            
            require_once './views/report_query/'.$report_query->getHeader();            
        }
        
	function exportcsv($sql,$sumall=0,$rowstart = 0){	
            $result = $this->dbh->query($sql);
            
            $csv_terminated = "\n";
            $csv_separator = ";";
            $csv_enclosed = '"';
            $csv_escaped = "\\";
	
            $schema_insert = '';
            $fields_cnt = $result->columnCount();
            if ($rowstart==0){
                for ($i = 0; $i < $fields_cnt; $i++){
                    $col = $result->getColumnMeta($i);
                    $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
                    stripslashes($col['name'])) . $csv_enclosed;
                    $schema_insert .= $l;
                    $schema_insert .= $csv_separator;
                } // end for

                $out = trim(substr($schema_insert, 0, -1));
                $out .= $csv_terminated;
            }
	
            $arraysum = array();	
            // Format the data
            $jmlRow = $result->rowCount();
            if($jmlRow > 0){
                foreach ($result as $row) {
                        $schema_insert = '';
                        for ($j = 0; $j < $fields_cnt; $j++){
                            $val = 0;
                            if (is_numeric($row[$j])){
                                $val = (float) $row[$j];
                            }
                            if(!isset($arraysum[$j])) {                    
                                $arraysum[$j] = null;
                            }
                            $arraysum[$j] += $val;
                            $schema_insert .= is_string($row[$j]) == true ? $csv_enclosed.(strtoupper($row[$j])).$csv_enclosed : $row[$j] ;
                            $schema_insert .= $csv_separator;	
                        } // end for

                        $out .= $schema_insert;
                        $out .= $csv_terminated;		
                } // end while
                
                $rowcount = "";
                if($sumall == 1) {
                    for($i=0; $i<count($arraysum); $i++){	
                        if ($i>0){
                            $rowcount .=  ($arraysum[$i]==0?"": $arraysum[$i]) .$csv_separator  ;
                        }else{
                            $rowcount .= $csv_separator;
                        }
                    }
                }
                $out .= $rowcount; 
            } else {
                $out .= "Tidak Ada Data Yang Ditampilkan.";
            }
            
            return $out ;
	}
        
	function generatetableview($sql, $sumall=0, $subtotal = 0, $rowstart = 0 ){	           
            //echo $sql;            
            $openDiv = "<div class=\"table-responsive\">";
            $closeDiv = "</div>";
            $opentable = "<table class=\"table-bordered1\"  width=\"100%\" >";
            $closetable = "</table>";
            $opentrheader = "<tr bgcolor=\"#E9F3F1\">";
            $opentr1 = "<tr bgcolor=\"#E1EDF4\">";
            $opentr2 = "<tr bgcolor=\"#F0F0F0\">";
            $closetr ="</tr>";
            $opentd = "<th height=\"30\" bgcolor=\"#EAEAE9\" class=\"DefaultBrownBold\">";
            $closetd = "</th>";
            $btnExport = "";
            $result = $this->dbh->query($sql);            
            $fields_cnt = $result->columnCount();
            $schema_insert = '';
            $headertr = "";
            if ($rowstart==0){
                $headertr = $opentrheader;
                for ($i = 0; $i < $fields_cnt; $i++){
                    $col = $result->getColumnMeta($i);
                    $headertr .=  $opentd . $col["name"]. $closetd;
                } // end for
                $headertr .= $closetr;	
            }	
            $arraysum = array($fields_cnt);	
            // Format the data
            $jmlRow = $result->rowCount();            
            $detail = "";
            $no = 1;  
            
            echo $jmlRow > 0 ? "<p style='text-align:center;text-transform:uppercase;'>Jumlah data yang ditampilkan berjumlah <b>".$jmlRow."</b> baris</p>" : "";
            
            $arraysub = array($fields_cnt);	
            $subfirst = ""; 
            $browfirst = true;
            $browfirst_span =  true;
            if($jmlRow > 0){
                foreach ($result as $row) {
                    $pi = $no + 1;
                    $detailtr = ($pi%2 != 0) ? $opentr1 : $opentr2;
                    $schema_insert = '';                   
                    $bsubfirst = false;

                    // Menampilkan subtotal group by kolom 1
                    if($subtotal == 1) {
                        if($subfirst != $row[0]) {
                            $subfirst = $row[0];
                            if ($browfirst == true) {
                                $bsubfirst = false; 
                                $browfirst = false;
                            }else{
                                $bsubfirst = true;
                            }
                            $browfirst_span =  true;
                        } else {
                            $browfirst_span = false;
                        }
                        if ($bsubfirst) {
                            $detailtr .= $closetr;												
                            $detailtr .= "<tr bgcolor=\"#CCCCCC\">";  
                            for($k=0; $k<$fields_cnt; $k++){	
                                if ($k>0){
                                    $q = number_format($arraysub[$k],2) == 0 ? "" : number_format($arraysub[$k],2);
                                }else{
                                    $q = "Sub Total";                                    
                                }
                                $detailtr .= "<td height=\"25\" align=\"right\" class=\"DefaultBold\">".($q)."</td>";					
                                $arraysub[$k] = 0;
                            }
                            $detailtr .= $closetr;												
                            $bsubfirst = false;
                        }
                    }
                    // End Menampikan subtotal group by kolom 1
                    
                    for ($j = 0; $j < $fields_cnt; $j++){
                        $col = $result->getColumnMeta($j);
                        $val = 0;
                        if ($j>0){
                            if(is_numeric($row[$col['name']])){
                                $val = (float) $row[$col['name']];
                            }
                        }
                        if(!isset($arraysum[$j])) {                    
                            $arraysum[$j] = null;
                            $arraysub[$j] = null;
                        }
                        $arraysum[$j] += $val;
                        $arraysub[$j] += $val;
                        
                        if($j == 0){
                            $isidetail = "<td align=\"left\" class=\"Default\">".($browfirst_span ? $row[$col['name']] : "")."</td>";
                        } else if (is_numeric($row[$col['name']]) && $j > 0) {
                            $isidetail = "<td align=\"right\" class=\"Default\">".number_format($row[$col['name']],2)."</td>";
                        }else{
                            $isidetail = "<td align=\"left\" class=\"Default\">".($row[$col['name']])."</td>";
                        }
                        $detailtr .= $isidetail;
                        
                        
                    } // end for
                    $detailtr .= $closetr;												
                    $detail .= $detailtr;
                    $no++;
                } // end while	
                
                // Menampikan subtotal group by kolom 1
                if($subtotal == 1) {
                    //$detailtr .= $closetr;												
                    $detailtr = "<tr bgcolor=\"#CCCCCC\">";                                
                    for($k=0; $k<$fields_cnt; $k++){	
                        if ($k>0){
                            $q = number_format($arraysub[$k],2) == 0 ? "" : number_format($arraysub[$k],2);
                        }else{
                            $q = "Sub Total ";                                    
                        }
                        $detailtr .= "<td height=\"25\" align=\"right\" class=\"DefaultBold\">".($q)."</td>";					
                        $arraysub[$k] = 0;
                    }                              
                    //$detailtr .= $closetr;												
                    $detail .= $detailtr;
                }            
                // End Menampikan subtotal group by kolom 1
                
                $total = "";		
                $q = "";
                $gtotal = "";
                $out = "";
                if($sumall==1) {
                    $total = "<tr bgcolor=\"#CCCCCC\">";
                    for($i=0; $i<$fields_cnt; $i++){	
                        if ($i>0){
                            $q = number_format($arraysum[$i],2) == 0 ? "" : number_format($arraysum[$i],2);
                        }else{
                            if($arraysum[0]){
                                $q = "Total";
                            } else {
                                $q = "&nbsp;";
                            }
                        }
                        $total .= "<td height=\"25\" align=\"right\" class=\"DefaultBold\">".($q)."</td>";					
                    }
                    $total .= "</tr>";
                    $gtotal .= $total;
                }
                $schema_insert = $openDiv.$opentable.$headertr.$detail.$gtotal.$closetable.$btnExport.$closeDiv;
                $out .= $schema_insert;			
            } else {
                $out = "Tidak Ada Data Yang Ditampilkan.";
            }
            
            return $out;
	}        
        
        function generatetableviewExcel($sql, $sumall=0, $subtotal = 0, $rowstart = 0 ){	           
            $opentable = "<table width=\"95%\" >";
            $closetable = "</table>";
            $opentrheader = "<tr>";
            $opentr1 = "<tr>";
            $opentr2 = "<tr>";
            $closetr ="</tr>";
            $opentd = "<th height=\"30\">";
            $closetd = "</th>";
            $btnExport = "";
            $result = $this->dbh->query($sql);
            $fields_cnt = $result->columnCount();
            $schema_insert = '';
            $headertr = "";
            if ($rowstart==0){
                $headertr = $opentrheader;
                for ($i = 0; $i < $fields_cnt; $i++){
                    $col = $result->getColumnMeta($i);
                    $headertr .=  $opentd . $col["name"]. $closetd;
                } // end for
                $headertr .= $closetr;	
            }	
            $arraysum = array($fields_cnt);	
            // Format the data
            $jmlRow = $result->rowCount();
            $detail = "";
            $no = 1;  
            
            $arraysub = array($fields_cnt);	
            $subfirst = ""; 
            $browfirst = true;
            $browfirst_span =  true;
            if($jmlRow > 0){
                foreach ($result as $row) {
                    $pi = $no + 1;
                    $detailtr = ($pi%2 != 0) ? $opentr1 : $opentr2;
                    $schema_insert = '';                   
                    $bsubfirst = false;

                    // Menampilkan subtotal group by kolom 1
                    if($subtotal == 1) {
                        if($subfirst != $row[0]) {
                            $subfirst = $row[0];
                            if ($browfirst == true) {
                                $bsubfirst = false; 
                                $browfirst = false;
                            }else{
                                $bsubfirst = true;
                            }
                            $browfirst_span =  true;
                        } else {
                            $browfirst_span = false;
                        }
                        if ($bsubfirst) {
                            $detailtr .= $closetr;												
                            $detailtr .= "<tr>";  
                            for($k=0; $k<$fields_cnt; $k++){	
                                if ($k>0){
                                    $q = number_format($arraysub[$k],2) == 0 ? "" : number_format($arraysub[$k],2);
                                }else{
                                    $q = "Sub Total";                                    
                                }
                                $detailtr .= "<td height=\"25\" align=\"right\">".($q)."</td>";					
                                $arraysub[$k] = 0;
                            }
                            $detailtr .= $closetr;												
                            $bsubfirst = false;
                        }
                    }
                    // End Menampikan subtotal group by kolom 1
                    
                    for ($j = 0; $j < $fields_cnt; $j++){
                        $col = $result->getColumnMeta($j);
                        $val = 0;
                        if ($j>0){
                            if(is_numeric($row[$col['name']])){
                                $val = (float) $row[$col['name']];
                            }
                        }
                        if(!isset($arraysum[$j])) {                    
                            $arraysum[$j] = null;
                            $arraysub[$j] = null;
                        }
                        $arraysum[$j] += $val;
                        $arraysub[$j] += $val;
                        
                        if($j == 0){
                            $isidetail = "<td align=\"left\">".($browfirst_span ? $row[$col['name']] : "")."</td>";
                        } else if (is_numeric($row[$col['name']]) && $j > 0) {
                            $isidetail = "<td align=\"right\">".number_format($row[$col['name']],2)."</td>";
                        }else{
                            $isidetail = "<td align=\"left\">".($row[$col['name']])."</td>";
                        }
                        $detailtr .= $isidetail;
                        
                        
                    } // end for
                    $detailtr .= $closetr;												
                    $detail .= $detailtr;
                    $no++;
                } // end while	
                
                // Menampikan subtotal group by kolom 1
                if($subtotal == 1) {
                    //$detailtr .= $closetr;												
                    $detailtr = "<tr>";                                
                    for($k=0; $k<$fields_cnt; $k++){	
                        if ($k>0){
                            $q = number_format($arraysub[$k],2) == 0 ? "" : number_format($arraysub[$k],2);
                        }else{
                            $q = "Sub Total ";                                    
                        }
                        $detailtr .= "<td height=\"25\" align=\"right\">".($q)."</td>";					
                        $arraysub[$k] = 0;
                    }                              
                    //$detailtr .= $closetr;												
                    $detail .= $detailtr;
                }            
                // End Menampikan subtotal group by kolom 1
                
                $total = "";		
                $q = "";
                $gtotal = "";
                $out = "";
                if($sumall==1) {
                    $total = "<tr>";
                    for($i=0; $i<$fields_cnt; $i++){	
                        if ($i>0){
                            $q = number_format($arraysum[$i],2) == 0 ? "" : number_format($arraysum[$i],2);
                        }else{
                            if($arraysum[0]){
                                $q = "Total";
                            } else {
                                $q = "&nbsp;";
                            }
                        }
                        $total .= "<td height=\"25\" align=\"right\">".($q)."</td>";					
                    }
                    $total .= "</tr>";
                    $gtotal .= $total;
                }
                $schema_insert = $opentable.$headertr.$detail.$gtotal.$closetable.$btnExport;
                $out .= $schema_insert;			
            } else {
                $out = "Tidak Ada Data Yang Ditampilkan.";
            }
            
            return $out;
	}        
        
        function generateDetailReport($sql, $sumall=0, $rowstart = 0){
            $iconClose = "<table align=\"center\"><tr><td><image src=\"images/icon-close.png\" onclick=\"closePopup()\"></td></tr></table>";
            $openDiv = "<div class=\"PreviewBox\" align=\"center\">";
            $closeDiv = "</div>";
            $openTable = "<table width=\"100%\" class=\"table-bordered2\">";
            $closeTable = "</table>";
            $opentrheader = "<tr bgcolor=\"#E9F3F1\">";
            $opentr1 = "<tr bgcolor=\"#E1EDF4\">";
            $opentr2 = "<tr bgcolor=\"#F0F0F0\">";
            $closetr ="</tr>";
            $openth = "<th height=\"30\" bgcolor=\"#EAEAE9\">";
            $closeth = "</th>";
            $btnExport = "<table align=\"center\"><tr><td><input type=\"button\" value=\"Export Data\" class=\"btn BtnBlue\"></td></td></table>";
            $result = $this->dbh->query($sql);            
            $fields_cnt = $result->columnCount();
            $schema_insert = '';
            $headertr = "";
            if ($rowstart==0){
                $headertr = $opentrheader;
                for ($i = 0; $i < $fields_cnt; $i++){
                    $col = $result->getColumnMeta($i);
                    $headertr .=  $openth . $col["name"]. $closeth;
                } // end for
                $headertr .= $closetr;	
            }	
            $arraysum = array($fields_cnt);	
            // Format the data
            $jmlRow = $result->rowCount();
            $detail = "";
            $no = 1;  
            if($jmlRow > 0){
                foreach ($result as $row) {
                    $pi = $no + 1;
                    $detailtr = ($pi%2 != 0) ? $opentr1 : $opentr2;
                    $schema_insert = '';                               
                    for ($j = 0; $j < $fields_cnt; $j++){
                        $col = $result->getColumnMeta($j);
                        $val = 0;
                        if ($j>0){
                            if(is_numeric($row[$col['name']])){
                                $val = (float) $row[$col['name']];
                            }
                        }
                        if(!isset($arraysum[$j])) {                    
                            $arraysum[$j] = null;
                        }
                        $arraysum[$j] += $val;

                        if (is_numeric($row[$j]) && $j > 0) {
                            $isidetail = "<td align=\"right\" class=\"Default\">".number_format($row[$col['name']],2)."</td>";
                        }else{
                            $isidetail = "<td align=\"left\" class=\"Default\">".($row[$col['name']])."</td>";
                        }
                        $detailtr .= $isidetail;				
                    } // end for
                    $detailtr .= $closetr;												
                    $detail .= $detailtr;                    
                    $no++;                    
                } // end while	

                $total = "";		
                $q = "";
                $gtotal = "";
                $out = "";
                if($sumall==1) {
                    $total = "<tr bgcolor=\"#CCCCCC\">";
                    for($i=0; $i<$fields_cnt; $i++){	
                        if ($i>0){
                            $q = number_format($arraysum[$i],2) == 0 ? "" : number_format($arraysum[$i],2);
                        }else{
                            if($arraysum[0]){
                                $q = "Total";
                            } else {
                                $q = "&nbsp;";
                            }
                        }
                        $total .= "<td height=\"25\" align=\"right\" class=\"DefaultBold\">".($q)."</td>";					
                    }
                    $total .= "</tr>";
                    $gtotal .= $total;
                }
                $title = "<center><h3>DETAIL REPORT ".strtoupper($row[1])."</h3></center>";
                $schema_insert = $iconClose.$openDiv.$title.$openTable.$headertr.$detail.$gtotal.$closeTable.$btnExport.$closeDiv;
                $out .= $schema_insert;			
            } else {
                $out = "Tidak Ada Data Yang Ditampilkan.";
            }
            
            return $out;
        }
        
        function showBSC(){
            $storeDB = $_REQUEST['db'];
            $a = array();
            $qry = "SELECT user_number,user_fullname FROM $storeDB.user_info a WHERE a.user_type_id IN (3,5,6,10) AND a.user_status='1' ORDER BY a.user_fullname;";
            $result = $this->dbh->query($qry);
            foreach ($result as $row) {
                $a[] = $row;
            }
            
            require_once './views/report_query/listBSC.php';
        }
        
        function showDetailReportJQuery(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $parameter1 = isset($_REQUEST['parameter1']) ?  $_REQUEST['parameter1'] : "";
            $parameter2 = isset($_REQUEST['parameter2']) ?  $_REQUEST['parameter2'] : "";
            $parameter3 = isset($_REQUEST['parameter3']) ?  $_REQUEST['parameter3'] : "";
            $parameter4 = isset($_REQUEST['parameter4']) ?  $_REQUEST['parameter4'] : "";
            $parameter5 = isset($_REQUEST['parameter5']) ?  $_REQUEST['parameter5'] : "";
            $parameter6 = isset($_REQUEST['parameter6']) ?  $_REQUEST['parameter6'] : "";
            $parameter7 = isset($_REQUEST['parameter7']) ?  $_REQUEST['parameter7'] : "";
            $parameter8 = isset($_REQUEST['parameter8']) ?  $_REQUEST['parameter8'] : "";
            $parameter9 = isset($_REQUEST['parameter9']) ?  $_REQUEST['parameter9'] : "";
            $parameter10 = isset($_REQUEST['parameter10']) ?  $_REQUEST['parameter10'] : "";
            
            
            $report_query = $this->showData($id);
            $query = $report_query->getQuery();
            
            $query = str_replace("<<parameter1>>", $parameter1, $query);
            $query = str_replace("<<parameter2>>", $parameter2, $query);
            $query = str_replace("<<parameter3>>", $parameter3, $query);
            $query = str_replace("<<parameter4>>", $parameter4, $query);
            $query = str_replace("<<parameter5>>", $parameter5, $query);
            $query = str_replace("<<parameter6>>", $parameter6, $query);
            $query = str_replace("<<parameter7>>", $parameter7, $query);
            $query = str_replace("<<parameter8>>", $parameter8, $query);
            $query = str_replace("<<parameter9>>", $parameter9, $query);
            $query = str_replace("<<parameter10>>", $parameter10, $query);

            echo $this->generateDetailReport($query,1);
        }
        
        function report_brand_achievement(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;            
            $report_query = $this->showData($id);            
            $queryAchieve = $this->getQueryGenerate($report_query);
            
            require_once './views/report_query/monthly_brand_achievement_detail.php';
        }
        
        function exportExcelreport_brand_achievement(){
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;            
            $report_query = $this->showData($id);            
            $queryAchieve = $this->getQueryGenerate($report_query);
            
            require_once './views/report_query/export_excel_monthly_brand_achieve.php';
        }
        
        function report_mutasi_stock_harian(){
            require_once './views/report_query/mutasi_stock_harian_detail.php';
        }
        
        function showStockCard(){
            require_once './views/report_query/kartu_stock_produk.php';
        }
        
        function exportExcellreport_mutasi_stock_harian(){
            require_once './views/report_query/export_mutasi_stock_harian_detail.php';
        }                
        
        function showSummaryByKel($idreport,$param1=0){
            $report_query = $this->showData($idreport);
            
            $sql = $this->getQueryGenerate($report_query, $param1);
            $result = $this->dbh->query($sql);
            
            return $result;
        }
        
        function reportSummaryByUsia(){
            $result_a = $this->showSummaryByKel(1);
            $result_b = $this->showSummaryByKel(2);
            $result_c = $this->showSummaryByKel(3);
            $result_d = $this->showSummaryByKel(10);
            
            require_once './views/report_query/ReportSummaryByUsiaAll.php';
        }
        
        function reportSummaryByUsiaByDept(){
            $user = $this->user;
            
            $m_user = new master_user();
            $m_userCtrl = new master_userController($m_user, $this->dbh);
            $userDeptId = $m_userCtrl->getUserDeptId();            
            
            $m_dept = new master_department();
            $m_deptCtrl = new master_departmentController($m_dept, $this->dbh);
            $deptList = $m_deptCtrl->showDataAllByRanting($userDeptId);
            
            $param1 = isset($_REQUEST['parameter1']) ? $_REQUEST['parameter1'] : $userDeptId;
            
            $result_a = $this->showSummaryByKel(4,$param1);
            $result_b = $this->showSummaryByKel(5,$param1);
            $result_c = $this->showSummaryByKel(6,$param1);
            $result_d = $this->showSummaryByKel(11,$param1);
            
            require_once './views/report_query/ReportSummaryByUsiaByDept.php';
        }
        
        function reportSummaryByGender(){
            $user = $this->user;
            
            $m_user = new master_user();
            $m_userCtrl = new master_userController($m_user, $this->dbh);
            $userDeptId = $m_userCtrl->getUserDeptId();            
            
            $m_dept = new master_department();
            $m_deptCtrl = new master_departmentController($m_dept, $this->dbh);
            $deptList = $m_deptCtrl->showDataAllByRanting($userDeptId);
            
            $param1 = isset($_REQUEST['parameter1']) ? $_REQUEST['parameter1'] : $userDeptId;
            
            $result_a = $this->showSummaryByKel(7,$param1);
            $result_b = $this->showSummaryByKel(8,$param1);
            $result_c = $this->showSummaryByKel(9,$param1);
            
            require_once './views/report_query/ReportSummaryByGender.php';
        }
    }
?>
