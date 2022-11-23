<table width="30%" border="0" style="border: #000000 2px 2px 2px 2px; border-collapse: collapse">       
    <tr> 
        <td align="center" colspan="3">                                
            <img src='images_small/<?php echo  $master_profil->getAvatar()  ?>' onClick="openFormImage('index.php?model=master_profil&action=showImageMedium')" > 
            <?php 
            if($bowner) {                        
            ?>
            <br><br>
            <a href ="#uploadphoto" onclick="showMenu('uploadphoto','index.php?model=master_profil&action=formUpload')">[Rubah Foto Profil]</a>
            <br>
            <?php
            }       
            ?> 
            <br>
            <div id="uploadphoto" style="width:100%"></div>
        </td> 
    </tr>

    <tr> 
        <td>             
        </td> 
        <td class="textBold">User</td> 
        <td>: <?php echo $master_user->getUser();?></td>            
    </tr>

    <tr> 
        <td class="textBold">&nbsp;</td> 
        <td class="textBold">Description</td> 
        <td>: <?php echo $master_user->getDescription();?></td>
    </tr>

    <tr> 
        <td class="textBold">&nbsp;</td> 
        <td class="textBold">Full Name</td> 
        <td>: <?php echo $master_user->getUsername();?></td>
    </tr>

    <tr> 
        <td class="textBold">&nbsp;</td> 
        <td class="textBold">NIK</td> 
        <td>: <?php echo $master_profil->getNik();?></td>
    </tr>

    <tr> 
        <td class="textBold">&nbsp;</td> 
        <td class="textBold">Cabang</td> 
        <td>
            : <?php echo "(".$master_profil->getUnitid() .") ".$master_unit_controller->showData($master_profil->getUnitid())->getUnitname() ?>
        </td>
    </tr>        
    
    <tr> 
        <td class="textBold">&nbsp;</td> 
        <td class="textBold">Ranting</td> 
        <td>
            : <?php echo "(".$master_profil->getDepartmentid() .") ".$master_department_controller->showData($master_profil->getDepartmentid())->getDescription() ?>
        </td>

    </tr>
</table>    
<br>
<br>
