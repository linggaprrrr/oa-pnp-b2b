<?= $this->extend('pnp/layout/component') ?>
<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="mb-1" style="justify-self: right">
        <div class="mb-1" x-data="{showModal:false}">
            <button @click="showModal = true" class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"><em class="fas fa-user-plus mr-1"></em>
            New Client
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
                    class="relative max-w-xl rounded-lg bg-white px-4 pb-4 transition-all duration-300 dark:bg-navy-700 sm:px-5"
                    x-show="showModal"
                    x-transition:enter="easy-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                    x-transition:leave="easy-in"
                    x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                    x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                    >
                    <div class="my-3 flex h-8 items-center justify-between">
                        <h2
                        class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base"
                        >
                        Add New Client
                        </h2>
                        
                        <button
                        @click="showModal = !showModal"
                        class="btn -mr-1.5 h-7 w-7 rounded-lg p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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
                    <p>
                        
                    </p>
                        <hr>
                        <form method="post" action="/pnp/add-new-client">
                            <?php csrf_field() ?>                                  
                            <div class="mt-4 grid grid-cols-1 gap-4">                           
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <label class="block">
                                        <span>Name </span>
                                        <span class="relative mt-1.5 flex">
                                            <input type="hidden" name="oauth_uid" value="<?= session()->get('oauth_uid') ?>">
                                            <input  name="name" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text" required>                                            
                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                <i class="fa-regular fa-user text-base"></i>
                                            </span>
                                        </span>
                                    </label>
                                    <label class="block">
                                        <span>Company Name </span>
                                        <span class="relative mt-1.5 flex">
                                            <input id="text" name="company" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text" required>
                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                <i class="fa-regular fas fa-building text-base"></i>
                                            </span>
                                        </span>
                                    </label>
                                    <label class="block">
                                    <span>Total Order </span>
                                    <span class="relative mt-1.5 flex">                                        
                                        <input  name="total_order" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                
                                <label class="block">
                                    <span>Order Date </span>
                                    <span class="relative mt-1.5 flex">                                        
                                    <input
                                        x-init="$el._x_flatpickr = flatpickr($el)"
                                        class="form-input peer w-full  rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Choose date..."
                                        type="text"
                                        name="order_date"
                                        required
                                        />
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa-regular fas fa-calendar-alt text-base"></i>
                                    </span>
                                    </span>
                                </label>                                                                                      
                            </div>
                            <div class="mt-4 text-right">                                    
                                <button
                                type="submit"
                                class="btn btn-add h-8 rounded-lg bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                >
                                Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </div>  
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div
            x-data="{isShow:true}"
            :class="!isShow && 'opacity-0 transition-opacity duration-300'"
            class="alert flex items-center justify-between overflow-hidden rounded-lg border border-info text-info"
            >
            <div class="flex">
                <div class="bg-info p-3 text-white">
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
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                </div>
                <div class="px-4 py-3 sm:px-5"><?= session()->getFlashdata('success') ?></div>
            </div>
            <div class="px-2">
                <button
                @click="isShow = false; setTimeout(()=>$root.remove(),300)"
                class="btn h-7 w-7 rounded-lg p-0 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
                >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
                </button>
            </div>
        </div>
    <?php endif ?>
    <div class="card px-4 pb-2 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                Users Management
            </h2>                        
        </div>
        <hr>
        <div class="my-3 max-w-full">
            <table class="table stripe datatable-init2">
                <thead>
                    <tr class="tb-tnx-head">
                        <th class="tb-tnx-id" style="width: 5%; text-align: center">#</th>
                        <th class="tb-tnx-info">Name</th>
                        <th class="tb-tnx-info">Company Name</th>
                        <th class="tb-tnx-info">Total Orders</th>
                        <th class="tb-tnx-info">Cost Left</th>
                        <th class="tb-tnx-info">Order Date</th>
                        <th class="tb-tnx-info">Total Assign</th>
                        <th class="tb-tnx-info" style="width: 5%; text-align: right"><em class="fas fa-caret-down"></em></th>
                    </tr>                        
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach($clients->getResultObject() as $client) : ?>
                        <tr>
                            <td class="tb-tnx-info"><span class="date"><?= $no++ ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= $client->client_name ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= $client->company ?></span></td>
                            <td class="tb-tnx-info"><span class="date">$<?= number_format($client->total_order, 2) ?></span></td>
                            <td class="tb-tnx-info"><span class="date">$<?= number_format($client->cost_left - $client->total_cost, 2) ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= date('d M Y', strtotime($client->order_date)) ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= $client->qty ?></span></td>
                            <td class="tb-tnx-info text-center"><a href="#" class="edit-user-btn" data-id="<?= $client->id ?>"><em class="fas fa-pen-square fa-lg"></em></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>     
        </div>
    </div>
    <div class="mb-1" x-data="{showModal:false}" style="display:  none;">
        <button @click="showModal = true" class="btn edit-user border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"><em class="fas fa-user-plus mr-1"></em>        
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
                class="relative max-w-xl rounded-lg bg-white px-4 pb-4 transition-all duration-300 dark:bg-navy-700 sm:px-5"
                x-show="showModal"
                x-transition:enter="easy-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                x-transition:leave="easy-in"
                x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                >
                <div class="my-3 flex h-8 items-center justify-between">
                    <h2
                    class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base"
                    >
                    Edit Client
                    </h2>
                    
                    <button
                    @click="showModal = !showModal"
                    class="btn -mr-1.5 h-7 w-7 rounded-lg p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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
                <p>
                    
                </p>
                    <hr>
                    <form method="post" action="/pnp/update-client">
                        <?php csrf_field() ?>                                  
                        <div class="mt-4 grid grid-cols-1 gap-4">                           
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <label class="block">
                                    <span>Name </span>
                                    <span class="relative mt-1.5 flex">
                                        <input type="hidden" name="id" class="user-id">
                                        <input  name="name" class="form-input name-edit peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" required>
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fa-user text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span>Company Name </span>
                                    <span class="relative mt-1.5 flex">                                        
                                        <input  name="company" class="form-input company-edit peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" required>
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fas fa-building text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span>Total Order </span>
                                    <span class="relative mt-1.5 flex">                                        
                                        <input  name="total_order" class="form-input total-order-edit peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fas fa-dollar-sign text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span>Order Date </span>
                                    <span class="relative mt-1.5 flex">                                        
                                        <input
                                            x-init="$el._x_flatpickr = flatpickr($el)"
                                            class="form-input peer w-full order-date-edit rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="Choose date..."
                                            type="text"
                                            name="order_date"
                                            required
                                            />
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fas fa-calendar-alt text-base"></i>
                                        </span>
                                    </span>
                                    
                                </label>
                                
                            </div>
                            <div class="mt-4 text-right">                                    
                                <button
                                type="submit"
                                class="btn btn-add h-8 rounded-lg bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                >
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </div>  
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
   
    $(document).on('click', '.edit-user-btn', function() {
        const id = $(this).data('id');
        $('.user-id').val(id);
        $.get('/pnp/get-client', {id: id}, function(data) {
            const resp = JSON.parse(data);
            $('.name-edit').val(resp['client_name']);
            $('.company-edit').val(resp['company']);
            $('.total-order-edit').val(resp['total_order']);
            $('.cost-left-edit').val(resp['cost_left']);
            $('.order-date-edit').val(resp['order_date']);
            
        });
        
        $('.edit-user').click();
    });
    
</script>
<?= $this->endSection() ?>