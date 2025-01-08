<?php
    require_once __DIR__ . "../../../../../vendor/autoload.php";

    use App\classes\Article;
    use App\classes\Theme;
	use App\classes\User;
	use App\classes\database;

    $user = new User();
    $user->isLoggedAsClient();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - Drive & Blog</title>
    <link rel="stylesheet" href="../../../assets/css/input.css">
    <link rel="stylesheet" href="../../../assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-800 shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-8">
                    <a href="#" class="text-white font-bold text-xl">DRIVE & LOC</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="#" class="text-white hover:text-blue-200 transition duration-300">Home</a>
                        <a href="articles.php" class="text-white hover:text-blue-200 transition duration-300">Articles</a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <div class="hidden md:flex bg-blue-700 rounded-lg">
                        <input type="text" placeholder="Search..." class="bg-transparent text-white px-4 py-2 focus:outline-none placeholder-blue-300">
                        <button class="px-4 text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <a href="#" class="text-white hover:text-blue-200 transition duration-300">
                        <i class="fas fa-star"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 transition duration-300">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            
            <!-- Filters -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Theme Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                    <select class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="">All Themes</option>
                        <?php
                        $db = new database();
                        $allThemes = $db->selectAll("theme");
                        foreach($allThemes as $element){
                            $theme = new Theme($element["id_theme"]);
                            $theme->displaySelect();
                        }
                        ?>  

                    </select>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm hover:bg-blue-200">
                            Performance
                        </button>
                        <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">
                            Luxury
                        </button>
                        <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">
                            Economy
                        </button>
                        <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">
                            Safety
                        </button>
                    </div>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="popular">Most Popular</option>
                        <option value="comments">Most Commented</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex justify-end mb-8">
            <button onclick="document.getElementById('createPostModal').classList.remove('hidden')" class="flex items-center gap-2 bg-blue-800 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                <i class="fas fa-plus"></i>
                Add New Article
            </button>
        </div>
        <!-- Articles Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            <?php
                $db = new database();
                $articles = $db->selectAll("article");
                foreach($articles as $articleInstance){
                    $article = new Article($articleInstance["id_article"]);
                    $article->displaySecondPage();
                }
            ?>

            <!-- Article Card 2 -->
            <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="/api/placeholder/800/400" alt="Article Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Electric</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">Performance</span>
                    </div>
                    <h2 class="text-xl font-bold mb-2">Future of Electric Sports Cars</h2>
                    <p class="text-gray-600 mb-4">Exploring the latest innovations in electric vehicle performance...</p>
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Jane Smith
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            Jan 4, 2025
                        </span>
                    </div>
                </div>
            </article>

            <!-- Add more article cards as needed -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2">
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100 disabled:opacity-50">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-4 py-2 border rounded-lg bg-blue-800 text-white">1</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">2</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">3</button>
            <span class="px-4 py-2">...</span>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">10</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </main>

    <!-- Add this modal at the end of the main content, before the footer -->
    <div id="createPostModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg w-full max-w-2xl">
            <!-- Modal Header -->
            <div class="p-4 border-b flex justify-between items-center">
                <h3 class="text-xl font-bold">Create New Article</h3>
                <button onclick="document.getElementById('createPostModal').classList.add('hidden')" 
                        class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form>
                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded-md">
                    </div>

                    <!-- Theme -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                        <select class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="">Select Theme</option>
                            <option value="suvs">SUVs</option>
                            <option value="sedans">Sedans</option>
                            <option value="sports">Sports Cars</option>
                            <option value="electric">Electric Vehicles</option>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <input type="text" placeholder="Separate tags with commas" class="w-full p-2 border border-gray-300 rounded-md">
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea rows="6" class="w-full p-2 border border-gray-300 rounded-md"></textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                        <input type="file" accept="image/*" class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t flex justify-end space-x-3">
                <button onclick="document.getElementById('createPostModal').classList.add('hidden')" 
                        class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-700">
                    Publish Post
                </button>
            </div>
        </div>
    </div>
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="bg-white w-11/12 max-w-4xl mx-auto mt-10 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl font-bold" id="article-title">Article Title</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <span class="text-2xl">&times;</span>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-4 space-y-4">
                <!-- Image -->
                <img src="/api/placeholder/800/400" alt="Article" class="w-full h-64 object-cover rounded-lg">

                <!-- Meta -->
                <div class="flex gap-4 text-sm text-gray-600">
                <span>Published: Jan 8, 2025</span>
                <span>5 Comments</span>
                </div>

                <!-- Tags -->
                <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">#technology</span>
                <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">#web</span>
                </div>

                <!-- Content -->
                <div class="prose max-w-none">
                <p>Article content goes here...</p>
                </div>

                <!-- Comments -->
                <div class="border-t pt-4 mt-8">
                    <h3 class="text-lg font-bold mb-4">Comments</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <div class="flex justify-between mb-2">
                                <span class="font-medium">User Name</span>
                                <span class="text-sm text-gray-500">2 hours ago</span>
                            </div>
                            <p class="text-gray-700">Comment content...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">DRIVE & LOC</h3>
                    <p class="mb-4">117, rue de la Pyramide<br>Casablanca, Morocco</p>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Vehicles</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition duration-300">SUVs</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Sedans</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Sports Cars</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Electric</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li>Phone: +212 61413 7566</li>
                        <li>Email: drive&loc@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p>&copy; 2002 - 2025 Drive & Loc. All Rights Reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition duration-300">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition duration-300">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="../../../assets/js/forum/articles.js"></script>
</body>
</html>