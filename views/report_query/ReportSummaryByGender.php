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

<div style="text-align: center; width: 90%;">
    <h3>LAPORAN REKAP ANGGOTA BERDASARKAN KELOMPOK GENDER</h3>
    <div style="margin: auto; width: 50%">    
        <table class="tbl-report" width="100%">
            <tr>
                <td colspan="7"><h3 class="title-report">Semua Kelompok (Laki-laik & Perempuan)</h3></td>
            </tr>        
            <tr bgcolor="#d8eff2">
                <td class="col-title" width="25%">KELAS</td>
                <td class="col-title" width="10%">PRA</td>
                <td class="col-title" width="10%">0</td>
                <td class="col-title" width="10%">1</td>
                <td class="col-title" width="10%">2</td>
                <td class="col-title" width="10%">3</td>
                <td class="col-title" width="25%">TOTAL</td>
            </tr>
            <?php                
                $totAll = 0; 
                $totPra = 0;
                $tot_0 = 0;
                $tot_1 = 0;
                $tot_2 = 0;
                $tot_3 = 0;
                foreach($result_a as $row_a){
                    $totPra += $row_a[5];
                    $tot_0 += $row_a[1];
                    $tot_1 += $row_a[2];
                    $tot_2 += $row_a[3];
                    $tot_3 += $row_a[4];
                    $totAll += ($row_a[1]+$row_a[2]+$row_a[3]+$row_a[4]);
            ?>
            <tr>
                <td align="center"><?php echo $row_a[0];?></td>
                <td align="center"><?php echo $row_a[5];?></td>
                <td align="center"><?php echo $row_a[1];?></td>
                <td align="center"><?php echo $row_a[2];?></td>
                <td align="center"><?php echo $row_a[3];?></td>
                <td align="center"><?php echo $row_a[4];?></td>
                <td align="center"><?php echo ($row_a[1]+$row_a[2]+$row_a[3]+$row_a[4]);?></td>
            </tr>
            <?php
                }
            ?>
            <tr bgcolor="#b5e4eb">
                <td class="col-title">TOTAL</td>
                <td class="col-title"><?php echo $totPra;?></td>
                <td class="col-title"><?php echo $tot_0;?></td>
                <td class="col-title"><?php echo $tot_1;?></td>
                <td class="col-title"><?php echo $tot_2;?></td>
                <td class="col-title"><?php echo $tot_3;?></td>
                <td class="col-title"><?php echo $totAll;?></td>
            </tr>
        </table>
    </div>
    
    <div style="display:inline-block;margin-right: 20px; width: 30%">    
        <table class="tbl-report" width="100%">
            <tr>
                <td colspan="7"><h3 class="title-report">Kelompok Laki-laki</h3></td>
            </tr>        
            <tr bgcolor="#d8eff2">
                <td class="col-title" width="25%">KELAS</td>
                <td class="col-title" width="10%">PRA</td>
                <td class="col-title" width="10%">0</td>
                <td class="col-title" width="10%">1</td>
                <td class="col-title" width="10%">2</td>
                <td class="col-title" width="10%">3</td>
                <td class="col-title" width="25%">TOTAL</td>
            </tr>
            <?php                
                $totAll = 0; 
                $totPra = 0;
                $tot_0 = 0;
                $tot_1 = 0;
                $tot_2 = 0;
                $tot_3 = 0;
                foreach($result_b as $row_b){
                    $totPra += $row_b[5];
                    $tot_0 += $row_b[1];
                    $tot_1 += $row_b[2];
                    $tot_2 += $row_b[3];
                    $tot_3 += $row_b[4];
                    $totAll += ($row_b[1]+$row_b[2]+$row_b[3]+$row_b[4]);
            ?>
            <tr>
                <td align="center"><?php echo $row_b[0];?></td>
                <td align="center"><?php echo $row_b[5];?></td>
                <td align="center"><?php echo $row_b[1];?></td>
                <td align="center"><?php echo $row_b[2];?></td>
                <td align="center"><?php echo $row_b[3];?></td>
                <td align="center"><?php echo $row_b[4];?></td>
                <td align="center"><?php echo ($row_b[1]+$row_b[2]+$row_b[3]+$row_b[4]);?></td>
            </tr>
            <?php
                }
            ?>
            <tr bgcolor="#b5e4eb">
                <td class="col-title">TOTAL</td>
                <td class="col-title"><?php echo $totPra;?></td>
                <td class="col-title"><?php echo $tot_0;?></td>
                <td class="col-title"><?php echo $tot_1;?></td>
                <td class="col-title"><?php echo $tot_2;?></td>
                <td class="col-title"><?php echo $tot_3;?></td>
                <td class="col-title"><?php echo $totAll;?></td>
            </tr>
        </table>
    </div>    
    <div style="display: inline-block; width: 30%;">    
        <table class="tbl-report" width="100%">
            <tr>
                <td colspan="7"><h3 class="title-report">Kelompok Perempuan</h3></td>
            </tr>        
            <tr bgcolor="#d8eff2">
                <td class="col-title" width="25%">KELAS</td>
                <td class="col-title" width="10%">PRA</td>
                <td class="col-title" width="10%">0</td>
                <td class="col-title" width="10%">1</td>
                <td class="col-title" width="10%">2</td>
                <td class="col-title" width="10%">3</td>
                <td class="col-title" width="25%">TOTAL</td>
            </tr>
            <?php                
                $totAll = 0; 
                $totPra = 0;
                $tot_0 = 0;
                $tot_1 = 0;
                $tot_2 = 0;
                $tot_3 = 0;
                foreach($result_c as $row_c){
                    $totPra += $row_c[5];
                    $tot_0 += $row_c[1];
                    $tot_1 += $row_c[2];
                    $tot_2 += $row_c[3];
                    $tot_3 += $row_c[4];
                    $totAll += ($row_c[1]+$row_c[2]+$row_c[3]+$row_c[4]);
            ?>
            <tr>
                <td align="center"><?php echo $row_c[0];?></td>
                <td align="center"><?php echo $row_c[5];?></td>
                <td align="center"><?php echo $row_c[1];?></td>
                <td align="center"><?php echo $row_c[2];?></td>
                <td align="center"><?php echo $row_c[3];?></td>
                <td align="center"><?php echo $row_c[4];?></td>
                <td align="center"><?php echo ($row_c[1]+$row_c[2]+$row_c[3]+$row_c[4]);?></td>
            </tr>
            <?php
                }
            ?>
            <tr bgcolor="#b5e4eb">
                <td class="col-title">TOTAL</td>
                <td class="col-title"><?php echo $totPra;?></td>
                <td class="col-title"><?php echo $tot_0;?></td>
                <td class="col-title"><?php echo $tot_1;?></td>
                <td class="col-title"><?php echo $tot_2;?></td>
                <td class="col-title"><?php echo $tot_3;?></td>
                <td class="col-title"><?php echo $totAll;?></td>
            </tr>
        </table>
    </div>    
</div>
<br><br>