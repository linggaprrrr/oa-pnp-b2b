<?= $this->extend('layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-2 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                Master List Page
            </h2>            
        </div>
        <hr>
        <div class="my-3 max-w-full">
            <table class="datatable-init stripe table" style="font-size: 11px; "> 
                <thead>
                    <tr>                                 
                        <th style="width: 15%">Item Description</th>         
                        <th class="text-center">ASIN</th>                   
                        <th class="text-center">Order Number</th>                                                   
                        <th class="text-center">Qty Ordered</th>                   
                        <th class="text-center" style="width: 5%">Qty Returned</th>                   
                        <th class="text-center" style="width: 5%">Qty Received</th>                   
                        <th class="text-center">Qty Remaining</th>             
                        <th class="text-center">Amazon Price</th>
                        <th class="text-center">Cost Per Unit</th>
                        <th class="text-center">Cost Total</th>
                        <th class="text-center">Allocate Date</th>                        
                        <th class="text-center">Shipping Status</th>
                        <th class="text-center" style="width: 12%">Notes</th>                        
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
                                    <td class="align-middle">
                                        <div class="form-group">                                            
                                            <div class="form-control-wrap number-spinner-wrap">                                                
                                                <input type="number" min="0" class="text-center form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent qty_returned qty_returned_<?= $purch['id'] ?>" data-ordered="<?= $purch['qty_ordered'] ?>" data-id="<?= $purch['id'] ?>" data-cost="<?= $purch['buy_cost'] ?>"  data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_returned'] == 0) ? '0' : $purch['qty_returned']  ?>">
                                            
                                            </div>
                                        </div> 
                                    </td>  
                                    <td class="text-center align-middle">
                                        <div class="form-group">                                            
                                            <div class="form-control-wrap number-spinner-wrap">                                
                                                <input type="number" min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty_received qty_received_<?= $purch['id'] ?>" data-ordered="<?= $purch['qty_ordered'] ?>" data-id="<?= $purch['id'] ?>" data-cost="<?= $purch['buy_cost'] ?>"  data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_received'] == 0) ? '0' : $purch['qty_received']  ?>">                                                
                                            </div>
                                        </div>     
                                    </td>
                                    <td class="text-center align-middle remain_<?= $purch['id'] ?>">
                                        <?php if ($purch['qty_ordered'] - ($purch['qty_received'] + $purch['qty_returned']) == 0) : ?>
                                            <span class="text-success font-semibold">Complete</span>
                                        <?php elseif ($purch['qty_ordered'] - ($purch['qty_received'] + $purch['qty_returned']) < 0) : ?>
                                            <span class="text-danger font-semibold text-error"><?= abs($purch['qty_ordered'] - (($purch['qty_received'] + $purch['qty_returned']))) ?></span>
                                        <?php else : ?>
                                            <span class="text-danger font-semibold"><?= abs($purch['qty_ordered'] - (($purch['qty_received'] + $purch['qty_returned']))) ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center align-middle ?>">$<?= round($purch['price'], 2) ?></td>
                                    <td class="text-center align-middle">$<?= round($purch['buy_cost'], 2) ?></td>
                                    <td class="text-center align-middle"><span class="total_buy_cost_<?= $purch['id'] ?>">$<?= round($purch['qty_received'] * $purch['buy_cost'], 2) ?></span></td>
                                    <td class="text-center align-middle allocated_date_<?= $purch['id'] ?>"><?= is_null($purch['allocated_date']) ? '-' : date('m/d/Y', strtotime($purch['allocated_date'])) ?></td>                                                                
                                    <td class="text-center align-middle" style="text-align: -webkit-center;"><a href="#" class="shipment-details" data-id="<?= $purch['purchased_item_id'] ?>" data-asin="<?= $purch['asin'] ?>"><img src="/assets/img/shipping-48.png" alt="" style="width: 30%;"></a></td>
                                    <td class="text-center align-middle">
                                        <input type="text" name="notes" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center notes" data-id="<?= $purch['purchased_item_id'] ?>" style="font-size: 11px;" placeholder="notes" value="<?= $purch['order_notes'] ?>">
                                    </td>                                    
                                        
                                </tr> 
                                <?php $date = date('F jS, Y', strtotime($purch['purchased_date'])) ?>
                            <?php else : ?>
                                <tr>
                                    <td class="align-middle"><?= substr($purch['title'], 0, 55) ?><?= (strlen($purch['title']) > 55) ? '..' : '' ?></td>
                                    <td class="text-center align-middle"><b><?= $purch['asin'] ?></b></td>
                                    <td class="text-center align-middle">
                                        
                                        <a href="#" class="orderModal" data-asin="<?= $purch['asin'] ?>" data-order_number="<?= implode(',',$purch['order_number']) ?>"><em class="far fa-credit-card"></em></a>                                        
                                    </td>
                                    <td class="text-center align-middle font-bold"><?= $purch['qty_ordered'] ?></td>
                                    <td class="align-middle">
                                        <div class="form-group">                                            
                                            <div class="form-control-wrap number-spinner-wrap">                                                
                                                <input type="number" min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty_returned qty_returned_<?= $purch['id'] ?>" data-ordered="<?= $purch['qty_ordered'] ?>" data-id="<?= $purch['id'] ?>" data-cost="<?= $purch['buy_cost'] ?>"  data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_returned'] == 0) ? '0' : $purch['qty_returned']  ?>">
                                            
                                            </div>
                                        </div> 
                                    </td>  
                                    <td class="text-center align-middle">
                                        <div class="form-group">                                            
                                            <div class="form-control-wrap number-spinner-wrap">                                
                                                <input type="number" min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty_received qty_received_<?= $purch['id'] ?>" data-ordered="<?= $purch['qty_ordered'] ?>" data-id="<?= $purch['id'] ?>" data-cost="<?= $purch['buy_cost'] ?>"  data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_received'] == 0) ? '0' : $purch['qty_received']  ?>">                                                
                                            </div>
                                        </div>     
                                    </td>
                                    <td class="text-center align-middle remain_<?= $purch['id'] ?>">
                                        <?php if ($purch['qty_ordered'] - ($purch['qty_received'] + $purch['qty_returned']) == 0) : ?>
                                            <span class="text-success font-semibold">Complete</span>
                                            <?php elseif ($purch['qty_ordered'] - ($purch['qty_received'] + $purch['qty_returned']) < 0) : ?>
                                                <span class="text-danger font-semibold text-error"><?= abs($purch['qty_ordered'] - (($purch['qty_received'] + $purch['qty_returned']))) ?></span>
                                            <?php else : ?>
                                                <span class="text-danger font-semibold"><?= abs($purch['qty_ordered'] - (($purch['qty_received'] + $purch['qty_returned']))) ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center align-middle ?>">$<?= round($purch['price'], 2) ?></td>                                    
                                    <td class="text-center align-middle">$<?= round($purch['buy_cost'], 2) ?></td>
                                    <td class="text-center align-middle"><span class="total_buy_cost_<?= $purch['id'] ?>">$<?= round($purch['qty_received'] * $purch['buy_cost'], 2) ?></span></td>
                                    <td class="text-center align-middle allocated_date_<?= $purch['id'] ?>"><?= is_null($purch['allocated_date']) ? '-' : date('m/d/Y', strtotime($purch['allocated_date'])) ?></td>                                
                                    
                                    <td class="text-center align-middle" style="text-align: -webkit-center;"><a href="#" class="shipment-details" data-id="<?= $purch['purchased_item_id'] ?>" data-asin="<?= $purch['asin'] ?>"><img src="/assets/img/shipping-48.png" alt="" style="width: 30%;"></a></td>
                                    <td class="text-center align-middle">
                                        <input type="text" name="notes" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center notes" data-id="<?= $purch['purchased_item_id'] ?>" style="font-size: 11px;" placeholder="notes" value="<?= $purch['order_notes'] ?>">
                                    </td>                                    
                                        
                                </tr>   
                            <?php endif ?>
                        <?php endif ?>
                    <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </div>
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

    <div style="display: none;" x-data="{showModal:false}">
        <button
        @click="showModal = true"
        class="shipment-modal btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
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
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 asin-title">
                    
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
                                <th class="whitespace-nowrap px-4 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    Shipping Number
                                </th>
                                <th class="whitespace-nowrap px-4 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    Tracking Info
                                </th>
                                <th class="whitespace-nowrap px-4 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    Last Checkpoint
                                </th>
                            </tr>
                        </thead>
                        <tbody class="shipment-tbody">                                     
                                                                                            
                        </tbody>
                    </table>
                </div>                    
            </div>                
        </template>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    $(document).on('input propertychange', '.qty_returned', function() {
        const id = $(this).data('id');
        const qty = $(this).val();
        
        const ordered = $(this).data('ordered');
        const received = $('.qty_received_'+id).val();

        $.post('/save-qty-returned', {id: id, qty: qty})
            .done(function(data) {
                if (((parseInt(qty) + parseInt(received)) - parseInt(ordered)) == 0) {
                    $('.remain_' + id).html('<span class="text-success font-semibold">Complete</span>');
                    $.notify("Your changes have been saved!", "success");
                } else if(qty == "") {
                    $('.remain_' + id).html('<span class="font-semibold">'+ Math.abs(parseInt(ordered) - 0) +'</span>');
                    $.notify("Your changes have been saved!", "success");
                } else {
                    $('.remain_' + id).html('<span class="font-semibold">'+ Math.abs(((parseInt(qty) + parseInt(received)) - parseInt(ordered))) +'</span>');
                    $.notify("Your changes have been saved!", "success");
                }    
                

                $('.allocated_date_' + id).html('<?= date('m/d/Y') ?>');
            });
            
    });

    $(document).on('input propertychange', '.qty_received', function() {
        const id = $(this).data('id');
        const cost = $(this).data('cost');
        const price = $(this).data('price');
        const ordered = $(this).data('ordered');
        const qty = $(this).val();
        const returned = $('.qty_returned_'+id).val();
        
        
        $.post('/save-qty-received', {id: id, qty: qty})
            .done(function(data) {                    
                if (qty == "") {
                    $('.total_buy_cost_' + id).html('$' + (0 * parseFloat(cost)).toFixed(2));
                    $('.total_price_' + id).html('$' + (0 * parseFloat(price)).toFixed(2));
                } else {
                    $('.total_buy_cost_' + id).html('$' + (parseFloat(qty) * parseFloat(cost)).toFixed(2));
                    $('.total_price_' + id).html('$' + (parseFloat(qty) * parseFloat(price)).toFixed(2));
                }

                if (((parseInt(qty) + parseInt(returned)) - parseInt(ordered)) == 0) {
                    $('.remain_' + id).html('<span class="text-success font-semibold">Complete</span>');
                } else if(qty == "") {
                    $('.remain_' + id).html('<span class="font-semibold">'+ Math.abs(parseInt(ordered) - 0) +'</span>');
                } else {
                    
                    if ((parseInt(qty) + parseInt(returned)) - parseInt(ordered) > 0) {
                        $('.remain_' + id).html('<span class="font-semibold text-error">'+ Math.abs((parseInt(qty) + parseInt(returned)) - parseInt(ordered)) +'</span>');
                    } else {
                        $('.remain_' + id).html('<span class="font-semibold">'+ Math.abs((parseInt(qty) + parseInt(returned)) - parseInt(ordered)) +'</span>');
                    }
                }                    
                $('.allocated_date_' + id).html('<?= date('m/d/Y') ?>');
            });
    });

    
    $(document).on('change', '.status-order', function(data) {
        const id = $(this).data('id');
        const stat = $(this).val();

        $.post('/save-status-order', {id: id, status: stat})
            .done(function(data) {
                $.notify("Your changes have been saved!", "success");
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
                $('.order-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"> <td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ no++ +'</td><td class="whitespace-nowrap px-4 py-3 sm:px-5">'+orderList[i]+'</td></tr>');
            }
        } else {
            $('.order-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"> <td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td><td class="whitespace-nowrap px-4 py-3 sm:px-5"> - </td></tr>');
        }
        $('.asin-code').html(asin);
        $('.order-number').click();
    });

    $(document).on('click', '.shipment-details', function() {
        const id = $(this).data('id');
        const asin = $(this).data('asin');
        var no = 1;
        $('.asin-title').html(asin);
        $('.shipment-tbody').html('');
        $.get('/get-shipment-info-by-item', {id: id})
            .done(function(data) {
                const resp = JSON.parse(data);
                            
                if (resp.length > 0) {
                    for (var i = 0; i < resp.length; i++) {
                    $('.shipment-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ no++ +'</td>');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ resp[i]['order_number'] +' ('+ resp[i]['buyer_name'] +')</td>');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ resp[i]['courier_name'] +'<br>'+ resp[i]['tracking_number'] +'</td>');
                    if (resp[i]['status'] == 'delivered') {                                                
                        $('.shipment-tbody').append('<td><div class="badge space-x-2.5 rounded-full bg-success/10 text-success dark:bg-success/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp[i]['status']) +'</span></div><div> <p class="text-sm">'+ resp[i]['checkpoint_date'] + ' '+resp[i]['location']+'</p><p class="text-sm">'+ resp[i]['tracking_details'] +'</p></div></td>');
                    } else if (resp[i]['status'] == 'transit' || resp[i]['status'] == 'pickup') {
                        $('.shipment-tbody').append('<td><div class="badge space-x-2.5 rounded-full bg-warning/10 text-warning dark:bg-warning/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp[i]['status']) +'</span></div><div> <p class="text-sm">'+ resp[i]['checkpoint_date'] + ' '+resp[i]['location']+'</p><p class="text-sm">'+ resp[i]['tracking_details'] +'</p></div></td>');
                    } else if (resp[i]['status'] == 'undelivered' || resp[i]['status'] == 'expired' || resp[i]['status'] == 'exception') {
                        $('.shipment-tbody').append('<td><div class="badge space-x-2.5 rounded-full bg-error/10 text-error dark:bg-error/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp[i]['status']) +'</span></div><div> <p class="text-sm">'+ resp[i]['checkpoint_date'] + ' '+resp[i]['location']+'</p><p class="text-sm">'+ resp[i]['tracking_details'] +'</p></div></td>');
                    } else if (resp[i]['status'] == 'inforeceived' || resp[i]['status'] == 'pending') {
                        $('.shipment-tbody').append('<td><div class="badge space-x-2.5 rounded-full bg-info/10 text-info dark:bg-info/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp[i]['status']) +'</span></div><div> <p class="text-sm">'+ resp[i]['checkpoint_date'] + ' '+resp[i]['location']+'</p><p class="text-sm">'+ resp[i]['tracking_details'] +'</p></div></td>');
                    } else {
                        $('.shipment-tbody').append('<td></td>');
                    }                                 
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">'+ resp[i]['checkpoint_date'] +'</td>')
                    $('.shipment-tbody').append('</tr>');
                }
                } else {
                    $('.shipment-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>');
                    $('.shipment-tbody').append('<td class="whitespace-nowrap px-4 py-3 sm:px-5">-</td>');
                    $('.shipment-tbody').append('</tr>');
                }
                
            })
        $('.shipment-modal').click();
        
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>
<?= $this->endSection() ?>
