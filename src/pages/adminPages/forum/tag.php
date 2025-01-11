<?php

use App\classes\Tag;
use App\classes\database;
use App\classes\User;

require_once "../../../../vendor/autoload.php";

$user = new User();
$user->isLoggedAsAdmin();

$db = new database();
?>

<html lang="en">
    <head data-pg-collapsed>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tag Management</title>
        <link rel="stylesheet" href="../../../assets/css/input.css">
        <link rel="stylesheet" href="../../../assets/css/output.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="font-serif text-gray-500"> 
        <header class="bg-gray-900 bg-opacity-95 py-2">
            <div class="container mx-auto relative"> 
                <nav class="flex flex-wrap items-center px-4"> 
                    <a href="../adminDashboard.php" class="font-bold font-sans hover:text-opacity-75 inline-flex items-center leading-none mr-4 space-x-1 text-primary-500 text-xl uppercase"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="2.5em" xml:space="preserve" fill="currentColor" viewBox="0 0 100 100" height="2.5em">
                            <path d="M38.333 80a11.571 11.571 0 0 1-7.646-2.883A11.724 11.724 0 0 1 26.834 70H10V46.667L43.333 40l20-20H90v26.667H43.995l-27.328 5.465v11.2h11.166a11.787 11.787 0 0 1 4.212-4.807 11.563 11.563 0 0 1 12.577 0 11.789 11.789 0 0 1 4.213 4.807h7.833V70h-6.837a11.719 11.719 0 0 1-3.853 7.117A11.571 11.571 0 0 1 38.333 80Zm0-16.667a5 5 0 1 0 5 5 5.006 5.006 0 0 0-5.001-5Zm27.761-36.666L52.762 40h30.571V26.667Z"></path>
                        </svg><span>Drive & loc</span> </a> 
                    <div class="flex-1 hidden lg:flex lg:items-center lg:justify-around lg:w-auto"> 
                        <div class="flex flex-col mr-auto lg:flex-row"> 
                            <a href="../adminDashboard.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Home</a>
                            <a href="../categoriesAdmin.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Categories</a>
                            <a href="../vehiclesAdmin.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Vehicles</a>
                            <a href="../reservationsAdmin.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Reservations</a>
                            <a href="article.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Articles</a>
                            <a href="theme.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Themes</a>
                            <a href="#" class="text-gray-400 lg:p-4 py-2">Tags</a>

                        </div>
                        <div class="flex-wrap inline-flex items-center py-1 space-x-2"> 
                            <a href="../../authentification/deauth.php" class="bg-primary-500 border border-primary-500 hover:bg-primary-600 inline-block px-6 py-2 text-white rounded-lg">Log out</a> 
                        </div>                         
                    </div>                     
                </nav>                 
            </div>
        </header>
        <div class="w-11/12 mx-auto mt-10 min-h-screen">
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-3xl font-bold">Tag Management</h1>
                <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-blue-500 text-white px-4 py-2 rounded">Add Tag</button>
            </div>
            <div class="w-1/2 mx-auto overflow-y-auto max-h-[80vh]"><table class="table-auto w-full bg-white rounded shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Tag Name</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="tagTable overflow-y-auto">
                    <?php
                        $allTags = $db->selectAll("tag");
                        foreach($allTags as $tagInst){
                            echo '<tr data-id='.$tagInst["id_tag"].'>';
                            echo '<td class="px-4 py-2">'.$tagInst['id_tag'].'</td>';
                            echo '<td class="px-4 py-2">'.$tagInst['name'].'</td>';
                            echo "<td class='px-4 py-2 text-center'>";
                            echo "<button class='bg-blue-500 text-white px-4 py-2 rounded mr-2 edit'>Edit</button>";
                            echo "<button class='bg-red-500 text-white px-4 py-2 rounded delete'>Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table></div>
        </div>

        <!-- Add Modal -->
        <div id="addModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-gray-400 rounded-lg shadow-lg w-3/4 md:w-1/2 max-h-[80vh] overflow-y-auto">
                <form id="addForm" class="p-6 space-y-4">
                    <h2 class="text-xl font-bold">Add New Tags</h2>
                    <div id="tagsInputContainer">
                        <div class="tag-input">
                            <label for="addName1" class="block text-sm font-medium">Tag Name</label>
                            <input type="text" id="addName1" name="name[]" class="w-full px-4 py-2 border rounded" required>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" id="addMoreTags" class="px-4 py-2 bg-blue-500 text-white rounded">Add More Tags</button>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" id="closeAddModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add Tags</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-gray-400 rounded-lg shadow-lg w-3/4 md:w-1/2">
                <form id="editForm" class="p-6 space-y-4">
                    <h2 class="text-xl font-bold">Edit Tag</h2>
                    <div>
                        <label for="editName" class="block text-sm font-medium">Tag Name</label>
                        <input type="text" id="editName" name="name" class="w-full px-4 py-2 border rounded" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" id="closeEditModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="bg-black bg-opacity-90 pt-12 text-gray-300"> 
            <div class="container mx-auto px-4 relative">               
                <div class="py-4"> 
                    <hr class="mb-4 opacity-25"> 
                    <div class="flex flex-wrap -mx-4 items-center"> 
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
        <script src="../../../assets/js/forum/tagsAdmin.js"></script>
    </body>
</html>