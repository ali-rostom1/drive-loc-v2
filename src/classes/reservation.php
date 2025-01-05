<?php
    namespace App\classes;
    require_once __DIR__."../../../vendor/autoload.php";

    use App\classes\database;

    class Reservation extends database{
        public $id;
        public $date;
        public $status;
        public $id_user;
        public $id_vehicle;

        public function __construct($id)
        {
            parent::__construct();
            if($id){
                if($data = $this->selectWhere("reservations","id_reservation",$id)){
                    $this->id = $data["id_reservation"];
                    $this->date = $data["date_reservation"];
                    $this->status = $data["status"];
                    $this->id_user = $data["id_user"];
                    $this->id_vehicle = $data["id_vehicle"];
                }
            }
        }
        public function addReservation($date,$id_user,$id_vehicle){
            
            $this->id = $this->insert("reservations",["date_reservation"=>$date,"status"=>"Pending","id_user"=>$id_user,"id_vehicle"=>$id_vehicle]);
            $this->date = $date;
            $this->status = "Pending";
            $this->id_user = $id_user;
            $this->id_vehicle = $id_vehicle;
        }
        public function displayReservation(){
            $vehicle = $this->getVehicleBasedOnRes($this->id);
            echo '
                <tr id="'.$this->id.'" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                   '.$vehicle["model_vehicle"].' 
                                </th>
                                <td class="px-6 py-4">
                                    '.$vehicle["brand_vehicle"].' 
                                </td>
                                <td class="px-6 py-4">
                                    '.$vehicle["location"].' 
                                </td>
                                <td class="px-6 py-4">
                                    '.$vehicle["price"].' 
                                </td>
                                <td class="px-6 py-4">
                                    '.$this->date.' 
                                </td>
                                <td class="px-6 py-4">
                                    '.$this->status.' 
                                </td>
                                <td class="px-6 py-4 flex justify-around items-center">
                                    <a class="delete"><i class="fa-solid fa-ban text-red-500 hover:scale-125 transition duration-300"></i></a>
                                    <a class="edit font-medium text-blue-600 dark:text-blue-500 hover:underline hover:scale-125 transition duration-300">Edit</a>
                                </td>
                </tr>

            ';
        }
        public function updateReservation($date){
            $this->date = $date;
            $this->update("reservations",["date_reservation"=>$this->date],"id_reservation",$this->id);
        }
        public function deleteReservation(){
            $this->deleteWhere("reservations","id_reservation",$this->id);
        }
        public function displayReservationAdmin(){

            
            echo '
                <tr>
                    <td class="px-4 py-2 border">'.$this->id.'</td>
                    <td class="px-4 py-2 border">'.$this->date.'</td>
                    <td class="px-4 py-2 border">'.$this->status.'</td>
                    <td class="px-4 py-2 border">'.$this->id_user.'</td>
                    <td class="px-4 py-2 border">'.$this->id_vehicle.'</td>
                    <td class="px-4 py-2 border space-x-2">';
            if($this->status == "Pending"){
                echo '<button class="approveBtn px-2 py-1 bg-green-500 text-white rounded" data-id="'.$this->id.'">Approve</button>
                        <button class="declineBtn px-2 py-1 bg-yellow-500 text-white rounded" data-id="'.$this->id.'">Decline</button>
                        <button class="deleteBtn px-2 py-1 bg-red-500 text-white rounded" data-id="'.$this->id.'">Delete</button>';
            }else if($this->status == "Accepted"){
                echo '
                    <button class="declineBtn px-2 py-1 bg-yellow-500 text-white rounded" data-id="'.$this->id.'">Decline</button>
                    <button class="deleteBtn px-2 py-1 bg-red-500 text-white rounded" data-id="'.$this->id.'">Delete</button>
                ';
            }else{
                echo ' 
                     <button class="approveBtn px-2 py-1 bg-green-500 text-white rounded" data-id="'.$this->id.'">Approve</button>
                    <button class="deleteBtn px-2 py-1 bg-red-500 text-white rounded" data-id="'.$this->id.'">Delete</button>
                ';
            }
            
            echo '</td>
                
                </tr>

            ';
        }
    }

?>