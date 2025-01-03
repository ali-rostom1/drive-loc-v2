<?php
    require_once __DIR__."../../../../vendor/autoload.php";
    use App\classes\User;


    $user = new User();
    $user->logout();
?>