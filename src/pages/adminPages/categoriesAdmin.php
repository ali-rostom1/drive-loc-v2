<?php
    require_once __DIR__."../../../../vendor/autoload.php";
    use App\classes\User;
    use App\classes\Vehicle;
    use App\classes\database;

    $user = new User();
    $user->isLoggedAsAdmin();
?>
<!DOCTYPE html>
<html lang="en">
    <head data-pg-collapsed>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Drive & Loc</title>
        <link rel="stylesheet" href="../../assets/css/input.css">
        <link rel="stylesheet" href="../../assets/css/output.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script>/* Pinegrow Interactions, do not remove */ (function(){try{if(!document.documentElement.hasAttribute('data-pg-ia-disabled')) { window.pgia_small_mq=typeof pgia_small_mq=='string'?pgia_small_mq:'(max-width:767px)';window.pgia_large_mq=typeof pgia_large_mq=='string'?pgia_large_mq:'(min-width:768px)';var style = document.createElement('style');var pgcss='html:not(.pg-ia-no-preview) [data-pg-ia-hide=""] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show=""] {opacity:1;visibility:visible;display:block;}';if(document.documentElement.hasAttribute('data-pg-id') && document.documentElement.hasAttribute('data-pg-mobile')) {pgia_small_mq='(min-width:0)';pgia_large_mq='(min-width:99999px)'} pgcss+='@media ' + pgia_small_mq + '{ html:not(.pg-ia-no-preview) [data-pg-ia-hide="mobile"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="mobile"] {opacity:1;visibility:visible;display:block;}}';pgcss+='@media ' + pgia_large_mq + '{html:not(.pg-ia-no-preview) [data-pg-ia-hide="desktop"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="desktop"] {opacity:1;visibility:visible;display:block;}}';style.innerHTML=pgcss;document.querySelector('head').appendChild(style);}}catch(e){console&&console.log(e);}})()</script>
    </head>
    <body class="font-serif text-gray-500"> 
        <header class="bg-gray-900 bg-opacity-95 py-2">
            <div class="container mx-auto relative"> 
                <nav class="flex flex-wrap items-center px-4"> 
                    <a href="#" class="font-bold font-sans hover:text-opacity-75 inline-flex items-center leading-none mr-4 space-x-1 text-primary-500 text-xl uppercase"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="2.5em" xml:space="preserve" fill="currentColor" viewBox="0 0 100 100" height="2.5em">
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
                            <a href="#" class="text-gray-400 lg:p-4 py-2">Home</a>
                            <a href="../adminPages/categoriesAdmin.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Categories</a>
                            <a href="../adminPages/vehiclesAdmin.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Vehicles</a>
                            <a href="../adminPages/reservationsAdmin.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Reservations</a>
                            <a href="../adminPages/ratingsAdmin.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Ratings</a>
                        </div>
                        <div class="flex-wrap inline-flex items-center py-1 space-x-2"> 
                            <a href="../authentification/deauth.php" class="bg-primary-500 border border-primary-500 hover:bg-primary-600 inline-block px-6 py-2 text-white rounded-lg">Log out</a> 
                        </div>                         
                    </div>                     
                </nav>                 
            </div>
        </header>
        <div class="container mx-auto mt-10 min-h-screen">
            <h1 class="text-3xl font-bold mb-5">All Categories</h1>

            <!-- Vehicle Table -->
            <table class="table-auto w-1/2 mx-auto bg-white rounded shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">name</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="categoryTable">
                    <?php
                        $db = new database;
                        $allCategories = $db->selectAll("category");
                        foreach($allCategories as $category){  
                            echo '
                            <tr class="border-t">
                                <td class="px-4 py-2">'.$category["id_cat"].'</td>
                                <td class="px-4 py-2">'.$category["name_cat"].'</td>
                                <td class="px-4 py-2 space-x-2">
                                    <button class="px-2 py-1 bg-green-500 text-white rounded editBtn" data-id="'.$category["id_cat"].'">Edit</button>
                                    <button class="px-2 py-1 bg-red-500 text-white rounded deleteBtn" data-id="'.$category["id_cat"].'">Delete</button>
                                </td>
                            </tr>
                        '; 
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-gray-400 rounded-lg shadow-lg w-3/4 md:w-1/2">
                <form id="editForm" class="p-6 space-y-4">
                    <h2 class="text-xl font-bold">Edit category</h2>
                    <input type="hidden" id="editId" name="id">
                    <div>
                        <label for="editName" class="block text-sm font-medium">Model</label>
                        <input type="text" id="editName" name="name" class="w-full px-4 py-2 border rounded">
                    </div>
                    <div>
                        <label for="editDescription" class="block text-sm font-medium">Description</label>
                        <textarea id="editDescription" name="description" class="w-full px-4 py-2 border rounded"></textarea>
                    </div>
                    <div>
                        <label for="editImgUrl" class="block text-sm font-medium">Image URL</label>
                        <input type="text" id="editImgUrl" name="imgUrl" class="w-full px-4 py-2 border rounded">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <footer class="bg-black bg-opacity-90 pt-12 text-gray-300"> 
            <div class="container mx-auto px-4 relative">               
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
        <script src="../../assets/js/categoryAdmin.js"></script>
    </body>
</html>
