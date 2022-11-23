<style>
    .tbl-report {
        border-collapse: collapse;        
    }
    .col-title {
        font-family: 'Calibri';
        font-size: 16px;
        font-weight: bold;        
        border-bottom: 1px #000 solid;
        border-top: 1px #000 solid;
        padding-top: 5px;
        padding-bottom: 5px;        
    }
    .tbl-report td {
        font-family: 'Calibri';
        font-size: 15px;        
        border-bottom: 1px #000 solid;
        padding-top: 3px;
        padding-bottom: 3px;        
    }
    .title-report {
        font-family: 'Calibri';
        font-size: 20px;        
        font-weight: bold;
        text-align: center;
    }
</style>
<script>
    function showReport(){
        var err = false;
        var param1 = document.getElementById('departemen').value;
        
        if(param1==""){
            alert("Pilih Kelas Dulu...!!!");
            err = true;
            return false;
        }
        if(err == false){
            showMenu('resultReport','index.php?model=report_query&action=reportSummaryByUsiaByDept&parameter1='+param1);            
        }
    }
</script>

<div id="resultReport" style="width: 90%;">
    <h3>LAPORAN REKAP ANGGOTA BERDASARKAN KELOMPOK USIA (KELAS)</h3>    
    <div id="header">
        <table width="30%" align="center">
            <tr>
                <td style="font-size:15px; font-weight: bold">KELAS</td>
                <td>
                    <select name="departemen" id="departemen" class="form-control">
                        <option value="">Pilih Kelas</option>
                        <?php
                            foreach($deptList as $dept){
                                $selected = ($dept->getDepartmentid()==$param1) ? "selected" : "";
                        ?>
                        <option value="<?php echo $dept->getDepartmentid();?>" <?php echo $selected;?>><?php echo $dept->getDescription();?></option>
                        <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="button" class="BtnGreen" value="Lihat Data" onclick="showReport()">
                </td>
            </tr>
        </table>
    </div>
    
    <div style="display:inline-block; margin-right: 20px; width: 30%">    
        <table class="tbl-report" width="100%">
            <tr>
                <td colspan="4"><h3 class="title-report">Kelompok Usia A (12 - 25 Tahun)</h3></td>
            </tr>        
            <tr bgcolor="#e4f3f5">
                <td align="center" class="col-title" width="25%">LEVEL</td>
                <td align="center" class="col-title" width="25%">LAKI-LAKI</td>
                <td align="center" class="col-title" width="25%">PEREMPUAN</td>
                <td align="center" class="col-title" width="25%">TOTAL</td>
            </tr>
            <?php
                $totLK = 0;
                $totPR = 0;
                $totAll = 0;                
                foreach($result_a as $row_a){
                    $totLK += $row_a[1];
                    $totPR += $row_a[3];
                    $totAll += ($row_a[1]+$row_a[3]);
            ?>
            <tr>
                <td align="center"><?php echo $row_a[0];?></td>
                <td align="center"><?php echo $row_a[1];?></td>
                <td align="center"><?php echo $row_a[3];?></td>
                <td align="center"><?php echo ($row_a[1]+$row_a[3]);?></td>
            </tr>
            <?php
                }
            ?>
            <tr bgcolor="#b5e4eb">
                <td align="center" class="col-title">TOTAL</td>
                <td align="center" class="col-title"><?php echo $totLK;?></td>
                <td align="center" class="col-title"><?php echo $totPR;?></td>
                <td align="center" class="col-title"><?php echo $totAll;?></td>
            </tr>
        </table>
    </div>

    <div style="display:inline-block;margin-right: 20px; width: 30%">    
        <table class="tbl-report" width="100%">
            <tr>
                <td colspan="4"><h3 class="title-report">Kelompok Usia B (26 - 40 Tahun)</h3></td>
            </tr>        
            <tr bgcolor="#e4f3f5">
                <td align="center" class="col-title" width="25%">LEVEL</td>
                <td align="center" class="col-title" width="25%">LAKI-LAKI</td>
                <td align="center" class="col-title" width="25%">PEREMPUAN</td>
                <td align="center" class="col-title" width="25%">TOTAL</td>
            </tr>
            <?php
                $totLK = 0;
                $totPR = 0;
                $totAll = 0;
                foreach($result_b as $row_b){
                    $totLK += $row_b[1];
                    $totPR += $row_b[3];
                    $totAll += ($row_b[1]+$row_b[3]);
            ?>
            <tr>
                <td align="center"><?php echo $row_b[0];?></td>
                <td align="center"><?php echo $row_b[1];?></td>
                <td align="center"><?php echo $row_b[3];?></td>
                <td align="center"><?php echo ($row_b[1]+$row_b[3]);?></td>
            </tr>
            <?php
                }
            ?>
            <tr bgcolor="#b5e4eb">
                <td align="center" class="col-title">TOTAL</td>
                <td align="center" class="col-title"><?php echo $totLK;?></td>
                <td align="center" class="col-title"><?php echo $totPR;?></td>
                <td align="center" class="col-title"><?php echo $totAll;?></td>
            </tr>
        </table>
    </div>    
    <div style="display: inline-block; width: 30%;">    
        <table class="tbl-report" width="100%">
            <tr>
                <td colspan="4"><h3 class="title-report">Kelompok Usia C (> 41 Tahun)</h3></td>
            </tr>        
            <tr bgcolor="#e4f3f5">
                <td align="center" class="col-title" width="25%">LEVEL</td>
                <td align="center" class="col-title" width="25%">LAKI-LAKI</td>
                <td align="center" class="col-title" width="25%">PEREMPUAN</td>
                <td align="center" class="col-title" width="25%">TOTAL</td>
            </tr>
            <?php
                $totLK = 0;
                $totPR = 0;
                $totAll = 0;
                foreach($result_c as $row_c){
                    $totLK += $row_c[1];
                    $totPR += $row_c[3];
                    $totAll += ($row_c[1]+$row_c[3]);
            ?>
            <tr>
                <td align="center"><?php echo $row_c[0];?></td>
                <td align="center"><?php echo $row_c[1];?></td>
                <td align="center"><?php echo $row_c[3];?></td>
                <td align="center"><?php echo ($row_c[1]+$row_c[3]);?></td>
            </tr>
            <?php
                }
            ?>
            <tr bgcolor="#b5e4eb">
                <td align="center" class="col-title">TOTAL</td>
                <td align="center" class="col-title"><?php echo $totLK;?></td>
                <td align="center" class="col-title"><?php echo $totPR;?></td>
                <td align="center" class="col-title"><?php echo $totAll;?></td>
            </tr>
        </table>
    </div>
    <div style="display: inline-block; width: 30%;">    
        <table class="tbl-report" width="100%">
            <tr>
                <td colspan="4"><h3 class="title-report">Kelompok Usia D (12 - 35 Tahun)</h3></td>
            </tr>        
            <tr bgcolor="#e4f3f5">
                <td align="center" class="col-title" width="25%">LEVEL</td>
                <td align="center" class="col-title" width="25%">LAKI-LAKI</td>
                <td align="center" class="col-title" width="25%">PEREMPUAN</td>
                <td align="center" class="col-title" width="25%">TOTAL</td>
            </tr>
            <?php
                $totLK = 0;
                $totPR = 0;
                $totAll = 0;
                foreach($result_d as $row_d){
                    $totLK += $row_d[1];
                    $totPR += $row_d[3];
                    $totAll += ($row_d[1]+$row_d[3]);
            ?>
            <tr>
                <td align="center"><?php echo $row_d[0];?></td>
                <td align="center"><?php echo $row_d[1];?></td>
                <td align="center"><?php echo $row_d[3];?></td>
                <td align="center"><?php echo ($row_d[1]+$row_d[3]);?></td>
            </tr>
            <?php
                }
            ?>
            <tr bgcolor="#b5e4eb">
                <td align="center" class="col-title">TOTAL</td>
                <td align="center" class="col-title"><?php echo $totLK;?></td>
                <td align="center" class="col-title"><?php echo $totPR;?></td>
                <td align="center" class="col-title"><?php echo $totAll;?></td>
            </tr>
        </table>
    </div>
</div>
<br><br>