<?= $this->extend('admin/layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    
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
                class="btn h-7 w-7 rounded-full p-0 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
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
                        <th class="tb-tnx-info">Email</th>
                        <th class="tb-tnx-info">Plan</th>
                        <th class="tb-tnx-info">Valid Date</th>
                        <th class="tb-tnx-info" style="width: 5%; text-align: right"><em class="fas fa-caret-down"></em></th>
                    </tr>                        
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($users->getResultObject() as $user) : ?>
                        <tr class="tb-tnx-item border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="tb-tnx-id text-center">
                                <span><?= $no++ ?></span>
                            </td>
                            
                            <td class="tb-tnx-info"><span class="date"><?= $user->name ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= $user->email ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= (is_null($user->plan)) ? 'FREE' : strtoupper($user->plan) ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= (is_null($user->plan)) ? '-' : date('d M Y', strtotime($user->valid_date)) .' - '. date('d M Y', strtotime($user->expire_date)) ?></span></td>
                            <td class="tb-tnx-info text-center"><a href="#" class="edit-user-btn" data-id="<?= $user->id ?>"><em class="fas fa-pen-square fa-lg"></em></a></td>
                        </tr><!-- .tb-tnx-item -->
                    <?php endforeach; ?>
                    
                    
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
                    Edit User
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
                <form method="post" action="/update-subscription" enctype="multipart/form-data">
                    <div class="mx-5 my-2 grid grid-cols-1 gap-4">   
                        <input type="hidden" name="id" class="user-id">                        
                        <span>Plan</span>
                        <select
                            name="plan"
                            class="plan form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                        >
                            <option value="free">Free</option>
                            <option value="monthly">Monthly</option>
                            <option value="annually">Annualy</option>
                        </select>
                        <span>Valid Date</span>
                        <label class="relative flex">
                            <div class="datee w-full">
                                <input     
                                    name="date"                               
                                    class="daterange form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Choose date..."
                                    type="text"
                                />
                            </div>
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
                    <div class="flex justify-between items-center p-2 mx-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">                                            
                        <div class="flex items-center">                                   
                        </div>            
                        <button type="submit" class="upload-btn btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 save-buyers">
                            <div class="spinner h-4 w-4 mr-2 animate-spin text-slate-100 dark:text-navy-300" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 28 28">
                                    <path fill="currentColor" fill-rule="evenodd" d="M28 14c0 7.732-6.268 14-14 14S0 21.732 0 14 6.268 0 14 0s14 6.268 14 14zm-2.764.005c0 6.185-5.014 11.2-11.2 11.2-6.185 0-11.2-5.015-11.2-11.2 0-6.186 5.015-11.2 11.2-11.2 6.186 0 11.2 5.014 11.2 11.2zM8.4 16.8a2.8 2.8 0 100-5.6 2.8 2.8 0 000 5.6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            Save
                        </button>
                    </div>
                </form>
            </div>                
        </template>
    </div>  
</div>
<?= $this->endSection() ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?= $this->section('js') ?>
<script>
    $(document).on('keyup', '#password, #confirm_password', function() {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Password Matching').css('color', 'green');
            $('.btn-add').prop('disabled', false);
        } else            
            $('#message').html('Password not matching!').css('color', 'red');
    });      

    $(document).on('keyup', '#new_password, #new_confirm_password', function() {
        if ($('#new_password').val() == $('#new_confirm_password').val()) {
            $('#message2').html('Password Matching').css('color', 'green');
            $('.btn-add').prop('disabled', false);
        } else
            $('#message2').html('Password not matching!').css('color', 'red');
    });   

    $(document).on('click', '.edit-user-btn', function() {
        const id = $(this).data('id');
        $('.user-id').val(id);
        $.get('/get-user', {id: id}, function(data) {
            if (data == 'null') {
                $(".daterange").flatpickr({
                    mode: "range",            
                    dateFormat: "Y-m-d",
                    defaultDate: ['<?= date('Y-m-d') ?>', '<?= date('Y-m-d', strtotime('+14 days')) ?>']               
                });                
            } else {
                const resp = JSON.parse(data);
                $('.plan').val(resp['plan']);
                $(".daterange").flatpickr({
                    mode: "range",            
                    dateFormat: "Y-m-d",
                    defaultDate: [resp['valid_date'], resp['expire_date']]               
                });   
            }
            
            
        });
        
        $('.edit-user').click();
    });

    
</script>
<?= $this->endSection() ?>