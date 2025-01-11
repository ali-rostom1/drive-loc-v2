<?php

    namespace App\classes;

    class User extends database{
        private $id;
        private $username;
        private $password;
        private $email;
        private $role;

        public function __construct(){
            parent::__construct();
            if(isset($_COOKIE["user_id"])){
                $id = (int)$_COOKIE["user_id"];
                $data = $this->selectWhere("user","id_user",$id);
                $this->id = $data["id_user"];
                $this->email = $data["email_user"];
                $this->username = $data["name_user"];
                $this->role = $data["id_role"] == 2 ? "admin" : "client";
            }
        }
        public function __get($name)
        {
            if(property_exists($this,$name)){
                return $this->$name;
            }
        }
        public function getId(){
            return $this->id;
        }
        public function setters($id,$username,$password,$email){
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }
        public function register(){
            $values = ["name_user"=>$this->username,"email_user"=>$this->email,"password_user"=>password_hash($this->password,PASSWORD_BCRYPT),"id_role"=>1];
           if($this->insert("user",$values)){
                header("location: login.php");
                return "success";
           }else return "incorrect informations";
        }
        public function login(){
            $data = $this->selectWhere("user","email_user",$this->email);
                if(password_verify($this->password,$data["password_user"])){
                    $this->id = $data["id_user"];  
                    setcookie("user_id",$data["id_user"],time() + (86400 * 30),'/');
                    setcookie("isAdmin",$data["id_role"] == 2 ? 1 : 0,time() + (86400 * 30),'/');
                    header("location: /drive-loc-v2/src/");
                    return "success";
                    
                }else{
                    return "incorrect credentials";
                }
        }
        public function isLoggedAsClient(){
            if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]==$this->id && $_COOKIE["isAdmin"]==0){
                return true;
            }else if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]==$this->id && $_COOKIE["isAdmin"]==1){
                header("location: /drive-loc-v2/src/pages/adminPages/adminDashboard.php");
                return false;
            }else{
                header("location: /drive-loc-v2/src/pages/authentification/login.php");
                return false;
            }
        }
        public function isLoggedAsAdmin(){
            if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]==$this->id && $_COOKIE["isAdmin"]==1){
                return true;
            }else if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]==$this->id && $_COOKIE["isAdmin"]==0){
                header("location: /drive-loc-v2/src/");
                return false;
            }else{
                header("location: /drive-loc-v2/src/pages/authentification/login.php");
                return false;
            }
        }
        public function logout(){
            setcookie('isAdmin', '', time() - 3600,'/');
            setcookie('user_id', '', time() - 3600,'/');
            header('location: /drive-loc-v2/src/pages/authentification/login.php');
        }
        public function isLogged(){
            if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]==$this->id && $_COOKIE["isAdmin"]==0){
                header("location: /drive-loc-v2/src/");
                return true;
            }else if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]==$this->id && $_COOKIE["isAdmin"]==1){
                header("location: /drive-loc-v2/src/pages/adminPages/adminDashboard.php");
                return true;
            }else{
                return false;
            }
        }
    }
?>