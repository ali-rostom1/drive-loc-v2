<?php
    require_once __DIR__.'../../../../vendor/autoload.php';
    use App\classes\User;
    if(isset($_GET["login"]) && isset($_POST["email"])){
        $user = new User();
        $user->setters(NULL,NULL,$_POST["password"],$_POST["email"]);
        $user->login();
    }
    if(isset($_GET["register"]) && isset($_POST["email"])){
        $user = new User();
        $user->setters(NULL,$_POST["name"],$_POST["password"],$_POST["email"]);
        $user->register();
    }
    $user = new User();
    var_dump($user);

?>