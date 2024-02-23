

<!DOCTYPE html>
<html lang="en">

    <head> 

        <!-- Basic Page Needs
        ================================================== -->
        <title>Quickprep</title>
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
                            <img src="assets/img/quickprep-logo.png" alt="" style="height: 70px">
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
                    
                        </ul>
                    </nav>
        
                    <a href="/sign-up" class="btn_buy"> Register </a>
        
                    <!-- overly for small devices -->
                    <div class="overly" uk-toggle="target: .header_menu ; cls: is-visible"></div>
        
                </div>
            </div>
        </header>
         
        <div class="section bg-white">
            <div class="container">

                <h1 class="sec__info h2" uk-scrollspy="cls: uk-animation-slide-bottom-small;delay: 50">  Try to soar to new heights with our capabilities</h1>
                <p class="sec__info info">  Amazing features for tracking your customers activity which give you significant advantages in offers.</p>
                
                <div class="grid md:grid-cols-2 gap-10 mb-10 md:mt-20">

                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative">
                        <img src="landing-page/assets/images/buy.png" alt="" class="w-full md:mb-12 mb-6">                        
                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> Buying Items </div>
                        <div class="text-gray-400"> Quickprep enables you to easily create purchase orders for various suppliers. You can manage a product catalog, monitor inventory, and track order statuses quickly and efficiently.</div>
                    
                    </div>

                    
                   
                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative">
                        <img src="landing-page/assets/images/profit.png" alt="" class="w-full md:mb-12 mb-6">

                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> Profit Analysis</div>
                        <div class="text-gray-400"> Quickprep provides advanced analytical tools that allow you to calculate and analyze the profit from each of your products. You can view comprehensive profit reports, including cost breakdowns, profit margins, and more.  </div>
                    
                    </div>

                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative md:mt-10 md:-mb-10">
                        <img src="landing-page/assets/images/roi.png" alt="" class="w-full md:mb-12 mb-6">

                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> ROI (Return on Investment) Analysis </div>
                        <div class="text-gray-400"> With Quickprep, you can easily calculate ROI for each product or marketing campaign. This helps you understand the effectiveness of your investments and make smarter decisions for your business growth.</div>
                    
                    </div>
                    <div class="bg-gray-50 rounded-2xl lg:p-10 p-4 md:space-y-5 space-y-3 relative md:mt-10 md:-mb-10">
                        <img src="landing-page/assets/images/tracking.png" alt="" class="w-full md:mb-12 mb-6">

                        <div class="font-semibold lg:text-3xl md:text-2xl text-xl"> Tracking System </div>
                        <div class="text-gray-400"> A powerful tracking system allows you to monitor the journey of products from the warehouse to the end customer. You can track shipments, identify bottlenecks, and provide real-time information to customers.</div>
                    
                    </div>
                </div>

        

            </div>
        </div> 

        

       


        <!-- footer -->
        <div class="section bg-white pb-10">
            <div class="container">
                <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 lg:gap-14 gap-7 text-gray-400 font-medium md:text-xl text-base">

                    

                </div>
        
                <div class="flex justify-center lg:mt-20 mt-10">
                    <p class="text-gray-400 font-medium md:text-lg text-base text-center"> © 2023 Quickprep. </p>
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




