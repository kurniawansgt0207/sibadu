<?php
    class CrossTab {
        var $dbh;
        function __construct($dbh) {
            $this->dbh = $dbh;
        }
        function getFields($sql) {        
            $fields = array();
            $result = $this->dbh->query($sql);
            
            $fields_cnt = $result->columnCount();
            for ($i = 0; $i < $fields_cnt; $i++){
                $col = $result->getColumnMeta($i);
                $fields[] = $col['name'];                  
            } 
            
            return $fields;            
        }

        function getCrossTab($fields,$sql,$style,$order_concat,$order_col_1,$order_col_2,$order_col_3) {        
            $FROM = "FROM";
            $GROUP = "GROUP";

            $SQLUP = strtoupper($sql);

            $pos = strpos($SQLUP, "FROM");
            $posgroup = strripos($SQLUP, "GROUP");

            if ($posgroup == 0) {
                $startfrom = substr($sql, $pos );
            }else{
                $startfrom = substr($sql, $pos, $posgroup - $pos );            
            }                	    
            $order_concat = ($order_concat!="")?" ORDER BY ".$order_concat:"";            
            $sqlconcat = "SELECT GROUP_CONCAT(DISTINCT `".$fields[0] ."`".$order_concat.") ".$startfrom;
            //echo $sqlconcat;
            
            $jmlKolom = count($fields);
            $columns =  array();
            foreach ($this->dbh->query($sqlconcat) as $row) {
                $columns = explode(",", str_replace("'","\'",$row[0]));
            }
                        
            $newsql = "\nSELECT ";
            if($jmlKolom == 3){
                $newsql .= ($style==3 || $style==4) ? "\n". $fields[1] : "";    
            } elseif($jmlKolom == 4){
                $newsql .= ($style==3 || $style==4) ? "\n". $fields[1].",".$fields[2] : "";               
            } elseif($jmlKolom == 5){
                $newsql .= ($style==3 || $style==4) ? "\n". $fields[1].",".$fields[2].",".$fields[3] : "";    
            }
            
            $no = 0;
            $fieldCol = "";
            $jmlRow = count($columns);
            foreach ($columns as $column){                 
                $colLabel = str_replace("\'", "'", $column);                                
                $fieldCol .= ($no < $jmlRow-1) ? "`".$colLabel."`," : "`".$colLabel."`";
                
                if($style==3 || $style==4){
                    if($jmlKolom == 3){
                        $newsql .= ",\n SUM(CASE WHEN `$fields[0]` = '$column' THEN $fields[2] ELSE 0 END) `$colLabel` ";
                    } elseif($jmlKolom == 5){
                        $newsql .= ",\n SUM(CASE WHEN `$fields[0]` = '$column' THEN $fields[4] ELSE 0 END) `$colLabel` ";
                    }
                } else {
                    $newsql .= "\n SUM(CASE WHEN `$fields[0]` = '$column' THEN $fields[1] ELSE 0 END) `$colLabel` ";
                    if($no < $jmlRow-1){
                        $newsql .= ",";
                    }                    
                } 
                $no++;
            }
            /*if($jmlKolom == 3){
                $newsql .= ($style==4) ? ",SUM($fields[2]) `Sub Total` " : "";
            } elseif($jmlKolom == 5){
                $newsql .= ($style==4) ? ",SUM($fields[4]) `Sub Total` " : "";
            }*/
            $newsql .= "\n FROM (";
            $newsql .= "\n". $sql;
            $newsql .= "\n) crosstab,(SELECT @ROW:=0) r ";
            if($jmlKolom == 3){
                $newsql .= "\n GROUP BY ".$fields[1]." ORDER BY ".$fields[$order_col_1]; 
            } elseif($jmlKolom == 4){
                $newsql .= "\n GROUP BY ".$fields[1]." ORDER BY ".$fields[$order_col_1].",".$fields[$order_col_2]; 
            } elseif($jmlKolom == 5){
                $newsql .= "\n GROUP BY ".$fields[1]." ORDER BY ".$fields[$order_col_1].",".$fields[$order_col_2].",".$fields[$order_col_3]; 
            }
            
            $numberCol = "@ROW:=@ROW+1 `No`,";
            if($jmlKolom == 3){
                $atas = ($style==3) ? "SELECT ".$fields[1].",".$fieldCol." FROM (" : "SELECT ".$numberCol.$fields[1].",".$fieldCol." FROM (";                 
            } elseif($jmlKolom == 4){
                $atas = ($style==3) ? "SELECT ".$fields[1].",".$fields[2].",".$fieldCol." FROM (" : "SELECT ".$numberCol.$fields[1].",".$fields[2].",".$fieldCol." FROM ("; 
            } elseif($jmlKolom == 5){                                        
                $atas = ($style==3) ? "SELECT ".$fields[1].",".$fields[2].",".$fields[3].",".$fieldCol." FROM (" : "SELECT ".$numberCol.$fields[1].",".$fields[2].",".$fields[3].",".$fieldCol." FROM (";
            }
            $bawah = ") as rs";
            $newsql = $atas.$newsql.$bawah;
            //echo $newsql;
            return $newsql ;
        }
    }
?>
