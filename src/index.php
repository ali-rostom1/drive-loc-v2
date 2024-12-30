<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\User;
    $user = new User();
    $user->name = 'ali';
    echo $user->name;
?>
