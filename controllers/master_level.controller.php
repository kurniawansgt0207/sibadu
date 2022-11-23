<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_level.class.php';
    require_once './controllers/master_level.controller.generate.php';
    if (!isset($_SESSION)){
        session_start();
    }

    class master_levelController extends master_levelControllerGenerate
    {

    }
?>
