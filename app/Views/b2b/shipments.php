<?= $this->extend('b2b/layout/component') ?>
<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">    
    <div>
        <form action="/b2b/shipments" method="GET" style="display: flex;">
            <div class="mr-4">
                <?php $last = date('m-d-Y', strtotime('-7 days')) ?>
                <?php $now = date('m-d-Y') ?>            
                    <label class="relative flex" style="width: 420px;">
                        <input
                        <?php if (!is_null($start)) : ?>
                            <?php if (!is_null($end)) : ?>                                    
                                x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $end ?>', '<?= $start ?>'] })"
                            <?php else : ?>
                                x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $start ?>', '<?= $start ?>'] })"
                            <?php endif ?>
                        <?php else : ?>
                            x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $now ?>', '<?= $now ?>'] })"
                        <?php endif ?>
                        
                        class="text-center form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        placeholder="Choose date..."
                        type="text"
                        name="date"
                        required
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
                <button type="submit" class="apply btn border border-info/30 bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">Apply</button>
            </div>
        </form>   
    </div>
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between" style="display: flex; ">        
            <div>
                <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                    Shipments Page
                </h2>      
            </div>
            <div>
                <div x-data="{showModal:false}">
                    <button
                        @click="showModal = true"
                        class="btn space-x-2 bg-warning font-medium text-white shadow-lg shadow-warning/50 hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90"
                        >
                        Track Shipment Manually
                        <em class="fas fa-shipping-fast ml-2"></em> 
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
                                    class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 close-shipment"
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
                                <form id="trackingForm">
                                    <div class="col-span-12 grid lg:col-span-8">
                                        <div class="card">
                                            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                                                <div class="flex items-center space-x-2">
                                                <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                                                    <i class="fa-solid fa-layer-group"></i>
                                                </div>
                                                    <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                                        Shipment Information
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="space-y-4 p-4 sm:p-5">
                                                <label class="block">
                                                    <span>Tracking Number <em class="text-error">*</em></span>
                                                    <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Tracking Number" type="text" name="tracking_number" required>
                                                </label>
                                                <label class="block">
                                                    <span>Order Information (optional)</span>
                                                    <textarea rows="4" placeholder="Eg. product title / order number" class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" name="shipment_information"></textarea>
                                                </label>                                                
                                                <div>
                                                    <div class="flex justify-end space-x-2 pt-4">                                                   
                                                        <button type="submit" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                            <div class="spinner h-4 w-4 mr-2 animate-spin text-slate-100 dark:text-navy-300" style="display: none;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 28 28">
                                                                    <path fill="currentColor" fill-rule="evenodd" d="M28 14c0 7.732-6.268 14-14 14S0 21.732 0 14 6.268 0 14 0s14 6.268 14 14zm-2.764.005c0 6.185-5.014 11.2-11.2 11.2-6.185 0-11.2-5.015-11.2-11.2 0-6.186 5.015-11.2 11.2-11.2 6.186 0 11.2 5.014 11.2 11.2zM8.4 16.8a2.8 2.8 0 100-5.6 2.8 2.8 0 000 5.6z" clip-rule="evenodd"></path>
                                                                </svg>
                                                            </div>
                                                            <span>Track</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>                    
                        </div>                
                    </template>
                </div>
                <div style="display: none;" x-data="{showModal:false}">
                    <button
                    @click="showModal = true"
                    class="btn tracking-details space-x-2 bg-warning font-medium text-white shadow-lg shadow-warning/50 hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90"
                    >                    
                    <em class="fas fa-shipping-fast ml-4"></em> 
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
                                <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 ">
                                
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
                            <div class="min-w-full overflow-x-auto">
                                <div class="col-span-12 grid lg:col-span-8">
                                    <div class="card">
                                        <div class="border-b flex justify-between border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                                            <div class="flex items-center space-x-2">
                                                
                                                <h4 class="text-lg tracking-number font-medium text-slate-700 dark:text-navy-100">                                                    
                                                </h4>
                                                <small class="service-code"></small>
                                            </div>
                                            <div class="text-right">
                                                <p>Origin: <small class="origin font-semibold"></small></p>
                                                <p>Destiny: <small class="destiny font-semibold"></small></p>
                                            </div>
                                        </div>
                                        <div class="space-y-4 p-4 sm:p-5" style="overflow: auto; max-height: 720px">
                                            <ol class="timeline line-space px-4 [--size:1.5rem] sm:px-5 tracking-info" >                                                                                       
                                            </ol>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>                
                    </template>
                </div>
            </div>
        </div>
        <hr>
        <div class="my-3 max-w-full">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <table class="is-hoverable w-full text-left">
                        <thead>
                            <tr>                        
                                <th class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"  style="width: 15%;">Shipment</th>                                
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Item / Order Information</th>  
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5" style="width: 5%;">Qty</th>                                
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5" style="width: 10%;">Status</th>                                
                                <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5" style="width: 5%;">Actions</th>                                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($shipments->getNumRows() > 0) : ?> 
                                <?php foreach($shipments->getResultObject() as $row) : ?>  
                                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                        <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold">
                                            <div class="flex">
                                                <span class="lg:text-base"><?= $row->courier_name ?> </span>                                            
                                            </div>
                                            <span><a href="#" class="shipment-number underline" data-id="<?= $row->id ?>"  data-tracking="<?= $row->tracking_number ?>" ><?= $row->tracking_number ?></a></span>
                                            <br>
                                            <small class="italic"><?= $row->service_code ?></small>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <?php if (empty($row->order_information)) : ?>
                                                <div>
                                                    <?= $row->asin ?> <br>
                                                    <button type="button" class="shipment-number" data-id="<?= $row->id ?>" x-tooltip.cursor.x="'<?= str_replace("'", " ", $row->title) ?>'">
                                                        <?= substr($row->title, 0, 90) ?><?= (strlen($row->title) > 90) ? '..' : '' ?>
                                                    </button>  
                                                </div>
                                                <small class="italic">Purchased at : <?= date('M d, Y h:i', strtotime($row->created_at)) ?></small>
                                            <?php else : ?>
                                                <div>
                                                    <?= $row->order_information ?>
                                                </div>
                                            <?php endif ?>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5" style="text-align: center"><?= $row->qty ?></td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <div class="track-<?= $row->tracking_number ?>">
                                                <?php if ($row->status == 'delivered') : ?>
                                                    <div class="badge space-x-2.5 rounded-full bg-success/10 text-success dark:bg-success/15">
                                                        <div class="h-2 w-2 rounded-full bg-current"></div>
                                                        <span><?= ucfirst($row->status) ?></span>
                                                    </div>
                                                <?php elseif ($row->status == 'transit' || $row->status == 'pickup') : ?>
                                                    <div class="badge space-x-2.5 rounded-full bg-warning/10 text-warning dark:bg-warning/15">
                                                        <div class="h-2 w-2 rounded-full bg-current"></div>
                                                        <span><?= ucfirst($row->status) ?></span>
                                                    </div>
                                                <?php elseif ($row->status == 'undelivered' || $row->status == 'expired' || $row->status == 'exception') : ?>
                                                    <div class="badge space-x-2.5 rounded-full bg-error/10 text-error dark:bg-error/15">
                                                        <div class="h-2 w-2 rounded-full bg-current"></div>
                                                        <span><?= ucfirst($row->status) ?></span>
                                                    </div>
                                                <?php elseif ($row->status == 'inforeceived' || $row->status == 'pending') : ?>
                                                    <div class="badge space-x-2.5 rounded-full bg-info/10 text-info dark:bg-info/15">
                                                        <div class="h-2 w-2 rounded-full bg-current"></div>
                                                        <span><?= ucfirst($row->status) ?></span>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="badge space-x-2.5 text-slate-800 dark:text-navy-100">
                                                        <div class="h-2 w-2 rounded-full bg-current"></div>
                                                        <span>Not Found</span>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                            <div>
                                                <p class="text-sm  checkpoint-<?= $row->tracking_number ?>"><?= $row->checkpoint_date ?> <?= $row->location ?></p>
                                                <p class="text-sm  details-<?= $row->tracking_number ?>"><?= $row->tracking_details ?></p>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5" style="text-align: center;">
                                            <a href="#" class="refresh-tracking" data-id="<?= $row->tracking_number ?>"><i class="fa fa-refresh"></i></a>
                                        </td>                                
                                    </tr>
                                <?php endforeach ?>  
                            <?php else : ?>                         
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5 font-semibold">
                                        -
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        -
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5" style="text-align: center">-</td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        -
                                    </td>
                                    <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5" style="text-align: center;">
                                        -
                                    </td>                                
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="display: none" x-data="{showModal:false}">
                <button
                    @click="showModal = true"
                    class="btn mt-12 bg-slate-50 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 tracking-number-modal"
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
                                
                            </div>                     
                        </div>
                    </div>
                </template>
            </div>
        </div>        
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>    
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    $(document).on('submit', '#trackingForm', function(e) {   
        var formData = new FormData(this);     
        var trackingNumber = "";   
        var serviceCode = ""; 
        var origin = "-";
        var destiny = "-";   
        formStat = true;
        
        $('.spinner').css('display', 'block'); 
        e.preventDefault();                
        $.ajax({
            url:'/tracking-shipment',
            type: 'POST',
            data: formData,
            success: function (data) {
                const resp = JSON.parse(data);
                const trackInfo = [];
                $('.tracking-info').html('');
                trackingNumber = resp['tracking']['tracking_number'];
                serviceCode = resp['tracking']['service_code'];
                origin = resp['tracking']['origin_city'] + ', ' +resp['tracking']['origin_state'] + ' ' +resp['tracking']['origin_country'];
                destiny = resp['tracking']['destination_city'] + ', ' +resp['tracking']['destination_state'] + ' ' +resp['tracking']['origin_country'];
                let location = "";
                for (var i = 0; i < resp['tracking']['origin_info']['trackinfo'].length; i++) {
                    // formatted date
                    const date = new Date(resp['tracking']['origin_info']['trackinfo'][i]['checkpoint_date']);                                
                    const year = date.getFullYear();
                    const month = date.getMonth();                    
                    const day = date.getDate();
                    let hour = date.getHours();
                    let minute = date.getMinutes();

                    hour = ("0" + hour).slice(-2);
                    minute = ("0" + minute).slice(-2);
                    const formattedDate = months[month].substring(0, 3) + ' ' + day + ', ' + year + ' at ' + hour + ':' + minute ;                                    
                    // detail info
                    const trackingDetails = resp['tracking']['origin_info']['trackinfo'][i]['tracking_detail'];
                    // location
                    location = (resp['tracking']['origin_info']['trackinfo'][i]['location'] == null) ? resp['tracking']['origin_info']['trackinfo'][i]['checkpoint_delivery_status'].toUpperCase() : resp['tracking']['origin_info']['trackinfo'][i]['location'];
                    // status shipment
                    const status = resp['tracking']['origin_info']['trackinfo'][i]['checkpoint_delivery_status']; 
                    
                    if (status == 'transit' || status == 'pickup') {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/shipping-48.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    } else if (status == 'inforeceived') {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/send-package-64.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    } else if (status == 'delivered') {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/delivered-64.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    } else {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/pending-32.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    }
                }
                $('.close-shipment').click();

                $('.tracking-number').html(trackingNumber);                
                $('.service-code').html(serviceCode);

                $('.origin').html(origin);
                $('.destiny').html(destiny);

                $('.tracking-details').click();
                formStat = false;
                $('.spinner').css('display', 'none');
                // swal("Good job!", "The files have been uploaded successfully", "success");
                // $('#trackingForm')[0].reset();
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).on('click', '.shipment-number', function(e) {
        const number = $(this).data('tracking');
        console.log(number);
        $.get('/b2b/tracking-detail'  , {tracking: number})
            .done(function (data) {
                const temp = JSON.parse(data);
                const resp = temp['data'][0];
                const trackInfo = [];
                $('.tracking-info').html('');
                
                trackingNumber = resp['tracking_number'];
                serviceCode = resp['service_code'];
                origin = resp['origin_city'] + ', ' +resp['origin_state'] + ' ' +resp['origin_country'];
                destiny = resp['destination_city'] + ', ' +resp['destination_state'] + ' ' +resp['origin_country'];
                let location = "";
                
                for (var i = 0; i < resp['origin_info']['trackinfo'].length; i++) {
                    // formatted date
                    const date = new Date(resp['origin_info']['trackinfo'][i]['checkpoint_date']);                                
                    const year = date.getFullYear();
                    const month = date.getMonth();                    
                    const day = date.getDate();
                    let hour = date.getHours();
                    let minute = date.getMinutes();

                    hour = ("0" + hour).slice(-2);
                    minute = ("0" + minute).slice(-2);
                    const formattedDate = months[month].substring(0, 3) + ' ' + day + ', ' + year + ' at ' + hour + ':' + minute ;                                    
                    // // detail info
                    const trackingDetails = resp['origin_info']['trackinfo'][i]['tracking_detail'];
                    // // location
                    location = (resp['origin_info']['trackinfo'][i]['location'] == null) ? resp['origin_info']['trackinfo'][i]['checkpoint_delivery_status'].toUpperCase() : resp['origin_info']['trackinfo'][i]['location'];
                    // // status shipment
                    const status = resp['origin_info']['trackinfo'][i]['checkpoint_delivery_status']; 
                    
                    if (status == 'transit' || status == 'pickup') {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/shipping-48.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    } else if (status == 'inforeceived') {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/send-package-64.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    } else if (status == 'delivered') {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/delivered-64.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    } else {
                        $('.tracking-info').append('<li class="timeline-item"><div class="timeline-item-point dark:bg-navy-700"><img src="/assets/img/pending-32.png" alt=""></div><div class="timeline-item-content flex-1 pl-4 sm:pl-8"><div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"><p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">'+ location +'</p><span class="text-xs text-slate-400 dark:text-navy-300">'+ formattedDate +'</span></div><p class="py-1">'+ trackingDetails +'</p></div></li>');
                    }
                }
                

                $('.tracking-number').html(trackingNumber);                
            
                $('.service-code').html(serviceCode);

                $('.origin').html(origin);
                $('.destiny').html(destiny);

                $('.tracking-details').click();
            });        
    });

    $(document).on('click', '.refresh-tracking', function(e) {
        const id = $(this).data('id');

        $.get('/b2b/refresh-tracking', {id: id})
            .done(function(data) {
                const resp = JSON.parse(data);
                
                if (resp['message'] == 'success') {
                    if (resp['status'] == 'delivered') {                                                
                        $('.track-'+id).html('<div class="badge space-x-2.5 rounded-full bg-success/10 text-success dark:bg-success/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp['status']) +'</span></div>');
                    } else if (resp['status'] == 'transit' || resp['status'] == 'pickup') {
                        $('.track-'+id).html('<div class="badge space-x-2.5 rounded-full bg-warning/10 text-warning dark:bg-warning/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp['status']) +'</span></div>');
                    } else if (resp['status'] == 'undelivered' || resp['status'] == 'expired' || resp['status'] == 'exception') {
                        $('.track-'+id).html('<div class="badge space-x-2.5 rounded-full bg-error/10 text-error dark:bg-error/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp['status']) +'</span></div>');
                    } else if (resp['status'] == 'inforeceived' || resp['status'] == 'pending') {
                        $('.track-'+id).html('<div class="badge space-x-2.5 rounded-full bg-info/10 text-info dark:bg-info/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>'+ capitalizeFirstLetter(resp['status']) +'</span></div>');                    
                    } else {
                        $('.track-'+id).html('<div class="badge space-x-2.5 text-slate-800 dark:text-navy-100"><div class="h-2 w-2 rounded-full bg-current"></div><span>Not Found</span></div>');
                    }             
                    $('.checkpoint-' + id).html(resp['check_point'] + ' '+resp['location']);
                    $('.details-' + id).html(resp['details']);
                    
                    swal("Shipment Status", "Shipping Status recently updated", "success");
                } else {
                    swal("Shipment Status", "There are no updates on this shipment yet", "info");
                }
            })
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

</script>
<?= $this->endSection() ?>