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
        protected function insert($table,$values){
            $columns = "";
            $placeholders = "";

            foreach($values as $key => $value){
                $columns .= $key . ", ";
                $placeholders .= ":" . $key . ", ";
            }
            $columns = rtrim($columns,", ");
            $placeholders = rtrim($placeholders,", ");

            $sql = "INSERT INTO $table($columns) VALUES($placeholders)";
            $result = $this->con->prepare($sql);

            foreach($values as $key=>$value){
                $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $result->bindValue(":".$key,$value,$type);
            }
            $result->execute();
        }
        protected function update($table,$values,$conditionColumn,$conditionValue){

            $columns = "";

            foreach($values as $key=>$value){
                $columns .= $key . " = :". $key . ",";
            }

            $columns = rtrim($columns,",");

            $sql = "UPDATE $table SET $columns WHERE $conditionColumn = :conditionValue";

            $result = $this->con->prepare($sql);
            
            foreach($values as $ley=>$value){
                $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $result->bindValue(":".$key,$value,$type);
            }
            $type = is_int($conditionValue) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $result->bindValue(":conditionValue",$conditionValue,$type);
            $result->execute();

        }
        protected function deleteAll($table){
            $sql = "SELECT * FROM $table";
            $this->con->query($sql);
        }
        protected function deleteWhere($table,$conditionColumn,$conditionValue){
            $sql = "DELETE FROM $table WHERE $conditionColumn = :conditionValue ;";
            $type = is_int($conditionValue) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":conditionValue",$conditionValue,$type);
            $stmt->execute();
        }

    }

?>
