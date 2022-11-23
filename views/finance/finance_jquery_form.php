<script language="javascript" type="text/javascript">
    /*(function() {
        $('form').ajaxForm({
            beforeSubmit: function() {
            },
            complete: function(xhr) {
                    alert($.trim(xhr.responseText));
                    showMenu('content', 'index.php?model=finance&action=showAllJQuery&skip=<?php echo $skip ?>&search=<?php echo $search ?>');
            }
         });
    })();
    function validate(evt){
        var e = evt || window.event;
        var key = e.keyCode || e.which;
        if((key <48 || key >57) && !(key ==8 || key ==9 || key ==13  || key ==37  || key ==39 || key ==46)  ){
            e.returnValue = false;
            if(e.preventDefault)e.preventDefault();
        }
    }*/
    function myFunction() {
        var input, filter, table, tr, td,td3 , i;
        input = document.getElementById("search_");
        filter = input.value.toUpperCase();
        table = document.getElementById("mytable_t1");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            td3 = tr[i].getElementsByTagName("td")[2];

            if (td) {
                if ((td.innerHTML.toUpperCase().indexOf(filter)> -1 || td3.innerHTML.toUpperCase().indexOf(filter)> -1)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function simpanDataDtl(no){
        var noAnggota = document.getElementById('noAnggota'+no).value;
        var nmAnggota = document.getElementById('nmAnggota'+no).value;
        var id = document.getElementById('id'+no).value;
        var infaq = document.getElementById('infaq'+no);
        var zakat = document.getElementById('zakat'+no);
        var external = document.getElementById('external'+no);        
        var infaqVal = (infaq.checked) ? "Y" : "T";
        var zakatVal = (zakat.checked) ? "Y" : "T";
        var externalVal = (external.checked) ? "Y" : "T";
        showMenu('lblSts'+no,'index.php?model=finance&action=simpanData&id='+id+'&noAnggota='+noAnggota+'&nmAnggota='+nmAnggota
        +'&infaq='+infaqVal+'&zakat='+zakatVal+'&external='+externalVal);
    }
</script>
<style>
    .titleCol {
        text-align: center;
        height: 40px;
        background-color: #bfbebb;
        vertical-align: middle;
    }
    
    .tbl-form {
        width: 97%;
        margin: center;
        background-color: #00000;
    }
    
    .tbl-form td {
        height: 35px;
        border-bottom: solid grey 1px;
    }
</style>

<div style="margin-bottom: 10px;">
    <input onkeyup="myFunction();" placeholder="Cari Berdasarkan No. Anggota atau Nama Anggota" type="text" class="form-control" style="width:380px;text-align: center" id="search_">
</div>    
<table class="tbl-form" id="mytable_t1">
    <thead>
    <tr>
        <th width="5%" class="titleCol">NO.</th>
        <th width="7%" class="titleCol">NO. ANGGOTA</th>
        <th width="40%" class="titleCol">NAMA ANGGOTA</th>
        <th width="7%" class="titleCol">UNIT</th>
        <th width="7%" class="titleCol">DEPT</th>
        <th width="5%" class="titleCol">IFQ</th>
        <th width="5%" class="titleCol">ZKT</th>
        <th width="5%" class="titleCol">EXT</th>
        <th width="15%" class="titleCol">KET</th>
        <th width="10%" class="titleCol">#</th>
    </tr>
    </thead>
    <?php
        $no = 0;
        foreach($anggota as $anggotaList){
            $pi = $no + 1;
            $bg = ($pi%2 != 0) ? "#E1EDF4" : "#F0F0F0";

            $unit = $m_unitCtrl->showData($anggotaList->getUnit());
            $dept = $m_deptCtrl->showData($anggotaList->getDepartemen());
            $finVal = $this->showDataByPeriodByAnggota($bulan,$tahun,$anggotaList->getNoAnggota());
            $stsKlg = $m_sts_klgCtrl->showData($anggotaList->getStsKeluarga());
            $labelStsKlg = ($anggotaList->getStsKeluarga()==1 || $anggotaList->getStsKeluarga()==2) ? "<b><i>(".$stsKlg->getStatus_keluarga().")</i></b>" : "";
    ?>
    <tr bgcolor="<?php echo $bg;?>" id="tr<?php echo ($no+1); ?>">
        <td align="center">
            <?php echo ($no+1);?>
            <input type="hidden" name="id[]" id="id<?php echo $no;?>" value="<?php echo ($finVal->getId() !="") ? $finVal->getId() : 0;?>">
        </td>
        <td align="center">
            <?php echo $anggotaList->getNoAnggota();?>
            <input type="hidden" name="noAnggota[]" id="noAnggota<?php echo $no;?>" value="<?php echo $anggotaList->getNoAnggota();?>">
        </td>                        
        <td align="left">
            <?php echo $anggotaList->getNamaAnggota()." ".$labelStsKlg;?>
            <input type="hidden" name="nmAnggota[]" id="nmAnggota<?php echo $no;?>" value="<?php echo $anggotaList->getNamaAnggota();?>">
        </td>
        <td align="center"><?php echo $unit->getDescription();?></td>
        <td align="center"><?php echo $dept->getDescription();?></td>
        <td align="center"><input type="checkbox" name="infaq[]" id="infaq<?php echo $no;?>" style="cursor: pointer" <?php echo ($finVal->getInfaq()=="Y") ? "checked" : "";?>></td>
        <td align="center"><input type="checkbox" name="zakat[]" id="zakat<?php echo $no;?>" style="cursor: pointer" <?php echo ($finVal->getZakat()=="Y") ? "checked" : "";?>></td>
        <td align="center"><input type="checkbox" name="external[]" id="external<?php echo $no;?>" style="cursor: pointer" <?php echo ($finVal->getExternal()=="Y") ? "checked" : "";?>></td>
        <td align="center">
            <div id="lblSts<?php echo $no;?>"></div>
        </td>
        <td align="center">
            <input type="button" name="BtnSubmit" class="BtnBlue" value="SIMPAN" onclick="simpanDataDtl('<?php echo $no;?>')">
        </td>
    </tr>
    <?php
            $no++;
        }
    ?>
</table>
<br>
<br>

