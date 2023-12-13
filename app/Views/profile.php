<?= $this->extend('layout/component') ?>

<?= $this->section('content') ?>

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

<div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">    
    <div class="col-span-12 lg:col-span-4">
        <div class="card p-4 sm:p-5">
            <div class="flex items-center space-x-4">
                <div class="avatar h-14 w-14">
                    <?php if (empty($user['photo'])) :  ?>
                        <img class="rounded-full" src="/lineone/images/200x200.png" alt="avatar">
                    <?php else : ?>                        
                        <img class="rounded-full"  src="/photos/<?= $user['photo'] ?>" alt="avatar">                        
                    <?php endif ?>
                </div>
            <div>
                <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                    <?= (empty(session()->get('name'))) ? ucfirst(session()->get('username')) : ucfirst(session()->get('name')) ?>
                </h3>
                <p class="text-xs+">Author</p>
            </div>
            </div>
            <ul class="mt-6 space-y-1.5 font-inter font-medium">
            <li>
                <a href="/profile" class="flex items-center space-x-2 rounded-lg bg-primary px-4 py-2.5 tracking-wide text-white outline-none transition-all dark:bg-accent" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                <span>Account</span>
                </a>
            </li>            
            <li>
                <a href="/documentation" class="group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span>Documentation</span>
                </a>
            </li>
            </ul>
        </div>
    </div>    
    <div class="col-span-12 lg:col-span-8">
        
        <form action="/update-profile" method="post" autocomplete="off" enctype="multipart/form-data">
            <?php csrf_field() ?>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            
            <div class="card">
                <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        Account Setting
                    </h2>
                    
                </div>
                <div class="p-4 sm:p-5">
                <div class="flex flex-col" style="align-items: center;">            
                    <div class="avatar mt-1.5 h-20 w-20">
                        <?php if (empty($user['photo'])) : ?>
                            <img id="output" class="mask is-squircle" src="/lineone/images/200x200.png" alt="avatar">
                        <?php else : ?>
                            <img id="output" class="mask is-squircle" src="/photos/<?= $user['photo'] ?>" alt="avatar">
                        <?php endif ?>
                        
                        <div class="absolute bottom-0 right-0 flex items-center justify-center rounded-full bg-white dark:bg-navy-700">
                            <button type="button" id="uploadImg" class="btn h-6 w-6 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <script>
                        $("#uploadImg").click(function() {
                            $("#photo").click();
                        })

                        var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                    </script>
                    <div style="display: none;">
                        <input type="file" name="photo" accept="image/*" id="photo" onchange="loadFile(event)">
                    </div>
                </div>
                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <label class="block">
                    <span>Username </span>
                        <span class="relative mt-1.5 flex">
                            <input class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" placeholder="Enter name" value="<?= $user['username'] ?>" disabled type="text">
                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <i class="fa-regular fa-user text-base"></i>
                            </span>
                        </span>
                    </label>
                    <label class="block">
                        <span>Full Name </span>
                        <span class="relative mt-1.5 flex">
                            <input name="name" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter full name" value="<?= $user['name'] ?>"  type="text">
                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <i class="fa-regular fa-user text-base"></i>
                            </span>
                        </span>
                    </label>
                    <label class="block">
                        <span>Email Address </span>
                        <span class="relative mt-1.5 flex">
                            <input name="email" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter email address" value="<?= $user['email'] ?>" type="email" autocomplete="email">
                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <i class="fa-regular fa-envelope text-base"></i>
                            </span>
                        </span>
                    </label>
                    <label class="block">
                        <span>Role</span>
                        <span class="relative mt-1.5 flex">
                            <input class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" value="<?= $user['role'] ?>"  disabled type="text">
                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <i class="fas fa-user-cog"></i>
                            </span>
                        </span>
                    </label>
                </div>
                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                <div class="alert-display-error" style="display: none">
                    <div class="alert my-2 flex space-x-2 rounded-lg border border-error px-2 py-2 text-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="message"></p>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <label class="block">
                    <span>New Password </span>
                        <span class="relative mt-1.5 flex">
                        <input class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"  type="password" name="new-password" id="password"  autocomplete="new-password">
                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <i class="fa-regular fas fa-lock text-base"></i>
                            </span>
                        </span>
                    </label>
                    <label class="block">
                        <span>Confirm Password </span>
                        <span class="relative mt-1.5 flex">
                            <input class="form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="password" name="confirm-password" id="confirm_password" autocomplete="confirm-password">
                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <i class="fa-regular fas fa-lock text-base"></i>
                            </span>
                        </span>
                    </label>            
                </div>
                <div>
                    <h3 class="text-base font-medium text-slate-600 dark:text-navy-100">                        
                    </h3>
                    <p class="text-xs+ text-slate-400 dark:text-navy-300">
                    
                    </p>
                    <div class="flex items-right justify-end pt-4">
                        <div class="flex items-right space-x-4">
                            
                        </div>
                        <button type="submit" class="btn btn-save min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90" disabled>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>    
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    $('#password, #confirm_password').on('keyup', function() {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('.message').html('Password Matching').css('color', 'green');            
            $('.alert-display-error').css('display', 'none');
            $('.btn-save').prop('disabled', false);
        } else
            $('.alert-display-error').css('display', 'block');
            $('.message').html('Password not matching!').css('color', 'red');            
    });
</script>
<?= $this->endSection() ?>