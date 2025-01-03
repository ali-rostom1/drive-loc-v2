<?php
    namespace App;
    require_once '../vendor/autoload.php';


    $action = $_GET["action"] ?? "home";
    switch ($action) {
        case 'home':
            header('location: pages/clientPages/home.php');
            break;
        default:
            include 'pages/clientPages/home.php';
            break;
    }
?>

