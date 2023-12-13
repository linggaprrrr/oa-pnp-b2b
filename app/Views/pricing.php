

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
         
        <div class="section main__section bg-white">
            <div class="container">
                <div class="max-w-5xl mx-auto">
                    
                    <h1 class="sec__info h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50"> Expand your options with a subscription</h1>
                    <p class="sec__info info">Choose the plan that suits you best! More features will be available thanks to individual plans.</p>
                    
                    

                    <div class="grid lg:grid-cols-2 gap-10 md:mt-20 mt-5">

                        <div class="packages__item price_3">
                            <div class="packages__top">
                                <div class="packages__subtitle">Monthly</div>
                            </div>
                            <div class="packages__text">For a small company that wants to show what it's worth.</div>
                            <div class="packages__line packages__line_border">
                                <div class="packages__price">
                                    <div id="price"> $300</div>
                                </div>
                                <div class="packages__note">Per User / Per month</div>
                            </div>
                            <ul class="packages__list">
                                <li>Access to editing all blocks</li>
                                <li>Editing blocks together</li>
                                <li>Access to all premium icons</li>
                                <li>A dedicated domain</li>
                                <li>Ability to integrate with CMS</li>
                            </ul>
                            <button class="packages__btn btn btn_blue-light btn_wide">Start 14 Days Free Trial</button>
                        </div>
                        <div class="packages__item price_3">
                            <div class="packages__top">
                                <div class="packages__subtitle">Annualy</div>
                                <div class="packages__category">Popular</div>
                            </div>
                            <div class="packages__text">For a large company that wants to achieve maximum returns</div>
                            <div class="packages__line packages__line_border">
                                <div class="packages__price">
                                    <div id="price"> $3600</div>
                                </div>
                                <div class="packages__note">Four Users / Per Year</div>
                            </div>
                            <ul class="packages__list">
                                <li>Access to editing all blocks</li>
                                <li>Editing blocks together</li>
                                <li>Access to all premium icons</li>
                                <li>A dedicated domain</li>
                                <li>Ability to integrate with CMS</li>
                            </ul>
                            <button class="packages__btn btn btn_blue btn_wide">Start 14 Days Free Trial</button>
                        </div>
                        
                    </div>

                    <div class="flex justify-center lg:mt-20 mt-8">
                        <button class="btn btn_blue-light md:w-auto w-full">Interested in a custom plan? Get in touch </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="section bg-gray-50">
            <div class="container">
                 
                <h1 class="sec__title h2"> View all our advantages before purchasing </h1>

                <!-- card list -->
                <div class="grid xl:grid-cols-3 md:grid-cols-2 gap-10 mt-16">
                    
                    <!-- card-1 -->
                    <div class="card_feature">
                        <div class="bg-blue-50 card_feature__icon">
                            <img src="landing-page/assets/images/icons/layout-arrange.svg" alt="">
                        </div>
                        <h3 class="card_feature__title"> Multiple layout  </h3>
                        <p class="card_feature__text"> Edit already created or create new page layouts.</p>
                    </div>
                    
                    <!-- card-2 -->
                    <div class="card_feature">
                        <div class="bg-green-50 card_feature__icon">
                            <img src="landing-page/assets/images/icons/select-green.svg" alt="">
                        </div>
                        <h3 class="card_feature__title"> Fully responsive </h3>
                        <p class="card_feature__text">Change the size of the components without loss of quality. </p>
                    </div>
                    
                    <!-- card-3 -->
                    <div class="card_feature">
                        <div class="bg-yellow-50 card_feature__icon">
                            <img src="landing-page/assets/images/icons/star.svg" alt="">
                        </div>
                        <h3 class="card_feature__title"> Premium icons </h3>
                        <p class="card_feature__text"> Included with the template are 600 + premium icons.</p>
                    </div>
                            
                    <!-- card-4 -->
                    <div class="card_feature">
                        <div class="bg-red-50 card_feature__icon">
                            <img src="landing-page/assets/images/icons/pictures.svg" alt="">
                        </div>
                        <h3 class="card_feature__title"> All images included </h3>
                        <p class="card_feature__text"> Photography and Illustration SVGs are included in the download package.</p>
                    </div>

                    <!-- card-5 -->
                    <div class="card_feature">
                        <div class="bg-blue-50 card_feature__icon">
                            <img src="landing-page/assets/images/icons/chat-smile.svg" alt="">
                        </div>
                        <h3 class="card_feature__title">Friendly support </h3>
                        <p class="card_feature__text"> Buy with confidence. Our team offers timely and personal support.</p>
                    </div>
                    
                    <!-- card-6 -->
                    <div class="card_feature">
                        <div class="bg-green-50 card_feature__icon">
                            <img src="landing-page/assets/images/icons/font.svg" alt="">
                        </div>
                        <h3 class="card_feature__title"> Fonts included</h3>
                        <p class="card_feature__text"> Included with the template are the fonts used.</p>
                    </div>
                
                </div>
                
            </div>
        </div>

        <div class="section bg-gray-50">
            <div class="container">
         
                <h1 class="sec__info h2"> Frequently asked question</h1>
                <p class="sec__info info"> Jobs that are available from us and looking for their own people! Browse our vacancies and find the one that is right for you!</p>
                 
                <div class="max-w-4xl mx-auto">
                    <div class="grid sm:gap-x-8 sm:gap-y-10 gap-4 mt-20 text-black sm:font-semibold font-medium">
    
                        <a href="#" class="hover:text-blue-600 duration-500">
                            <div class="bg-white flex items-start sm:p-8 p-5 rounded-2xl sm:space-x-6">
                                <div class="flex-1 sm:leading-8 sm:text-xl"> Can I use this template for commercial purposes? </div>
                                <i class="icon-feather-chevron-right text-3xl sm:text-xl"></i>
                            </div>
                        </a>
                        <a href="#" class="hover:text-blue-600 duration-500">
                            <div class="bg-white flex items-start sm:p-8 p-5 rounded-2xl sm:space-x-6">
                                <div class="flex-1 sm:leading-8 sm:text-xl"> In which applications can I edit your template? </div>
                                <i class="icon-feather-chevron-right text-3xl sm:text-xl"></i>
                            </div>
                        </a>
                        <a href="#" class="hover:text-blue-600 duration-500">
                            <div class="bg-white flex items-start sm:p-8 p-5 rounded-2xl sm:space-x-6">
                                <div class="flex-1 sm:leading-8 sm:text-xl"> Can support help me work with the template? </div>
                                <i class="icon-feather-chevron-right text-3xl sm:text-xl"></i>
                            </div>
                        </a>
                        <a href="#" class="hover:text-blue-600 duration-500">
                            <div class="bg-white flex items-start sm:p-8 p-5 rounded-2xl sm:space-x-6">
                                <div class="flex-1 sm:leading-8 sm:text-xl">Will there be updates are related to the store? </div>
                                <i class="icon-feather-chevron-right text-3xl sm:text-xl"></i>
                            </div> 
                        </a>
                        <a href="#" class="hover:text-blue-600 duration-500">
                            <div class="bg-white flex items-start sm:p-8 p-5 rounded-2xl sm:space-x-6">
                                <div class="flex-1 sm:leading-8 sm:text-xl"> In which applications can I edit your template? </div>
                                <i class="icon-feather-chevron-right text-3xl sm:text-xl"></i>
                            </div>
                        </a>
                        <a href="#" class="hover:text-blue-600 duration-500">
                            <div class="bg-white flex items-start sm:p-8 p-5 rounded-2xl sm:space-x-6">
                                <div class="flex-1 sm:leading-8 sm:text-xl"> Will there be a version for Figma in the future? </div>
                                <i class="icon-feather-chevron-right text-3xl sm:text-xl"></i>
                            </div> 
                        </a>
    
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




