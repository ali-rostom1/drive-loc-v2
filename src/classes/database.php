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
        protected function selectAll($table){
            $sql = "SELECT * FROM $table";
            $result = $this->con->query($sql);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        protected function selectWhere($table,$conditionColumn,$conditionValue){
            $sql = "SELECT * FROM $table WHERE $conditionColumn = :conditionValue";
            $result = $this->con->prepare($sql);
            $type = is_int($conditionValue) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $result->bindParam(":conditionValue",$conditionValue,$type);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>
