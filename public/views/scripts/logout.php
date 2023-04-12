<?php
    require_once __DIR__ . '/../../controllers/Auth/AuthController.php';
    $auth = new App\Controller\Auth();
    $auth->logout();    
    header('Location: ../login.php');
    exit;
?>
