<?php
    require_once __DIR__ . "../../../../../vendor/autoload.php";
    use App\classes\User;
    $user = new User();
    $user->isLoggedAsClient();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Forum</title>

	<!-- Tailwind -->
	<style>
		@import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

		.font-family-karla {
			font-family: karla;
		}
	</style>
	<link rel="stylesheet" href="../../../assets/css/input.css">
	<link rel="stylesheet" href="../../../assets/css/output.css">
	<!-- AlpineJS -->
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

	<nav class="w-full py-4 bg-blue-800 shadow">
		<div class=" container flex flex-wrap items-center justify-between max-w-6xl mx-auto">

			<nav>
				<ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
					<li><a class="hover:text-gray-200 hover:underline px-4" href="#">Home</a></li>
					<li><a class="hover:text-gray-200 hover:underline px-4" href="#">Articles</a></li>
					<li><a class="hover:text-gray-200 hover:underline px-4" href="#">Drive & loc</a></li>
				</ul>
			</nav>

			<div class="flex items-center text-lg no-underline text-white pr-6">
				<a class="" href="../../clientPages/forumPages/favorites.php">
					<i class="fa-solid fa-star"></i>
				</a>
				<a class="pl-6" href="../../authentification/deauth.php">
					<i class="fa-solid fa-right-from-bracket"></i>
				</a>
			</div>
		</div>

	</nav>

	<header class="w-full max-w-6xl container mx-auto">
		<div class="flex flex-col items-center py-12">
			<a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
				DRIVE & BLOG
			</a>
			<p class="text-lg text-gray-600">
				All you need to know about Vehicles
			</p>
		</div>
	</header>

	<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
		<div class="block sm:hidden">
			<a href="#" class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center" @click="open = !open">
				Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
			</a>
		</div>
		<div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
			<div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
				<?php
					
				?>
				<a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Sports</a>
			</div>
		</div>
	</nav>

	<main class="container mx-auto flex flex-wrap py-6">

		<!-- Posts Section -->
		<section class="w-full md:w-2/3 max-w-6xl mx-auto flex flex-col items-center px-3">

			<article class="flex flex-col shadow my-4">
				<!-- Article Image -->
				<!-- <a href="#" class="hover:opacity-75">
					<img src="../../../assets/images/adminDashboard.jpg">
				</a> -->
				<div class="bg-white flex flex-col justify-start p-6">
					<a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
					<a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a>
					<p href="#" class="text-sm pb-3">
						By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on April 25th, 2020
					</p>
					<a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
					<a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
				</div>
			</article>

			<article class="flex flex-col shadow my-4">
				<!-- Article Image -->
				<!-- <a href="#" class="hover:opacity-75">
					<img src="../../../assets/images/signup_img.jpg">
				</a> -->
				<div class="bg-white flex flex-col justify-start p-6">
					<a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Automotive, Finance</a>
					<a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a>
					<p href="#" class="text-sm pb-3">
						By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on January 12th, 2020
					</p>
					<a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
					<a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
				</div>
			</article>

			<article class="flex flex-col shadow my-4">
				<!-- Article Image -->
				<!-- <a href="#" class="hover:opacity-75">
					<img src="https://source.unsplash.com/collection/1346951/1000x500?sig=3">
				</a> -->
				<div class="bg-white flex flex-col justify-start p-6">
					<a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Sports</a>
					<a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a>
					<p href="#" class="text-sm pb-3">
						By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on October 22nd, 2019
					</p>
					<a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
					<a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
				</div>
			</article>

			<!-- Pagination -->
			<!-- <div class="flex items-center py-8">
				<a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
				<a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
				<a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>
			</div> -->
			<div class ="py-8">
				<a href="articles" class="px-6 py-4 bg-blue-800 text-white rounded-xl font-bold text-xl">see more</a>
			</div>

		</section>

	</main>
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
</body>

</html>