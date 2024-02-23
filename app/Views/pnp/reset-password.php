

<!DOCTYPE html>
<html lang="en">
    <head> 
        <!-- Basic Page Needs
        ================================================== -->
        <title>OA - App</title>
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


    <div id="wrapper" class="horizontal">
      
        <!--  Header  -->
        <header class="border-none is-transparent backdrop-filter backdrop-blur-2xl bg-opacity-80"
            uk-sticky="cls-inactive:is-transparent border-none ; cls-active:has-shadow">
            <div class="header_inner">
                <div class="left-side">
        
                    <!-- Logo -->
                    <div id="logo" >
                        <a href="/" class="flex block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500">
                            <img src="/lineone/images/sw.jpeg" alt="" class="mr-2">     
                            <p class="">OA App</p>                            
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


        <div class="bg-white pt-56 pb-28 -mt-20">

            <div class="max-w-md mx-auto rounded-xl">
                <form class="w-full" action="/reset-password" method="post" autocomplete="off">
            
                    <div class="mb-12 text-center">
                        <h1 class="lg:text-4xl text-2xl font-semibold mb-4"> Reset Password </h1>
                        <h6 class="text-gray-400 text-xl">  Please entry your new password</h6>
                    </div>
                    <div class="space-y-6">
                    <?php if (session()->getFlashdata('error')) : ?>
                      <div class="my-4 alert flex space-x-2 rounded-lg border border-error px-4 py-4 text-error">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-5 w-5"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"
                          />
                        </svg>
                        <p><?= session()->getFlashdata('error') ?></p>
                      </div>
                    <?php endif ?>
                        <div>
                            <label for="password"> Password </label>
                            <div class="input-with-icon">
                                <i class="uil-unlock"></i>
                                <input type="password" class="input-text with-border" id="password" name="password" autocomplete="nope">
                            </div>                            
                        </div>    
                        <div>
                            <label for="password"> Confirm Password </label>
                            <div class="input-with-icon">
                                <i class="uil-unlock"></i>
                                <input type="password" class="input-text with-border" id="password" name="password" autocomplete="nope">
                            </div>                            
                        </div>              
                        <button type="submit" class="btn btn_blue w-full">Reset</button>                        
                    </div>                    
                </form>
            </div>

        </div>
        
        <!-- footer -->
        <div class="section bg-white pb-10">
            <div class="container">
                <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 lg:gap-14 gap-7 text-gray-400 font-medium md:text-xl text-base">

                    <div class="lg:col-span-2 sm:col-span-4 col-span-2">                        
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
                    <p class="text-gray-400 font-medium md:text-lg text-base text-center"> © 2023 OA App</p>
                </div>
            </div>
        </div>
  
    </div>
        
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