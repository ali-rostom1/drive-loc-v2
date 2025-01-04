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
        public function selectAll($table){
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
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        protected function selectAllWhere($table,$conditionColumn,$conditionValue){
            $sql = "SELECT * FROM $table WHERE $conditionColumn = :conditionValue";
            $result = $this->con->prepare($sql);
            $type = is_int($conditionValue) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $result->bindParam(":conditionValue",$conditionValue,$type);
            $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
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
            return $result->execute();
        }
        protected function update($table,$values,$conditionColumn,$conditionValue){

            $columns = "";

            foreach($values as $key=>$value){
                $columns .= $key . " = :". $key . ",";
            }

            $columns = rtrim($columns,",");

            $sql = "UPDATE $table SET $columns WHERE $conditionColumn = :conditionValue";

            $result = $this->con->prepare($sql);
            
            foreach($values as $key=>$value){
                $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $result->bindValue(":".$key,$value,$type);
            }
            $type = is_int($conditionValue) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $result->bindValue(":conditionValue",$conditionValue,$type);
            return $result->execute();

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
        public function selectCountWhere($table,$conditionColumn,$conditionValue){
            $sql = "Select Count(*) as total FROM $table where $conditionColumn = :conditionValue";
            $type = is_int($conditionValue) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":conditionValue",$conditionValue,$type);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
        }
        public function selectLimit($table,$page){
            $offset = ($page-1) * 6;
            $sql = "SELECT * FROM $table LIMIT :offset,6";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":offset",$offset,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getRatingValue($id_user,$id_vehicle){
            $sql = "select r.value_rating as value from vehicle v,user u,rating r,rating_user_relation ru where v.id_vehicle=r.id_vehicle and u.id_user=ru.user_id and ru.rating_id = r.id_rating and u.id_user=:id_user and v.id_vehicle=:id_vehicle;";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id_user",$id_user,PDO::PARAM_INT);
            $stmt->bindParam(":id_vehicle",$id_vehicle,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getRatingId($id_user,$id_vehicle){
            $sql = "select r.id_rating as id from vehicle v,user u,rating r,rating_user_relation ru where v.id_vehicle=r.id_vehicle and u.id_user=ru.user_id and ru.rating_id = r.id_rating and u.id_user=:id_user and v.id_vehicle=:id_vehicle;";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id_user",$id_user,PDO::PARAM_INT);
            $stmt->bindParam(":id_vehicle",$id_vehicle,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function updateRating($id_user,$id_vehicle,$value){
            $sql = "update vehicle v,user u,rating r,rating_user_relation ru set r.value_rating=:value where v.id_vehicle=r.id_vehicle and u.id_user=ru.user_id and ru.rating_id = r.id_rating and u.id_user=:id_user and v.id_vehicle=:id_vehicle;";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id_user",$id_user,PDO::PARAM_INT);
            $stmt->bindParam(":id_vehicle",$id_vehicle,PDO::PARAM_INT);
            $stmt->bindParam(":value",$value,PDO::PARAM_INT);
            $stmt->execute();
        }
        public function insertRating($id_user,$id_vehicle,$value){
            $sql = "insert into rating(value_rating,id_vehicle) values (:value,:id_vehicle)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":value",$value,PDO::PARAM_INT);
            $stmt->bindParam(":id_vehicle",$id_vehicle,PDO::PARAM_INT);
            if($stmt->execute()){
                $rating_id = $this->con->lastInsertId();
                $sql2 = "insert into rating_user_relation(rating_id,user_id) VALUES(:rating_id,:user_id);";
                $stmt2 = $this->con->prepare($sql2);
                $stmt2->bindParam(":rating_id",$rating_id,PDO::PARAM_INT);
                $stmt2->bindParam(":user_id",$id_user,PDO::PARAM_INT);
                $stmt2->execute();
            }
        }
        protected function selectWhereAnd($table, $conditions)
        {
            $sql = "SELECT * FROM $table WHERE ";
            
            $placeholders = [];
            foreach ($conditions as $column => $value) {
                $placeholders[] = "$column =:$column";
            }
            $sql .= implode(" AND ", $placeholders);
        
            
            $result = $this->con->prepare($sql);
        

            foreach ($conditions as $column => $value) {
                $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $result->bindValue(":$column", $value, $type);
            }
        
            
            $result->execute();
        
            
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function getUserRatings($id_user){
            $sql = "select r.value_rating,v.model_vehicle,v.price,v.brand_vehicle,r.id_rating,v.id_vehicle from vehicle v,user u,rating r,rating_user_relation ru where v.id_vehicle=r.id_vehicle and u.id_user=ru.user_id and r.deleted = FALSE and ru.rating_id = r.id_rating and u.id_user=:id_user;";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id_user",$id_user,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getIsDeletedRating($id_user,$id_vehicle){
            $sql = "select r.deleted from vehicle v,user u,rating r,rating_user_relation ru where v.id_vehicle=r.id_vehicle and u.id_user=ru.user_id and ru.rating_id = r.id_rating and u.id_user=:id_user and v.id_vehicle=:id_vehicle;";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id_user",$id_user,PDO::PARAM_INT);
            $stmt->bindParam(":id_vehicle",$id_vehicle,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
    }

?>
