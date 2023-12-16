<?= $this->extend('admin/layout/component') ?>

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
                <a href="/profile" class="group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                <span>Account</span>
                </a>
            </li>            
            <li>
                <a href="/documentation" class="flex items-center space-x-2 rounded-lg bg-primary px-4 py-2.5 tracking-wide text-white outline-none transition-all dark:bg-accent">
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
        <div class="card">
            <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                    Documentation   
                </h2>
                
            </div>
            <div class="p-4 sm:p-5">            
                <a href="https://drive.google.com/drive/folders/12gNPmc8XuG9FFV_UfjulVsN2mqC81CIJ?usp=sharing" target="_blank">https://drive.google.com/drive/folders/12gNPmc8XuG9FFV_UfjulVsN2mqC81CIJ?usp=sharing</a>
            </div>        
        </div>
    </div>    
</div>
<?= $this->endSection() ?>