<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('admin/layout/header'); ?>
    <title>Administrator</title>    
    
</head>
    <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    <div
        class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900"
    >
        <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div>

    <!-- Page Wrapper -->
    <div
        id="root"
        class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
        x-cloak
    >
        <!-- Sidebar -->
        <?= $this->include('admin/layout/sidebar'); ?>

        <!-- App Header Wrapper-->
        <nav class="header before:bg-white dark:before:bg-navy-750 print:hidden">
            <!-- App Header  -->
            <div
                class="header-container relative flex w-full bg-white dark:bg-navy-750 print:hidden"
            >
                <!-- Header Items -->
                <div class="flex w-full items-center justify-between">
                <!-- Left: Sidebar Toggle Button -->
                <div class="h-7 w-7">                
                </div>

                <!-- Right: Header buttons -->
                <?= $this->include('admin/layout/topbar'); ?>
                </div>
            </div>
        </nav>

        <!-- Mobile Searchbar -->
        <div
        x-show="$store.breakpoints.isXs && $store.global.isSearchbarActive"
        x-transition:enter="easy-out transition-all"
        x-transition:enter-start="opacity-0 scale-105"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="easy-in transition-all"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-[100] flex flex-col bg-white dark:bg-navy-700 sm:hidden"
        >
            <div
                class="flex items-center space-x-2 bg-slate-100 px-3 pt-2 dark:bg-navy-800"
            >
                <button
                class="btn -ml-1.5 h-7 w-7 shrink-0 rounded-full p-0 text-slate-600 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25"
                @click="$store.global.isSearchbarActive = false"
                >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7"
                    />
                </svg>
                </button>
                <input
                x-effect="$store.global.isSearchbarActive && $nextTick(() => $el.focus() );"
                class="form-input h-8 w-full bg-transparent placeholder-slate-400 dark:placeholder-navy-300"
                type="text"
                placeholder="Search here..."
                />
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <main class="main-content w-full px-[var(--margin-x)] pb-8">
            <div class="flex items-center space-x-4 py-5 lg:py-6">                
            </div>        
            <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                <?= $this->renderSection('content'); ?>  
            </div>            
        </main>
    </div>
    <div id="x-teleport-target"></div>
    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
    
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
    
</html>
<?= $this->renderSection('js'); ?>
<script>    
    $(document).ready(function() {    
        let url = window.location.href;        
        switch (true) {
            case url.includes('users') :                                     
                    $('#users').removeClass();
                    $('#users').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');   
                break;          
            case url.includes('invoices') :                            
                    $('#invoices').removeClass();
                    $('#invoices').addClass('flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90');
                break;
           
        }


        $('.datatable-init').DataTable({
            "aLengthMenu": [[50, 75, 100, -1], [50, 75, 100, "All"]],
            "iDisplayLength": 50,
            "bInfo" : false,
            "aaSorting": []
        });

        var table = $('.datatable-init2').DataTable({            
            "bInfo" : false,
            "aaSorting": [],
            
        });

        $('.datatable-init3').DataTable({            
            "bInfo" : false,
            "aaSorting": [],
            "bLengthChange": false,
        });                         
    });
    var price = 0;
    var plan = "";
    
    $(document).on('click', '.remove-plan', function() {
        swal({
            title: "Are you sure?",
            text: "Once you removed, you will not be able to access the features",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            swal("Poof! You just removed your plan", {
                icon: "success",
            });
            setTimeout(function(){
                window.location.reload();
            }, 2500);
        } else {
            
        }
        });
    });

    $(document).on('click', '.plan1', function(e) {          
        $('.close-plan').click();
        $('.plan-description').html('Monthly');
        $('.plan-rate').html('$300.00');
        $('.plan-subtotal').html('$300.00');
        $('.plan-summary').html('$300.00');
        $('.plan-total').html('$300.00');
        price = 5;
        plan = 'monthly';
        $('.plan-choosed').click();
    });

    $(document).on('click', '.plan2', function(e) {          
        $('.close-plan').click();
        $('.plan-description').html('Annualy');
        $('.plan-rate').html('$3600.00');
        $('.plan-subtotal').html('$3600.00');
        $('.plan-summary').html('$3600.00');
        $('.plan-total').html('$3600.00');
        price = 15;
        plan = 'annualy';
        $('.plan-choosed').click();
    });



    
    
</script>