

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


    <div id="wrapper" class="horizontal">

        <!--  Header  -->
        <header class="border-none is-transparent backdrop-filter backdrop-blur-2xl bg-opacity-80"
            uk-sticky="cls-inactive:is-transparent border-none ; cls-active:has-shadow">
            <div class="header_inner">
                <div class="left-side">
        
                    <!-- Logo -->
                    <div id="logo">
                        <a href="/">
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
        
                    <a href="/pnp/login" class="btn_buy"> Login </a>
        
                    <!-- overly for small devices -->
                    <div class="overly" uk-toggle="target: .header_menu ; cls: is-visible"></div>
        
                </div>
            </div>
        </header>

 
        <div class="bg-white pt-56 pb-28 -mt-20">

            <div class="max-w-md mx-auto rounded-xl">
                <form class="w-full"  action="/sign-up-process" method="POST">
                    <div class="mb-12 text-center">
                        <h1 class="lg:text-4xl text-2xl font-semibold mb-4"> Create your account </h1>
                        <h6 class="text-gray-400 text-xl"> Please sign up to continue.</h6>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label for="Name"> Name </label>
                            <div class="input-with-icon">
                                <i class="uil-user"></i>
                                <input type="text" class="input-text with-border" id="Name" name="name">
                            </div>
                        </div>
                        <div>
                            <label for="email"> Email Address </label>
                            <div class="input-with-icon">
                                <i class="uil-envelope-alt"></i>
                                <input type="email" class="input-text with-border" id="email" name="email">
                            </div>
                        </div>
                        <div>
                            <label for="password"> Password </label>
                            <div class="input-with-icon">
                                <i class="uil-unlock"></i>
                                <input type="password" class="input-text with-border" id="password" name="password">
                            </div>
                        </div>
                        <div>
                            <label for="password"> Confirm Password </label>
                            <div class="input-with-icon">
                                <i class="uil-unlock"></i>
                                <input type="password" class="input-text with-border" id="confirm_password" name="password">
                            </div>
                        </div>
                        <div>
                            <label for="Name"> Type </label>
                            <div class="input-with-icon">                            
                                <select id="types" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">                                    
                                    <option value="pnp">P&P</option>
                                    <option value="b2b">B2B</option>
                                </select>
                            </div>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="chekcbox2" class="privacy-policy">
                            <label for="chekcbox2">
                                <span class="checkbox-icon -mt-1"></span> <span class="font-semibold text-gray-400 text-lg">  I agree with privacy policy </span> 
                            </label>
                        </div>
                        <label for="">
                            <small id="message"></small>
                        </label>
                        <button type="submit" class="btn btn_blue w-full">Create my account</button>
                        <div class="font-semibold py-3 text-center text-gray-400 text-xl uk-heading-linee"><span class="px-5">Or</span></div>
                        <a href="<?= $googleAuth ?>" class="btn btn_blue-light w-full flex items-center justify-center"><img src="assets/img/google.svg" alt="" class="g-6 mr-4 w-6"><span class="btn__text">Sign Up with Google</span></a>
                        <a class="block font-medium text-center text-gray-400 text-lg hover:text-blue-600 duration-500" href="/pnp/login">Already have an account? Sign In</a>
                    </div>
                    
                </form>
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

    <script>
        $(document).ready(function() {
            $('.privacy-policy').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.btn-submit').removeClass('disabled:opacity-60');
                    $('.btn-submit').prop("disabled", false);
                } else {
                    $('.btn-submit').addClass('disabled:opacity-60');
                    $('.btn-submit').prop("disabled", true);
                }
            });

            $(document).on('keyup', '#password, #confirm_password', function() {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#message').html('Password Matching').css('color', 'green');
                    
                } else {
                    $('#message').html('Password not matching!').css('color', 'red');
                    $('.btn-submit').prop("disabled", true);
                }            
                    
            });      

            
        })
    </script>
</body>

</html>
