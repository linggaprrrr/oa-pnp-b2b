<?= $this->extend('pnp/layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="mb-1" style="justify-self: right">
        <div class="mb-1" x-data="{showModal:false}">
            <button @click="showModal = true" class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"><em class="fas fa-user-plus mr-1"></em>
            New User
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
                        Add New User
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
                    <p>
                        
                    </p>
                        <hr>
                        <form method="post" action="/add-user">
                            <?php csrf_field() ?>                                  
                            <div class="mt-4 grid grid-cols-1 gap-4">                           
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <label class="block">
                                        <span>Username </span>
                                        <span class="relative mt-1.5 flex">
                                            <input  name="username" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Username" type="text" required>
                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                <i class="fa-regular fa-user text-base"></i>
                                            </span>
                                        </span>
                                    </label>
                                    <label class="block">
                                        <span>Password </span>
                                        <span class="relative mt-1.5 flex">
                                            <input id="password" name="password" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter New Password" type="password" required>
                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                <i class="fa-regular fas fa-lock  text-base"></i>
                                            </span>
                                        </span>
                                    </label>
                                    <label class="block">
                                        <span>Role </span>
                                        <span class="relative mt-1.5 flex">
                                            <select name="role" class="form-select w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">                                                
                                                <option value="purchase">Purchase User</option>
                                                <option value="warehouse">Warehouse User</option>
                                            </select>                                           
                                        </span>
                                    </label>
                                    <label class="block">
                                    <span>Confirm Password</span>
                                        <span class="relative mt-1.5 flex">
                                            <input  id="confirm_password" name="confirm_password" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Confirm Password" type="password" required>
                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                <i class="fa-regular fas fa-lock text-base"></i>
                                            </span>
                                        </span>
                                    </label>
                                    <div class="message">
                                        <p id='message'>test</p>
                                    </div>
                                </div>
                                <div class="mt-4 text-right">                                    
                                    <button
                                    type="submit"
                                    class="btn btn-add h-8 rounded-full bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                    >
                                    Add
                                    </button>
                                </div>
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
                        <th class="tb-tnx-info">Username</th>
                        <th class="tb-tnx-info">Role</th>
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
                            
                            <td class="tb-tnx-info"><span class="date"><?= $user->username ?></span></td>
                            <td class="tb-tnx-info"><span class="date"><?= $user->role ?></span></td>
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
                    Edit User
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
                <p>
                    
                </p>
                    <hr>
                    <form method="post" action="/update-user">
                        <?php csrf_field() ?>                                  
                        <div class="mt-4 grid grid-cols-1 gap-4">                           
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <label class="block">
                                    <span>Username </span>
                                    <span class="relative mt-1.5 flex">
                                        <input type="hidden" name="id" class="user-id">
                                        <input  name="username" disabled class="form-input username-edit peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Username" type="text" required>
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fa-user text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span>New Password </span>
                                    <span class="relative mt-1.5 flex">
                                        <input id="new_password" name="password" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter New Password" type="password" required>
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fas fa-lock  text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span>Role </span>
                                    <span class="relative mt-1.5 flex">
                                        <select name="role" class="form-select role-edit w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">                                                
                                            <option value="purchase">Purchase User</option>
                                            <option value="warehouse">Warehouse User</option>
                                        </select>                                           
                                    </span>
                                </label>
                                <label class="block">
                                <span>Confirm Password</span>
                                    <span class="relative mt-1.5 flex">
                                        <input  id="new_confirm_password" name="confirm_password" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Confirm Password" type="password" required>
                                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-regular fas fa-lock text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <div class="message2">
                                    <span id='message2'></span>
                                </div>
                            </div>
                            <div class="mt-4 text-right">                                    
                                <button
                                type="submit"
                                class="btn btn-add h-8 rounded-full bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                >
                                Add
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
        $.get('/get-client', {id: id}, function(data) {
            const resp = JSON.parse(data);
            $('.username-edit').val(resp['username']);
            $('.role-edit').val(resp['role']);
        });
        
        $('.edit-user').click();
    });
    
</script>
<?= $this->endSection() ?>