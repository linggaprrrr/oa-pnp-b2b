<?= $this->extend('b2b/layout/component') ?>


<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="mb-1" style="justify-self: right">
        <div class="mb-1" x-data="{showModal:false}">
            <button @click="showModal = true" class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"><em class="fas fa-database mr-1"></em>
            Restore
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
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 asin-code">
                        Restore Data
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
                    <form method="post" action="/restore-data" enctype="multipart/form-data">
                        <div class="mx-5 my-2 grid grid-cols-1 gap-4">                           
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload Your Backup File</label>
                            <input class="files block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".sql" name="file" type="file" required>                                                        
                        </div>                                  
                        <div class="flex justify-between items-center p-2 mx-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">                                            
                            <div class="flex items-center">                                   
                            </div>            
                            <button type="submit" class="upload-btn btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 save-buyers">
                                <div class="spinner h-4 w-4 mr-2 animate-spin text-slate-100 dark:text-navy-300" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 28 28">
                                        <path fill="currentColor" fill-rule="evenodd" d="M28 14c0 7.732-6.268 14-14 14S0 21.732 0 14 6.268 0 14 0s14 6.268 14 14zm-2.764.005c0 6.185-5.014 11.2-11.2 11.2-6.185 0-11.2-5.015-11.2-11.2 0-6.186 5.015-11.2 11.2-11.2 6.186 0 11.2 5.014 11.2 11.2zM8.4 16.8a2.8 2.8 0 100-5.6 2.8 2.8 0 000 5.6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                Restore
                            </button>
                        </div>
                    </form>
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
                Back Up & Restore
            </h2>                        
        </div>
        <hr>
        <div class="my-3 max-w-full">
            <table class="table stripe datatable-init2">
                <thead>
                    <tr class="tb-tnx-head">
                        <th class="tb-tnx-id" style="width: 5%; text-align: center">#</th>
                        <th class="tb-tnx-info">Backup File</th>
                        <th class="tb-tnx-info">Encryption</th>
                        <th class="tb-tnx-info">Date</th>
                        <th class="tb-tnx-info" style="width: 5%; text-align: right"><em class="fas fa-caret-down"></em></th>
                    </tr>                        
                </thead>
                <tbody>
                    <?php if (!is_null($lastUpload)) : ?>
                        <?php 
                            $no = 1; 
                            $now = time(); // or your date as well
                            $your_date = strtotime($lastUpload->created_at);
                            $datediff = $now - $your_date;
                            
                            $interval = round($datediff / (60 * 60 * 24));                    
                        ?>
                        <?php if (!is_null($lastUpload)) : ?> 
                            <?php if (date('Y-m-d') == date('Y-m-d', strtotime( $lastUpload->created_at))) : ?>
                                <tr>
                                    <td class="tb-tnx-info"><span class="date"><?= $no++ ?></span></td>
                                    <td class="tb-tnx-info"><span class="date"><?= date('Y-m-d', strtotime('-0 days')). '_backup.sql' ?></span></td>
                                    <td class="tb-tnx-info"><span class="date">AES-128-CTR</span></td>
                                    <td class="tb-tnx-info"><span class="date"><?= date('d M Y', strtotime('-0 days')) ?></span></td>
                                    <td class="tb-tnx-info text-center">
                                        <a href="/download-backup/<?= date('Y-m-d', strtotime('-0 days')) ?>/<?= session()->get('oauth_uid') ?>"  class="btn h-9 w-9 border border-warning/30 bg-warning/10 p-0 font-medium text-warning hover:bg-warning/20 hover:shadow-lg hover:shadow-warning/50 focus:bg-warning/20 focus:shadow-lg focus:shadow-warning/50 active:bg-warning/25">
                                            <i class="fa-solid fas fa-cloud-download-alt text-base"></i>
                                        </a>
                                    </td>
                                </tr>                            
                            <?php else :  ?>
                                <?php for ($i = 0; $i <= $interval; $i++) : ?>
                                    <tr>
                                        <td class="tb-tnx-info"><span class="date"><?= $no++ ?></span></td>
                                        <td class="tb-tnx-info"><span class="date"><?= date('Y-m-d', strtotime('-'.$i.' days')). '_backup.sql' ?></span></td>
                                        <td class="tb-tnx-info"><span class="date">AES-128-CTR</span></td>
                                        <td class="tb-tnx-info"><span class="date"><?= date('d M Y', strtotime('-'.$i.' days')) ?></span></td>
                                        <td class="tb-tnx-info text-center">
                                            <a href="/download-backup/<?= date('Y-m-d', strtotime('-'.$i.' days')) ?>/<?= session()->get('oauth_uid') ?>"  class="btn h-9 w-9 border border-warning/30 bg-warning/10 p-0 font-medium text-warning hover:bg-warning/20 hover:shadow-lg hover:shadow-warning/50 focus:bg-warning/20 focus:shadow-lg focus:shadow-warning/50 active:bg-warning/25">
                                                <i class="fa-solid fas fa-cloud-download-alt text-base"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php if ($i >= 6) { break; } ?>
                                <?php endfor ?> 
                                
                            <?php endif ?>                           
                            
                        <?php endif ?>
                    <?php endif ?>
                    
                </tbody>
            </table>    
            <?php 
                
             ?>
            
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
                    <form method="post" action="/update-client">
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
                                    <span>Cost Left </span>
                                    <span class="relative mt-1.5 flex">                                        
                                        <input  name="cost_left" class="form-input cost-left-edit peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">                                        
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
   
    $(document).on('click', '.edit-user-btn', function( ) {
        const id = $(this).data('id');
        $('.user-id').val(id);
        $.get('/get-client', {id: id}, function(data) {
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