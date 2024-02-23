<?= $this->extend('b2b/layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-2 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                Inventory Page
            </h2>            
            
        </div>
        <hr>
        <div class="my-3 max-w-full">
            <div style="float: right; margin-bottom: 10px">
                <button
                    type="button"
                    class="btn h-9 w-9 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 hover:shadow-lg hover:shadow-slate-200/50 focus:bg-slate-200 focus:shadow-lg focus:shadow-slate-200/50 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:hover:shadow-navy-450/50 dark:focus:bg-navy-450 dark:focus:shadow-navy-450/50 dark:active:bg-navy-450/90"
                    id="scroll-left"
                    >
                    <i class="fa-solid fas fa-angle-double-left"></i>                    
                </button>
                <button
                    type="button"
                    class="btn h-9 w-9 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 hover:shadow-lg hover:shadow-slate-200/50 focus:bg-slate-200 focus:shadow-lg focus:shadow-slate-200/50 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:hover:shadow-navy-450/50 dark:focus:bg-navy-450 dark:focus:shadow-navy-450/50 dark:active:bg-navy-450/90"
                    id="scroll-right"
                    >
                    <i class="fa-solid fas fa-angle-double-right"></i>                    
                </button>
            </div>
            <table class="datatable-init stripe table scroll-container" style="font-size: 11px; "> 
                <thead>
                    <tr>                                 
                        <th>Item Description</th>         
                        <th class="text-center">ASIN</th>                   
                        <th class="text-center">Order Number</th>                                                   
                        <th class="text-center">Qty Ordered</th>                   
                        <th class="text-center" style="width: 5%">Qty Returned</th>                   
                        <th class="text-center" style="width: 5%">Qty Received</th>                   
                        <th class="text-center">Qty Remaining</th>             
                        <th class="text-center">Amazon Price</th>
                        <th class="text-center">Cost Per Unit</th>
                        <th class="text-center">Cost Total</th>
                        
                    </tr>                            
                </thead>
                <tbody>
                    <?php $id = ""; $date = "";?>
                    <?php foreach($purchased_items as $purch) : ?>
                        <?php if ($purch['qty_ordered'] > 0) : ?>
                            <?php if ($date != date('F jS, Y', strtotime($purch['purchased_date']))) : ?>
                                <tr>
                                    <td class="text-center align-middle table-primary font-bold"><?= date('F jS, Y', strtotime($purch['purchased_date'])) ?></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                    <td class="table-primary"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><?= substr($purch['title'], 0, 120) ?><?= (strlen($purch['title']) > 120) ? '..' : '' ?></td>
                                    <td class="text-center align-middle"><b><?= $purch['asin'] ?></b></td>
                                    <td class="text-center align-middle">
                                        <a href="#" class="orderModal" data-asin="<?= $purch['asin'] ?>" data-order_number="<?= implode(',',$purch['order_number']) ?>"><em class="far fa-credit-card"></em></a>                                        
                                    </td>
                                    <td class="text-center align-middle font-bold"><?= $purch['qty_ordered'] ?></td>
                                    <td class="text-center align-middle">
                                        <?= empty($purch['qty_returned']) ? '0' : $purch['qty_returned'] ?>                                             
                                    </td>  
                                    <td class="text-center align-middle">
                                        <?= empty($purch['qty_received']) ? '0' : $purch['qty_received'] ?> 
                                    </td>
                                    <td class="text-center align-middle remain_<?= $purch['id'] ?>">
                                        <?php if ($purch['qty_ordered'] - ($purch['qty_received'] + $purch['qty_returned']) == 0) : ?>
                                            <span class="text-success font-bold">Complete</span>
                                        <?php else : ?>
                                            <span class="text-danger font-bold"><?= $purch['qty_ordered'] - (($purch['qty_received'] + $purch['qty_returned'])) ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center align-middle total_price_<?= $purch['id'] ?>">$<?= round($purch['price'], 2) ?></td>
                                    <td class="text-center align-middle">$<?= round($purch['buy_cost'], 2) ?></td>
                                    <td class="text-center align-middle"><span class="total_buy_cost_<?= $purch['id'] ?>">$<?= round($purch['qty_received'] * $purch['buy_cost'], 2) ?></span></td>                                                                                                                
                                </tr>  
                                <?php $date = date('F jS, Y', strtotime($purch['purchased_date'])) ?>
                            <?php else : ?>
                                <tr>
                                    <td class="align-middle"><?= substr($purch['title'], 0, 120) ?><?= (strlen($purch['title']) > 120) ? '..' : '' ?></td>
                                    <td class="text-center align-middle"><b><?= $purch['asin'] ?></b></td>
                                    <td class="text-center align-middle">
                                        <a href="#"  data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="orderModal" data-asin="<?= $purch['asin'] ?>" data-order_number="<?= implode('<br>',$purch['order_number']) ?>"><em class="far fa-credit-card"></em></a>                                        
                                    </td>
                                    <td class="text-center align-middle font-bold"><?= $purch['qty_ordered'] ?></td>
                                    <td class="text-center align-middle">
                                        <?= empty($purch['qty_returned']) ? '0' : $purch['qty_returned'] ?>                                             
                                    </td>  
                                    <td class="text-center align-middle">
                                        <?= empty($purch['qty_received']) ? '0' : $purch['qty_received'] ?> 
                                    </td>
                                    <td class="text-center align-middle remain_<?= $purch['id'] ?>">
                                        <?php if ($purch['qty_ordered'] - ($purch['qty_received'] + $purch['qty_returned']) == 0) : ?>
                                            <span class="text-success font-bold ">Complete</span>
                                        <?php else : ?>
                                            <span class="text-danger font-bold"><?= $purch['qty_ordered'] - (($purch['qty_received'] + $purch['qty_returned'])) ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center align-middle total_price_<?= $purch['id'] ?>">$<?= round($purch['price'], 2) ?></td>                                    
                                    <td class="text-center align-middle">$<?= round($purch['buy_cost'], 2) ?></td>
                                    <td class="text-center align-middle"><span class="total_buy_cost_<?= $purch['id'] ?>">$<?= round($purch['qty_received'] * $purch['buy_cost'], 2) ?></span></td>                                                                                                                
                                </tr>   
                            <?php endif ?>
                        <?php endif ?>
                    <?php endforeach ?>                                                    
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Main modal -->
    
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

<script>
    $(document).ready(function() {
        const scrollContainer = $(".scroll-container");
        const scrollLeftButton = $("#scroll-left");
        const scrollRightButton = $("#scroll-right");

        scrollLeftButton.on("click", function() {
            scrollContainer.scrollLeft(scrollContainer.scrollLeft() - 100); // Ubah nilai scroll sesuai kebutuhan

        });

        scrollRightButton.on("click", function() {
            scrollContainer.scrollLeft(scrollContainer.scrollLeft() + 100); // Ubah nilai scroll sesuai kebutuhan
        });
    });
    $(document).on('click', '.orderModal', function() {            
        let asin = $(this).data('asin');
        let orders = $(this).data('order_number');                                    
        const orderList = orders.split(',');
        var no = 1;

        $('.order-tbody').html('');
        if (orders != '') {                        
            for (var i = 0; i < orderList.length; i++) {
                $('.order-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"> <td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ no++ +'</td><td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ orderList[i] +'</td></tr>');
            }
        } else {
            $('.order-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"> <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td><td class="whitespace-nowrap px-4 py-3 sm:px-5"> - </td></tr>');
        }
        $('.asin-code').html(asin);
        $('.order-number').click();
    });
</script>
<?= $this->endSection() ?>
