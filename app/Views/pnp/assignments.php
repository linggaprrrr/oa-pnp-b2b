<?= $this->extend('pnp/layout/component') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="justify-between" style="display: flex;">
        <div class="mb-1">                   
            <form action="/pnp/assignments" method="GET" style="display: flex;">
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
        <div class="mb-1" style="justify-self: right" x-data="{showModal:false}">
            <button @click="showModal = true" class="company-list btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            Company List
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
                    class="relative rounded-lg bg-white px-4 pb-4 transition-all duration-300 dark:bg-navy-700 sm:px-5"
                    x-show="showModal"
                    x-transition:enter="easy-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                    x-transition:leave="easy-in"
                    x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                    x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                    style="width: 890px"
                    >
                    <div class="my-3 flex h-8 items-center justify-between">
                        <h2
                        class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base"
                        >
                        Company List
                        </h2>
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
                            />
                        </svg>
                        </button>
                        
                    </div>
                        <hr>                
                        <form id="formClient">
                            <?php csrf_field() ?>      
                            <div class="mt-4">                           
                                <table class="datatable-init4 stripe table" style="font-size: 11px;"> 
                                    <thead>
                                        <tr>                                        
                                            <th class="tb-tnx-info">Name</th>
                                            <th class="tb-tnx-info">Company Name</th>
                                            <th class="tb-tnx-info">Total Orders</th>
                                            <th class="tb-tnx-info">Cost Left</th>
                                            <th class="tb-tnx-info">Order Date</th>
                                            <th class="tb-tnx-info">Total Assign</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($clients->getResultObject() as $client) : ?>
                                            <tr>                                            
                                                <td class="tb-tnx-info"><span class="date"><?= $client->client_name ?></span></td>
                                                <td class="tb-tnx-info"><span class="date"><?= $client->company ?></span></td>
                                                <td class="tb-tnx-info"><span class="date">$<?= number_format($client->total_order, 2) ?></span></td>
                                                <td class="tb-tnx-info"><span class="date">$<?= number_format($client->cost_left, 2) ?></span></td>
                                                <td class="tb-tnx-info"><span class="date"><?= date('d M Y', strtotime($client->order_date)) ?></span></td>
                                                <td class="tb-tnx-info"><span class="date"><?= $client->total_assign ?></span></td>                                            
                                            </tr>
                                        <?php endforeach ?>
                                        
                                    </tbody>
                                </table>
                            </div>                                
                        </form>
                    </div>
                </div>
            </template>
        </div>  
    </div>                                    
    <div class="card px-4 pb-4 sm:px-5">
        <form id="assignmentForm">
            <div class="my-3 flex h-8 items-center justify-between" style="display: flex; ">
                <div>
                    <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                        Box Assignments 
                    </h2>      
                </div>      
                <div>
                    <button type="submit" class="btn space-x-2 bg-warning font-medium text-white shadow-lg shadow-warning/50 hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90">
                        <span>Send to Need To Upload Process</span>
                        <em class="fas fa-shipping-fast"></em>
                    </button>    
                </div>
            </div>
            <hr>
            <div class="my-3 max-w-full">
                <div class="overflow-x-auto">
                    <table class="is-hoverable w-full text-left" style="font-size: 12px">
                        <thead>
                            <tr>                        
                                <th class="rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 ">#</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 ">ASIN</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 " style="width: 30%;">Item Description</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 " style="width: 5%;">Buy Cost</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 " style="width: 7%;">Qty Assign</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 " style="width: 5%;">Qty Remaining</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 " style="width: 5%;">Total Cost</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 " >Company Assigned To</th>
                                <th class="bg-slate-200 text-center px-4 py-1 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 " style="width: 7%;">Notes</th>
                                <th class="rounded-r-lg text-center bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 "></th>                                                    
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $id = 1; $date = "";?>
                            <?php if (count($assigned_items) == 0) : ?>
                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="rounded-l-lg px-4 py-3 sm:px-5 font-semibold">-</td>
                                    <td class="px-4 py-3 sm:px-5">-</td>
                                    <td class="px-4 py-3 sm:px-5">-</td>
                                    <td class="px-4 py-3 sm:px-5">
                                        - 
                                    </td>
                                    <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                        -
                                    </td>
                                    <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                        -
                                    </td>
                                    <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                        -
                                    </td>
                                    <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                        -
                                    </td>
                                    <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                        -
                                    </td>
                                    <td class="addmore">
                                        
                                    </td>
                                </tr>     
                            <?php else : ?>
                                <?php $purchId = null; ?>
                                <?php foreach($assigned_items as $purch) : ?>
                                    <?php if ($purch['id'] != $purchId) : ?>                               
                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500 row_<?= $purch['id'] ?>">
                                            <td class="rounded-l-lg px-4 py-3 sm:px-5 font-semibold"><?= $id++ ?></td>
                                            <td class="px-4 py-3 sm:px-5 assigned-asin<?= $purch['aid'] ?>">
                                                <?= $purch['asin'] ?>
                                                <input type="hidden" name="assign_id[]" value="<?= $purch['aid'] ?>">                                                                                                
                                            </td>
                                            <td class="px-4 py-3 sm:px-5">
                                                <button type="button" class="text-left font-bold" x-tooltip.cursor.x="'<?= str_replace("'", " ", $purch['title']) ?>'">
                                                    <?= substr($purch['title'], 0, 90) ?><?= (strlen($purch['title']) > 90) ? '..' : '' ?>
                                                </button>                           
                                                <hr>      
                                                <div class="box-section<?= $purch['aid'] ?>">
                                                    <?php if (count($purch['boxes']) > 0) : ?>
                                                        <?php for ($i = 0; $i < count($purch['boxes']); $i++) :?>  
                                                            <div class="grid grid-cols-3 gap-2 box-<?= $purch['boxes'][$i]->id ?>" data-box="<?= $purch['boxes'][$i]->id ?>">
                                                                <label class="block">
                                                                    <span>B&zwnj;ox N&zwnj;ame </span>
                                                                    <span class="ntu-icon<?= $purch['aid'] ?>">
                                                                    <?php if (!is_null($purch['boxes'][$i]->ntu_date)) : ?>
                                                                        <a x-tooltip.success="'<?= (date('m-d-Y') == date('m-d-Y', strtotime($purch['boxes'][$i]->ntu_date)) ? 'This item just sent to NTU today ' : 'This item has been sent to NTU on '.date('m/d/Y', strtotime($purch['boxes'][$i]->ntu_date)).'') ?> '">
                                                                            <em class="fas fa-shipping-fast"></em>
                                                                        </a>
                                                                    <?php endif ?>
                                                                    </span>
                                                                    <input type="hidden" name="box_id[]" class="box_id<?= $purch['aid'] ?>" value="<?= $purch['boxes'][$i]->id ?>">
                                                                    <input name="box" class="get-boxname form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent box-name box-name<?= $purch['aid'] ?>" data-id="<?= $purch['aid'] ?>" data-box_id="<?= $purch['boxes'][$i]->id ?>" data-allocation="<?= $purch['boxes'][$i]->allocation ?>" value="<?= $purch['boxes'][$i]->box_name ?>" type="text" autocomplete="nope">
                                                                </label>
                                                                <label class="block">
                                                                    <span>Total Allocation</span>
                                                                    <input class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent total-allocation total-allocation<?= $purch['aid'] ?>" data-id="<?= $purch['aid'] ?>" data-box_id="<?= $purch['boxes'][$i]->id ?>" data-allocation="<?= $purch['boxes'][$i]->allocation ?>"  placeholder="..." value="<?= $purch['boxes'][$i]->allocation ?>" type="number" min="1">
                                                                </label>
                                                                <label for="" class="flex items-center justify-center">                                                        
                                                                    <?php if ($i == 0) : ?>
                                                                        <button
                                                                            type="button"
                                                                            class="btn new-box border h-6 px-3 border-success/30 bg-success/10 font-medium text-success text-tiny hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
                                                                            data-id="<?= $purch['aid'] ?>"
                                                                        >
                                                                            <em class="fas fa-box-open mr-2"></em>
                                                                            New Box
                                                                        </button>
                                                                    <?php else : ?>
                                                                        <button
                                                                            type="button"
                                                                            class="delete-box btn h-9 w-9 p-0 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25"
                                                                            data-id="<?= $purch['aid'] ?>"
                                                                            data-box_id="<?= $purch['boxes'][$i]->id ?>"
                                                                        >
                                                                            <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            class="h-5 w-5"
                                                                            fill="none"
                                                                            viewBox="0 0 24 24"
                                                                            stroke="currentColor"
                                                                            >
                                                                            <path
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                            />
                                                                            </svg>
                                                                        </button>                                                                        
                                                                            
                                                                        
                                                                    <?php endif ?>
                                                                </label>
                                                            </div>
                                                        <?php endfor ?>
                                                    <?php else : ?>
                                                        <div class="grid grid-cols-3 gap-2" data-box="">
                                                            <label class="block">
                                                                <span>B&zwnj;ox N&zwnj;ame </span>
                                                                <span class="ntu-icon<?= $purch['aid'] ?>">
                                                                </span>
                                                                <input type="hidden" name="box_id[]" class="box_id<?= $purch['aid'] ?>">                                                                
                                                                <input name="box" class="get-boxname form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent box-name box-name<?= $purch['aid'] ?>" data-id="<?= $purch['aid'] ?>" data-box_id="" data-allocation="" type="text" autocomplete="nope">
                                                            </label>
                                                            <label class="block">
                                                                <span>Total Allocation</span>
                                                                <input  class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent total-allocation total-allocation<?= $purch['aid'] ?>" data-id="<?= $purch['aid'] ?>" data-box_id=""  data-allocation="" placeholder="..." type="number" min="1">
                                                            </label>
                                                            <label for="" class="flex items-center justify-center">                                                        
                                                                <button
                                                                    type="button"
                                                                    class="btn new-box border h-6 px-3 border-success/30 bg-success/10 font-medium text-success text-tiny hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
                                                                    data-id="<?= $purch['aid'] ?>"
                                                                >
                                                                    <em class="fas fa-box-open mr-2"></em>
                                                                    New Box
                                                                </button>
                                                            </label>
                                                        </div>  
                                                    <?php endif ?>
                                                </div>

                                            </td>
                                            <td class="px-4 py-3 sm:px-5">
                                                $<?= $purch['buy_cost'] ?>
                                            </td>
                                            <td class="px-4 py-3 sm:px-5">
                                                <div class="form-group">                                            
                                                    <div class="form-control-wrap number-spinner-wrap">                                
                                                        <input type="number" name="qty[]" min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty_assigned qty_assigned<?= $purch['aid'] ?>" data-received="<?= $purch['qty_received'] ?>" data-pid="<?= $purch['id'] ?>" data-id="<?= $purch['aid'] ?>" data-cost="<?= $purch['buy_cost'] ?>" data-asin="<?= $purch['asin'] ?>" data-title="<?= $purch['title'] ?>" data-remaining="<?= $purch['qty_remaining'] ?>" data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_assigned'] == 0) ? '0' : $purch['qty_assigned']  ?>">                                                
                                                    </div>
                                                </div>    
                                            </td>
                                            <td class="rounded-r-lg px-4 py-3 sm:px-5 text-center assigned_remain_<?= $purch['id'] ?>">
                                                <?php if ($purch['qty_remaining'] == 0) : ?>
                                                    <span class="text-success font-semibold qty_remain_<?= $purch['id'] ?>">Complete</span>
                                                <?php else : ?>
                                                    <span class="text-danger font-semibold qty_remain_<?= $purch['id'] ?>"><?= $purch['qty_remaining'] ?></span> 
                                                <?php endif ?>
                                            </td>
                                            <td class="px-4 py-3 sm:px-5 total_buy_cost_<?= $purch['id'] ?>">
                                                $<?= round(($purch['buy_cost'] * $purch['qty_assigned']), 2)  ?>
                                            </td>
                                            <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                                <select name="client[]" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent select-client select-client_<?= $purch['aid'] ?>" data-id="<?= $purch['aid'] ?>" data-item="<?= $purch['purchased_item_id'] ?>" style="font-size: 10px" id="">
                                                    <option value="">...</option>
                                                    <?php foreach ($clients->getResultObject() as $cl) : ?>
                                                        <option value="<?= $cl->id ?>" <?= $cl->id == $purch['order_id'] ? 'selected' : '' ?>><?= $cl->client_name ?> (<?= $cl->company ?>)</option>
                                                    <?php endforeach ?>
                                                </select>
                                            </td>
                                            <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                                <input type="text"  class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent assigned_notes" data-id="<?= $purch['aid'] ?>" style="font-size: 11px;" value="<?= $purch['assigned_notes'] ?>">
                                            </td>
                                            <td class="text-right addmore_<?= $purch['id'] ?>">
                                                <div>                                                
                                                    <button type="button" class="text-success add-more add-more_<?= $purch['id'] ?>" data-id="<?= $purch['aid'] ?>" data-pid="<?= $purch['id'] ?>"  data-asin="<?= $purch['asin'] ?>" data-title="<?= $purch['title'] ?>" data-received="<?= $purch['qty_received'] ?>" data-remaining="<?= $purch['qty_remaining'] ?>" ><em class="fas fa-plus-circle fa-lg"></em></button> 
                                                </div>
                                            </td>
                                        </tr>  
                                    <?php else : ?>
                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="rounded-l-lg px-4 py-3 sm:px-5 font-semibold"></td>
                                            <td class="px-4 py-3 sm:px-5 assigned-asin<?= $purch['aid'] ?>">
                                                <?= $purch['asin'] ?>
                                                <input type="hidden" name="assign_id[]" value="<?= $purch['aid'] ?>">
                                                <?php if (!is_null($purch['sid'])) : ?>
                                                    <a x-tooltip.success="'<?= (date('m-d-Y') == date('m-d-Y', strtotime($purch['sent_date'])) ? 'This item just sent to NTU today ' : 'This item has been sent to NTU on '.date('m/d/Y', strtotime($purch['sent_date'])).'') ?> '">
                                                        <em class="fas fa-shipping-fast"></em>
                                                    </a>
                                                <?php endif ?>
                                            </td>
                                            <td class="px-4 py-3 sm:px-5">
                                                <button x-tooltip.cursor.x="'<?= str_replace("'", " ", $purch['title']) ?>'">
                                                    <?= substr($purch['title'], 0, 90) ?><?= (strlen($purch['title']) > 90) ? '..' : '' ?>
                                                </button>                                                                   
                                                
                                            </td>
                                            <td class="px-4 py-3 sm:px-5">
                                                <div class="form-group">                                            
                                                    <div class="form-control-wrap number-spinner-wrap">                                
                                                        <input type="number" name="qty[]" min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty_assigned qty_assigned<?= $purch['aid'] ?>" data-received="<?= $purch['qty_received'] ?>" data-pid="<?= $purch['id'] ?>" data-id="<?= $purch['aid'] ?>" data-cost="<?= $purch['buy_cost'] ?>"  data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_assigned'] == 0) ? '0' : $purch['qty_assigned']  ?>">                                                
                                                    </div>
                                                </div>    
                                            </td>
                                            <td class="rounded-r-lg px-4 py-3 sm:px-5 text-center assigned_remain_<?= $purch['id'] ?>">
                                                <?php if ($purch['qty_remaining'] == 0) : ?>
                                                    <span class="text-success font-semibold qty_remain_<?= $purch['id'] ?>">Complete</span>
                                                <?php else : ?>
                                                    <span class="text-danger font-semibold qty_remain_<?= $purch['id'] ?>"><?= $purch['qty_remaining'] ?></span> 
                                                <?php endif ?>
                                            </td>
                                            <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                                <select name="client[]" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent select-client select-client_<?= $purch['aid'] ?>" data-id="<?= $purch['aid'] ?>" data-item="<?= $purch['purchased_item_id'] ?>" data-asin="<?= $purch['asin'] ?>" style="font-size: 10px" id="">
                                                    <option value="">...</option>
                                                    <?php foreach ($clients->getResultObject() as $cl) : ?>
                                                        <option value="<?= $cl->id ?>" <?= $cl->id == $purch['order_id'] ? 'selected' : '' ?>><?= $cl->client_name ?> (<?= $cl->company ?>)</option>
                                                    <?php endforeach ?>
                                                </select>
                                            </td>
                                            <td class="rounded-r-lg px-4 py-3 sm:px-5">
                                                <input type="text"  class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent assigned_notes" data-id="<?= $purch['aid'] ?>" style="font-size: 11px;" value="<?= $purch['assigned_notes'] ?>">
                                            </td>
                                            <td class="text-right addmore_<?= $purch['id'] ?>">
                                                <div>                                                
                                                    <button type="button" class="text-error delete-row" data-id="<?= $purch['aid'] ?>" data-pid="<?= $purch['id'] ?>"  data-asin="<?= $purch['asin'] ?>" data-title="<?= $purch['title'] ?>" data-received="<?= $purch['qty_received'] ?>" data-remaining="<?= $purch['qty_remaining'] ?>" ><em class="fas fa-minus-circle fa-lg"></em></button> 
                                                </div>
                                            </td>
                                        </tr>  
                                    <?php endif ?>
                                    <?php $purchId = $purch['id'] ?>
                                <?php endforeach ?>
                            <?php endif ?>
                            
                                            
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    $(document).ready(function() {
        $(".get-boxname").attr("autocomplete", "off");
    });
    $(document).ready(function() {
        var formStat = false;


        $( "#assignmentForm" ).on( "submit", function( event ) {
            event.preventDefault();                        
            $.post('/pnp/shipments', $( "#assignmentForm" ).serialize() )
                .done(function(data) {
                    formStat = false;                   
                    const resp = JSON.parse(data);
                    if (resp['result'] == 'success') {
                        swal("Good Job!", "These Boxes have been successfully added to NTU, please refresh the page.", "success");
                        
                    } else {
                        swal("Error!", "There is no data.", "warning");
                    }
            });
            
        });
        
        window.addEventListener("beforeunload", function (e) {
            var confirmationMessage = 'It looks like you have been editing something. '
                                    + 'If you leave before saving, your changes will be lost.';

            if (formStat == true) {
                (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
            }
                                    
        });
        
        $('.apply').click(function() {
            formStat = false;
        });
        
        table = $('.datatable-init4').DataTable({
            "bInfo" : false,
            "aaSorting": [],
            "bLengthChange": false,
        });
       

        $(document).on('input propertychange', '.qty_assigned', function() {
            const id = $(this).data('id');
            const pid = $(this).data('pid');
            const received = $(this).data('received');
            const qty = $(this).val();            
            const asin = $(this).data('asin');
            const cost = $(this).data('cost');
            const title = $(this).data('title');
            const remaining = $(this).data('remaining');
            

            $.post('/pnp/save-qty-assigned', {id: id, pid: pid, qty: qty, received: received})
                .done(function(data) { 
                    const remainder = JSON.parse(data);

                    if (remainder['qty_remainder'] == 0) {
                        $('.assigned_remain_' + pid).html('<span class="text-success font-semibold qty_remain_'+pid+'">Complete</span>');                                                                        
                    } else if(remainder['qty_remainder'] == "") {
                        $('.assigned_remain_' + pid).html('<span class="text-error font-semibold qty_remain_'+pid+'">'+ Math.abs(remainder['qty_remainder'] - 0) +'</span>');
                        $.notify("Quantity exceeded!", "error");         
                    } else {
                        if (remainder['qty_remainder'] < 0) {
                            $('.assigned_remain_' + pid).html('<span class="text-error font-semibold qty_remain_'+pid+'">'+ Math.abs(remainder['qty_remainder']) +'</span>');
                            $.notify("Quantity exceeded!", "error");                            
                        } else {
                            $('.assigned_remain_' + pid).html('<span class="font-semibold qty_remain_'+pid+'">'+ Math.abs(remainder['qty_remainder']) +'</span>');                            
                                                                                                
                        }
                    }                      
                    $('.total_buy_cost_' + pid).html('$'+parseFloat(parseInt(qty) * parseFloat(cost)).toFixed(2));

                });

            formStat = true;
        });

        $(document).on('input propertychange', '.assigned_notes', function(data) {            
            const item = $(this).data('id');
            const notes = $(this).val();            

            $.post('/pnp/save-assigned-notes', {item: item, notes: notes})
                .done(function(data) {
                    
                });
            formStat = true;
        });

        $(document).on('change', '.select-client', function(data) {
            const id = $(this).data('id');
            const item = $(this).data('item');
            const asin = $(this).data('asin');
            const clientID = $(this).val();

            $.post('/pnp/save-client-order', {id: id, item: item, client_id: clientID, asin: asin})
                .done(function(data) {
                    const resp = JSON.parse(data);
                    if (resp['status'] == 'warning') {
                        swal("Warning!", "The client costs exceed total buy costs", "warning");
                    }
                    $.notify("Your changes have been saved!", "success");
                });
            formStat = true;
        });

        $(document).on('click', '.select-client-add-more', function(data) {            
            const id = $(this).data('id');
            const client = $(this).val();

            $.get('/pnp/get-client-list')
                .done(function(data) {
                    const resp = JSON.parse(data);   
                    
                    $('.select-client-add-more_'+id)
                        .empty()
                        .append('<option value="">...</option>');
                    for (var i = 0; i < resp.length; i++) {
                        if (resp[i]['status'] == null) {
                            if (resp[i]['order_id'] == client) {
                                $('.select-client-add-more_'+id).append('<option selected value="'+ resp[i]['order_id'] +'">'+ resp[i]['client_name'] +' ('+resp[i]['company']+')</option>');
                            } else {
                                $('.select-client-add-more_'+id).append('<option value="'+ resp[i]['order_id'] +'">'+ resp[i]['client_name'] +' ('+resp[i]['company']+')</option>');
                            }
                        } else {
                            if (resp[i]['order_id'] == client) {
                                $('.select-client-add-more_'+id).append('<option selected value="'+ resp[i]['order_id'] +'">'+ resp[i]['client_name'] +' ('+resp[i]['company']+') - '+ resp[i]['status'].toUpperCase() +'</option>');
                            } else {
                                $('.select-client-add-more_'+id).append('<option value="'+ resp[i]['order_id'] +'">'+ resp[i]['client_name'] +' ('+resp[i]['company']+') - '+ resp[i]['status'].toUpperCase() +'</option>');
                            }
                            
                        }
                    }
                }); 
            
        });
        
        $(document).on('change', '.select-client-add-more', function(data) {
            const id = $(this).data('id');
            const item = $(this).data('item');
            const orderID = $(this).val();

            $.post('/pnp/save-client-order', {id: id, item: item, order_id: orderID})
                .done(function(data) {
                    $.notify("Your changes have been saved!", "success");
                });
            formStat = true;
        });



        $(document).on('change', '.select-client-add-more', function(data) {
            const id = $(this).data('id');
            const item = $(this).data('item');
            const orderID = $(this).val();

            $.post('/pnp/save-client-order', {id: id, item: item, order_id: orderID})
                .done(function(data) {
                    $.notify("Your changes have been saved!", "success");
                });
            formStat = true;
        });
        
        $(document).on('click', '.add-more', function(data) {
            const id = $(this).data('id');
            const pid = $(this).data('pid');
            const qty = $(this).data('qty');
            const asin = $(this).data('asin');
            const title = $(this).data('title');
            const received = $(this).data('received');
            const remaining = $(this).data('remaining');
            
            $.post('/pnp/add-new-assign', {pid: pid})
                .done(function(data) {                    
                    const client = JSON.parse(data);                                     
                    if (client['remaining'] != 0) {
                        var newRow = '<tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500 row_"><td class="rounded-l-lg px-4 py-3 sm:px-5 font-semibold"></td><td class="px-4 py-3 sm:px-5">'+asin+'<input type="hidden" name="assign_id[]" value="'+client['id']+'"></td><td class="px-4 py-3 sm:px-5">'+title+'</td><td class="px-4 py-3 sm:px-5"><div class="form-group"><div class="form-control-wrap number-spinner-wrap"><input type="number" name="qty[]" min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty_assigned qty_assigned'+pid+'" data-received="'+received+'" data-id="'+client['id']+'" data-pid="'+pid+'"  value="0"></div></div></td><td class="rounded-r-lg px-4 py-3 sm:px-5 text-center assigned_remain_'+pid+'"><span class="qty_remain_'+pid+'">'+client['remaining']+'</span></td><td class="rounded-r-lg px-4 py-3 sm:px-5"><select name="client[]" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent select-client-add-more select-client-add-more_'+client['id']+'" data-id="'+client['id']+'" style="font-size:10px" id=""><option>...</option></select></td><td class="rounded-r-lg px-4 py-3 sm:px-5"><input type="text"  class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent assigned_notes" data-id="'+client['id']+'"></td><td class="text-right addmore_"><div><button type="button" class="text-error delete-row" data-id="'+client['id']+'" data-pid="'+pid+'"><em class="fas fa-minus-circle fa-lg"></em></button></div></td></tr>';
                        $('.row_'+pid).after(newRow);
                    } else {
                        $.notify("Quantity exceeded!", "error");    
                    }
                });
            formStat = true;
        });


        $(document).on('click', '.delete-row', function(data) {
            const id = $(this).data('id');
            const pid = $(this).data('pid');

            $(this).closest("tr").remove();
            $.post('/pnp/delete-assign-data', {id: id})
                .done(function(data) {
                    const qty = JSON.parse(data);
                    const remain = $('.qty_remain_' + pid).html();
                    
                    if (qty['qty'] == 0) {
                        $('.qty_remain_' + pid).html(remain);                        
                        $('.add-more_'+pid).data('remaining', remain);
                    } else {
                        if (remain == 'Complete') {
                            $('.qty_remain_' + pid).removeClass('text-success')
                            $('.qty_remain_' + pid).html(parseInt(qty['qty']));
                            $('.add-more_'+pid).data('remaining', parseInt(qty['qty']));
                        } else {
                            $('.qty_remain_' + pid).html(parseInt(qty['qty']) + parseInt(remain));
                            $('.add-more_'+pid).data('remaining', parseInt(qty['qty']) + parseInt(remain));
                        }
                        
                    }
                });
            
            formStat = true;
        });

        
        $(document).on("change",".tick-client",function() {
            const id = $(this).data('id');
            const clientID = $(this).data('client');
            const orderID = $(this).val();
            const name = $(this).data('name');
            const company = $(this).data('company');
            var checkFlag = 'unchecked';

            if ($(this).is(':checked')) {
                checkFlag = 'checked';                                
            }
            $.post( "/save-clients", { id: id, order_id: orderID, client_id: clientID, check_flag: checkFlag, name: name, company: company})
                .done(function( data ) {                          
                    $.notify("Your changes have been saved!", "success");
                    
                    $.get('/pnp/get-client-list', {id: id, order_id: orderID})
                        .done(function(data) {
                        const resp = JSON.parse(data);          
                        
                        // $('.select-client').append('<option>...</option>');                                 
                        if (checkFlag == 'checked') {
                            if (resp['status'] == null) {
                                $('.select-client').append('<option value="'+ resp['order_id'] +'">'+ resp['client_name'] +' ('+resp['company']+')</option>');
                            } else {
                                $('.select-client').append('<option value="'+ resp['order_id'] +'">'+ resp['client_name'] +' ('+resp['company']+') - '+ resp['status'].toUpperCase() +'</option>');
                            }
                        } else {
                            $('.select-client option[value="'+ orderID +'"]').remove();
                            
                        }
                    });
                });
        });

        $(document).on("change",".tick-client-status",function() {
            const id = $(this).data('id');
            const orderID = $(this).data('order_id');
            const clientID = $(this).data('client_id');
            const status = $(this).val();                  
            const name = $(this).data('name');
            const company = $(this).data('company');

            $.post( "/save-clients-status", { id: id, order_id: orderID, client_id: clientID, status: status, name: name, company: company })
                .done(function( data ) {                          
                    $.notify("Your changes have been saved!", "success");
                    // $('.select-client').find('option').remove();
                    // $.get('/pnp/get-client-list', {id: id})
                    //     .done(function(data) {
                    //     const resp = JSON.parse(data);          
                        
                    //     $('.select-client').append('<option>...</option>');                                 
                    //     for (var i = 0; i < resp.length; i++) {
                    //         if (resp[i]['status'] == null) {
                    //             $('.select-client').append('<option value="'+ resp[i]['order_id'] +'">'+ resp[i]['client_name'] +' ('+resp[i]['company']+')</option>');
                    //         } else {
                    //             $('.select-client').append('<option value="'+ resp[i]['order_id'] +'">'+ resp[i]['client_name'] +' ('+resp[i]['company']+') - '+ resp[i]['status'].toUpperCase() +'</option>');
                    //         }
                    //     }
                    // });
                });
        });
        
        function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || ''
                s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }

    });

    let inputTimer;
    
    $(document).on("change", ".box-name", function() {
        const id = $(this).data('id');
        const boxName = $(this).val();
        const boxId =  $(this).closest('div').find('.box_id' + id).val();
        
        $.post('/update-box-name', {id: id, box: boxName, box_id: boxId})
            .done( function(data) {
                const resp = JSON.parse(data);                        
                $(this).data('box_id', resp['box_id']);                 
                $('.box_id' + id).val(resp['box_id']);
                
            })
        // clearTimeout(inputTimer);

        // // Set a new timer to execute after 500 milliseconds (adjust as needed)
        // inputTimer = setTimeout(function() {
        //     // The user has stopped inputting for 500 milliseconds
            
        // }, 200);
        

    })  
    var allocation = 0;
    $(document).on("input propertychange", ".total-allocation", function() {    
        const id = $(this).data('id');
        allocation = $(this).data('allocation');
        const qty = $(this).val();
        const boxId =  $(this).closest('div').find('.box_id' + id).val();
        const qtyAssign = $('.qty_assigned'+ id).val();                
        const getAlloc = $('.total-allocation'+id).map(function() {
            return parseInt($(this).val()) || 0; 
        }).get();


        var totalAlloc = getAlloc.reduce(function(a, b) {
            return a + b;
        }, 0);

        clearTimeout(inputTimer);

        if (boxId === undefined) {            
            if (totalAlloc > qtyAssign) {
                $(this).val(allocation);                             
                swal("Warning", "The total allocation exceeds the Quantity Assigned to this client", "warning");                
            } else {                
                inputTimer = setTimeout(function() {
                    $.post('/update-total-allocation', {id: id, total: qty, box_id: null})
                            .then(function(data) {                    
                                const resp = JSON.parse(data);                        
                                $(this).data('box_id', resp['box_id']); 
                                $(this).data('allocation', resp['allocation']);
                                $('.box_id' + id).val(resp['box_id']);
                        }.bind(this))
                            .fail(function(error) {
                                console.error("Error:", error);
                        });
                }, 500);            
            }
        } else {            
            if (totalAlloc > qtyAssign) {
                $(this).val(allocation);
                swal("Warning", "The total allocation exceeds the Quantity Assigned to this client", "warning");                
            } else {
                inputTimer = setTimeout(function() {
                    $.post('/update-total-allocation', {id: id, total: qty, box_id: boxId})
                        .then(function(data) {                    
                            const resp = JSON.parse(data);                        
                            $(this).data('box_id', resp['box_id']); 
                            $(this).data('allocation', resp['allocation']);
                            $('.box_id' + id).val(resp['box_id']);
                    }.bind(this))
                        .fail(function(error) {
                            console.error("Error:", error);
                    });
                }, 500);                  
            }
        }
    })

    $(document).on('click', '.new-box', function() {
        const id = $(this).data('id');
        const qtyAssign = $('.qty_assigned'+ id).val();        
        const getAlloc = $('.total-allocation'+id).map(function() {
            return parseInt($(this).val()) || 0; 
        }).get();

        var totalAlloc = getAlloc.reduce(function(a, b) {
            return a + b;
        }, 0);
        
        if (totalAlloc >= qtyAssign) {
            swal("Warning", "The total allocation exceeds the Quantity Assigned to this client", "warning");
            
        } else {
            $.post('/add-new-box', {id: id})
                .done( function(data) {
                    const resp = JSON.parse(data);
                    $('.box-section'+id).append('<div class="grid grid-cols-3 gap-2 box-'+ resp['box_id'] +'"><label class="block"><span>B&zwnj;ox N&zwnj;ame</span><input type="hidden" name="box_id[]" class="box_id'+id+'" value="'+ resp['box_id'] +'"> <input names="box" class="get-boxname form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent box-name box-name'+id+'" data-id="'+id+'" data-box_id="'+resp['box_id']+'" placeholder="BOX#12345..." type="text"></label><label class="block"><span>Total Allocation</span><input class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent total-allocation total-allocation'+id+'" data-id="'+id+'" data-box_id="'+resp['box_id']+'" data-qty="" placeholder="..." type="number" min="1" ></label><label for="" class="flex items-center justify-center"><button type="button" class="delete-box btn h-9 w-9 p-0 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25" data-id="'+id+'" data-box_id="'+resp['box_id']+'"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button></label></div>');
                })
        }

        
        
        
    })

    $(document).on('click', '.delete-box', function() {
        const id = $(this).data('box_id');        
        $.post('/delete-box', {id: id})
            .done( function(data) {
                $.notify("Box successfully deleted!", "error");       
                $('.box-'+ id).remove()
            })
    })
    $(document).on('focus', '.get-boxname', function() {
        $(this).autocomplete({
            source: function(request, response) {
                // Ajax request to fetch suggestions based on user input
                $.ajax({
                    url: "/get-all-box-name", // Replace with your actual server endpoint
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data); // Pass the received suggestions to the autocomplete
                    }
                });
            },
            minLength: 2, // Minimum characters before triggering autocomplete
            select: function(event, ui) {
                // This function will be triggered when an item is selected from the suggestion list
                var selectedValue = ui.item.value;
                const id = $(this).data('id');
                const boxId =  $(this).closest('div').find('.box_id' + id).val();
                $.post('/update-box-name', {id: id, box: selectedValue, box_id: boxId})
                    .done( function(data) {
                        const resp = JSON.parse(data);                                                      
                        $('.box_id' + id).val(resp['box_id']);
                        
                    })
                // You can perform additional actions here based on the selected value
                // For example, update another field or make an Ajax call
            },
        });
    });
   

</script>
<?= $this->endSection() ?>
