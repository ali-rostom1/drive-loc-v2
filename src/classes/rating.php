<?php
    namespace App\classes;
    require_once __DIR__."../../../vendor/autoload.php";

    use App\classes\database;

    
    
    class Rating extends database{
        public $id;
        public $id_user;
        public $id_vehicle;
        public $value;
        public $isReserved;
        public $isDeleted;

        public function __construct($id_user,$id_vehicle){
            parent::__construct();
            $conditions = ["id_vehicle"=>$id_vehicle,"id_user"=>$id_user];
            if($this->selectWhereAnd("reservations",$conditions)){
                $this->isReserved = true;
            }else $this->isReserved = false;
            $this->id_user = $id_user;
            $this->id_vehicle = $id_vehicle;
            $this->value = $this->getRatingValue($this->id_user,$this->id_vehicle) ? $this->getRatingValue($this->id_user,$this->id_vehicle)["value"] : NULL;
            $this->id = $this->getRatingId($this->id_user,$this->id_vehicle) ? $this->getRatingId($this->id_user,$this->id_vehicle)["id"] : NULL;
            $this->isDeleted = $this->getIsDeletedRating($this->id_user,$this->id_vehicle) ? $this->getIsDeletedRating($this->id_user,$this->id_vehicle)["deleted"] : NULL;
           
        }
        public function updateValue($value){
            $this->value = $value;
            if($this->updateRating($this->id_user,$this->id_vehicle,$this->value)){
                return true;
            }else return false;
        }
        public function addRating($value){
            $this->value = $value;
            $this->insertRating($this->id_user,$this->id_vehicle,$value);
        }
        public function softDeleteRating(){
            $this->update("rating",["deleted"=> true],"id_rating",$this->id);
        }
    }



?>