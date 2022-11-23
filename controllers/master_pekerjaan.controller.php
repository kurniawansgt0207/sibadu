<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_pekerjaan.class.php';
    require_once './controllers/master_pekerjaan.controller.generate.php';
    if (!isset($_SESSION)){
        session_start();
    }

    class master_pekerjaanController extends master_pekerjaanControllerGenerate
    {

    }
?>
