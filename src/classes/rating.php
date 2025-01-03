<?php
    namespace App\classes;
    require_once __DIR__."../../../vendor/autoload.php";

    use App\classes\database;

    
    
    class Rating extends database{
        public $id_user;
        public $id_vehicle;
        public $value;

        public function __construct($id_user,$id_vehicle){
            parent::__construct();
            $this->id_user = $id_user;
            $this->id_vehicle = $id_vehicle;
            $this->value = $this->getRatingValue($this->id_user,$this->id_vehicle) ? $this->getRatingValue($this->id_user,$this->id_vehicle)["value"] : NULL;
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
    }



?>