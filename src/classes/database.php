<?php
    namespace App\classes;
    use PDO;
    use PDOException;

    class database{
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $dbName = "drive_loc";
        public $con;

        public function __construct(){
            try{
                $this->con = new PDO("mysql:host=$this->hostname;dbname=$this->dbName",$this->username,$this->password);
                $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("connection failed : ".$e->getMessage());
            }
        }

    }

?>
