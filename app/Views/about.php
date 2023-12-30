

<!DOCTYPE html>
<html lang="en">
    <head> 
        <!-- Basic Page Needs
        ================================================== -->
        <title>OA App</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Flex is - Professional A unique and beautiful collection of UI elements">

        <!-- Favicon -->
        <link href="landing-page/assets/images/favicon.png" rel="icon" type="image/png">

        <!-- icons
        ================================================== -->
        <link rel="stylesheet" href="landing-page/assets/css/icons.css">

        <!-- CSS
        ================================================== -->
        <link rel="stylesheet" href="landing-page/assets/css/uikit.css">
        <link rel="stylesheet" href="landing-page/assets/css/style.css">
        <link rel="stylesheet" href="landing-page/assets/css/tailwind.css"> 

    </head>

    <body>
        
        <!--  Header  -->
        <header class="border-none is-transparent backdrop-filter backdrop-blur-2xl bg-opacity-80"
            uk-sticky="cls-inactive:is-transparent border-none ; cls-active:has-shadow">
            <div class="header_inner">
                <div class="left-side">
        
                    <!-- Logo -->
                    <div id="logo">
                        <a href="homepage-desktop-app.html">
                            <img src="landing-page/assets/images/logo.svg" alt="">
                            <img src="landing-page/assets/images/logo-white.svg" class="logo_inverse" alt="">
                            <img src="landing-page/assets/images/logo-mobile.svg" class="logo_mobile" alt="">
                        </a>
                    </div>
        
                    <!-- icon menu for mobile -->
                    <div class="triger" uk-toggle="target: .header_menu ; cls: is-visible">
                    </div> 
        
                </div>
                <div class="right-side">
        
                    <!-- menu bar for mobile -->
                    <nav class="header_menu">
                        <ul>
                            <li> 
                              <a href="/"  class="flex block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500">Home</a>                                
                            </li>
                            <li> 
                              <a href="/features"  class="flex block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500">Features</a>                                
                            </li>
                            <li> 
                              <a href="/pricing"  class="flex block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500">Pricing</a>                                
                            </li>
                            <li> 
                              <a href="/about"  class="flex block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500">About</a>                                
                            </li>
                        </ul>
                    </nav>
        
                    <a href="/login" class="btn_buy"> Login </a>
        
                    <!-- overly for small devices -->
                    <div class="overly" uk-toggle="target: .header_menu ; cls: is-visible"></div>
        
                </div>
            </div>
        </header>
        
        <div class="section main__section bg-gray-50">
            <div class="container">
                
                <h1 class="sec__title h1" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50">We are a small team that thinks big!</h1>
                <div class="sec__info info mb-0">We have created software for each employee of your team to help them do their work more efficiently and better to plan, track and release great software!</div>
                
            </div>
        </div>

        <div class="section bg-white">
            <div class="container">
                <div class="max-w-6xl mx-auto lg:space-y-32 space-y-20">
                    <div class="md:flex items-center md:space-x-10 lg:space-x-0">
                        <div class="relative md:w-6/12 transform xl:scale-95">
                            <img src="landing-page/assets/images/content/main-pic-8.1.png" alt="" class="shadow-1 w-full rounded-2xl"  uk-scrollspy="cls: uk-animation-slide-left-medium"> 
                        </div>
                        <div class="space-y-8 md:w-6/12 transform lg:translate-x-20 lg:mt-0 mt-10">
                            <h1 class="h2"  uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50">A team that creates amazing products</h1>
                            <p class="info max-w-md"> Get to know our team members better. Find out what we do and how we want to make the world a better place.</p>
                            <a class="more" href="#">Meet the crew
                                <i class="icon-feather-arrow-right icon"></i>
                            </a>
                        </div>
         
                    </div>
                    <div class="md:flex items-center md:space-x-10 lg:space-x-0"> 
                        <div class="space-y-8 md:w-6/12 transform   lg:mt-0 mt-10">
                            <h1 class="h2"  uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50">Communicate without borders</h1>
                            <p class="info max-w-md"> Our platform has its own chat, which you can use to communicate between colleagues. And you can also install various integrations of other messengers.</p>
                            <div class="grid lg:grid-cols-2 gap-x-4 lg:gap-y-8 gap-y-5 text-lg text-gray-400">
                                <div class="flex items-center space-x-3.5">
                                    <img src="landing-page/assets/images/icons/check.svg" alt=""> 
                                    <div> Fully Responsive </div>
                                </div>
                                <div class="flex items-center space-x-3.5">
                                    <img src="landing-page/assets/images/icons/check.svg" alt=""> 
                                    <div> Suits Your Style </div>
                                </div>
                                <div class="flex items-center space-x-3.5">
                                    <img src="landing-page/assets/images/icons/check.svg" alt=""> 
                                    <div> Multiple Layouts </div>
                                </div>
                                <div class="flex items-center space-x-3.5">
                                    <img src="landing-page/assets/images/icons/check.svg" alt=""> 
                                    <div> Modular Components </div>
                                </div>
                            </div>

                        </div>
                        <div class="relative md:w-6/12 transform xl:scale-95">
                            <img src="landing-page/assets/images/content/main-pic-6.1.png" alt="" class="shadow-1 w-full"  uk-scrollspy="cls: uk-animation-slide-right-medium"> 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="section bg-gray-50">
            <div class="container">

                <h1 class="sec__info h2"  uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50"> What we’re about </h1>
                <p class="sec__info info"> We have created software for each employee of your team to help them do their work more efficiently and better to plan, track and release great software!</p>
          
                <div class="max-w-5xl mx-auto">

                    <div class="relative" uk-slideshow="ratio: 6:3;animation: pull;min-height: 300; max-height: 600">
    
                        <ul class="uk-slideshow-items rounded-2xl shadow-2xl">
                            <li>
                                <img src="landing-page/assets/images/content/slider-pic-1.png" alt="" class="object-cover w-full h-full inset-0">
                            </li> 
                            <li>
                                <img src="landing-page/assets/images/content/slider-pic-1.png" alt="" class="object-cover w-full h-full inset-0">
                            </li> 
                            <li>
                                <img src="landing-page/assets/images/content/slider-pic-1.png" alt="" class="object-cover w-full h-full inset-0">
                            </li> 
                        </ul>
    
                        <a class="absolute bg-white text-3xl text-blue-500 hover:bg-blue-600 hover:text-white bottom-1/2 transform translate-y-1/2 md:flex items-center justify-center -right-8 rounded-full shadow-md z-10 w-16 h-16 hidden" href="#" uk-slideshow-item="next"> <i class="icon-feather-arrow-right"></i></a>
                        <a class="absolute bg-white text-3xl text-blue-500 hover:bg-blue-600 hover:text-white bottom-1/2 transform translate-y-1/2 md:flex items-center justify-center -left-8 rounded-full shadow-md z-10 w-16 h-16 hidden" href="#" uk-slideshow-item="previous"> <i class="icon-feather-arrow-left"></i></a>
                    
                        <ul class="uk-slideshow-nav uk-dotnav flex md:hidden mt-10 justify-center"></ul>

                    </div>

                    

                </div>
 
                <div class="max-w-4xl mx-auto sm:mt-32 mt-20 md:p-0 p-5">
                    <div class="grid md:grid-cols-3 sm:grid-cols-2 sm:gap-x-4 sm:gap-y-8 gap-8">
                        <div class="sm:space-y-6 space-y-3">
                            <div class="lg:text-6xl md:text-4xl text-3xl text-red-400 font-bold"> 900K+ </div>
                            <div class="text-black font-semibold lg:text-2xl text-xl"> Active Customers </div>
                            <p class="sm:font-medium text-gray-400"> We are proud to provide our music app to so many people.</p>
                        </div>
                        <div class="sm:space-y-6 space-y-3">
                            <div class="lg:text-6xl md:text-4xl text-3xl text-blue-400 font-bold"> 2M+ </div>
                            <div class="text-black font-semibold lg:text-2xl text-xl"> Following </div>
                            <p class="sm:font-medium text-gray-400"> Our app has been downloaded by more than 2 million people.</p>
                        </div>
                        <div class="sm:space-y-6 space-y-3">
                            <div class="lg:text-6xl md:text-4xl  text-3xl text-yellow-400 font-bold"> 99.99%</div>
                            <div class="text-black font-semibold lg:text-2xl text-xl"> Positive feedback </div>
                            <p class="sm:font-medium text-gray-400"> We get mostly positive ratings for the quality of our app.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
       

        <!-- footer -->
        <div class="section bg-white pb-10">
            <div class="container">
                <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 lg:gap-14 gap-7 text-gray-400 font-medium md:text-xl text-base">

                    <div class="lg:col-span-2 sm:col-span-4 col-span-2">
                        <img src="landing-page/assets/images/logo.svg" alt="" class="mb-4 md:mb-6 md:w-36 w-24">
                        <p class="md:text-xl md:leading-9 text-base"> AO App is an innovative software designed specifically to help businesses manage and optimize their operations. With a combination of outstanding features.
                        </p>

                        <!-- social icons  -->
                        <div class="flex items-center lg:space-x-5 space-x-3 md:text-2xl text-xl text-gray-300 md:mb-0 my-6">
                            <a href="#" class="bg-gray-50 flex items-center justify-center md:rounded-xl rounded-lg md:w-12 md:h-12 w-9 h-9 border-2 hover:text-pink-600 hover:border-gray-500 border-transparent duration-300" data-tippy-placement="top" title="dribbble"> <i class="icon-brand-dribbble"></i></a>
                            <a href="#" class="bg-gray-50 flex items-center justify-center md:rounded-xl rounded-lg md:w-12 md:h-12 w-9 h-9 border-2 hover:text-indigo-600 hover:border-gray-500 border-transparent duration-300" data-tippy-placement="top" title="Facebook"> <i class="icon-brand-facebook-f"></i></a>
                            <a href="#" class="bg-gray-50 flex items-center justify-center md:rounded-xl rounded-lg md:w-12 md:h-12 w-9 h-9 border-2 hover:text-blue-600 hover:border-gray-500 border-transparent duration-300" data-tippy-placement="top" title="Twitter"> <i class="icon-brand-twitter"></i></a>
                            <a href="#" class="bg-gray-50 flex items-center justify-center md:rounded-xl rounded-lg md:w-12 md:h-12 w-9 h-9 border-2 hover:text-red-600 hover:border-gray-500 border-transparent duration-300" data-tippy-placement="top" title="youtube"> <i class="icon-brand-youtube"></i></a> 
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-4 text-black md:text-2xl text-lg font-semibold">Home</h6>
                        <ul class="list-unstyled space-y-3">
                            <li><a href="#" class="hover:text-blue-500">Desktop App</a></li>
                            <li><a href="#" class="hover:text-blue-500">Mobile App</a></li>
                            <li><a href="#" class="hover:text-blue-500">SaaS</a></li>
                            <li><a href="#" class="hover:text-blue-500">Software</a></li>
                            <li><a href="#" class="hover:text-blue-500">Event</a></li> 
                        </ul>
                    </div>
                    <div>
                        <h6 class="mb-4 text-black md:text-2xl text-lg font-semibold">Pages</h6>
                        <ul class="list-unstyled space-y-3">
                            <li><a href="#" class="hover:text-blue-500">About Us</a></li>
                            <li><a href="#" class="hover:text-blue-500">Careers</a></li>
                            <li><a href="#" class="hover:text-blue-500">Case Studies</a></li>
                            <li><a href="#" class="hover:text-blue-500">Pricing</a></li> 
                        </ul>
                    </div>
                    <div>
                        <h6 class="mb-4 text-black md:text-2xl text-lg font-semibold">Blog</h6>
                        <ul class="list-unstyled space-y-3">
                            <li><a href="#" class="hover:text-blue-500">Blog Listing</a></li>
                            <li><a href="#" class="hover:text-blue-500">Blog Article</a></li>
                            <li><a href="#" class="hover:text-blue-500">Newsroom</a></li> 
                        </ul>
                    </div>
                    <div>
                        <h6 class="mb-4 text-black md:text-2xl text-lg font-semibold">Portfolio</h6>
                        <ul class="list-unstyled space-y-3">
                            <li><a href="#" class="hover:text-blue-500">Portfolio</a></li>
                            <li><a href="#" class="hover:text-blue-500">Single Case</a></li> 
                        </ul>
                    </div>

                </div>
        
                <div class="flex justify-center lg:mt-20 mt-10">
                    <p class="text-gray-400 font-medium md:text-lg text-base text-center"> © 2019-2020 Flex Multipurpose Design Template. </p>
                </div>
            </div>
        </div>

    </body>



        <!-- Javascript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.6/dist/js/uikit.min.js"></script>
    <script src="landing-page/assets/js/tippy.all.min.js"></script>
    <script src="landing-page/assets/js/simplebar.js"></script>
    <script src="landing-page/assets/js/custom.js"></script>
    <script src="landing-page/assets/js/bootstrap-select.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

 
</body>

</html>




