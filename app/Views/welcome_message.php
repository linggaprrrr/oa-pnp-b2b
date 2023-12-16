

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
        <!-- <link rel="stylesheet" href="landing-page/assets/css/icons.css"> -->

        <!-- CSS
        ================================================== -->
        <link rel="stylesheet" href="landing-page/assets/css/uikit.css">
        <link rel="stylesheet" href="landing-page/assets/css/style.css">
        <link rel="stylesheet" href="landing-page/assets/css/tailwind.css"> 

    </head>

    <body>
         
        <!--  Header  -->
        <header class="border-none is-transparent backdrop-filter backdrop-blur-2xl bg-opacity-80"3600
            uk-sticky="cls-inactive:is-transparent border-none ; cls-active:has-shadow">
            <div class="header_inner">
                <div class="left-side">
        
                    <!-- Logo -->
                    <div id="logo">
                        <a href="/">
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
                            <!-- <li> 
                              <a href="/pricing"  class="flex block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500">Pricing</a>                                
                            </li> -->
                            <li> 
                              <a href="/about"  class="flex block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500">About</a>                                
                            </li>
                        </ul>
                    </nav>
        
                    <a href="/sign-up" class="btn_buy"> Register </a>
        
                    <!-- overly for small devices -->
                    <div class="overly" uk-toggle="target: .header_menu ; cls: is-visible"></div>
        
                </div>
            </div>
        </header>
        
        <div class="section main__section bg-gray-50 pb-0 overflow-hidden">
 
            <div class="max-w-6xl mx-auto lg:p-0 md:pb-0 px-6">
                 
                <div class="md:flex items-center lg:mt-10 mb-4">
                    <div class="relative md:w-6/12 transform xl:scale-105 lg:translate-x-20 md:translate-x-14 order-2">
                        <img src="landing-page/assets/images/home-dash-2.png" alt="">
                    </div>
                    <div class="space-y-8 md:w-6/12 lg:-mt-10 mt-10">
                        <h1 class="h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50">Something that will help you analyze </h1>
                        <p class="info">OA-app is an innovative software designed specifically to help businesses manage and optimize their operations. With a combination of outstanding features.</p>              
                        <p class="info">Choose the option that best suits your requirements.</p>
                        <div class="md:flex font-semibold items-center md:space-x-6 md:md:mb-14 mb-10 md:space-y-0 space-y-4" style="margin-top: 10px;">
                            <a href="/pnp/login" class="btn btn-blue-dark md:w-auto w-full">P&P</a>
                            <a href="/b2b/login" class="btn btn-yellow md:w-auto w-full">B2B</a>
                        </div>

                    </div>
                </div>
               
            </div>
           
        </div>

        <div class="section bg-white">
            <div class="container">

                <h1 class="sec__info h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50">  Try to soar to new heights with our capabilities</h1>
                <p class="sec__info info">  Amazing features for tracking your customers activity which give you significant advantages in offers.</p>
                
                <div class="grid md:grid-cols-2 gap-10 mb-10 md:mt-20">

                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative">
                        <img src="landing-page/assets/images/buy.png" alt="" class="w-full md:mb-12 mb-6">                        
                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> Buying Items </div>
                        <div class="text-gray-400"> OA-app enables you to easily create purchase orders for various suppliers. You can manage a product catalog, monitor inventory, and track order statuses quickly and efficiently.</div>
                    
                    </div>

                    
                   
                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative">
                        <img src="landing-page/assets/images/profit.png" alt="" class="w-full md:mb-12 mb-6">

                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> Profit Analysis</div>
                        <div class="text-gray-400"> OA-app provides advanced analytical tools that allow you to calculate and analyze the profit from each of your products. You can view comprehensive profit reports, including cost breakdowns, profit margins, and more.  </div>
                    
                    </div>

                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative md:mt-10 md:-mb-10">
                        <img src="landing-page/assets/images/roi.png" alt="" class="w-full md:mb-12 mb-6">

                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> ROI (Return on Investment) Analysis </div>
                        <div class="text-gray-400"> With OA-app, you can easily calculate ROI for each product or marketing campaign. This helps you understand the effectiveness of your investments and make smarter decisions for your business growth.</div>
                    
                    </div>
                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative md:mt-10 md:-mb-10">
                        <img src="landing-page/assets/images/tracking.png" alt="" class="w-full md:mb-12 mb-6">

                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> Tracking System </div>
                        <div class="text-gray-400"> A powerful tracking system allows you to monitor the journey of products from the warehouse to the end customer. You can track shipments, identify bottlenecks, and provide real-time information to customers.</div>
                    
                    </div>
                </div>

                <!-- <div class="md:flex font-semibold items-center justify-center md:mt-24 mt-10">
                    <button class="btn btn_blue-light md:w-auto w-full">Try it for free 30 days today</button>
                </div> -->

            </div>
        </div> 

        <div class="section bg-white lg:-mt-10 -mt-16">
            <div class="container">
                <div class="max-w-6xl mx-auto md:space-y-48 space-y-24">
         
                    <div class="md:flex items-center lg:mt-10">
                        <div class="relative md:w-7/12 transform xl:scale-105 lg:translate-x-12 md:translate-x-8 order-2">
                            <img src="landing-page/assets/images/benefits.png" class="shadow" alt=""> 
                        </div>
                        <div class="space-y-8 md:w-6/12 lg:mt-0 mt-10">
                            <h1 class="h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50">Benefits s</h1>                            
                            <div class="lg:pr-3">
                 
                                <div class="feature__item">
                                    <div class="feature__icon"><img src="landing-page/assets/images/icons/optimize.png" alt=""></div>
                                    <div class="feature__details">
                                      <div class="feature__title">Operational Optimization</div>
                                      <div class="feature__text">It helps you optimize your business operations by streamlining the purchasing process, tracking products, and analyzing profits.</div>
                                    </div>
                                </div>
                                <div class="feature__item">
                                    <div class="feature__icon"><img src="landing-page/assets/images/icons/data.png" alt=""></div>
                                    <div class="feature__details">
                                      <div class="feature__title">Data-Driven Decision-Making</div>
                                      <div class="feature__text">With comprehensive analytical reports, you can make better strategic decisions for your business growth.</div>
                                    </div>
                                </div>
                                <div class="feature__item">
                                    <div class="feature__icon"><img src="landing-page/assets/images/icons/profit.png" alt=""></div>
                                    <div class="feature__details">
                                      <div class="feature__title">Increased Profits</div>
                                      <div class="feature__text">With a better understanding of profits and ROI, you can identify profitable products and take steps to increase revenue.</div>
                                    </div>
                                </div>
                                <div class="feature__item">
                                    <div class="feature__icon"><img src="landing-page/assets/images/icons/cs.png" alt=""></div>
                                    <div class="feature__details">
                                      <div class="feature__title">Improved Customer Service</div>
                                      <div class="feature__text">Tracking systems and real-time information help you provide better customer service by offering accurate delivery estimates and faster issue resolution.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
         
                    </div>
                                         

                </div>
            </div>
        </div>

        <div class="section bg-gray-50">
            <div class="container">
         
                <h1 class="sec__info h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50"> Be better every day </h1>
                <p class="sec__info info">Every day people interact with our platform which helps track user activity from products</p>

                <div uk-lightbox>
                    <a href="https://www.youtube.com/watch?v=YE7VzlLtp-4" data-caption="YouTube">
                        <div data-src="landing-page/assets/images/content/video-prev.png" class="view-video bg-cover bg-center shadow-1" uk-img>
        
                            <div class="bg-blue-600 rounded-full absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 ">
                                <div class="flex items-center justify-center w-20 h-20 text-white"> <ion-icon name="play" class="text-5xl"></ion-icon> </div> 
                            </div>
                      
                        </div>
                    </a>
                </div>

            </div>
        </div>
        
        <!-- <div class="section bg-white">
            <div class="container">
        
                <h1 class="sec__info h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50"> Expand your options with a subscription</h1>
                <p class="sec__info info">Choose the plan that suits you best! More features will be available thanks to individual plans.</p>
                                

                <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-10 mt-20">                   
                    <div class="packages__item">
                      <div class="packages__subtitle">Montly</div>
                      <div class="packages__text">For a small company that wants to show what it's worth.</div>
                      <div class="packages__line">
                        <div class="packages__price">
                            <div id="price"> $300</div>                            
                        </div>
                        <div class="packages__note">Per User / Per Month</div>
                      </div>
                      <ul class="packages__list">
                        <li>Access to editing all blocks</li>
                        <li>Editing blocks together</li>
                        <li>Access to all premium icons</li>
                        <li>A dedicated domain</li>
                        <li>Ability to integrate with CMS</li>
                      </ul>
                      <button class="packages__btn btn btn_blue btn_wide">Choose</button>
                    </div>
                    <div class="packages__item">
                      <div class="packages__subtitle">Annualy</div>
                      <div class="packages__text">For a large company that wants to achieve maximum returns</div>
                      <div class="packages__line">
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
                      <button class="packages__btn btn btn_blue-light btn_wide">Choose</button>
                    </div>
                      
                </div>

            </div>
        </div> -->

        <div class="section bg-gray-50">
            <div class="container">
        
                <h1 class="sec__info h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50"> Frequently asked question</h1>
                <p class="sec__info info"> Jobs that are available from us and looking for their own people! Browse our vacancies and find the one that is right for you!</p>

                <div class="grid sm:grid-cols-2 sm:gap-x-8 sm:gap-y-10 gap-4 mt-20 text-black sm:font-semibold font-medium">

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

                <div class="flex justify-center md:mt-20 mt-6">
                    <button class="btn btn_blue-light md:w-auto w-full btn_more"> Still have unanswered questions? Get in touch </button>
                </div>

            </div>
        </div>

        <div class="section bg-white pb-0">
            <div class="container"> 

                <div class="md:flex md:border-b-2 border-light md:pb-20">
                    <div class="flex-1">
                        <div class="font-semibold mb-2 md;text-3xl text-2xl"> Secure your data in minutes. </div>
                        <div class="text-gray-400 md:text-xl"> Prevent security breaches and save money. </div>
                    </div>
                    <div class="md:flex items-center justify-center md:space-x-6 md:space-y-0 space-y-4 md:w-6/12 md:mt-0 mt-6">
                        <button class="btn btn_blue w-full">Get Started</button>
                        <button class="btn btn_blue-light w-full">View more</button>
                    </div>
                </div>

            </div>
        </div>
 
        <!-- footer -->
        <div class="section bg-white pb-10">
            <div class="container">
                <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 lg:gap-14 gap-7 text-gray-400 font-medium md:text-xl text-base">

                    <div class="lg:col-span-2 sm:col-span-4 col-span-2">                        
                        <p class="md:text-xl md:leading-9 text-base"> OA App  is an innovative software designed specifically to help businesses manage and optimize their operations. With a combination of outstanding features.
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




