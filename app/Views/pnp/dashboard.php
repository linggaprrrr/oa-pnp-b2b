<?= $this->extend('pnp/layout/component') ?>
<?= $this->section('content') ?>
<?php
    use function App\Helpers\timeSpan;
    helper('time');
    
    $purchaseLabels = array();
    $purchaseValue = array();
    $purchaseMTDLabel = array();
    $purchaseMTDValue = array();
    $totalPurchMTD = 0;
    $totalPurchYTD = 0;

    foreach ($purchase['purchase_data'] as $data) {
        array_push($purchaseLabels, $data['day']);
        array_push($purchaseValue, round($data['total_price'], 2));                
    }   

    $maxDays = date('t');
    $count = 1;
    
    for ($i = 0; $i < $maxDays; $i++) {
        $match = false;
        foreach ($purchase['total_mtd'] as $mtd) {
            if ($i == $mtd->day) {
                array_push($purchaseMTDValue, round($mtd->total_price, 2));
                $totalPurchMTD = $totalPurchMTD + $mtd->total_price;
                $match = true;
            } 
            
        }
        if ($i < 10) {
            $count = str_pad($count, 2, "0", STR_PAD_LEFT);
            array_push($purchaseMTDLabel, $count);
        } else {
            array_push($purchaseMTDLabel, $count);
        }
        
        if ($match == false) {
            array_push($purchaseMTDValue, 0);    
        }         
        $count++;
    }

    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $purchaseYTDValue = array();    
    $totalPurchYTD = 0;
    $purchThisMonth = 0;
    for ($i = 0; $i < count($months); $i++) {
        
        $found = false;
        foreach ($purchase['total_ytd'] as $ytd) {
            if (strtolower($ytd->month) == strtolower($months[$i])) {            
                array_push($purchaseYTDValue, round($ytd->total_price, 1));
                $totalPurchYTD = $totalPurchYTD + $ytd->total_price;
                $purchThisMonth = $ytd->total_price;
                $found = true;
            }            
        }
        if ($found == false) {
            array_push($purchaseYTDValue, 0);
        }
    }

    $assignMTDLabel = array();  
    $assignMTDValue = array();  
    $totalAssignedMTD = 0;
    $count = 1;
    for ($i = 0; $i < $maxDays; $i++) {
        $match = false;
        foreach ($assigned['total_mtd'] as $mtd) {
            if ($i == $mtd->day) {
                if (is_null($mtd->total_assigned)) {
                    array_push($assignMTDValue, 0);
                    $totalAssignedMTD = $totalAssignedMTD + 0;
                } else {
                    array_push($assignMTDValue, $mtd->total_assigned);
                    $totalAssignedMTD = $totalAssignedMTD + $mtd->total_assigned;
                }
                
                
                $match = true;
            } 
            
        }
        if ($i < 10) {
            $count = str_pad($count, 2, "0", STR_PAD_LEFT);
            array_push($assignMTDLabel, $count);
        } else {
            array_push($assignMTDLabel, $count);
        }
        
        if ($match == false) {
            array_push($assignMTDValue, 0);    
        }         
        $count++;
    }

    $assignYTDValue = array();
    $totalAssignedYTD = 0;
    $assignThisMonth = 0;
    for ($i = 0; $i < count($months); $i++) {
        $found = false;
        foreach ($assigned['total_ytd'] as $ytd) {
            if (strtolower($ytd->month) == strtolower($months[$i])) {            
                if (is_null($ytd->total_assigned)) {
                    array_push($assignYTDValue, 0);
                    $totalAssignedYTD = $totalAssignedYTD + 0;                           
                } else {
                    array_push($assignYTDValue, $ytd->total_assigned);
                    $totalAssignedYTD = $totalAssignedYTD + $ytd->total_assigned;                
                    $assignThisMonth =  $ytd->total_assigned;
                }
                $found = true;                
            }
        }
        if ($found == false) {            
            array_push($assignYTDValue, 0);
        }
    }

    $ntuMTDLabel = array();  
    $ntuMTDValue = array();  
    $totalNTUMTD = 0;
    $count = 1;
    for ($i = 0; $i < $maxDays; $i++) {
        $match = false;
        foreach ($ntu['total_mtd'] as $mtd) {
            if ($i == $mtd->day) {
                if (is_null($mtd->total_cost)) {
                    array_push($ntuMTDValue, 0);
                    $totalNTUMTD = $totalNTUMTD + 0;
                } else {
                    array_push($ntuMTDValue, round($mtd->total_cost, 2));
                    $totalNTUMTD = $totalNTUMTD + $mtd->total_cost;
                }
                $match = true;
            } 
            
        }
        if ($i < 10) {
            $count = str_pad($count, 2, "0", STR_PAD_LEFT);
            array_push($ntuMTDLabel, $count);
        } else {
            array_push($ntuMTDLabel, $count);
        }
        
        if ($match == false) {
            array_push($ntuMTDValue, 0);    
        }         
        $count++;
    }
    
    $ntuYTDValue = array();
    $totalNTUYTD = 0;
    $ntuThisMonth = 0;
    for ($i = 0; $i < count($months); $i++) {
        $found = false;
        foreach ($ntu['total_ytd'] as $ytd) {
            if (strtolower($ytd->month) == strtolower($months[$i])) {            
                if (is_null($ytd->total_cost)) {
                    array_push($ntuYTDValue, 0);
                    $totalNTUYTD = $totalNTUYTD + 0; 
                } else {
                    array_push($ntuYTDValue, $ytd->total_cost);
                    $totalNTUYTD = $totalNTUYTD + $ytd->total_cost;
                    $ntuThisMonth = $ytd->total_cost;                 
                }
                $found = true;
            }          
        }
        if ($found == false) {
            array_push($ntuYTDValue, 0);
        }
    }

    $assignLabels = array();
    $assignValue = array();
    foreach ($assigned['assigned_data'] as $assign) {
        array_push($assignLabels, $assign['day']);
        array_push($assignValue, round($assign['total_assigned'], 2));
    }

    $ntuLabels = array();
    $ntuValue = array();
    foreach ($ntu['ntu_data'] as $day) {
        array_push($ntuLabels, $day['day']);
        array_push($ntuValue, round($day['total_cost'], 2));
    }
?>
<script>
    const purchLabel = <?= json_encode(array_reverse($purchaseLabels)) ?>;
    const purchValue = <?= json_encode(array_reverse($purchaseValue)) ?>;
    const purchMTDLabel = <?= json_encode($purchaseMTDLabel) ?>;
    const purchMTDValue = <?= json_encode($purchaseMTDValue) ?>;    
    const purchYTDValue = <?= json_encode($purchaseYTDValue) ?>;
    
    const assignLabel = <?= json_encode(array_reverse($assignLabels)) ?>;
    const assignValue = <?= json_encode(array_reverse($assignValue)) ?>;
    const assignMTDLabel = <?= json_encode($assignMTDLabel) ?>;
    const assignMTDValue = <?= json_encode($assignMTDValue) ?>;    
    const assignYTDValue = <?= json_encode($assignYTDValue) ?>;    

    const ntuLabel = <?= json_encode(array_reverse($ntuLabels)) ?>;
    const ntuValue = <?= json_encode(array_reverse($ntuValue)) ?>;
    const ntuMTDLabel = <?= json_encode($ntuMTDLabel) ?>;
    const ntuMTDValue = <?= json_encode($ntuMTDValue) ?>;    
    const ntuYTDValue = <?= json_encode($ntuYTDValue) ?>;
    
</script>
<?php 

    // dd($ntuYTDValue);
?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card mt-12 bg-gradient-to-r from-blue-500 to-blue-600 p-5 sm:mt-0 sm:flex-row ">
        <div class="flex justify-center sm:order-last">
            <img class="-mt-16 h-40 sm:mt-0" src="/lineone/images/illustrations/dashboard-check.svg" alt="">
        </div>
        <div class="mt-2 flex-1 pt-2 text-center text-white sm:mt-0 sm:text-left">
            <h3 class="text-xl">
                Welcome Back, <span class="font-semibold"><?= (empty(session()->get('name'))) ? ucfirst(session()->get('username')) : ucfirst(session()->get('name')) ?></span>
            </h3>
            <p class="mt-2 leading-relaxed">
                Total purchases for today is
                <span class="font-semibold text-white-700"><?= (!is_null($totalQtyToday)) ? $totalQtyToday->total_qty : '-' ?></span> of Qty
            </p>
            <div class="flex">
                <div x-data="{showModal:false}" class="mr-4">
                    <button
                        @click="showModal = true"
                        class="btn mt-12 bg-slate-50 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80"
                    >
                        See Details
                    </button>                
                    <template x-teleport="#x-teleport-target">
                        <div
                            class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                            x-show="showModal"
                            role="dialog"
                            @keydown.window.escape="showModal = false"
                        >
                            <div
                                class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                                @click="showModal = false"
                                x-show="showModal"
                                x-transition:enter="ease-out"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                            ></div>
                            <div
                                class="relative w-full max-w-screen-lg origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"
                                x-show="showModal"
                                x-transition:enter="easy-out"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="easy-in"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                            >
                                <div
                                class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"
                                >
                                <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                    Your Purchase Today
                                </h3>
                                <button
                                    @click="showModal = !showModal"
                                    class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                >
                                    <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4.5 w-4.5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    ></path>
                                    </svg>
                                </button>
                                </div>
                                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                #
                                            </th>
                                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                ASIN
                                            </th>
                                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                Title
                                            </th>
                                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                Qty
                                            </th>
                                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                Buy Cost
                                            </th>
                                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                Market Price
                                            </th>
                                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                Profit
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php if ($purchaseDataToday->getNumRows() > 0) : ?>
                                            <?php foreach($purchaseDataToday->getResultObject() as $prod) : ?>
                                                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $no++ ?></td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                        <?= $prod->asin ?>
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">                                            
                                                        <?= substr($prod->title, 0, 50) ?><?= (strlen($prod->title) > 50) ? '..' : '' ?>
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $prod->qty ?></td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($prod->buy_cost, 2) ?></td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($prod->market_price, 2) ?></td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($prod->profit, 2) ?></td>                                        
                                                </tr>    
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    -
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">                                            
                                                    -
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>                                        
                                            </tr>
                                        <?php endif ?>
                                                                
                                    </tbody>
                                </table>
                                </div>                     
                            </div>
                        </div>
                    </template>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="mt-2 grid grid-cols-1 gap-6 sm:grid-cols-4">
        <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
            <p class="text-xs uppercase text-sky-100">Total Purchase Amount Today</p>                        
            <div class="flex items-end justify-between space-x-2">
                <p class="mt-2 text-2xl font-medium text-white">$<?= (is_null($purchase['total_today'])) ? '-' : number_format($purchase['total_today'], 2) ?></p>                               
            </div>            
            <div class="flex justify-end">                
                <div class="mr-4">
                    <p class="text-xs uppercase text-sky-100">This Month</p>
                    <div class="flex items-end justify-between space-x-2">
                        <p class="text-xl font-medium text-white">$<?= (is_null($purchThisMonth)) ? '-' : number_format($purchThisMonth, 2) ?></p>                
                    </div>
                </div>
                <div>
                    <p class="text-xs uppercase text-sky-100">This Week</p>
                    <div class="flex items-end justify-between space-x-2">
                        <p class="text-xl font-medium text-white">$<?= (is_null($purchase['total_this_week'])) ? '-' : number_format($purchase['total_this_week'], 2) ?></p>                
                    </div>
                </div>
            </div>
            
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
        </div>
        <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 p-3.5">
            <p class="text-xs uppercase text-amber-50">Total Assigned Today</p>
            <div class="flex items-end justify-between space-x-2">
                <p class="mt-2 text-2xl font-medium text-white"><?= (is_null($assigned['total_today']) ? '-' : $assigned['total_today']) ?></p>             
            </div>
            <div class="flex justify-end">                
                <div class="mr-4">
                    <p class="text-xs uppercase text-sky-100">This Month</p>
                    <div class="flex items-end justify-between space-x-2">
                    <p class="text-xl font-medium text-white"><?= (is_null($assignThisMonth)) ? '-' : $assignThisMonth ?></p>                
                    </div>
                </div>
                <div>
                    <p class="text-xs uppercase text-sky-100">This Week</p>
                    <div class="flex items-end justify-between space-x-2">
                        <p class="text-xl font-medium text-white"><?= (is_null($assigned['total_this_week'])) ? '-' : $assigned['total_this_week'] ?></p>                
                    </div>
                </div>
            </div>
            <div class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
        </div>
        <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
            <p class="text-xs uppercase text-pink-100">Total Need To Upload Today</p>
                <div class="flex items-end justify-between space-x-2">
                <p class="mt-2 text-2xl font-medium text-white">$<?= (is_null($ntu['total_today'])) ? '-' : number_format($ntu['total_today'], 2) ?> </p>           
            </div>
            <div class="flex justify-end">                
                <div class="mr-4">
                    <p class="text-xs uppercase text-sky-100">This Month</p>
                    <div class="flex items-end justify-between space-x-2">
                        <p class="text-xl font-medium text-white">$<?= (is_null($ntuThisMonth)) ? '-' : number_format($ntuThisMonth, 2) ?></p>                
                    </div>
                </div>
                <div>
                    <p class="text-xs uppercase text-sky-100">This Week</p>
                    <div class="flex items-end justify-between space-x-2">
                        <p class="text-xl font-medium text-white">$<?= (is_null($ntu['total_this_week'])) ? '-' : number_format($ntu['total_this_week'], 2) ?></p>                
                    </div>
                </div>
            </div>
            <div class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
        </div>
        <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-fuchsia-600  to-info-focus p-3.5">
            <p class="text-xs uppercase text-sky-100">Total Qty Received Today                 
            </p>                        
            
            <div class="flex items-end justify-between space-x-2">
                <p class="mt-2 text-2xl font-medium text-white"><?= (is_null($totalReceivedToday)) ? '-' : $totalReceivedToday->total_received ?></p>                                           
            </div>            
            <div class="flex justify-end">                
                <div class="mr-4">
                    <p class="text-xs uppercase text-sky-100">Refund Today</p>
                    <div class="flex items-end justify-between space-x-2">
                        <p class="text-xl font-medium text-white"><?= (is_null($totalRefundToday)) ? '-' : $totalRefundToday->total_refund  ?></p>                
                    </div>
                </div>
                <div>
                    <p class="text-xs uppercase text-sky-100">Not Received Today</p>
                    <div class="flex items-end justify-between space-x-2">
                        <p class="text-xl font-medium text-white"><?= (is_null($totalUnreceivedToday)) ? '-' : $totalUnreceivedToday->total_unreceived ?></p>                
                    </div>
                </div>
            </div>
            
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
        </div>
    </div>
    
    <div class="card px-4 pb-4 sm:px-5">
        <div class="max-w-full">            
            <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:grid-cols-2 lg:gap-6 mt-4">
                <div>                   
                    <div id="purchase_mtd"> 
                        <script type="text/javascript">
                            var options = {
                            series: [{
                                name: "Total Amount",
                                data: purchMTDValue
                            }],
                            chart: {
                                height: 350,
                                type: 'line',
                                zoom: {
                                    enabled: false
                                },
                                dropShadow: {
                                    enabled: true,
                                    color: "#1E202C",
                                    top: 18,
                                    left: 6,
                                    blur: 8,
                                    opacity: 0.1,
                                },
                            },
                            dataLabels: {
                                enabled: false
                                },
                                stroke: {
                                    width: 5,
                                    curve: 'smooth'
                                },
                                title: {
                                    text: 'Purchase Overview [MTD]',
                                    align: 'left'
                                },
                                grid: {
                                    row: {
                                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                        opacity: 0.5
                                    },
                                },
                                yaxis: {
                                    labels: {
                                        formatter: function (value) {
                                        return "$"+value;
                                        }
                                    },                                    
                                },
                                xaxis: {
                                    categories: purchMTDLabel,
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#purchase_mtd"), options);
                            chart.render();
                        </script>
                    </div>
                    
                    
                
                </div>
                <div>                   
                    <div id="purchase_ytd"> 
                        
                        <script type="text/javascript">
                            // console.log(purchYTDValue);
                            var options = {
                            series: [{
                                name: "Total Amount",
                                data: purchYTDValue
                            }],
                            chart: {
                                height: 350,
                                type: 'line',
                                zoom: {
                                    enabled: false
                                },
                                dropShadow: {
                                    enabled: true,
                                    color: "#1E202C",
                                    top: 18,
                                    left: 6,
                                    blur: 8,
                                    opacity: 0.1,
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                width: 5,
                                curve: 'smooth'
                            },
                            title: {
                                text: 'Purchase Overview [YTD]',
                                align: 'left'
                            },
                            grid: {
                                row: {
                                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                    opacity: 0.5
                                },
                            },
                            yaxis: {
                                    labels: {
                                        formatter: function (value) {
                                        return "$"+value;
                                        }
                                    },
                                },
                                fill: {
                                    type: "gradient",
                                    gradient: {
                                        shade: "dark",
                                        gradientToColors: ["#86efac"],
                                        shadeIntensity: 1,
                                        type: "horizontal",
                                        opacityFrom: 1,
                                        opacityTo: 0.95,
                                        stops: [0, 100, 0, 100],
                                    },
                                },
                                xaxis: {
                                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#purchase_ytd"), options);
                            chart.render();
                        </script>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
    <div class="card px-4 pb-4 sm:px-5">
        <div class="max-w-full">            
            <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:grid-cols-2 lg:gap-6 mt-4">
                <div>                   
                    <div id="assigned_mtd"> 
                        <script type="text/javascript">
                            var options = {
                            series: [{
                                name: "Total Qty",
                                data: assignMTDValue
                            }],
                            chart: {
                                height: 350,
                                type: 'line',
                                zoom: {
                                    enabled: false
                                },
                                dropShadow: {
                                    enabled: true,
                                    color: "#1E202C",
                                    top: 18,
                                    left: 6,
                                    blur: 8,
                                    opacity: 0.1,
                                },
                            },
                            dataLabels: {
                                enabled: false
                                },
                                stroke: {
                                    width: 5,
                                    curve: 'smooth'
                                },
                                title: {
                                    text: 'Total Assigned Overview [MTD]',
                                    align: 'left'
                                },
                                grid: {
                                    row: {
                                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                        opacity: 0.5
                                    },
                                },                                
                                xaxis: {
                                    categories: assignMTDLabel,
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#assigned_mtd"), options);
                            chart.render();
                        </script>
                    </div>        
                </div>
                <div>                   
                    <div id="assigned_ytd"> 
                        <script type="text/javascript">
                            var options = {
                            series: [{
                                name: "Total Qty",
                                data: assignYTDValue
                            }],
                            chart: {
                                height: 350,
                                type: 'line',
                                zoom: {
                                    enabled: false
                                },
                                dropShadow: {
                                    enabled: true,
                                    color: "#1E202C",
                                    top: 18,
                                    left: 6,
                                    blur: 8,
                                    opacity: 0.1,
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth'
                            },
                            title: {
                                text: 'Total Assigned Overview [YTD]',
                                align: 'left'
                            },
                            grid: {
                                row: {
                                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                    opacity: 0.5
                                },
                            },                         
                            xaxis: {
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shade: "dark",
                                    gradientToColors: ["#f43f5e"],
                                    shadeIntensity: 1,
                                    type: "horizontal",
                                    opacityFrom: 1,
                                    opacityTo: 0.95,
                                    stops: [0, 100, 0, 100],
                                },
                            },
                            };

                            var chart = new ApexCharts(document.querySelector("#assigned_ytd"), options);
                            chart.render();
                        </script>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
    <div class="card px-4 pb-4 sm:px-5">
        <div class="max-w-full">            
            <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:grid-cols-2 lg:gap-6 mt-4">
                <div>                   
                    <div id="ntu_mtd"> 
                        <script type="text/javascript">
                            var options = {
                            series: [{
                                name: "Total Amount",
                                data: ntuMTDValue
                            }],
                            chart: {
                                height: 350,
                                type: 'line',
                                zoom: {
                                    enabled: false
                                },
                                dropShadow: {
                                    enabled: true,
                                    color: "#1E202C",
                                    top: 18,
                                    left: 6,
                                    blur: 8,
                                    opacity: 0.1,
                                },
                            },
                            dataLabels: {
                                enabled: false
                                },
                                stroke: {
                                    width: 5,
                                    curve: 'smooth',
                                    
                                },
                                title: {
                                    text: 'Total Need To Upload Overview [MTD]',
                                    align: 'left'
                                },
                                grid: {
                                    row: {
                                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                        opacity: 0.5
                                    },
                                },
                                yaxis: {
                                    labels: {
                                        formatter: function (value) {
                                        return "$"+value;
                                        }
                                    },
                                },
                                xaxis: {
                                    categories: ntuMTDLabel,
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#ntu_mtd"), options);
                            chart.render();
                        </script>
                    </div>
                    
                    
                
                </div>
                <div>                   
                    <div id="ntu_ytd"> 
                        <script type="text/javascript">
                            var options = {
                                series: [{
                                    name: "Total Amount",
                                    data: ntuYTDValue
                                }],
                                chart: {
                                    height: 350,
                                    type: 'line',
                                    zoom: {
                                        enabled: false
                                    },
                                    dropShadow: {
                                        enabled: true,
                                        color: "#1E202C",
                                        top: 18,
                                        left: 6,
                                        blur: 8,
                                        opacity: 0.1,
                                    },
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    width: 5,
                                    curve: 'smooth',
                                },
                                title: {
                                    text: 'Total Need To Upload Overview [YTD]',
                                    align: 'left'
                                },                           
                                grid: {
                                    row: {
                                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                        opacity: 0.5
                                    },
                                },
                                
                                yaxis: {
                                        labels: {
                                            formatter: function (value) {
                                            return "$"+value;
                                            }
                                        },
                                    },
                                fill: {
                                    type: "gradient",
                                    gradient: {
                                        shade: "dark",
                                        gradientToColors: ["#fbbf24"],
                                        shadeIntensity: 1,
                                        type: "horizontal",
                                        opacityFrom: 1,
                                        opacityTo: 0.95,
                                        stops: [0, 100, 0, 100],
                                    },
                                },
                                xaxis: {
                                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#ntu_ytd"), options);
                            chart.render();
                        </script>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4 lg:gap-6">
        <div class="card flex-row justify-between p-4">
            <div>
            <p class="text-xs+ uppercase">Total Received Completed </p>
            <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                <?= is_null($inventory['total_received']) ? '0' : $inventory['total_received']  ?>
                </p>
                <!-- <p class="text-xs text-success">+21%</p> -->
            </div>
            </div>
            <div class="mask is-squircle flex h-10 w-10 items-center justify-center bg-success/10">
            <i class="fa-solid fa-cubes text-xl text-success"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
            <i class="fa-solid fa-cubes translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
        </div>
        <div class="card flex-row justify-between p-4">
            <div>
            <p class="text-xs+ uppercase">Total Unreceived</p>
            <i>15 days after purchased</i>
            <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                <?= is_null($inventory['total_unreceived']) ? '0' : $inventory['total_unreceived']  ?>
                </p>
                <!-- <p class="text-xs text-success">+4%</p> -->
            </div>
            </div>
            <div class="mask is-squircle flex h-10 w-10 items-center justify-center bg-error/10">
            <i class="fa-solid fa-cubes text-xl text-error"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
            <i class="fa-solid fa-cubes translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
        </div>
        <div class="card flex-row justify-between p-4">
            <div>
            <p class="text-xs+ uppercase">Total Received Uncompleted</p>
            <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                <?= is_null($inventory['total_received_uncomleted']) ? '0' : $inventory['total_received_uncomleted'] ?>
                </p>
                <!-- <p class="text-xs text-success">+8%</p> -->
            </div>
            </div>
            <div class="mask is-squircle flex h-10 w-10 items-center justify-center bg-warning/10">
            <i class="fa-solid fa-shipping-fast text-xl text-warning"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
            <i class="fa-solid fa-shipping-fast translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
        </div>
        <div class="card flex-row justify-between p-4">
            <div>
            <p class="text-xs+ uppercase">Total Unassigned Items</p>            
            <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                <?= is_null($inventory['total_unassigned']) ? '0' : $inventory['total_unassigned'] ?>
                </p>
                <!-- <p class="text-xs text-error">-2.3%</p> -->
            </div>
            </div>
            <div class="mask is-squircle flex h-10 w-10 items-center justify-center bg-error/10">
            <i class="fa-solid fa-box-open text-xl text-error"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
            <i class="fa-solid fa-box-open translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
        </div>
    </div>
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 max-w-full">
            <div class="my-2">
                <h2 class="font-medium my-1 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                    Purchase History
                </h2>
                <hr>
            </div>
            <table class="datatable-init2 stripe table" style="font-size: 11px; "> 
                <thead>
                    <tr>
                        <th style="width: 3%; text-align:center">#</th>
                        <th class="text-center" style="width: 5%; text-align:center">Purchase Date</th>                                 
                        <th class="text-center" style="width: 5%; text-align:center">ASIN</th>                   
                        <th style="width: 35%;">Item Description</th>                                 
                        <th class="text-center" style="width: 10%; text-align:center">Order Number</th> 
                        <th class="text-center" style="width: 5%; text-align:center">Assigned Date</th> 
                        <th class="text-center" style="text-align:center">Clients</th> 
                        <th class="text-center" style="width: 5%; text-align:center">Qty</th> 
                        <th class="text-center" style="width: 5%; text-align:center">Cost Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; $date = "";?>                    
                    <?php foreach($reports as $purch) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= $no++ ?></td>     
                            <td class="text-center align-middle"><?= ($purch['purchased_date']) ? date('m/d/Y', strtotime($purch['purchased_date'])) : '-' ?></td>                       
                            <td class="text-center align-middle"><b><?= $purch['asin'] ?></b></td>
                            <td class="align-middle"><?= $purch['title'] ?></td>
                            <td class="text-center align-middle">
                                <button type="button" class="orderModal" data-asin="<?= $purch['asin'] ?>" data-order_number="<?= implode(',',$purch['order_number']) ?>"><em class="far fa-credit-card"></em></button>                                        
                            </td>
                            <td class="text-center align-middle"><?= ($purch['assigned_date']) ? date('m/d/Y', strtotime($purch['assigned_date'])) : '-' ?></td>                       
                            <td class="text-left align-middle">
                                <?php if (count($purch['clients']) > 0) : ?>
                                    <?php foreach ($purch['clients'] as $client) : ?>
                                        <?= $client ?>, <br>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>                
                            <td class="text-center align-middle">
                                <?php if (count($purch['qty_assigned']) > 0) : ?>
                                    <?php foreach ($purch['qty_assigned'] as $qty) : ?>
                                        <?= $qty ?><br>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </td>            
                            <td class="text-center align-middle"><span class="font-semibold total_buy_cost_<?= $purch['id'] ?>">$<?= round($purch['qty_received'] * $purch['buy_cost'], 2) ?></span></td>                            
                            
                        </tr>
                    <?php endforeach ?>                                                    
                </tbody>
            </table>
            
            <div style="display: none;" x-data="{showModal:false}">
                <button
                @click="showModal = true"
                class="order-number btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                >
                </button>
                <template x-teleport="#x-teleport-target">
                    <div
                        class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                        x-show="showModal"
                        role="dialog"
                        @keydown.window.escape="showModal = false"
                    >
                        <div
                        class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                        @click="showModal = false"
                        x-show="showModal"
                        x-transition:enter="ease-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        ></div>
                        <div
                        class="relative w-full max-w-2xl origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"
                        x-show="showModal"
                        x-transition:enter="easy-out"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="easy-in"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        >
                        <div
                            class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"
                        >
                            <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 asin-code">
                            
                            </h3>
                            <button
                            @click="showModal = !showModal"
                            class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                            >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4.5 w-4.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                                ></path>
                            </svg>
                            </button>
                        </div>
                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                        <th class="whitespace-nowrap px-4 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                            #
                                        </th>                                     
                                        <th class="whitespace-nowrap px-4 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                            Order Number
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="order-tbody">                                     
                                                                                                    
                                </tbody>
                            </table>
                        </div>                    
                    </div>                
                </template>
            </div>
            
        </div>
    </div>
    <form action="/pnp/dashboard/" method="GET" id="summaryForm">
    <?php csrf_field() ?>
        <div class="card px-4 pb-4 sm:px-5">
        
        <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="card px-4 pb-4 sm:px-5">
                <a href="#cc-usage" id="link-cc-usage"></a>
                <div class="my-3 max-w-full">                        
                    <div class="my-2 flex justify-between">
                        <div>
                            <h2 class="font-medium my-1 mr-4 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                                CC Usage
                            </h2>
                        </div>
                        <div class="flex">                   
                            <div class="mr-4">
                                <?php $firstDate = date('m-01-Y') ?>
                                <?php $now = date('m-d-Y') ?>                           
                                    <label class="relative flex" style="width: 420px;">
                                        <input
                                        <?php if (!is_null($startCC)) : ?>
                                            <?php if (!is_null($endCC)) : ?>                                    
                                                x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $endCC ?>', '<?= $startCC ?>'] })"
                                            <?php else : ?>
                                                x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $startCC ?>', '<?= $startCC ?>'] })"
                                            <?php endif ?>
                                        <?php else : ?>
                                            x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $firstDate ?>', '<?= $now ?>'] })"
                                        <?php endif ?>
                                        class="text-center form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Choose date..."
                                        type="text"
                                        name="dateCC"
                                        
                                        />
                                        <span
                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                        >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 transition-colors duration-200"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                        </span>
                                    </label>            
                                </div>
                            <div>
                                <button type="submit" class="btn border border-info/30 bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">Apply</button>
                            </div>                    
                        </div>                
                    </div>            
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2"> 
                        <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                            <div class="flex justify-between space-x-1">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    $<?= number_format($totalCCUsage, 2) ?>
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Total Usage</p>
                        </div>
                        <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                <?= $totalQty ?>
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Total Qty</p>
                        </div>                   
                    </div>
                    <table class="is-hoverable w-full text-left my-4"> 
                        <thead>
                            <tr>                        
                                <th class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">#</th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Buyer</th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">CC</th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Total Qty</th>
                                <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Total Purchase</th>                                                    
                            </tr>                    
                        </thead>
                        <tbody>
                            <?php $no = 1; $buyerID = "";?>                    
                            <?php if ($CCUsages->getNumRows() > 0) : ?>        
                                <?php foreach($CCUsages->getResultObject() as $cc) : ?>
                                    <?php if ($buyerID != $cc->id) : ?>
                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold align-middle"><?= $no++ ?></td>                                                                  
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $cc->buyer_name ?></td>     
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $cc->cc ?></td>     
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $cc->total_qty ?></td>                                                    
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($cc->total_buy_cost, 2) ?></td>     
                                        </tr>
                                    <?php else : ?>
                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold align-middle"></td>                                                                  
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5 "></td>     
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $cc->cc ?></td>     
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $cc->total_qty ?></td>                                                 
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($cc->total_buy_cost, 2) ?></td>     
                                        </tr>
                                    <?php endif ?>
                                    <?php $buyerID = $cc->id ?>
                                <?php endforeach ?>                                            
                            <?php else : ?>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold align-middle">-</td>                                                                  
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>                                         
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                                </tr>
                            <?php endif ?>                                                 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card px-4 pb-4 sm:px-5">
                <div class="my-4 flex items-center justify-between">
                    <h2 class="font-medium my-2 mr-4 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                        User Activity
                    </h2>     
                    <a href="/history" class="btn text-xs border border-info/30 bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                        See Details
                    </a>   
                </div>  
                <hr class="">         
                <ol class="mt-4 timeline line-space px-4 [--size:1.5rem] sm:px-5">                
                    <?php if ($logs->getNumRows() > 0) : ?>
                        <?php $number = 1; ?>
                        <?php foreach($logs->getResultObject() as $log) : ?>
                            <li class="timeline-item">
                                <?php switch($log->title) : 
                                    case 'login' :
                                            ?>
                                                <div class="timeline-item-point rounded-full border border-current bg-white text-success dark:bg-navy-700">
                                                    <i class="fas fa-sign-in-alt text-tiny"></i>
                                                </div>
                                            <?php
                                        break;
                                    case 'upload-file' :
                                            ?>
                                                <div class="timeline-item-point rounded-full border border-current bg-white text-info dark:bg-navy-700">
                                                    <i class="fas fa-file-upload text-tiny"></i>
                                                </div>
                                            <?php
                                        break;
                                    case 'upload-asin' :
                                            ?>
                                                <div class="timeline-item-point rounded-full border border-current bg-white text-secondary dark:bg-navy-700">
                                                    <i class="fas fa-file-upload text-tiny"></i>
                                                </div>
                                            <?php
                                        break;
                                    case 'purchase-item' :
                                            ?>
                                                <div class="timeline-item-point rounded-full border border-current bg-white text-error dark:bg-navy-700">
                                                    <i class="fas fa-box text-tiny"></i>
                                                </div>
                                            <?php
                                        break;
                                    case 'assignments' :
                                            ?>
                                                <div class="timeline-item-point rounded-full border border-current bg-white text-success dark:bg-navy-700">
                                                    <i class="fas fa-file-import text-tiny"></i>
                                                </div>
                                            <?php
                                        break;
                                    case 'create-ntu' :
                                            ?>
                                                <div class="timeline-item-point rounded-full border border-current bg-white text-success dark:bg-navy-700">
                                                    <i class="fas fa-file-alt text-tiny"></i>
                                                </div>
                                            <?php
                                        break;
                                    ?>
                                    
                                <?php endswitch ?>                        
                                <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                                    <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                                        <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                                        <?= strtoupper($log->title) ?>
                                        </p>
                                        <span class="text-xs text-slate-400 dark:text-navy-300"><?= timeSpan(strtotime($log->created_at)) ?> ago</span>
                                    </div>
                                    <p class="py-1"><?= $log->description ?></p>  
                                    <?php if (!empty($log->items) || !is_null($log->items)) : ?>                    
                                        <div>
                                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                            ASIN:
                                            </p>
                                            <div class="flex text-xs">
                                                <?= substr($log->items, 0, 120) ?><?= (strlen($log->items) > 120) ? '...' : '' ?>                                                
                                            </div>
                                        </div>  
                                    <?php endif ?>
                                    <div class="">
                                        <?php switch($log->title) : 
                                            case 'upload-file' :
                                                    ?>
                                                        <a href="/leads-list" class="tag rounded-full border border-info/30 bg-info/10 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                            Upload File
                                                        </a>
                                                        <a href="/selections" class="tag rounded-full border border-error/30 bg-error/10 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                            Selections
                                                        </a>
                                                    <?php
                                                break;
                                            case 'upload-asin' :
                                                    ?>
                                                        <a href="/selections" class="tag rounded-full border border-error/30 bg-error/10 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                            Selections
                                                        </a>
                                                    <?php
                                                break;
                                            case 'purchase-item' :
                                                    ?>
                                                        <a href="/selections" class="tag rounded-full border border-error/30 bg-error/10 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                            Selections
                                                        </a>
                                                        <a href="/purchases-list" class="tag rounded-full border border-success/30 bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                            Purchase List
                                                        </a>
                                                        
                                                    <?php
                                                break;
                                            case 'assignments' :
                                                    ?>
                                                        <a href="/assignments" class="tag rounded-full border border-info/30 bg-info/10 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                            Assignments
                                                        </a>  
                                                        <a href="/need-to-upload" class="tag rounded-full border border-success/30 bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                            Need To Upload
                                                        </a>                                                        
                                                    <?php
                                                break;
                                            case 'create-ntu' :
                                                    ?>
                                                        <a href="/need-to-upload" class="tag rounded-full border border-success/30 bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                            Need To Upload
                                                        </a>                                                        
                                                    <?php
                                                break;
                                            ?>
                                            
                                        <?php endswitch ?>
                                    </div>
                                </div>
                            </li>  
                            <?php $number++; ?> 
                            <?php if ($number > 5) : ?>
                                <li class="timeline-item">
                                    <div class="timeline-item-point rounded-full border border-current bg-white text-error dark:bg-navy-700">
                                    <i class="fa fa-history text-tiny"></i>
                                    </div>
                                    <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                                    <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                                        <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                                        ...
                                        </p>
                                        <span class="text-xs text-slate-400 dark:text-navy-300">...</span>
                                    </div>
                                    <p class="py-1">and more</p>
                                    </div>
                                </li>
                                <?php break; ?>
                            <?php endif ?>
                            
                        <?php endforeach ?>
                    <?php endif ?>                    
                </ol>               
            </div>
        </div>    
        <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1">
            <div class="card px-4 pb-4 sm:px-5">
                <div class="my-4 flex items-center justify-between">
                    <h2 class="font-medium my-2 mr-4 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                        Monthly Summary
                    </h2>                     
                    <label class="block">           
                        <?php $yearLength = date('Y') - 2022; ?>             
                        <select name="year" class="form-select select-year mt-1.5 w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent" style="width: 160px;">
                            <?php if (!is_null($year)) : ?>
                                <option value="2022" <?= (2022 == $year) ? 'selected' : '' ?>>2022</option>
                                <?php for ($i = 0; $i < $yearLength; $i++) : ?>
                                    <option value="<?= (2022 + $i+1) ?>" <?= (date('Y') == $year) ? 'selected' : '' ?>>2023</option>
                                <?php endfor ?>
                            <?php else : ?>
                                <option value="2022" <?= (date('Y') == '2022') ? 'selected' : '' ?>>2022</option>
                                <?php for ($i = 0; $i < $yearLength; $i++) : ?>
                                    <option value="<?= (2022 + $i+1) ?>" <?= (date('Y') == (2022 + $i+1)) ? 'selected' : '' ?>>2023</option>
                                <?php endfor ?>
                            <?php endif ?>
                        </select>                        
                    </label>                
                </div> 
                <div class="grid grid-cols-3 gap-3 sm:grid-cols-2 sm:gap-5 lg:grid-cols-2"> 
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <div class="flex">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    $<?= (!empty($getMonthlySummary->getResultObject())) ? number_format($getAnnualuSummary['buy_cost'], 2) : '-' ?>
                                </p>
                                <div class="badge mx-2 space-x-1 bg-success/10 text-success dark:bg-success/15">
                                    <span>AVG $<?= (!empty($getMonthlySummary->getResultObject())) ? number_format($getAnnualuSummary['buy_cost']/$getMonthlySummary->getNumRows(), 2) : '-' ?></span>                      
                                </div>
                            </div>                        
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="mt-1 text-xs+">Total Buy Cost</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <div class="flex">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    $<?= (!empty($getMonthlySummary->getResultObject())) ? number_format($getAnnualuSummary['sell_price'], 2) : '-' ?>
                                </p>
                                <div class="badge mx-2 space-x-1 bg-success/10 text-success dark:bg-success/15">
                                    <span>AVG $<?= (!empty($getMonthlySummary->getResultObject())) ? number_format($getAnnualuSummary['sell_price']/$getMonthlySummary->getNumRows(), 2) : '-' ?></span>                      
                                </div>
                            </div>   
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="mt-1 text-xs+">Total Selling Price</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <div class="flex">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    $<?= (!empty($getMonthlySummary->getResultObject())) ? number_format($getAnnualuSummary['profit'], 2) : '-' ?>
                                </p>
                                <div class="badge mx-2 space-x-1 bg-success/10 text-success dark:bg-success/15">
                                    <span>AVG $<?= (!empty($getMonthlySummary->getResultObject())) ? number_format($getAnnualuSummary['profit']/$getMonthlySummary->getNumRows(), 2) : '-' ?></span>                      
                                </div>
                            </div>
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="mt-1 text-xs+">Total Profit</p>
                    </div>

                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <div class="flex">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    <?= (!empty($getMonthlySummary->getResultObject())) ? $getAnnualuSummary['qty'] : '-' ?>
                                </p>
                                <div class="badge mx-2 py-1 space-x-1 bg-success/10 text-success dark:bg-success/15">
                                    <span>AVG <?= (!empty($getMonthlySummary->getResultObject())) ? $getAnnualuSummary['qty']/$getMonthlySummary->getNumRows() : '-' ?></span>                      
                                </div>
                            </div>
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <p class="mt-1 text-xs+">Total Qty</p>
                    </div>                   
                </div>
                <?php 
                    $monthName = [
                        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
                    ];
                    $altMonth = [
                        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                    ];
                    $month = array();                
                    $buyCostData = array();
                    $sellPriceData = array();
                    $profitData = array();
                    $marginData = array();
                    $roiData = array();
                    $qtyData = array();

                    
                ?>            
                <table class="is-hoverable w-full text-left my-4"> 
                    <thead>
                        <tr>                        
                            <th class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Month</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Buy Cost</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Selling Price</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Total Profit</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">ROI</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Margins</th>
                            <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"># of Items</th>                                                    
                        </tr>                    
                    </thead>
                    <tbody>
                        <?php $no = 0;?>                    
                        <?php if ($getMonthlySummary->getNumRows() > 0) : ?>   
                            <?php 
                                for ($i = 0; $i < count($monthName); $i++) {
                                    $found = false;
                                    foreach($getMonthlySummary->getResultObject() as $summary) {
                                        if (strtolower($monthName[$i]) == strtolower($summary->month)) {
                                            ?>
                                            <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold align-middle"><?= $summary->month ?></td>                                                                  
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($summary->buy_cost, 2) ?></td>     
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($summary->sell_price, 2) ?></td>     
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">$<?= number_format($summary->profit, 2) ?></td>     
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= number_format($summary->roi, 2) ?>%</td>    
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= number_format($summary->margin, 2) ?>%</td>     
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $summary->qty ?></td>     
                                            </tr>  
                                            <?php 
                                            array_push($month, substr($monthName[$i], 0, 3)); 
                                            array_push($buyCostData, round($summary->buy_cost, 2)); 
                                            array_push($sellPriceData, round($summary->sell_price, 2)); 
                                            array_push($profitData, round($summary->profit, 2)); 
                                            array_push($marginData, round($summary->margin, 2)); 
                                            array_push($roiData, round($summary->roi, 2)); 
                                            array_push($qtyData, $summary->qty); 
                                            $found = true;
                                            break;
                                        }
                                    }
                                    if ($found == false) {
                                        ?>
                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold align-middle"><?= $monthName[$i] ?></td>                                                                  
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">$0</td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">$0</td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">$0</td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">0</td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">0</td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">0</td>
                                        </tr> 
                                        <?php
                                        array_push($month, substr($monthName[$i], 0, 3)); 
                                        array_push($buyCostData, 0); 
                                        array_push($sellPriceData, 0); 
                                        array_push($profitData, 0); 
                                        array_push($marginData, 0); 
                                        array_push($roiData, 0); 
                                        array_push($qtyData, 0);                         
                                    }
                                }
                                
                                ?>                             
                        <?php else : ?>
                            <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold align-middle">-</td>                                                                  
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>     
                            </tr>
                            <?php $month = $altMonth ?>
                        <?php endif ?>                                                 
                    </tbody>
                </table> 
            </div>
        </div>
    </form>
    <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1">
        <div class="card px-4 pb-4 sm:px-5">
            <div class="my-4 flex items-center justify-between">
                <h2 class="font-medium my-2 mr-4 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                    Buy Cost and Total Profit
                </h2>                    
            </div>  
            <div id="montlySummary"></div>
            <script type="text/javascript">
                var options = {
                    colors: ["#4C4EE7", "#0EA5E9", "#ff5724"],
                    series: [
                        {
                            name: "Buy Cost",
                            data: <?= json_encode($buyCostData) ?>,
                        },
                        {
                            name: "Selling Price",
                            data: <?= json_encode($sellPriceData) ?>,
                        },
                        {
                            name: "Total Profit",
                            data: <?= json_encode($profitData) ?>,
                        },
                    ],
                    chart: {
                        height: 255,
                        type: "bar",
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        dropShadow: {
                            enabled: true,
                            color: "#1E202C",
                            top: 18,
                            left: 6,
                            blur: 8,
                            opacity: 0.1,
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val >= 1000 ? "$" + (val / 1000).toFixed(2) + "k" : "$" +val;
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '11px',
                        },
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 10,                            
                            columnWidth: "65%",
                            dataLabels: {
                                position: "top",
                                
                            },
                            
                        },
                    },
                    legend: {
                        show: true,
                    },
                    xaxis: {
                        categories: <?= json_encode($month) ?>,
                        labels: {
                            hideOverlappingLabels: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        tooltip: {
                            enabled: false,
                        },
                        position: "top",
                    },
                    grid: {
                        padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: -10,
                        },
                    },
                    yaxis: {
                        show: true,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                        },
                    },
                    responsive: [
                        {
                        breakpoint: 850,
                        options: {
                            plotOptions: {
                                bar: {
                                    columnWidth: "55%",
                                },
                            },
                        },
                        },
                    ],
                };

                var chart = new ApexCharts(document.querySelector("#montlySummary"), options);
                chart.render();
            </script>
        </div>        
    </div>
    <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="card px-4 pb-4 sm:px-5">
            <div class="my-4 flex items-center justify-between">
                <h2 class="font-medium my-2 mr-4 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                    Margin
                </h2>                  
            </div>  
            <div id="montlySummaryMargin"></div>
            <script type="text/javascript">
                var options = {
                    series: [
                            {
                                name: "Margin",
                                data: <?= json_encode($marginData) ?>,
                            },
                        ],
                        colors: ["#1D7874"],
                        chart: {
                            height: 250,
                            type: "bar",
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false,
                            },
                            dropShadow: {
                                enabled: true,
                                color: "#1E202C",
                                top: 18,
                                left: 6,
                                blur: 8,
                                opacity: 0.1,
                            },
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "55%",
                                dataLabels: {
                                    position: "top",
                                },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val >= 1000 ? (val / 1000).toFixed(2) + "%" :  val + "%";
                            },
                            offsetY: -20,
                        },
                        xaxis: {
                            categories: <?= json_encode($month) ?>,
                            position: "top",
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            tooltip: {
                                enabled: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                show: false,
                            },
                        },
                    };

                var chart = new ApexCharts(document.querySelector("#montlySummaryMargin"), options);
                chart.render();
            </script>
        </div>
        <div class="card px-4 pb-4 sm:px-5">
            <div class="my-4 flex items-center justify-between">
                <h2 class="font-medium my-2 mr-4 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                    # Of Items
                </h2>                    
            </div>  
            <div id="montlySummaryQty"></div>
            <script type="text/javascript">
                var options = {
                    series: [
                            {
                                name: "# of items",
                                data: <?= json_encode($qtyData) ?>,
                            },
                        ],
                        colors: ["#EE2E31"],
                        chart: {
                            height: 250,
                            type: "bar",
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false,
                            },
                            dropShadow: {
                                enabled: true,
                                color: "#1E202C",
                                top: 18,
                                left: 6,
                                blur: 8,
                                opacity: 0.1,
                            },
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "55%",
                                dataLabels: {
                                    position: "top",
                                },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val >= 1000 ? (val / 1000).toFixed(2) + "k" : val;
                            },
                            offsetY: -20,
                        },
                        xaxis: {
                            categories: <?= json_encode($month) ?>,
                            position: "top",
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            tooltip: {
                                enabled: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                show: false,
                            },
                        },
                        
                    };

                var chart = new ApexCharts(document.querySelector("#montlySummaryQty"), options);
                chart.render();
            </script>
        </div>
    </div>    
    <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-1">
        <div class="card px-4 pb-4 sm:px-5">
            <div class="my-4 flex items-center justify-between">
                <h2 class="font-medium my-2 mr-4 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                    ROI
                </h2>                    
            </div>  
            <div id="montlySummary2">

            </div>
            <script type="text/javascript">
                var options = {
                    series: [
                        {
                            name: "ROI",
                            data: <?= json_encode($roiData) ?>,
                        },
                        ],
                        colors: ["#4467EF"],
                        chart: {
                            height: 250,
                            type: "bar",
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false,
                            },
                            dropShadow: {
                                enabled: true,
                                color: "#1E202C",
                                top: 18,
                                left: 6,
                                blur: 8,
                                opacity: 0.1,
                            },
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 20,
                                columnWidth: "55%",
                                dataLabels: {
                                    position: "top",
                                },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val >= 1000 ? (val / 1000).toFixed(2) + "%" : val + "%";
                            },
                            offsetY: -20,
                        },
                        xaxis: {
                            categories: <?= json_encode($month) ?>,
                            position: "top",
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            tooltip: {
                                enabled: false,
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                show: false,
                            },
                        },
                    };

                var chart = new ApexCharts(document.querySelector("#montlySummary2"), options);
                chart.render();
            </script>
            
        </div>
    </div>
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 max-w-full">
            <div class="my-2 flex justify-between">
                <div>
                    <h2 class="font-medium my-1 tracking-wide text-slate-700 line-clamp-1 mb-2 dark:text-navy-100 lg:text-base">
                        Qty Overview
                    </h2>
                </div>
                <div class="flex">                   
                    <div class="mr-4">
                        <?php $firstDate = date('m-01-Y') ?>
                        <?php $now = date('m-d-Y') ?>                          
                         
                            <label class="relative flex" style="width: 420px;">
                                <input
                                
                                <?php if (!is_null($startQty)) : ?>
                                    <?php if (!is_null($endQty)) : ?>                                    
                                        x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $endQty ?>', '<?= $startQty ?>'] })"
                                    <?php else : ?>
                                        x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $startQty ?>', '<?= $startQty ?>'] })"
                                    <?php endif ?>
                                <?php else : ?>
                                    x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $firstDate ?>', '<?= $now ?>'] })"
                                <?php endif ?>
                                class="text-center form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Choose date..."
                                type="text"
                                name="dateQty"
                                
                                />
                                <span
                                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-colors duration-200"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                                </span>
                            </label>            
                        </div>
                    <div>
                        <button type="submit" class="btn border border-info/30 bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">Apply</button>
                    </div>                    
                </div> 
                
            </div>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-3" style="margin-bottom: 20px;"> 
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between space-x-1">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                        <?= (is_null($qtyTotalQtyOverview)) ? '-' : ((is_null($qtyTotalQtyOverview->total_received) || $qtyTotalQtyOverview->total_received == 0) ? '-' : $qtyTotalQtyOverview->total_received)  ?>
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="mt-1 text-xs+">Total Received</p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                            <?= (is_null($qtyTotalQtyOverview)) ? '-' : ((is_null($qtyTotalQtyOverview->total_refund) || $qtyTotalQtyOverview->total_refund == 0) ? '-' : $qtyTotalQtyOverview->total_refund)  ?>
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <p class="mt-1 text-xs+">Total Refund</p>
                </div>      
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                        <?= (is_null($qtyTotalQtyOverview)) ? '-' : ((is_null($qtyTotalQtyOverview->total_unreceived) || $qtyTotalQtyOverview->total_unreceived == 0) ? '-' : $qtyTotalQtyOverview->total_unreceived)  ?>
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <p class="mt-1 text-xs+">Total Not Received</p>
                </div>               
            </div>
            <table class="datatable-init2 stripe table" style="font-size: 11px; "> 
                <thead>
                    <tr>                        
                        <th class="text-center" style="width: 5%; text-align:center">Purchase Date</th>                                 
                        <th class="text-center" style="width: 5%; text-align:center">ASIN</th>                   
                        <th style="width: 35%;">Item Description</th>                                                         
                        <th class="text-center" style="width: 5%; text-align:center">Total Purchase</th> 
                        <th class="text-center" style="width: 5%; text-align:center">Qty Received</th> 
                        <th class="text-center" style="width: 5%; text-align:center">Qty Refund</th> 
                        <th class="text-center" style="width: 5%; text-align:center">Qty Not Received</th>                         
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($qtyOverView->getResultObject() as $itemQty) : ?>
                        <tr>
                            <td class="text-center"><?= date('m/d/Y', strtotime($itemQty->purchased_date)) ?></td>
                            <td class="text-center"><?= $itemQty->asin ?></td>
                            <td><?= $itemQty->title ?></td>
                            <td class="text-center"><?= (is_null($itemQty->qty) || $itemQty->qty == 0) ? '-' : $itemQty->qty ?></td>
                            <td class="text-center"><?= (is_null($itemQty->total_received) || $itemQty->total_received == 0) ? '-' : $itemQty->total_received ?></td>
                            <td class="text-center"><?= (is_null($itemQty->total_refund) || $itemQty->total_refund == 0) ? '-' : $itemQty->total_refund ?></td>
                            <td class="text-center"><?= (is_null($itemQty->total_unreceived) || $itemQty->total_unreceived == 0) ? '-' : $itemQty->total_unreceived ?></td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
    $(document).on('click', '.orderModal', function() {            
        let asin = $(this).data('asin');
        let orders = String($(this).data('order_number'));                               
        
        var no = 1;
        $('.order-tbody').html('');
        if (orders.includes(",")) {
            const orderList = orders.split(',');
            for (var i = 0; i < orderList.length; i++) {
                $('.order-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"> <td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ no++ +'</td><td class="whitespace-nowrap px-4 py-3 sm:px-5">'+orderList[i]+'</td></tr>');
            }
            
        } else {
            if (orders != '') { 
                $('.order-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"> <td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ no++ +'</td><td class="whitespace-nowrap px-4 py-3 sm:px-5">'+orders+'</td></tr>');
            } else {
                $('.order-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"> <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td><td class="whitespace-nowrap px-4 py-3 sm:px-5"> - </td></tr>');
            }
            
        }       
        $('.asin-code').html(asin);
        $('.order-number').click();        
    });
    
    let startDate = "<?= (is_null($start) ? "false" : $start) ?>";    
    
    if (startDate != "false") {
        window.location = document.getElementById('link-summary').href        
    }      

    $("#list-summary").click(function() {
        
    });

    let startDateCC = "<?= (is_null($startCC) ? "false" : $startCC) ?>";    
    
    $(document).on('change', '.select-year', function() {
        $('#summaryForm').submit();
    });

    // if (startDateCC != "false") {
    //     console.log("kwkwkw");
    //     window.location = document.getElementById('link-cc-usage').href        
    // }      

    // $("#link-cc-usage").click(function() {
    //     $('html, body').animate({
    //         scrollTop: $("#cc-usage").offset().top
    //     }, 2000);
    // });

    

        
</script>
<?= $this->endSection() ?>