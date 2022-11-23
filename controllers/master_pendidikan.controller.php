<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_pendidikan.class.php';
    require_once './controllers/master_pendidikan.controller.generate.php';
    if (!isset($_SESSION)){
        session_start();
    }

    class master_pendidikanController extends master_pendidikanControllerGenerate
    {

    }
?>
