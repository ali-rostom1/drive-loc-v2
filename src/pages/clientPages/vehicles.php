<?php
    require_once "../../../vendor/autoload.php";

    use App\classes\database;
    use App\classes\Vehicle;
    use App\classes\User;

    $user = new User();
    $user->isLoggedAsClient();

    
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }else $page = 1;
    $v = new Vehicle();
    $nb = $v->getNbOfVehicles();
    $perPage = 6;
    $totalPages = ceil($nb/$perPage);
    $vehicles = $v->selectLimit("vehicle",$page);

?>
<!DOCTYPE html>
<html lang="en">
    <head data-pg-collapsed>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Vehicles</title>
        <link rel="stylesheet" href="../../assets/css/input.css">
        <link rel="stylesheet" href="../../assets/css/output.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script>/* Pinegrow Interactions, do not remove */ (function(){try{if(!document.documentElement.hasAttribute('data-pg-ia-disabled')) { window.pgia_small_mq=typeof pgia_small_mq=='string'?pgia_small_mq:'(max-width:767px)';window.pgia_large_mq=typeof pgia_large_mq=='string'?pgia_large_mq:'(min-width:768px)';var style = document.createElement('style');var pgcss='html:not(.pg-ia-no-preview) [data-pg-ia-hide=""] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show=""] {opacity:1;visibility:visible;display:block;}';if(document.documentElement.hasAttribute('data-pg-id') && document.documentElement.hasAttribute('data-pg-mobile')) {pgia_small_mq='(min-width:0)';pgia_large_mq='(min-width:99999px)'} pgcss+='@media ' + pgia_small_mq + '{ html:not(.pg-ia-no-preview) [data-pg-ia-hide="mobile"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="mobile"] {opacity:1;visibility:visible;display:block;}}';pgcss+='@media ' + pgia_large_mq + '{html:not(.pg-ia-no-preview) [data-pg-ia-hide="desktop"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="desktop"] {opacity:1;visibility:visible;display:block;}}';style.innerHTML=pgcss;document.querySelector('head').appendChild(style);}}catch(e){console&&console.log(e);}})()</script>
    </head>
    <body class="font-serif text-gray-500"> 
        <header class="bg-gray-900 bg-opacity-95 py-2">
            <div class="container mx-auto relative"> 
                <nav class="flex flex-wrap items-center px-4"> 
                    <a href="../../" class="font-bold font-sans hover:text-opacity-75 inline-flex items-center leading-none mr-4 space-x-1 text-primary-500 text-xl uppercase"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="2.5em" xml:space="preserve" fill="currentColor" viewBox="0 0 100 100" height="2.5em">
                            <path d="M38.333 80a11.571 11.571 0 0 1-7.646-2.883A11.724 11.724 0 0 1 26.834 70H10V46.667L43.333 40l20-20H90v26.667H43.995l-27.328 5.465v11.2h11.166a11.787 11.787 0 0 1 4.212-4.807 11.563 11.563 0 0 1 12.577 0 11.789 11.789 0 0 1 4.213 4.807h7.833V70h-6.837a11.719 11.719 0 0 1-3.853 7.117A11.571 11.571 0 0 1 38.333 80Zm0-16.667a5 5 0 1 0 5 5 5.006 5.006 0 0 0-5.001-5Zm27.761-36.666L52.762 40h30.571V26.667Z"></path>
                            <path d="M56.667 63.333h-7.833a11.6 11.6 0 0 0-21 0H16.667v-11.2l27.328-5.465h12.672Z" opacity="0.2"></path>
                            <path d="M90 63.333H80v-10h-6.667v10h-10V70h10v10H80V70h10Z"></path>
                            <path d="M52.762 40h30.571V26.667H66.094Z" opacity="0.2"></path>
                        </svg><span>Drive & loc</span> </a> 
                    <button class="hover:bg-primary-500 hover:text-white ml-auto px-3 py-2 rounded text-white lg:hidden" data-name="nav-toggler" data-pg-ia='{"l":[{"name":"NabMenuToggler","trg":"click","a":{"l":[{"t":"^nav|[data-name=nav-menu]","l":[{"t":"set","p":0,"d":0,"l":{"class.remove":"hidden"}}]},{"t":"#gt# span:nth-of-type(1)","l":[{"t":"tween","p":0,"d":0.2,"l":{"rotationZ":45,"yPercent":300}}]},{"t":"#gt# span:nth-of-type(2)","l":[{"t":"tween","p":0,"d":0.2,"l":{"autoAlpha":0}}]},{"t":"#gt# span:nth-of-type(3)","l":[{"t":"tween","p":0,"d":0.2,"l":{"rotationZ":-45,"yPercent":-300}}]}]},"pdef":"true","trev":"true"}]}' data-pg-ia-apply="$nav [data-name=nav-toggler]"> 
                        <span class="block border-b-2 border-current my-1 w-6"></span> 
                        <span class="block border-b-2 border-current my-1 w-6"></span> 
                        <span class="block border-b-2 border-current my-1 w-6"></span> 
                    </button>                     
                    <div class="flex-1 hidden space-y-2 w-full lg:flex lg:items-center lg:justify-around lg:space-x-4 lg:space-y-0 lg:w-auto" data-name="nav-menu"> 
                        <div class="flex flex-col mr-auto lg:flex-row"> 
                            <a href="../../" class="hover:text-gray-400 lg:p-4 py-2 text-white">Home</a>
                            <a href="categories.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Categories</a>
                            <a href="#" class="text-gray-400 lg:p-4 py-2 ">Vehicles</a>
                        </div>
                        <div class="flex-wrap inline-flex items-center py-1 space-x-2">
                            <a href="ratings.php" class="border border-primary-500 hover:bg-primary-500 hover:text-white inline-block px-6 py-2 text-primary-500 rounded-lg">My Ratings</a>
                            <a href="reservations.php" class="border border-primary-500 hover:bg-primary-500 hover:text-white inline-block px-6 py-2 text-primary-500 rounded-lg">Reservations</a>
                            <a href="../authentification/deauth.php" class="bg-primary-500 border border-primary-500 hover:bg-primary-600 inline-block px-6 py-2 text-white rounded-lg">Log out</a> 
                        </div>                         
                    </div>                     
                </nav>                 
            </div>
        </header>
        <section class="bg-gray-50 py-10"> 
                <div class="container mx-auto px-4"> 
                    <div class="-mx-4 flex flex-wrap items-center mb-6"> 
                        <div class="px-4 w-full md:flex-1 flex items-center justify-between">
                            <div class="w-1/2">
                                <h3 class="capitalize font-bold mb-4 text-4xl text-gray-900">All Vehicles</h3>
                                <div class="bg-primary-500 mb-6 pb-1 w-2/12"></div>
                            </div> 
                            <div class="relative w-1/2 md:w-1/3">
                                <input 
                                    id="searchBar" 
                                    type="text" 
                                    class="w-full py-4 px-4 border bg-primary-500 text-white border-gray-300 rounded-xl placeholder:text-gray-200" 
                                    placeholder="Search vehicle..." 
                                />
                                <div id="searchResults" class="absolute left-0 right-0 bg-white border border-gray-300 mt-2 max-h-60 overflow-y-auto hidden">
                                
                                </div>
                            </div>                         
                        </div>                         
                    </div>
                    <!-- CATEGORIES -->
                    <div class="categories-container flex flex-wrap gap-5 items-center mb-6">
                        <div id="0" class ="font-medium mb-1 text-primary-500 text-lg hover:bg-primary-500 hover:text-white px-3 py-2 border-2 border-primary-500 rounded-full cursor-pointer active">All</div>
                        <?php 
                            $db = new database();
                            $allCategories = $db->selectAll("category");
                            foreach($allCategories as $category){
                                echo '<div id="'.$category["id_cat"].'" class ="font-medium mb-1 text-primary-500 text-lg hover:bg-primary-500 hover:text-white px-3 py-2 border-2 border-primary-500 rounded-full cursor-pointer">'.$category["name_cat"].'</div>';
                            }
                        ?>           
                    </div>
                    <!-- CARDS -->
                    <div class="-mx-3 flex flex-wrap justify-center mb-12 card-container"> 
                        <?php
                            foreach($vehicles as $vehicle){
                                $vehicleInstance = new Vehicle();
                                $vehicleInstance->fetchForVehicle($vehicle["id_vehicle"]);
                                $vehicleInstance->displayThumbnail();
                            }
                        ?>                
                    </div>
                    <!-- PAGINATION -->
                    <div id="pagination" class="-mx-3 flex flex-wrap justify-center mb-12 gap-5">
                        <?php
                            for($i=1;$i<=$totalPages;$i++){
                                if ($page == $i) {
                                    echo '<a class="py-2 px-4 bg-white text-primary-500 border-2 border-primary-500 hover:bg-primary-500 hover:text-white rounded-full font-medium mb-1 text-xl active">'.$i.'</a>';
                                } else {
                                    echo '<a href="?page='.$i.'" class="py-2 px-4  bg-white text-primary-500 border-2 border-primary-500 hover:bg-primary-500 hover:text-white rounded-full font-medium mb-1 text-xl">'.$i.'</a>';
                                }
                            }
                        ?>
                    </div>
                </div>               
        </section>
        <div id="productModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-3/4 md:w-1/2 p-5">
                <div class="border-b px-4 py-2 flex justify-between items-center">
                    <h3 class="text-lg font-semibold" id="productTitle">Vehicle Details</h3>
                    <button id="closeModal" class="text-gray-500 hover:text-black text-3xl font-bold">&times;</button>
                </div>
                <div class="p-4 flex flex-col space-y-4">
                    <!-- Product Image -->
                    <div class="w-full flex justify-center">
                        <img id="productImage" src="" alt="Product Image" class="rounded-md shadow-md max-h-64">
                    </div>
                    <!-- Product Name -->
                    <h2 class="text-2xl font-bold" id="productName"></h2>
                    <!-- Product Description -->
                    <p class="text-gray-600" id="productDescription"></p>
                    <!-- Product location -->
                    <p class="text-gray-600" id="productLocation"></p>
                    <!-- Product Price -->
                    <p class="text-lg font-semibold text-green-600" id="productPrice"></p>
                    
                    <div class="flex items-center">
                        <div id="productRating" class="flex items-center space-x-1">
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4  ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4  ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4  ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg class="w-4 h-4 ms-1 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                        </div>
                        <a id="reserve" class="ml-auto bg-primary-500 font-bold text-white py-2 px-4 rounded-lg hover:bg-yellow-200 hover:text-black transition duration-300 ease-in-out">
                            Reserve
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="reserveModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white rounded-lg p-8 w-96">
                <h2 class="text-xl font-bold mb-4 text-center text-black">Select Reservation Date</h2>
                <form id="reserveForm" method="POST">
                    <div class="mb-4">
                        <label for="reservationDate" class="block text-sm font-medium text-gray-700">Choose a Date</label>
                        <input type="date" id="reservationDate" name="reservationDate" class="mt-2 w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-between">
                        <button id="cancel" type="button" class="bg-gray-300 text-black py-2 px-4 rounded-lg hover:bg-gray-400 transition duration-300">Cancel</button>
                        <button type="submit" class="bg-primary-500 font-bold text-white py-2 px-4 rounded-lg hover:bg-yellow-200 hover:text-black transition duration-300">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
        <footer class="bg-black bg-opacity-90 pt-12 text-gray-300"> 
            <div class="container mx-auto px-4 relative"> 
                <div class="flex flex-wrap -mx-4"> 
                    <div class="p-4 w-full lg:w-4/12"> 
                        <a href="#" class="font-bold font-sans hover:text-opacity-90 inline-flex items-center leading-none mb-4 space-x-2 text-3xl text-primary-500 uppercase"> <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="3em" xml:space="preserve" fill="currentColor" viewBox="0 0 100 100" height="3em">
                                <path d="M38.333 80a11.571 11.571 0 0 1-7.646-2.883A11.724 11.724 0 0 1 26.834 70H10V46.667L43.333 40l20-20H90v26.667H43.995l-27.328 5.465v11.2h11.166a11.787 11.787 0 0 1 4.212-4.807 11.563 11.563 0 0 1 12.577 0 11.789 11.789 0 0 1 4.213 4.807h7.833V70h-6.837a11.719 11.719 0 0 1-3.853 7.117A11.571 11.571 0 0 1 38.333 80Zm0-16.667a5 5 0 1 0 5 5 5.006 5.006 0 0 0-5.001-5Zm27.761-36.666L52.762 40h30.571V26.667Z"></path>
                                <path d="M56.667 63.333h-7.833a11.6 11.6 0 0 0-21 0H16.667v-11.2l27.328-5.465h12.672Z" opacity="0.2"></path>
                                <path d="M90 63.333H80v-10h-6.667v10h-10V70h10v10H80V70h10Z"></path>
                                <path d="M52.762 40h30.571V26.667H66.094Z" opacity="0.2"></path>
                            </svg><span>Drive & loc</span> </a>
                        <ul class="mb-4 space-y-1">
                            <li> 117, rue de la Pyramide Casablanca Morocco</li>
                            <li>
                                <a href="#" class="hover:text-gray-400 text-white">+212 61413 7566</a>
                            </li>
                            <li>
                                <a href="mailto:ali.rostom220@gmail.com" class="hover:text-gray-400 text-white">drive&loc@gmail.com</a>
                            </li>
                        </ul>                         
                        <div class="flex-wrap inline-flex space-x-3"> 
                            <a href="#" aria-label="facebook" class="hover:text-gray-400"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"/> 
                                </svg></a> 
                            <a href="#" aria-label="twitter" class="hover:text-gray-400"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"/> 
                                </svg></a> 
                            <a href="#" aria-label="instagram" class="hover:text-gray-400"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 0 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/> 
                                </svg></a>
                            <a href="#" aria-label="linkedin" class="hover:text-gray-400"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M6.94 5a2 2 0 1 1-4-.002 2 2 0 0 1 4 .002zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z"/> 
                                </svg></a>
                            <a href="#" aria-label="youtube" class="hover:text-gray-400"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M21.543 6.498C22 8.28 22 12 22 12s0 3.72-.457 5.502c-.254.985-.997 1.76-1.938 2.022C17.896 20 12 20 12 20s-5.893 0-7.605-.476c-.945-.266-1.687-1.04-1.938-2.022C2 15.72 2 12 2 12s0-3.72.457-5.502c.254-.985.997-1.76 1.938-2.022C6.107 4 12 4 12 4s5.896 0 7.605.476c.945.266 1.687 1.04 1.938 2.022zM10 15.5l6-3.5-6-3.5v7z"/> 
                                </svg></a> 
                        </div>                         
                    </div>                     
                    <div class="p-4 w-full sm:w-6/12 md:flex-1 lg:w-3/12">
                        <h2 class="font-bold text-color3-500 text-xl">Company</h2>
                        <hr class="border-gray-600 inline-block mb-6 mt-4 w-3/12">
                        <ul> 
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">FAQ</a> 
                            </li>
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">News</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Careers</a> 
                            </li>
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">About Us</a> 
                            </li>
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Contact Us</a> 
                            </li>                             
                        </ul>
                    </div>
                    <div class="p-4 w-full sm:w-6/12 md:flex-1 lg:w-3/12">
                        <h2 class="font-bold text-color3-500 text-xl">Vehicles</h2>
                        <hr class="border-gray-600 inline-block mb-6 mt-4 w-3/12">
                        <ul> 
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">SUVs</a> 
                            </li>
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Sedans</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Mini Vans</a> 
                            </li>
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Sports Cars</a> 
                            </li>
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Convertibles</a> 
                            </li>                             
                        </ul>
                    </div>
                    <div class="p-4 w-full md:w-5/12 lg:w-4/12"> 
                        <h2 class="font-bold text-color3-500 text-xl">Top Cities</h2>
                        <hr class="border-gray-600 inline-block mb-6 mt-4 w-3/12">
                        <div class="-mx-4 flex flex-wrap"> 
                            <div class="pb-4 px-4 w-full sm:w-6/12"> 
                                <ul> 
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Taxes</a> 
                                    </li>
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Boston</a> 
                                    </li>                                     
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Colorado</a> 
                                    </li>
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">California</a> 
                                    </li>
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Manhattan</a> 
                                    </li>                                     
                                </ul>
                            </div>
                            <div class="pb-4 px-4 w-full sm:w-6/12"> 
                                <ul> 
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Dallas</a> 
                                    </li>
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Huston</a> 
                                    </li>
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Seattle</a> 
                                    </li>
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Denver</a> 
                                    </li>
                                    <li class="mb-4"> 
                                        <a href="#" class="hover:text-gray-400">Phoenix</a> 
                                    </li>                                     
                                </ul>
                            </div>                             
                        </div>                         
                    </div>                     
                </div>                 
                <div class="py-4"> 
                    <hr class="mb-4 opacity-25"> 
                    <div class="flex flex-wrap -mx-4  items-center"> 
                        <div class="px-4 py-2 w-full md:flex-1"> 
                            <p>&copy; 2002 - 2025. All Rights Reserved - Drive & Loc</p> 
                        </div>                         
                        <div class="px-4 py-2 w-full md:w-auto"> 
                            <a href="#" class="hover:text-gray-400">Privacy Policy</a> |                      
                            <a href="#" class="hover:text-gray-400">Terms of Use</a> 
                        </div>                         
                    </div>                     
                </div>                 
            </div>             
        </footer>
        <script src="../../assets/js/vehicles.js"></script>
    </body>
</html>
        