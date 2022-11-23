<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_status_keluarga.class.php';
    require_once './controllers/master_status_keluarga.controller.generate.php';
    if (!isset($_SESSION)){
        session_start();
    }

    class master_status_keluargaController extends master_status_keluargaControllerGenerate
    {

    }
?>
