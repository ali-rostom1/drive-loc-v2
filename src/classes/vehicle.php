<?php    
    namespace App\classes;
    use App\classes\database;
    class Vehicle extends database{
        public $id;
        public $model;
        public $idCategory;
        public $description;
        public $brand;
        public $price;
        public $available;
        public $imgUrl;
        
        public function fetchForVehicle($id){
            $data = $this->selectWhere("vehicle","id_vehicle",$id);
            $this->id = $id;
            $this->model = $data["model_vehicle"];
            $this->idCategory = $data["id_cat"];
            $this->description = $data["desc_vehicle"];
            $this->brand = $data["brand_vehicle"];
            $this->price = $data["price"];
            $this->available = $data["available"];
            $this->imgUrl = $data["img_path"];
            return $data;
        }
        public function addVehicleToDb(){
            $values = ["model_vehicle"=>$this->model,"id_cat"=>$this->idCategory,"desc_vehicle"=>$this->description,"brand_vehicle"=>$this->brand,"price"=>$this->price,"available"=>$this->available,"img_path"=>$this->imgUrl];
            if($this->insert("vehicle",$values)){
                return "Vehicle Added Successfully";
            }else return "Error with Vehicle infos";
        }
        public function editVehicleDb(){
            $values = ["model_vehicle"=>$this->model,"id_cat"=>$this->idCategory,"desc_vehicle"=>$this->description,"brand_vehicle"=>$this->brand,"price"=>$this->price,"available"=>$this->available,"img_path"=>$this->imgUrl];
            if($this->update("vehicle",$values,"id_vehicle",$this->id)){
                return "Vehicle edited Successfully";
            }else return "Error with Vehicle infos";
        }
        public function removeVehicleDb(){
            if($this->deleteWhere("vehicle","id_vehicle",$this->id)){
                return "car removed successfully";
            }else return "car couldn't be removed";
        }
        public function displayThumbnail(){
            echo '
                <div id="'.$this->id.'" class="p-3 w-full md:w-6/12 lg:w-4/12"> 
                            <div class="bg-white border shadow-md text-gray-500"> 
                                <a href="#"><img src="'.$this->imgUrl.'" class="hover:opacity-90 w-full" alt="..." width="600" height="450"/></a>
                                <div class="p-6">
                                    <h4 class="font-bold mb-2 text-gray-900 text-xl"><a href="#" class="hover:text-gray-500">'.$this->model.'</a></h4>
                                    <hr class="border-gray-200 my-4">
                                    <div class="flex items-center justify-between">
                                        <div class="inline-flex items-center py-1 space-x-1">
                                            <span>4.7</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1.125em" height="1.125em" class="text-primary-500">
                                                <g>
                                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                                    <path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z"></path>
                                                </g>
                                            </svg>
                                            <span>(245 reviews)</span>
                                        </div>
                                        <p class="font-bold text-gray-900">$'.$this->price.'/day</p>
                                    </div>
                                </div>                                 
                            </div>                             
                        </div> 
            ';
        }
        public function getAllVehicles(){
            return $this->selectAll("Vehicle");
        }
        public function getNbOfVehicles(){
            return $this->selectCountWhere("vehicle","1","1");
        }
    }
?>
