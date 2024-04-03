<?= $this->extend('admin/layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    
   
    <div class="card px-4 pb-2 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                History Invoices
            </h2>      
            <div>
                <div x-data="{showModal:false}">
                    <button
                        @click="showModal = true"
                        class="btn invoice-modal space-x-2 bg-warning font-medium text-white shadow-lg shadow-warning/50 hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90"
                    >
                    <em class="fas fa-file-invoice-dollar mr-2"></em>
                    Create Invoice                    
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
                            class="relative w-full max-w-full origin-top rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
                            x-show="showModal"
                            x-transition:enter="easy-out"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="easy-in"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            >
                                <div
                                    class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-1 dark:bg-navy-800 sm:px-5"
                                >
                                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                        New Invoice
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
                                <div class="px-4 py-4 sm:px-5">  
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">                                                                       
                                        <div style="overflow: auto; max-height: 640px">                                                                 
                                            <h1 class="text-3xl text-success font-bold">PREP PRICING</h1>
                                            <h3 class="text-xl font-bold">Standard Unit Processing Charges:</h3>
                                            <p class="text-error italic">Includes FNSKU labeling. No price reduction for pre-labeled or no label items. Based on monthly volume.</p>
                                            <p>Standard units = $1.65/unit up to 200 units</p>
                                            <p class="text-error italic font-bold">(Clients with less than 200 units/month will incur a $25/month fee)</p>
                                            <p>Standard units = $1.35/unit over 200 units</p>
                                            <p>1,000+ units/month = $1.20/unit</p>
                                            <p>2,000+ units/month = $1.00/unit</p>
                                            <p>3,000+ units/month = Contact us for pricing</p>
                                            <p>Large units (shoes excluded) = Add $0.60/unit</p>
                                            <p class="text-error italic">(Large units are any unit over 11″ on longest side, 8″ on median side, or 5″ on shortest side)</p>
                                            Oversize units = Add $2.05/unit
                                            <p class="text-error italic">(Oversize units are any unit over 18″ on longest side, 15″ on median side, or 12″ on shortest side)</p>                                            
                                            <p class="font-bold">We do not accept units over 24″ on their longest side without written pre-authorization.</p>
                                            <h1 class="text-3xl text-success font-bold">Bundling/Multipacks/Kitting:</h1>                                            
                                            <p>Bundles up to 6 items = Add $0.60/bundle</p>
                                            <p>Bundles up to 12 items = Add $1.55/bundle</p>
                                            <p>Bundles 13-20 items = Add $2.50/bundle</p>
                                            <h3 class="text-xl font-bold">New Boxes and Materials:</h3>
                                            <p>Product boxes = Prices vary, please inquire</p>
                                            <p>Small outbound boxes = $3/box</p>
                                            <p>Medium outbound boxes = $4/box</p>
                                            <p>Large outbound boxes = $5/box</p>
                                            <p>Extra large boxes = $6/box</p>
                                            <p>Bubble wrap = $0.25 per cubic foot</p>
                                            <p>Extra large poly bag = $0.80 each</p>
                                            <p>Palletizing fee = $35/pallet</p>
                                            <p>New Pallet = $12/pallet</p>
                                            <h1 class="text-3xl text-success font-bold">STORAGE</h1>
                                            <p>First seven (7) days = FREE!</p>
                                            <p>8-180 days = $26.48/cubic meter/month</p>
                                            <p>181+ days = $36.48/cubic meter/month</p>
                                            <h1 class="text-3xl text-success font-bold">WHOLESALE</h1>
                                            <h3 class="text-xl font-bold">Receiving:</h3>
                                            <p>Pallet receiving charge = $10/pallet</p>
                                            <h3>Unloading:</h3>
                                            <p>20ft container unload = $325/container</p>
                                            <p>40ft container unload = $650/container</p>
                                            <h3 class="text-xl font-bold">Pallets:</h3>
                                            <p>Palletizing fee = $35/pallet</p>
                                            <p>New Pallet = $12/pallet</p>
                                            <h1 class="text-3xl text-success font-bold">RETURNS</h1>
                                            <p>Charged same as prep</p>
                                        </div>
                                        <div>
                                            <div>
                                                <label class="inline-flex items-center space-x-2">
                                                    <input
                                                    class="form-radio sw-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:!border-error checked:bg-error hover:!border-error focus:!border-error dark:border-navy-400"
                                                    name="basic"
                                                    type="radio"
                                                    checked
                                                    />
                                                    <p class="font-bold">SW</p>
                                                </label>
                                                <label class="inline-flex items-center space-x-2">
                                                    <input
                                                    class="form-radio lg-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:!border-error checked:bg-error hover:!border-error focus:!border-error dark:border-navy-400"
                                                    name="basic"
                                                    type="radio"
                                                    />
                                                    <p class="font-bold">SPC</p>
                                                </label>
                                             
                                            </div>
                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">                                                                                                                
                                            <label class="block">                                                                                            
                                                <span>Client Name </span>
                                                <span class="relative mt-2 flex">                                                
                                                    <select name="client" class="client form-input peer w-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">...</option>
                                                        <?php foreach ($clients->getResultObject() as $client) : ?>
                                                            <option value="<?= $client->id ?>"><?= $client->name ?> (<?= $client->email ?>)</option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                        <i class="fa-regular fa-user text-base"></i>
                                                    </span>
                                                </span>
                                            </label>
                                            <label class="block">
                                                <?php $now = date('m-d-Y') ?>            
                                                <span>Date </span>
                                                <span class="relative mt-1.5 flex">
                                                <input
                                                    x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $now ?>', '<?= $now ?>'] })"                                            
                                                    class="text-center date-range form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Choose date..."
                                                    type="text"
                                                    name="date"
                                                    required
                                                />
                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-regular fa-calendar-alt text-base"></i>
                                                </span>
                                                </span>
                                            </label>                                        
                                        </div>
                                        <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                                            <div class="mt-4 space-y-4">
                                                <div style="overflow: auto; max-height: 460px">
                                                    <h2 class="font-bold text-lg"><em class="fas fa-caret-right"></em> Prep Pricing</h2>    
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>Standard Unit Processing </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input unit w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Units"
                                                                        name="unit"
                                                                        type="text"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        
                                                                        />                                                    
                                                            </span>
                                                        </label>   
                                                        <label class="block">
                                                            <span>Unit Price </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input unit-price w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Price"
                                                                        type="text"
                                                                        name="unit_price"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        />  
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                                  
                                                            </span>
                                                        </label>  
                                                        <label class="block">
                                                            <span>Bundling</span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input bundling w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Total bundle"
                                                                        name="bundling"
                                                                        type="text"
                                                                        />                                                    
                                                            </span>
                                                        </label>      
                                                        <label class="block">
                                                            <span>Bundling Price</span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input w-full pl-9 bundling-price rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Price"
                                                                        type="text"
                                                                        name="bundling_price"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        />  
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                                   
                                                            </span>
                                                        </label>                                                                                                            
                                                    </div>  
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Boxes and Materials</span>
                                                                <span class="relative mt-1.5 flex">
                                                                <select name="material" class="material form-input peer w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                                    <option value="">...</option>
                                                                    <option value="Small outbound boxes">Small outbound boxes</option>
                                                                    <option value="Medium outbound boxes">Medium outbound boxes</option>
                                                                    <option value="Large outbound boxes">Large outbound boxes</option>
                                                                    <option value="Extra large boxes">Extra large boxes</option>
                                                                    <option value="Bubble wrap">Bubble wrap</option>
                                                                    <option value="Extra large poly bag">Extra large poly bag</option>
                                                                </select>                                                                                                
                                                            </span>
                                                        </label>      
                                                        <label class="block">
                                                            <span>Qty</span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input material-qty w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Qty"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        type="text"
                                                                        name="material_qty"
                                                                        />                                                    
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Boxes and Materials Price</span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input material-price w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Price"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        type="text"
                                                                        name="boxes_price"
                                                                        />           
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                          
                                                            </span>
                                                        </label>  
                                                    </div>
                                                    <h2 class="font-bold text-lg"><em class="fas fa-caret-right"></em> Storage</h2>    
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>Number of day </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input days w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="days"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        type="text"
                                                                        name="days"
                                                                        />                                                    
                                                            </span>
                                                        </label>   
                                                        <label class="block">
                                                            <span>Price/Day </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input day-price w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Price"
                                                                        type="text"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        name="day_price"
                                                                        />            
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                         
                                                            </span>
                                                        </label>                                               
                                                    </div> 
                                                    <h2 class="font-bold text-lg"><em class="fas fa-caret-right"></em> Wholesale</h2>    
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <label class="block">
                                                            <span>Qty Pallets </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input receiving-qty-pallet w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Qty"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        type="text"
                                                                        name="Qty"
                                                                        />                                                    
                                                            </span>
                                                        </label>  
                                                        <label class="block">
                                                            <span>Price </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input receiving w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="price/pallet"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        type="text"
                                                                        name="Price"
                                                                        />   
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                                   
                                                            </span>
                                                        </label>  
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Unloading </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <select name="unloading" class="unloading form-input peer w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                                        <option value="">...</option>
                                                                        <option value="20ft">20ft container unload</option>
                                                                        <option value="40ft">40ft container unload</option>
                                                                    </select>                                                                                                            
                                                            </span>
                                                        </label>  
                                                        <label class="block">
                                                            <span>Qty</span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input unloading-qty w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Unloading Qty"
                                                                        type="text"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        name="qty_unloading"
                                                                        />                                                    
                                                            </span>
                                                        </label>       
                                                        <label class="block">
                                                            <span>Unloading Price </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input unloading-price w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="price/container"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        type="text"
                                                                        name="unloading_price"
                                                                        />   
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                                   
                                                            </span>
                                                        </label>                                                  
                                                    </div> 
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                        <label class="block">
                                                            <span>Pallet </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <select name="client" class="pallet form-input peer w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                                        <option value="">...</option>
                                                                        <option value="fee">Palletizing fee</option>
                                                                        <option value="new">New Pallet</option>
                                                                    </select>                                            
                                                            </span>
                                                        </label>                                                      
                                                        <label class="block">
                                                            <span>Qty</span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input pallet-qty w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Qty"
                                                                        type="text"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        name="qty_pallet"
                                                                        />                                                    
                                                            </span>
                                                        </label>                                                  
                                                        <label class="block">
                                                            <span>Price</span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input pallet-price w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="price/pallet"
                                                                        type="text"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        name="pallet"
                                                                        />   
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                                   
                                                            </span>
                                                        </label>                                                  
                                                    </div> 
                                                    <h2 class="font-bold text-lg text-error"><em class="fas fa-caret-right"></em> Return</h2>                                               
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">                                                   
                                                        <label class="block">
                                                            <span class="text-error">Standard Unit Processing </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input return w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Units"
                                                                        name="return"
                                                                        type="text"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        value="0"
                                                                        />                                                    
                                                            </span>
                                                        </label>   
                                                        <label class="block">
                                                            <span class="text-error">Unit Price </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input return-price w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Price"
                                                                        type="text"
                                                                        name="return_price"
                                                                        value="1.65"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        />   
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                                   
                                                            </span>
                                                        </label>  
                                                                                                    
                                                    </div> 
                                                    <h2 class="font-bold text-lg text-success"><em class="fas fa-caret-right"></em> Additional Charges </h2>                                               
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">                                                   
                                                        <label class="block"">
                                                            <span>Descriptions</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input add-description w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="additional charge"
                                                                        name="add_description"
                                                                        type="text"
                                                                        />                                             
                                                            </span>
                                                        </label>
                                                        <label class="block">
                                                            <span>Qty </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input add-qty w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Qty"
                                                                        name="add_qty"
                                                                        type="text"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        
                                                                        />                                                    
                                                            </span>
                                                        </label>   
                                                        <label class="block">
                                                            <span>Additional Price </span>
                                                                <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input add-price w-full pl-9 rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Price"
                                                                        type="text"
                                                                        name="add_price"
                                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                        /> 
                                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                        <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                                                    </span>                                                     
                                                            </span>
                                                        </label>                                                                                                  
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                        <div class="space-x-2 text-right mt-4">
                                            <button
                                            @click="showModal = false"
                                            class="btn close min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                                            >
                                            Cancel
                                            </button>
                                            <button
                                            type="button"
                                            class="btn preview-invoice min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                            >
                                            Preview
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div x-data="{showModal:false}" style="display: none;">
                    <button
                        @click="showModal = true"
                        class="preview-modal"
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
                            class="relative w-full max-w-screen-lg origin-top rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
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
                                        Preview Invoice
                                    </h3>
                                    <button
                                    @click="showModal = !showModal"
                                    class="btn close-preview -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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
                                <div class="px-4 py-4 sm:px-5">                                                                           
                                    <div class="mt-4 space-y-4">                                            
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <label class="block">
                                            <p>Bill To:</p>
                                            <p><span class="pre-client"></span></p>                                            
                                        </label>
                                        <label class="block text-right">
                                            <p></p>
                                            <p>Date: <span class="pre-date"></span></p>
                                        </label>
                                        
                                    </div>    
                                    <div
                                        class="is-scrollbar-hidden min-w-full overflow-x-auto rounded-lg border border-slate-200 dark:border-navy-500"
                                    >
                                        <table class="table w-full text-left">
                                            <thead>
                                                <tr>
                                                    <th class="whitespace-nowrap border border-t-0 border-l-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                                                        Transaction Details
                                                    </th>
                                                    <th class="whitespace-nowrap border border-t-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                                                        Descriptions
                                                    </th>
                                                    <th class="whitespace-nowrap border border-t-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                                                        Qty
                                                    </th>
                                                    <th class="whitespace-nowrap border border-t-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                                                        Unit
                                                    </th>
                                                    <th class="whitespace-nowrap border border-t-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                                                        Price
                                                    </th>
                                                    <th class="whitespace-nowrap border border-t-0 border-r-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                                                        Total Charged
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="3" class="whitespace-nowrap border border-l-0 border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Prep Pricing
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Standard Unit Processing
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-unit">
                                                        1
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Items
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-unit-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-unit-charge">
                                                        
                                                    </td>
                                                </tr>
                                                <tr>     
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Bundling/Multipacks/Kitting
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-bundling">
                                                        1
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Bundle
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-bundling-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-bundling-charge">
                                                        
                                                    </td>                                                                                               
                                                </tr>
                                                <tr>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        New Boxes and Materials	
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-material-qty">
                                                        1
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-material">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-material-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-material-charge">
                                                        
                                                    </td>                                                                                                                                           
                                                </tr>
                                                <tr>
                                                    <td class="whitespace-nowrap border border-l-0 border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Storage
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Storage	
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-storage">
                                                        1
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Days
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-storage-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-storage-charge">
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3" class="whitespace-nowrap border border-l-0 border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Wholesale		
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Receiving Pallets
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-receiving">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Pallets
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-receiving-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-receiving-charge">
                                                        
                                                    </td>
                                                </tr>
                                                <tr>     
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Unloading
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-unloading-qty">
                                                        1
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-unloading">
                                                        20 ft Container/40ft Container
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-unloading-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-unloading-charge">
                                                        
                                                    </td>                                                                                               
                                                </tr>
                                                <tr>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Pallets	
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-pallet-qty">
                                                        1
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-pallet">
                                                        Palletizing fee/New Pallet
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-pallet-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-pallet-charge">
                                                        
                                                    </td>                                                                                                                                           
                                                </tr>
                                                <tr>
                                                    <td class="whitespace-nowrap text-error border border-l-0 border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Return
                                                    </td>
                                                    <td class="whitespace-nowrap text-error border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Standard Unit Processing		
                                                    </td>
                                                    <td class="whitespace-nowrap text-error border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-return">
                                                        1
                                                    </td>
                                                    <td class="whitespace-nowrap text-error border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 ">
                                                        Items
                                                    </td>
                                                    <td class="whitespace-nowrap text-error border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-return-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap text-error border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-return-charge">
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Additional Charges		
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-add">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-add-qty">
                                                        
                                                        </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Items
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-add-price">
                                                        
                                                    </td>
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-add-charge">
                                                        
                                                    </td>                                                                                                                                           
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="whitespace-nowrap text-center font-bold border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5">
                                                        Total	
                                                    </td>
                                                   
                                                    <td class="whitespace-nowrap border border-slate-200 px-3 py-1 dark:border-navy-500 lg:px-5 preview-total">
                                                        
                                                    </td>                                                                                                                                           
                                                </tr>
                                                
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    
                                    <div class="space-x-2 text-right">
                                        <button
                                        type="button"
                                        class="btn back min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                                        >
                                        Back
                                        </button>
                                        <button
                                        type="button"
                                        class="btn save-invoice min-w-[7rem] rounded-full bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                        >
                                        <span class="loader" style="display: none;"> 

                                        </span>
                                        Save and Download Invoice
                                        </button>
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
            <table class="table stripe datatable-init2">
                <thead>
                    <tr class="tb-tnx-head">
                        <th class="tb-tnx-id" style="width: 5%; text-align: center">#</th>
                        <th class="tb-tnx-info">Invoice Date</th>
                        <th class="tb-tnx-info">Client</th>
                        <th class="tb-tnx-info">Total Amount</th>
                        <th class="tb-tnx-info">File</th>
                        <th class="tb-tnx-info">Created At</th>
                    </tr>                        
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($invoices->getResultObject() as $inv) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $inv->date ?></td>
                            <td><?= $inv->name ?> (<?= $inv->email ?>)</td>
                            <td>$<?= number_format($inv->total_amount , 2) ?></td>
                            <td><a href="/invoices/<?= $inv->invoice_file ?>" download><?= $inv->invoice_file ?></a></td>
                            <td><?= date('M/d/Y h:i A', strtotime($inv->created_at)) ?></td>
                        </tr>
                    <?php endforeach ?>
                    
                </tbody>
            </table>     
        </div>
    </div>
    <a href="" class="inv-download" download></a>

<?= $this->endSection() ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?= $this->section('js') ?>
<script>
    var clientId = '';
    var clientName = '';
    var dateRange = '';
    var unit = '';
    var unitPrice = '';
    var bundling = '';
    var bundlingPrice = '';
    var material = '';
    var materialPrice = '';
    var days = '';
    var daysPrice = '';
    var receivingPallet = '';    
    var receiving = '';    
    var unloading = '';
    var unloadingQty = '';
    var unloadingPrice = '';
    var fees = '';
    var pallet = '';
    var palletQty = '';
    var palletPrice = '';
    var unitReturn = '';
    var additional = '';
    var addQty = '';
    var addPrice = '';    
    var total = 0;

    $(document).on('click', '.preview-invoice', function() {
        
        clientId = $('.client').val();
        clientName = $('.client').find(":selected").text();
        dateRange = $('.date-range').val();
        unit = $('.unit').val();
        unitPrice = $('.unit-price').val();
        bundling = $('.bundling').val();
        bundlingPrice = $('.bundling-price').val();
        material = $('.material').find(":selected").text();
        materialQty = $('.material-qty').val();
        materialPrice = $('.material-price').val();
        days = $('.days').val();
        daysPrice = $('.day-price').val();
        receivingPallet = $('.receiving-qty-pallet').val();
        receiving = $('.receiving').val();
        unloading = $('.unloading').find(":selected").text();
        unloadingQty = $('.unloading-qty').val();
        unloadingPrice = $('.unloading-price').val();
        pallet = $('.pallet').find(":selected").text();
        palletQty = $('.pallet-qty').val();
        palletPrice = $('.pallet-price').val();
        unitReturn = $('.return').val();
        returnPrice = $('.return-price').val();
        additional = $('.add-description').val();
        addQty = $('.add-qty').val();
        addPrice = $('.add-price').val();
        if (clientId == '' || unitPrice == '' || bundling == '' || bundlingPrice == '' || material == '' || materialQty == '' || materialPrice == '' || days == '' || daysPrice == '' || receivingPallet == '' || receiving == '' || unloading == '' || unloadingQty == '' || unloadingPrice == '' || pallet == '' || palletQty == '' || palletPrice == '') {
            alert("Some item cannot be empty");
        } else {
            $('.pre-client').html(clientName);
            $('.pre-date').html(dateRange);

            $('.preview-unit').html(unit);
            $('.preview-unit-price').html('$'+unitPrice);
            $('.preview-unit-charge').html('$'+ (unit * unitPrice).toFixed(2));

            $('.preview-bundling').html(bundling);
            $('.preview-bundling-price').html('$'+bundlingPrice);
            $('.preview-bundling-charge').html('$'+ (bundling * bundlingPrice).toFixed(2));

            
            $('.preview-material').html(material);
            $('.preview-material-qty').html(materialQty);
            $('.preview-material-price').html('$'+materialPrice);
            $('.preview-material-charge').html('$'+ (materialQty * materialPrice).toFixed(2));

            $('.preview-storage').html(days);
            $('.preview-storage-price').html('$'+daysPrice);
            $('.preview-storage-charge').html('$'+ (days * daysPrice).toFixed(2));

            $('.preview-receiving').html(receivingPallet);
            $('.preview-receiving-price').html('$'+receiving);
            $('.preview-receiving-charge').html('$'+ (receivingPallet * receiving).toFixed(2));

            $('.preview-unloading').html(unloading);        
            $('.preview-unloading-price').html('$'+unloadingPrice);
            $('.preview-unloading-charge').html('$'+ unloadingPrice);
            
            $('.preview-pallet').html(pallet);
            $('.preview-pallet-qty').html(palletQty);
            $('.preview-pallet-price').html('$'+palletPrice);
            $('.preview-pallet-charge').html('$'+ (palletQty * palletPrice).toFixed(2));

            $('.preview-return').html(unitReturn);        
            $('.preview-return-price').html('$'+returnPrice);
            $('.preview-return-charge').html('$'+ (unitReturn * returnPrice).toFixed(2));

            $('.preview-add').html(additional);
            $('.preview-add-qty').html(addQty);
            $('.preview-add-price').html('$'+addPrice);
            $('.preview-add-charge').html('$'+ (addQty * addPrice).toFixed(2));

            total = (unit * unitPrice) + (bundling * bundlingPrice) + (materialQty * materialPrice) + (days * daysPrice) +  (receivingPallet * receiving) + (unloadingQty * unloadingPrice) + (palletQty * palletPrice) + (addQty * addPrice) + (unitReturn * returnPrice);
            $('.preview-total').html('$'+ parseFloat(total).toFixed(2));

            $('.close').click();
            $('.preview-modal').click();
            
        }
        
    });

    $(document).on('click', '.back', function() {
        $('.close-preview').click();
        $('.invoice-modal').click();
    });

    $(document).on('change', '.sw-radio', function() {
        $('.client')
            .find('option')
            .remove()
            .end()
            .append('<option value="">...</option>');
        $.get('/get-client/sw')
            .done(function(data){
                const resp = JSON.parse(data);                
                for (var i = 0; i < resp['users'].length; i++) {
                    $('.client')                    
                        .append('<option value="'+ resp['users'][i]['id'] +'">'+ resp['users'][i]['name'] +'</option>');
                }
            });

                    
    });

    $(document).on('change', '.lg-radio', function() {
        $('.client')
            .find('option')
            .remove()
            .end()
            .append('<option value="">...</option>');
        
        $.get('/get-client/lg')
            .done(function(data){
                const resp = JSON.parse(data);                
                for (var i = 0; i < resp['users'].length; i++) {
                    $('.client')                    
                        .append('<option value="'+ resp['users'][i]['id'] +'">'+ resp['users'][i]['name'] +'</option>');
                }
            });
    });

    $(document).on('change', '.client', function() {
        const id = $(this).val();
        const date = $('.date-range').val();
        
        $.get('/get-total-unit-client', {id: id, date: date})
            .done(function(data) {
                const resp = JSON.parse(data);
                if (resp['unit'] == null) {
                    $('.unit').val(0)
                    $('.return').val(0);
                    $('.unit-price').val(1.65);
                    $('.bundling-price').val(0.60);
                    $('.day-price').val(26.48);
                    $('.receiving').val(10);
                } else {
                    $('.unit').val(resp['unit']['total_unit']);
                    if (resp['unit']['total_return'] == null) {
                        $('.return').val(0);
                    } else {
                        $('.return').val(resp['unit']['total_return']);
                    }
                    $('.unit-price').val(1.65);
                    $('.bundling-price').val(0.60);
                    $('.day-price').val(26.48);
                    $('.receiving').val(10);
                }
            })
    });

    $(document).on('change', '.date-range', function() {
        const id = $('.client').val();
        const date = $('.date-range').val();
        
        $.get('/get-total-unit-client', {id: id, date: date})
            .done(function(data) {
                const resp = JSON.parse(data);
                if (resp['unit'] == null) {
                    $('.unit').val(0)
                    $('.unit-price').val(1.65);
                    $('.bundling-price').val(0.60);
                    $('.day-price').val(26.48);
                    $('.receiving').val(10);
                } else {
                    $('.unit').val(resp['unit']['total_unit'])
                    if (resp['unit']['total_return'] == null) {
                        $('.return').val(0);
                    } else {
                        $('.return').val(resp['unit']['total_return']);
                    }
                    $('.unit-price').val(1.65);
                    $('.bundling-price').val(0.60);
                    $('.day-price').val(26.48);
                    $('.receiving').val(10);
                }
            })
    });

    $(document).on('change', '.material', function() {
        const material = $(this).val();
        switch (material) {
            case 'Small outbound boxes' : $('.material-price').val(3);
                break;
            case 'Medium outbound boxes' : $('.material-price').val(4);
                break;
            case 'Large outbound boxes' : $('.material-price').val(5);
                break;
            case 'Extra large boxes' : $('.material-price').val(6);
                break;
            case 'Bubble wrap' : $('.material-price').val(0.25);
                break;
            case 'Extra large poly bag' : $('.material-price').val(0.8);
                break;

        }        
        $('.material-qty').val(1);
    });


    $(document).on('keyup', '.bundling', function() {
        const bundling = $(this).val();
        if (bundling <= 6) {
            $('.bundling-price').val(0.6);
        } else if (bundling > 6 && bundling <= 12) {
            $('.bundling-price').val(1.55);
        } else if (bundling > 12 && bundling <= 20) {
            $('.bundling-price').val(2.50);
        }
    });

    $(document).on('change', '.unloading', function() {
        const container = $(this).val();
        
        if (container == '20ft') {
            $('.unloading-price').val(325);
        } else {
            $('.unloading-price').val(650);
        }
        $('.unloading-qty').val(1);
    });

    $(document).on('change', '.pallet', function() {
        const pallet = $(this).val();
        
        if (pallet == 'fee') {
            $('.pallet-price').val(35);
        } else {
            $('.pallet-price').val(12);
        }
        $('.pallet-qty').val(1);
    });

    $(document).on('click', '.save-invoice', function() {
        const invoice = {
            'client': clientId,
            'client_name': clientName,        
            'date': dateRange,
            'unit': unit,
            'unit_price': unitPrice,
            'bundling': bundling,
            'bundling_price': bundlingPrice,
            'material': material,
            'material_price': materialPrice,
            'material_qty': materialQty,
            'storage': days,
            'storage_price': daysPrice,
            'receiving_pallet': receivingPallet,
            'receiving_pallet_price': receiving,
            'unloading': unloading,
            'unloading_qty': unloadingQty,
            'unloading_price': unloadingPrice,
            'pallet': pallet,
            'pallet_qty': palletQty,
            'pallet_price': palletPrice,
            'storage': days,
            'storage_price': daysPrice,
            'return': unitReturn,
            'return_price': returnPrice,
            'additional': additional,
            'additional_qty': addQty,
            'additional_price': addPrice,
            'total_amount': total
        }
        $.post('/save-invoice', {invoice: invoice})
            .done(function(data) {
                $('.inv-download').attr("href", "/invoices/" + data);
                $('.inv-download')[0].click();                                
                setTimeout(function() {
                    // Refresh the page
                    window.location.reload();
                }, 3000); // 3000 milliseconds = 3 seconds
                
            })
    });

    
  
</script>
<?= $this->endSection() ?>