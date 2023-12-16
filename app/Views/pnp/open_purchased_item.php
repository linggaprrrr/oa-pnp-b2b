<?= $this->extend('pnp/layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="max-w-sm">
        <a href="/purchases-list" class="btn rounded-full bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90"><em class="fas fa-angle-left mr-2"></em> Back</a>                  
    </div>
    <div class="card px-4 pb-4 sm:px-5">        
        <div class="max-w-full">
            <div class="my-3 flex h-8 items-center justify-between">
                <?php 
                
                ?>
                <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                    Purchase List
                </h2>            
            </div>
            <table class="datatable-init table stripe" style="font-size: 11px"> 
                <thead>
                    <tr>                                                            
                        <th class="text-center">ASIN</th>
                        <th>Item Name</th>
                        <th class="text-center">Product URL</th>
                        <th class="text-center" style="width: 5%">Buy Qty</th>
                        <th class="text-center" style="width: 10%">Size</th>
                        <th class="text-center">Buy Cost</th>
                        <th class="text-center">Total Buy Cost</th>
                        <th class="text-center">Selling Price</th>
                        <th class="text-center">Total Selling</th>
                        <th class="text-center">Total Profit</th>
                        <th class="text-center">Order Staff</th>
                        <th class="text-center"><em class="icon ni ni-more-h-alt"></em></th>
                    </tr>                            
                </thead>
                <tbody>
                    <?php foreach($purchases->getResultObject() as $purch) : ?>
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="text-center align-middle"><b><?= $purch->asin ?></b></td>
                            <td class="align-middle"><?= substr($purch->title, 0, 55) ?><?= (strlen($purch->title) > 55) ? '..' : '' ?></td>
                            <td class="text-center align-middle"><a href="<?= $purch->retail_link ?>" target="_blank"><em class="fa fa-external-link-alt"></em></a></td>
                            <td>
                                <div class="form-group">                                            
                                    <?php if (session()->get('user_id') == $purch->order_staff) : ?>
                                        <div class="form-control-wrap number-spinner-wrap">                                                
                                            <input type="number" min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty-entry qty_<?= $purch->uid ?>" data-id="<?= $purch->uid ?>" data-cost="<?= $purch->buy_cost ?>"  data-price="<?= $purch->market_price ?>"  data-profit="<?= $purch->profit ?>" value="<?= ($purch->qty == 0) ? '0' : $purch->qty  ?>">                                                
                                        </div>
                                    <?php else : ?>
                                        <div class="form-control-wrap number-spinner-wrap">                                                
                                            <input type="number" disabled min="0" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center qty-entry qty_<?= $purch->uid ?>" data-id="<?= $purch->uid ?>" data-cost="<?= $purch->buy_cost ?>"  data-price="<?= $purch->market_price ?>"  data-profit="<?= $purch->profit ?>" value="<?= ($purch->qty == 0) ? '0' : $purch->qty  ?>">                                                
                                        </div>
                                    <?php endif ?>
                                </div> 
                            </td>                                    
                            <td>
                                <?php if (session()->get('user_id') == $purch->order_staff) : ?>
                                    <input type="text" name="size" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center size" value="<?= $purch->size ?>" data-id="<?= $purch->uid ?>">
                                <?php else : ?>
                                    <input type="text" name="size" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent text-center size" value="<?= $purch->size ?>" data-id="<?= $purch->uid ?>" disabled>
                                <?php endif ?>
                                
                            </td>
                            <td class="text-center align-middle">$<?= round($purch->buy_cost, 2) ?></td>                                    
                            <td class="text-center align-middle"><span class="total_buy_cost_<?= $purch->uid ?>">$<?= round($purch->qty * $purch->buy_cost, 2) ?></span></td>
                            <td class="text-center align-middle">$<?= round($purch->market_price, 2) ?></td>
                            <td class="text-center align-middle"><span class="total_selling_<?= $purch->uid ?>">$<?= round($purch->qty * $purch->market_price, 2) ?></span></td>
                            <td class="text-center align-middle"><span class="total_profit_<?= $purch->uid ?>">$<?= round($purch->qty * $purch->profit, 2) ?></span></td>
                            <td class="text-center align-middle">
                                <?php if (session()->get('user_id') == $purch->order_staff) : ?>
                                    <select name="staff" data-id="<?= $purch->uid ?>" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-1 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent staff" style="font-size: 10px" id="">                                        
                                        <option value="<?= $purch->username ?>"><?= (!is_null($purch->name)) ? $purch->name : $purch->username ?></option>
                                    </select>
                                <?php else : ?>
                                    <select disabled name="staff" data-id="<?= $purch->uid ?>" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-1 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent staff" style="font-size: 10px" id="">                                        
                                        <option value="<?= $purch->username ?>"><?= (!is_null($purch->name)) ? $purch->name : $purch->username ?></option>
                                    </select>
                                <?php endif ?>
                                
                            </td>                                
                            <td class="text-center align-middle">
                                <?php if (session()->get('user_id') == $purch->order_staff) : ?>
                                    <?php if ($purch->qty == $purch->buyer_qty) : ?>
                                        <button type="button" data-id="<?= $purch->uid ?>" class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25 buyerModal buyer-<?= $purch->uid ?>">Buyers</button>
                                    <?php elseif (is_null($purch->buyer_qty)) : ?>
                                        <button type="button" data-id="<?= $purch->uid ?>" class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 hover:shadow-lg hover:shadow-slate-200/50 focus:bg-slate-200 focus:shadow-lg focus:shadow-slate-200/50 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:hover:shadow-navy-450/50 dark:focus:bg-navy-450 dark:focus:shadow-navy-450/50 dark:active:bg-navy-450/90 buyerModal buyer-<?= $purch->uid ?>">Buyers</button>
                                    <?php else : ?>
                                        <button type="button" data-id="<?= $purch->uid ?>" class="btn border border-error/30 bg-error/10 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25 buyerModal buyer-<?= $purch->uid ?>">Buyers</button>                                                
                                    <?php endif ?>     
                                <?php else : ?>
                                    <?php if (is_null($purch->buyers_id)) : ?>
                                        <button disabled type="button" data-id="<?= $purch->uid ?>" class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 hover:shadow-lg hover:shadow-slate-200/50 focus:bg-slate-200 focus:shadow-lg focus:shadow-slate-200/50 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:hover:shadow-navy-450/50 dark:focus:bg-navy-450 dark:focus:shadow-navy-450/50 dark:active:bg-navy-450/90 buyerModal buyer-<?= $purch->uid ?>">Buyers</button>
                                    <?php else : ?>
                                        <button disabled type="button" data-id="<?= $purch->uid ?>" class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25 buyerModal buyer-<?= $purch->uid ?>">Buyers</button>
                                    <?php endif ?>     
                                <?php endif ?>                                                                      
                            </td>
                        </tr>
                    <?php endforeach ?>                                                    
                </tbody>
            </table>
        </div>
    </div>

    <div style="display: none;" x-data="{showModal:false}">
        <button
        @click="showModal = true"
        class="buyer-template btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
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
                class="relative w-full max-w-screen-lg origin-bottom rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
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
                    Buyer - <span class="font-bold asin-modal"></span> [<small class="fst-italic">Buy Qty: <em class="away"></em><em class="buy_qty"></em> </small>]
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
                <div class="">
                    <!-- Modal content -->
                    <div class="">
                        <!-- Modal body -->
                        <div class="p-2 space-y-6 font-bold">
                            <form id="buyer_form"> 
                                <input type="hidden" name="purch_id" class="purch_id"> 
                                <input type="hidden" name="price_val" class="price_val">                                                      
                                <div x-data="{activeTab:'tabBuyer1'}" class="tabs flex flex-col">
                                    <div class="is-scrollbar-hidden overflow-x-auto">
                                        <div class="border-b-2 border-slate-150 dark:border-navy-500">
                                            <div class="tabs-list -mb-0.5 flex" >
                                                <button
                                                    type="button"
                                                    @click="activeTab = 'tabBuyer1'"
                                                    :class="activeTab === 'tabBuyer1' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 rounded-none border-b-2 px-3 py-2 font-medium"
                                                    >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span>Buyer 1</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="activeTab = 'tabBuyer2'"
                                                    :class="activeTab === 'tabBuyer2' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                                                    >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span>Buyer 2</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="activeTab = 'tabBuyer3'"
                                                    :class="activeTab === 'tabBuyer3' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                                                    >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span>Buyer 3</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="activeTab = 'tabBuyer4'"
                                                    :class="activeTab === 'tabBuyer4' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                                                    >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span>Buyer 4</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="activeTab = 'tabBuyer5'"
                                                    :class="activeTab === 'tabBuyer5' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                                                    >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span>Buyer 5</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="activeTab = 'tabBuyer6'"
                                                    :class="activeTab === 'tabBuyer6' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                                                    >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span>Buyer 6</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="activeTab = 'tabBuyer7'"
                                                    :class="activeTab === 'tabBuyer7' ? 'border-primary dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium"
                                                    >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4.5 w-4.5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    >
                                                        <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span>Buyer 7</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content pt-4">
                                        <div                                    
                                            x-show="activeTab === 'tabBuyer1'"
                                            x-transition:enter="transition-all duration-500 easy-in-out"
                                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        >
                                            <div>
                                                <div class="m-2 space-y-4">
                                                    <label class="block">
                                                        <span>Name</span>
                                                        <span class="relative mt-1.5 flex">
                                                            <input type="hidden" name="buyer-id1" class="buyer-id1">
                                                            <select name="buyer1" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                <option>...</option>
                                                                <?php foreach ($buyers->getResultObject() as $buyer) : ?>
                                                                    <option value="<?= $buyer->id ?>" data-cc="<?= $buyer->cc ?>"><?= $buyer->buyer_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-user text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>CC</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="cc1" class="cc1 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your CC" type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-credit-card text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Order Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input  name="order_number1" class="order_number1 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="999-9999" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Qty</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input data-price="0" class="qty-buyer qty1 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="..." name="qty1" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-box"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            
                                                                <input class="price1 price form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Total Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input class="total_price total_price1 form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Total Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                        <span>Shipping Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="shipping1" class="shipping1 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Shipping Number.." type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-shipping-fast text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Attachment</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <div class="filepond fp-bordered">
                                                                <input type="file" class="attachment1" accept="application/pdf,image/png,image/jpeg"  name="attachment1"/>
                                                                <input type="text" id="fileValue1" name="fileValue1" style="font-size: 10px; width: 100%; display:none" readonly>
                                                                
                                                                <span class="fileTemp1" style="display: none;">
                                                                    <a id="fileShow1" style="width: 100%;" download></a>    
                                                                    <button type="button" id="fileDelete1"><i class="fas fa-trash text-error"></i></button>                                                                
                                                                </span>

                                                            </div>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div
                                            x-show="activeTab === 'tabBuyer2'"
                                            x-transition:enter="transition-all duration-500 easy-in-out"
                                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        >
                                            <div>                                    
                                                <div class="m-2 space-y-4">
                                                    <label class="block">
                                                        <span>Name</span>
                                                        <span class="relative mt-1.5 flex">
                                                            <input type="hidden" name="buyer-id2" class="buyer-id2">
                                                            <select name="buyer2" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer2">
                                                                <option>...</option>
                                                                <?php foreach ($buyers->getResultObject() as $buyer) : ?>
                                                                    <option value="<?= $buyer->id ?>" data-cc="<?= $buyer->cc ?>"><?= $buyer->buyer_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-user text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>CC</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="cc2" class="cc2 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your CC" type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-credit-card text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Order Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input  name="order_number2" class="order_number2 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="999-9999" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Qty</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input data-price="0" class="qty-buyer qty2 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="..." name="qty2" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-box"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Price</span>
                                                            <span class="relative mt-1.5 flex">                                                    
                                                                <input class="price2 price form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Total Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input class="total_price total_price2 form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Total Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                        <span>Shipping Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="shipping2" class="shipping2 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Shipping Number.." type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-shipping-fast text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Attachment</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <div class="filepond fp-bordered">
                                                                <input type="file" accept="application/pdf,image/png,image/jpeg" class="attachment2" name="attachment2"/>
                                                                <input type="text" id="fileValue2" name="fileValue2" style="font-size: 10px; width: 100%; display:none" readonly>                                                                
                                                                <span class="fileTemp2" style="display: none;">
                                                                    <a id="fileShow2" style="width: 100%;" download></a>    
                                                                    <button type="button" id="fileDelete2"><i class="fas fa-trash text-error"></i></button>                                                                
                                                                </span>
                                                            </div>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            x-show="activeTab === 'tabBuyer3'"
                                            x-transition:enter="transition-all duration-500 easy-in-out"
                                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        >
                                            <div>
                                                <div class="m-2 space-y-4">
                                                    <label class="block">
                                                        <span>Name</span>
                                                        <span class="relative mt-1.5 flex">
                                                        <input type="hidden" name="buyer-id3" class="buyer-id3">
                                                            <select name="buyer3" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer3">
                                                                <option>...</option>
                                                                <?php foreach ($buyers->getResultObject() as $buyer) : ?>
                                                                    <option value="<?= $buyer->id ?>" data-cc="<?= $buyer->cc ?>"><?= $buyer->buyer_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-user text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>CC</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="cc3" class="cc3 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your CC" type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-credit-card text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Order Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input  name="order_number3" class="order_number3 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="999-9999" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Qty</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input data-price="0" class="qty-buyer qty3 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="..." name="qty3" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-box"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            
                                                                <input class="price3 price form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Total Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input class="total_price total_price3 form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Total Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                        <span>Shipping Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="shipping3" class="shipping3 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Shipping Number.." type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-shipping-fast text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Attachment</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <div class="filepond fp-bordered">
                                                                <input type="file" accept="application/pdf,image/png,image/jpeg" class="attachment2" name="attachment3"/>
                                                                <input type="text" id="fileValue3" name="fileValue3" style="font-size: 10px; width: 100%; display:none" readonly>
                                                                
                                                                <span class="fileTemp3" style="display: none;">
                                                                    <a id="fileShow3" style="width: 100%;" download></a>    
                                                                    <button type="button" id="fileDelete3"><i class="fas fa-trash text-error"></i></button>                                                                
                                                                </span>
                                                            </div>
                                                            </span>
                                                        </label>
                                                    </div>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            x-show="activeTab === 'tabBuyer4'"
                                            x-transition:enter="transition-all duration-500 easy-in-out"
                                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        >
                                            <div>
                                                <div class="m-2 space-y-4">
                                                    <label class="block">
                                                        <span>Name</span>
                                                        <span class="relative mt-1.5 flex">
                                                            <input type="hidden" name="buyer-id4" class="buyer-id4">
                                                            <select name="buyer4" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer4">
                                                                <option>...</option>
                                                                <?php foreach ($buyers->getResultObject() as $buyer) : ?>
                                                                    <option value="<?= $buyer->id ?>" data-cc="<?= $buyer->cc ?>"><?= $buyer->buyer_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-user text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>CC</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="cc4" class="cc4 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your CC" type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-credit-card text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Order Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input  name="order_number4" class="order_number4 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="999-9999" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Qty</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input data-price="0" class="qty-buyer qty4 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="..." name="qty4" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-box"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            
                                                                <input class="price4 price form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Total Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input class="total_price total_price4 form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" placeholder="Total Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                        <span>Shipping Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="shipping4" class="shipping4 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Shipping Number.." type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-shipping-fast text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Attachment</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <div class="filepond fp-bordered">
                                                                <input type="file" accept="application/pdf,image/png,image/jpeg" class="attachment4" name="attachment4"/>
                                                                <input type="text" id="fileValue4" name="fileValue4" style="font-size: 10px; width: 100%; display:none" readonly>
                                                                
                                                                <span class="fileTemp4" style="display: none;">
                                                                    <a id="fileShow4" style="width: 100%;" download></a>    
                                                                    <button type="button" id="fileDelete4"><i class="fas fa-trash text-error"></i></button>                                                                
                                                                </span>
                                                            </div>
                                                            </span>
                                                        </label>
                                                    </div>
                                                                                        
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div
                                            x-show="activeTab === 'tabBuyer5'"
                                            x-transition:enter="transition-all duration-500 easy-in-out"
                                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        >
                                            <div>
                                                <div class="m-2 space-y-4">
                                                    <label class="block">
                                                        <span>Name</span>
                                                        <span class="relative mt-1.5 flex">
                                                            <input type="hidden" name="buyer-id5" class="buyer-id5">
                                                            <select name="buyer5" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer5">
                                                                <option>...</option>
                                                                <?php foreach ($buyers->getResultObject() as $buyer) : ?>
                                                                    <option value="<?= $buyer->id ?>" data-cc="<?= $buyer->cc ?>"><?= $buyer->buyer_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-user text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>CC</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="cc5" class="cc5 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your CC" type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-credit-card text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Order Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input  name="order_number5" class="order_number5 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="999-9999" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Qty</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input data-price="0" class="qty-buyer qty5 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="..." name="qty5" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-box"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            
                                                                <input class="price5 price form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" name="price5" placeholder="Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Total Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input class="total_price total_price5 form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" name="total_price5" placeholder="Total Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                        <span>Shipping Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="shipping5" class="shipping5 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Shipping Number.." type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-shipping-fast text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Attachment</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <div class="filepond fp-bordered">
                                                                <input type="file" accept="application/pdf,image/png,image/jpeg" class="attachment5" name="attachment5"/>
                                                                <input type="text" id="fileValue5" name="fileValue5" style="font-size: 10px; width: 100%; display:none" readonly>
                                                                
                                                                <span class="fileTemp5" style="display: none;">
                                                                    <a id="fileShow5" style="width: 100%;" download></a>    
                                                                    <button type="button" id="fileDelete5"><i class="fas fa-trash text-error"></i></button>                                                                
                                                                </span>
                                                            </div>
                                                            </span>
                                                        </label>
                                                    </div>                                      
                                                </div>                                    
                                            </div>
                                        </div>
                                        <div
                                            x-show="activeTab === 'tabBuyer6'"
                                            x-transition:enter="transition-all duration-500 easy-in-out"
                                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        >
                                            <div>
                                                <div class="m-2 space-y-4">
                                                    <label class="block">
                                                        <span>Name</span>
                                                        <span class="relative mt-1.5 flex">
                                                        <input type="hidden" name="buyer-id6" class="buyer-id6">
                                                            <select name="buyer6" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer6">
                                                                <option>...</option>
                                                                <?php foreach ($buyers->getResultObject() as $buyer) : ?>
                                                                    <option value="<?= $buyer->id ?>" data-cc="<?= $buyer->cc ?>"><?= $buyer->buyer_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-user text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>CC</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="cc6" class="cc6 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your CC" type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-credit-card text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Order Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input  name="order_number6" class="order_number6 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="999-9999" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Qty</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input data-price="0" class="qty-buyer qty6 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="..." name="qty6" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-box"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Price</span>
                                                            <span class="relative mt-1.5 flex">                                                    
                                                                <input class="price6 price form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" name="price6" placeholder="Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Total Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input class="total_price total_price6 form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" name="total_price6" placeholder="Total Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                        <span>Shipping Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="shipping6" class="shipping6 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Shipping Number.." type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-shipping-fast text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Attachment</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <div class="filepond fp-bordered">
                                                                <input type="file" accept="application/pdf,image/png,image/jpeg" class="attachment6" name="attachment6"/>
                                                                <input type="text" id="fileValue6" name="fileValue6" style="font-size: 10px; width: 100%; display:none" readonly>
                                                                
                                                                <span class="fileTemp6" style="display: none;">
                                                                    <a id="fileShow6" style="width: 100%;" download></a>    
                                                                    <button type="button" id="fileDelete6"><i class="fas fa-trash text-error"></i></button>                                                                
                                                                </span>
                                                            </div>
                                                            </span>
                                                        </label>
                                                    </div>                                        
                                                </div>                                         
                                            </div>
                                        </div>
                                        <div
                                            x-show="activeTab === 'tabBuyer7'"
                                            x-transition:enter="transition-all duration-500 easy-in-out"
                                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        >
                                            <div>
                                                <div class="m-2 space-y-4">
                                                    <label class="block">
                                                        <span>Name</span>
                                                        <span class="relative mt-1.5 flex">
                                                            <input type="hidden" name="buyer-id7" class="buyer-id7">
                                                            <select name="buyer7" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer7">
                                                                <option>...</option>
                                                                <?php foreach ($buyers->getResultObject() as $buyer) : ?>
                                                                    <option value="<?= $buyer->id ?>" data-cc="<?= $buyer->cc ?>"><?= $buyer->buyer_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-user text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>CC</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input name="cc7" class="cc7 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your CC" type="text" >
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="far fa-credit-card text-base"></i>
                                                            </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Order Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input  name="order_number7" class="order_number7 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="999-9999" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Qty</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input data-price="0" class="qty-buyer qty7 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="..." name="qty7" type="text" x-input-mask="{numericOnly: true}">
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-box"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Price</span>
                                                            <span class="relative mt-1.5 flex">                                                    
                                                                <input class="price7 price form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" name="price7" placeholder="Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Total Price</span>
                                                            <span class="relative mt-1.5 flex">
                                                            <input class="total_price total_price7 form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900" name="total_price7" placeholder="Total Price" type="text" readonly>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                        <span>Shipping Number</span>
                                                            <span class="relative mt-1.5 flex">
                                                                <input name="shipping7" class="shipping7 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Shipping Number.." type="text" >
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-shipping-fast text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Attachment</span>
                                                            <span class="relative mt-1.5 flex">
                                                                <div class="filepond fp-bordered">
                                                                    <input type="file" accept="application/pdf,image/png,image/jpeg" class="attachment7" name="attachment7"/>
                                                                    <input type="text" id="fileValue7" name="fileValue7" style="font-size: 10px; width: 100%; display:none" readonly>
                                                                
                                                                    <span class="fileTemp7" style="display: none;">
                                                                        <a id="fileShow7" style="width: 100%;" download></a>    
                                                                        <button type="button" id="fileDelete7"><i class="fas fa-trash text-error"></i></button>                                                                
                                                                    </span>
                                                                </div>
                                                            </span>
                                                        </label>
                                                    </div>                                       
                                                </div>   
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex justify-end items-center p-2 mx-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">                                                                           
                            <button type="button" class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 save-buyers">Save</button>
                        </div>
                    </div>
                </div>                 
            </div>                
        </template>
    </div>                       
</div>

<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script>
    $(document).on("change",".tick",function() {
            const id = $(this).data('id');
            // $.post( "/tick-item", { id: id })
            //     .done(function( data ) {                          
                   
            //     });
        });
        
        $(document).on("input propertychange",".notes",function() {
            const id = $(this).data('id');
            const notes = $(this).val();
            $.post( "/save-notes", {id: id, notes: notes})
                .done(function( data ) {
                    const resp = JSON.parse(data);                                                            
                    if (resp['notes'] != "") {                        
                        $( "." + resp['id'] ).removeClass("text-secondary");
                        $( "." + resp['id'] ).addClass("text-info");
                    }                                        
                });
        });

        $(".save-note").click(function() {
            $.post( "/save-notes", $( "#note-form" ).serialize())
                .done(function( data ) {
                    const resp = JSON.parse(data);                                        
                    
                    if (resp['notes'] != "") {                        
                        $( "." + resp['id'] ).removeClass("text-secondary");
                        $( "." + resp['id'] ).addClass("text-info");
                    }
                    $( "#modalDefault" ).modal('hide');
                });
        });

        $(document).on("click", ".qty", function() {
            const id = $(this).data('id');
            const qty = parseInt($(".qty_" + id).val());
            const cost = parseFloat($(this).data('cost'));
            const price = parseFloat($(this).data('price'));
            const profit = parseFloat($(this).data('profit'));
            $.post("/save-qty", {id: id, qty: qty})
                .done(function( data ) {
                    $('.total_buy_cost_' + id).html("$" + (qty * cost).toFixed(2));
                    $('.total_selling_' + id).html("$" + (qty * price).toFixed(2));
                    $('.total_profit_' + id).html("$" + (qty * profit).toFixed(2));
                });
                
        });

        $(document).on("input propertychange", ".qty-entry", function() {
            const id = $(this).data('id');
            const qty = parseInt($(".qty_" + id).val());
            const cost = parseFloat($(this).data('cost'));
            const price = parseFloat($(this).data('price'));
            const profit = parseFloat($(this).data('profit'));
            $.post("/save-qty", {id: id, qty: qty})
                .done(function( data ) {
                    $('.total_buy_cost_' + id).html("$" + (qty * cost).toFixed(2));
                    $('.total_selling_' + id).html("$" + (qty * price).toFixed(2));
                    $('.total_profit_' + id).html("$" + (qty * profit).toFixed(2));
                });
                
        });

        $(document).on("input propertychange", ".size", function() {
            const id = $(this).data('id');
            const size = $(this).val();
            $.post("/save-size", {id: id, size: size})
                .done(function( data ) {
                    
                });
        });

        $(document).on("change", ".staff", function() {
            const id = $(this).data('id');
            const staff = $(this).val();
            $.post("/save-staff", {id: id, staff: staff})
                .done(function( data ) {
                    $.notify("Your changes have been saved!", "success");
                });
        })

        $(document).on("click", "#fileDelete1", function() {
            $(".attachment1").show();
            $("#fileShow1").html("");
            $("#fileDelete1").hide();
            $("#fileValue1").val("");
        });

        $(document).on("click", "#fileDelete2", function() {
            $(".attachment2").show();
            $("#fileShow2").html("");
            $("#fileDelete2").hide();
            $("#fileValue2").val("");
        });

        $(document).on("click", "#fileDelete3", function() {
            $(".attachment3").show();
            $("#fileShow3").html("");
            $("#fileDelete3").hide();
            $("#fileValue3").val("");
        });

        $(document).on("click", "#fileDelete4", function() {
            $(".attachment4").show();
            $("#fileShow4").html("");
            $("#fileDelete4").hide();
            $("#fileValue4").val("");
        });

        $(document).on("click", "#fileDelete5", function() {
            $(".attachment5").show();
            $("#fileShow5").html("");
            $("#fileDelete5").hide();
            $("#fileValue5").val("");
        });

        $(document).on("click", "#fileDelete6", function() {
            $(".attachment6").show();
            $("#fileShow6").html("");
            $("#fileDelete6").hide();
            $("#fileValue6").val("");
        });

        $(document).on("click", "#fileDelete7", function() {
            $(".attachment7").show();
            $("#fileShow7").html("");
            $("#fileDelete7").hide();
            $("#fileValue7").val("");
        });

        $(document).on("click", ".buyerModal", function() {
            const id = $(this).data('id');
            $(".save-buyers").removeData('id');    
            $("#buyer_form")[0].reset();
            $("textarea").val('');
            $(".total_price").html("$0.00");
            $(".qty-buyer").attr('data-id', id); //setter
            $(".save-buyers").attr('data-id', id);
            $.get("/get-purchase-item", {id : id})
                .done(function( data ) {
                    const resp = JSON.parse(data);                                
                    var j = 1;
                    var totalQty = 0;
                    $(".asin-modal").html(resp[0]['asin']);
                    $(".buy_qty").html(resp[0]['qty']);
                    $(".price").val(parseFloat(resp[0]['market_price']).toFixed(2));                                               
                    $(".price_val").val(parseFloat(resp[0]['market_price']).toFixed(2));                           
                    $(".qty-buyer").attr('data-price', parseFloat(resp[0]['market_price']).toFixed(2)); //setter
                    if (resp.length >= 5) {                        
                        for (var i = 0; i < resp.length; i++) {
                            
                            totalQty = totalQty + parseInt(resp[i]['buyer_qty']);
                            $(".buyer-id" + j).val(resp[i]['id']);
                            $(".buyer" + j).val(resp[i]['buyer']);
                            $(".cc" + j).val(resp[i]['cc']);
                            
                            if (resp[i]['buyer_notes'] !== null) {                                   
                                if (resp[i]['buyer_notes'].length > 0) {
                                    $('.fileTemp' + j).show();                         
                                    $("#fileValue" + j).val(resp[i]['buyer_notes']);                                
                                    $('#fileShow' + j).attr('href', '/cc_receipts/'+ resp[i]['buyer_notes']);
                                    $('#fileShow' + j).html(resp[i]['buyer_notes']);                                
                                    $(".attachment" + j).hide();
                                }
                            }
                            
                            $(".qty" + j).val(resp[i]['buyer_qty']);
                            if (resp[i]['buyer_qty'] == null) {
                                $(".total_price" + j).val('$' + (parseFloat(resp[i]['market_price']) * parseFloat(0)).toFixed(2));
                            } else {
                                $(".total_price" + j).val('$' + (parseFloat(resp[i]['market_price']) * parseFloat(resp[i]['buyer_qty'])).toFixed(2));
                            }
                            $(".order_number" + j).val(resp[i]['order_number']);
                            $(".shipping" + j).val(resp[i]['tracking_number']);
                            j++;
                        }
                    }
                    $(".away").html(totalQty + ' / ');
                    $(".purch_id").val(id);
                    
                });
            $('.buyer-template').click();
        });

        // buyer 1
        $(document).on("input propertychange", ".qty1", function() {
            const id = $(this).data('id');
            const buyQty = parseInt($('.buy_qty').text());
            const qty = parseInt($(this).val());            
            
            const price = parseFloat($(this).data('price'));
            var qty2 = parseInt($('.qty2').val());            
            var qty3 = parseInt($('.qty3').val());
            var qty4 = parseInt($('.qty4').val());
            var qty5 = parseInt($('.qty5').val());
            var qty6 = parseInt($('.qty6').val());
            var qty7 = parseInt($('.qty7').val());
            
            if (isNaN(qty2)) {
                qty2 = 0;
            }
            if (isNaN(qty3)) {
                qty3 = 0;
            }
            if (isNaN(qty4)) {
                qty4 = 0;
            }
            if (isNaN(qty5)) {
                qty5 = 0;
            }
            if (isNaN(qty6)) {
                qty6 = 0;
            }
            if (isNaN(qty7)) {
                qty7 = 0;
            }
            console.log(qty);
            if (isNaN(qty)) {                
                $(".total_price1").val('0.00');
                $('.away').html(0 +" / ");
            } else {
                $(".total_price1").val((qty * price).toFixed(2)); 
                $('.away').html((qty + qty2 + qty3 + qty4 + qty5 + qty6 + qty7) +" / ");                
                if (buyQty - (qty + qty2 + qty3 + qty4 + qty5) < 0) {
                    alert("Out of total qty");
                    $('.qty1').val(0);
                    $('.away').html((0 + qty2 + qty3 + qty4 + qty5 + qty6 + qty7) +" / ");    
                    $(".total_price1").val((0 * price).toFixed(2)); 
                }
            }
        });

        $(document).on("change", ".buyer1", function() {
            const cc = $(this).find(':selected').attr('data-cc')            
            $(".cc1").val(cc);

            $('.cc1').attr("readonly", false); ;
            $('.qty1').attr("readonly", false); ;
            $('.order_number1').attr("readonly", false); ;
            $('.order_number1').attr("readonly", false); ;
            $('.notes1').attr("readonly", false); ;
        
        });

        // buyer 2
        $(document).on("input propertychange", ".qty2", function() {
            const id = $(this).data('id');
            const qty = parseInt($(this).val());
            const buyQty = parseInt($('.buy_qty').text());
            const price = parseFloat($(this).data('price'));
            
            var qty1 = parseInt($('.qty1').val());            
            var qty3 = parseInt($('.qty3').val());
            var qty4 = parseInt($('.qty4').val());
            var qty5 = parseInt($('.qty5').val());
            var qty6 = parseInt($('.qty6').val());
            var qty7 = parseInt($('.qty7').val());
            
            if (isNaN(qty1)) {
                qty1 = 0;
            }
            if (isNaN(qty3)) {
                qty3 = 0;
            }
            if (isNaN(qty4)) {
                qty4 = 0;
            }
            if (isNaN(qty5)) {
                qty5 = 0;
            }
            if (isNaN(qty6)) {
                qty6 = 0;
            }
            if (isNaN(qty7)) {
                qty7 = 0;
            }
            
            if (isNaN(qty)) {                
                $(".total_price2").val('0.00');
                $('.away').html(0 +" / ");                
            } else {
                $(".total_price2").val((qty * price).toFixed(2)); 
                $('.away').html((qty + qty1 + qty3 + qty4 + qty5 + qty6 + qty7) +" / ");                
                if (buyQty - (qty + qty1 + qty3 + qty4 + qty5 + qty6 + qty7) < 0) {
                    alert("Out of total qty");
                    $('.qty2').val(0);
                    $('.away').html((0 + qty1 + qty3 + qty4 + qty5 + qty6 + qty7) +" / ");    
                    $(".total_price2").val((0 * price).toFixed(2)); 
                }
            }
        });

        $(document).on("change", ".buyer2", function() {
            const cc = $(this).find(':selected').attr('data-cc')            
            $(".cc2").val(cc);

            $('.cc2').attr("readonly", false); ;
            $('.qty2').attr("readonly", false); ;
            $('.order_number2').attr("readonly", false); ;
            $('.notes2').attr("readonly", false); ;
        });
        
        // buyer 3
        $(document).on("input propertychange", ".qty3", function() {
            const id = $(this).data('id');
            const qty = parseInt($(this).val());
            const buyQty = parseInt($('.buy_qty').text());
            const price = parseFloat($(this).data('price'));
            var qty1 = parseInt($('.qty1').val());            
            var qty2 = parseInt($('.qty2').val());
            var qty4 = parseInt($('.qty4').val());
            var qty5 = parseInt($('.qty5').val());
            var qty6 = parseInt($('.qty6').val());
            var qty7 = parseInt($('.qty7').val());
            
            if (isNaN(qty1)) {
                qty1 = 0;
            }
            if (isNaN(qty2)) {
                qty2 = 0;
            }
            if (isNaN(qty4)) {
                qty4 = 0;
            }
            if (isNaN(qty5)) {
                qty5 = 0;
            }
            if (isNaN(qty6)) {
                qty6 = 0;
            }
            if (isNaN(qty7)) {
                qty7 = 0;
            }
            
            if (isNaN(qty)) {                
                $(".total_price3").val('0.00');
                $('.away').html(0 +" / ");
            } else {
                $(".total_price3").val((qty * price).toFixed(2)); 
                $('.away').html((qty + qty2 + qty1 + qty4 + qty5 + qty6 + qty7) +" / ");                
                if (buyQty - (qty + qty2 + qty1 + qty4 + qty5 + qty6 + qty7) < 0) {
                    alert("Out of total qty");
                    $('.qty3').val(0);
                    $('.away').html((0 + qty2 + qty1 + qty4 + qty5 + qty6 + qty7) +" / ");    
                    $(".total_price3").val((0 * price).toFixed(2)); 
                }
            }
        });

        $(document).on("change", ".buyer3", function() {
            const cc = $(this).find(':selected').attr('data-cc')            
            $(".cc3").val(cc);
            
            $('.cc3').attr("readonly", false); ;
            $('.qty3').attr("readonly", false); ;
            $('.order_number3').attr("readonly", false); ;            
            $('.notes3').attr("readonly", false); ;
        
        });

        // buyer 4
        $(document).on("input propertychange", ".qty4", function() {
            const id = $(this).data('id');
            const qty = parseInt($(this).val());
            const buyQty = parseInt($('.buy_qty').text());
            const price = parseFloat($(this).data('price'));
            var qty2 = parseInt($('.qty2').val());            
            var qty3 = parseInt($('.qty3').val());
            var qty1 = parseInt($('.qty1').val());
            var qty5 = parseInt($('.qty5').val());
            var qty6 = parseInt($('.qty6').val());
            var qty7 = parseInt($('.qty7').val());
            
            if (isNaN(qty2)) {
                qty2 = 0;
            }
            if (isNaN(qty3)) {
                qty3 = 0;
            }
            if (isNaN(qty1)) {
                qty1 = 0;
            }
            if (isNaN(qty5)) {
                qty5 = 0;
            }
            if (isNaN(qty6)) {
                qty6 = 0;
            }
            if (isNaN(qty7)) {
                qty7 = 0;
            }
            
            if (isNaN(qty)) {                
                $(".total_price4").val('0.00');
                $('.away').html(0 +" / ");
            } else {
                $(".total_price4").val((qty * price).toFixed(2)); 
                $('.away').html((qty + qty2 + qty3 + qty1 + qty5 + qty6 + qty7) +" / ");                
                if (buyQty - (qty + qty2 + qty3 + qty1 + qty5 + qty6 + qty7) < 0) {
                    alert("Out of total qty");
                    $('.qty4').val(0);
                    $('.away').html((0 + qty2 + qty3 + qty1 + qty5 + qty6 + qty7) +" / ");    
                    $(".total_price4").val((0 * price).toFixed(2)); 
                }
            }
            
        });

        $(document).on("change", ".buyer4", function() {
            const cc = $(this).find(':selected').attr('data-cc')            
            $(".cc4").val(cc);

            $('.cc4').attr("readonly", false); ;
            $('.qty4').attr("readonly", false); ;
            $('.order_number4').attr("readonly", false); ;
            $('.notes4').attr("readonly", false); ;
        
        });

        // buyer 5
        $(document).on("input propertychange", ".qty5", function() {
            const id = $(this).data('id');
            const qty = parseInt($(this).val());
            const buyQty = parseInt($('.buy_qty').text());
            const price = parseFloat($(this).data('price'));

            var qty1 = parseInt($('.qty1').val());
            var qty2 = parseInt($('.qty2').val());            
            var qty3 = parseInt($('.qty3').val());
            var qty4 = parseInt($('.qty4').val());
            var qty6 = parseInt($('.qty6').val());
            var qty7 = parseInt($('.qty7').val());
            
            if (isNaN(qty2)) {
                qty2 = 0;
            }
            if (isNaN(qty3)) {
                qty3 = 0;
            }
            if (isNaN(qty4)) {
                qty4 = 0;
            }
            if (isNaN(qty1)) {
                qty1 = 0;
            }
            if (isNaN(qty6)) {
                qty6 = 0;
            }
            if (isNaN(qty7)) {
                qty7 = 0;
            }
            
            if (isNaN(qty)) {                
                $(".total_price5").html('0.00');
                $('.away').html(0 +" / ");
            } else {
                $(".total_price5").val((qty * price).toFixed(2)); 
                $('.away').html((qty + qty2 + qty3 + qty4 + qty1 + qty6 + qty7) +" / ");                
                if (buyQty - (qty + qty2 + qty3 + qty4 + qty1 + qty6 + qty7) < 0) {
                    alert("Out of total qty");
                    $('.qty5').val(0);
                    $('.away').html((0 + qty2 + qty3 + qty4 + qty1 + qty6 + qty7) +" / ");    
                    $(".total_price5").val((0 * price).toFixed(2)); 
                }
            }
        });

        $(document).on("change", ".buyer5", function() {
            const cc = $(this).find(':selected').attr('data-cc')            
            $(".cc5").val(cc);

            $('.cc5').attr("readonly", false); ;
            $('.qty5').attr("readonly", false); ;
            $('.order_number5').attr("readonly", false); ;
            $('.notes5').attr("readonly", false); ;
        
        });

        // buyer 6
        $(document).on("input propertychange", ".qty6", function() {
            const id = $(this).data('id');
            const qty = parseInt($(this).val());
            const buyQty = parseInt($('.buy_qty').text());
            const price = parseFloat($(this).data('price'));

            var qty1 = parseInt($('.qty1').val());
            var qty2 = parseInt($('.qty2').val());            
            var qty3 = parseInt($('.qty3').val());
            var qty4 = parseInt($('.qty4').val());
            var qty5 = parseInt($('.qty5').val());
            var qty7 = parseInt($('.qty7').val());
            
            if (isNaN(qty1)) {
                qty1 = 0;
            }
            
            if (isNaN(qty2)) {
                qty2 = 0;
            }
            if (isNaN(qty3)) {
                qty3 = 0;
            }
            if (isNaN(qty4)) {
                qty4 = 0;
            }            
            if (isNaN(qty5)) {
                qty5 = 0;
            }
            if (isNaN(qty7)) {
                qty7 = 0;
            }
            
            if (isNaN(qty)) {                
                $(".total_price6").html('0.00');
                $('.away').html(0 +" / ");
            } else {
                $(".total_price6").val((qty * price).toFixed(2)); 
                $('.away').html((qty + qty2 + qty3 + qty4 + qty1 + qty5 + qty7) +" / ");                
                if (buyQty - (qty + qty2 + qty3 + qty4 + qty1 + qty5 + qty7) < 0) {
                    alert("Out of total qty");
                    $('.qty6').val(0);
                    $('.away').html((0 + qty2 + qty3 + qty4 + qty1 + qty5 + qty7) +" / ");    
                    $(".total_price6").val((0 * price).toFixed(2)); 
                }
            }
        });

        $(document).on("change", ".buyer6", function() {
            const cc = $(this).find(':selected').attr('data-cc')            
            $(".cc6").val(cc);

            $('.cc6').attr("readonly", false); ;
            $('.qty6').attr("readonly", false); ;
            $('.order_number6').attr("readonly", false); ;
            $('.notes6').attr("readonly", false); ;
        
        });

        // buyer 7
        $(document).on("input propertychange", ".qty7", function() {
            const id = $(this).data('id');
            const qty = parseInt($(this).val());
            const buyQty = parseInt($('.buy_qty').text());
            const price = parseFloat($(this).data('price'));

            var qty1 = parseInt($('.qty1').val());
            var qty2 = parseInt($('.qty2').val());            
            var qty3 = parseInt($('.qty3').val());
            var qty4 = parseInt($('.qty4').val());
            var qty5 = parseInt($('.qty5').val());
            var qty6 = parseInt($('.qty6').val());
            
            if (isNaN(qty1)) {
                qty1 = 0;
            }
            
            if (isNaN(qty2)) {
                qty2 = 0;
            }
            if (isNaN(qty3)) {
                qty3 = 0;
            }
            if (isNaN(qty4)) {
                qty4 = 0;
            }            
            if (isNaN(qty5)) {
                qty5 = 0;
            }
            if (isNaN(qty6)) {
                qty6 = 0;
            }
            
            if (isNaN(qty)) {                
                $(".total_price7").html('0.00');
                $('.away').html(0 +" / ");
            } else {
                $(".total_price7").val((qty * price).toFixed(2)); 
                $('.away').html((qty + qty2 + qty3 + qty4 + qty1 + qty5 + qty6) +" / ");                
                if (buyQty - (qty + qty2 + qty3 + qty4 + qty1 + qty5 + qty6) < 0) {
                    alert("Out of total qty");
                    $('.qty7').val(0);
                    $('.away').html((0 + qty2 + qty3 + qty4 + qty1 + qty5 + qty6) +" / ");    
                    $(".total_price7").val((0 * price).toFixed(2)); 
                }
            }
        });

        $(document).on("change", ".buyer7", function() {
            const cc = $(this).find(':selected').attr('data-cc')            
            $(".cc7").val(cc);

            $('.cc7').attr("readonly", false); ;
            $('.qty7').attr("readonly", false); ;
            $('.order_number7').attr("readonly", false); ;
            $('.notes7').attr("readonly", false); ;
        
        });

        $(document).on("click", ".save-buyers", function() {    
            const id = $(this).data('id');        
            var formData = new FormData($("#buyer_form")[0]);
            $.ajax({
                type: "POST",
                url: "/save-buyers",
                data: formData,
                processData: false,  // Important! Don't process the data
                contentType: false,  // Important! Set contentType to false
                success: function(data) {
                    // Handle the success response                    
                    const resp = JSON.parse(data);
                    if (parseInt(resp['rest_qty']['qty']) === parseInt(resp['rest_qty']['buyer_qty'])) {
                        $('.buyer-' + id).removeClass('bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 hover:shadow-lg hover:shadow-slate-200/50 focus:bg-slate-200 focus:shadow-lg focus:shadow-slate-200/50 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:hover:shadow-navy-450/50 dark:focus:bg-navy-450 dark:focus:shadow-navy-450/50 dark:active:bg-navy-450/90').addClass('border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25');                                        
                    } else if (parseInt(resp['rest_qty']['qty']) > parseInt(resp['rest_qty']['buyer_qty'])) {
                        $('.buyer-' + id).removeClass('bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 hover:shadow-lg hover:shadow-slate-200/50 focus:bg-slate-200 focus:shadow-lg focus:shadow-slate-200/50 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:hover:shadow-navy-450/50 dark:focus:bg-navy-450 dark:focus:shadow-navy-450/50 dark:active:bg-navy-450/90')
                        .removeClass('border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25')
                            .addClass('border border-error/30 bg-error/10 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25');                                        
                    }
                    $.notify("Your changes have been saved!", "success");
                },
                error: function(error) {
                    // Handle the error response
                    console.error(error);
                }
            });
            
        });
</script>
<?= $this->endSection() ?>