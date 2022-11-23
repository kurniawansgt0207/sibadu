<?php
    require_once './models/master_user.class.php';
    require_once './controllers/master_user.controller.php';
    require_once './models/master_materi.class.php';
    require_once './controllers/master_materi.controller.generate.php';
    if (!isset($_SESSION)){
        session_start();
    }

    class master_materiController extends master_materiControllerGenerate
    {

    }
?>
