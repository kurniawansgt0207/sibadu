<?php
    ob_start();
    ini_set("diplay_errors",1);
    date_default_timezone_set("Asia/Bangkok");
    include_once './controllers/layout.controller.php';
    include_once './controllers/master_user.controller.php';
    include_once './models/master_user.class.php';
    include_once './controllers/tools.controller.php';
    
    $layout = new layoutController($dbh);
    if(!isset($_SESSION)) {
        session_start();
    }
    
    $timeNow = date("H:i");
        
    
    /*$_SESSION['start_time'] = time();
    
    $logout_redirect_url = "index.php?model=login&action=logOut"; // Set logout URL        

    $timeout = (30 * 24 * 60 * 60); // Converts minutes to seconds for 1 month       
    if (isset($_SESSION['start_time'])) {
        $elapsed_time = time() - $_SESSION['start_time'];        
        if ($elapsed_time >= $timeout) {
            session_destroy();
            header("Location: $logout_redirect_url");
        }
    }*/    
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdn.gravitec.net/storage/316ac1af7fd4592b25a4469129b763c6/client.js" async></script>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo $initial_company->getCompany_name();?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>        
        <?php
            if($initial_company->getBgfile()!=""){
                $fav=$initial_company->getLogo();            
            }else{
                $fav="nologo.png";            
            }
            
            include './views/library.php';
            //include_once './views/css_import.php';
        ?>
        <link rel="shortcut icon" href="./images/<?php echo $fav;?>"/>               
    </head>
    <body class="skin-blue">
        <div id="popup" style="width:80%; height:auto; overflow:auto; padding-bottom:0px; margin-left: auto;"></div>
        <div id="popupimage" style="width:40%; height:auto; overflow:auto; padding-bottom:0px; margin-left: auto;"></div>
            <?php
                $layout->getHeader();
                $layout->getMenuSlider();
            ?>
            <div id="contentmenu"></div>                
            <div id="content" align="center">                  
            <?php
                $layout->getMenuContent();              
            ?>                                                                            
            </div>                
            <div class="clearfix"></div>
            <?php              
                $layout->getFooter();
                
                if (isset($_SESSION[config::$LOGIN_USER])) {                          
                    
                        $userGroup = count($master_group_detail_list) > 0 ? $master_group_detail_list[0]->getGroupcode() : "Admin";                        
                        if($userGroup == "User"){
                            $moduleID = 9;
                        } elseif($userGroup == "Admin_Group" || $userGroup == "Admin_Dakwah" || $userGroup == "Admin_Pembinaan"){
                            $moduleID = 3;
                        } elseif($userGroup == "Admin_Keuangan"){
                            $moduleID = 14;
                        } elseif($userGroup == "Admin"){
                            $moduleID = 2;
                        }
                    
            ?>            
            <script type="text/javascript">
               $("#contentmenu").load('index.php?model=master_module&action=showMenu&id=<?php echo $moduleID;?>');      
            </script>
            <?php                             
                }
            ?>
    </body>
</html>
