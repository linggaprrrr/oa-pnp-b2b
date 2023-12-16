<?= $this->extend('layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
            File Parameter
            </h2>   
        </div>
        <hr>
        <div class="my-3  max-w-full">
            <div x-data="{showModal:false}">
            <?php if ($subscription['plan'] == 0) : ?>
                <button disabled="" class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                Setup File
                </button>  
            <?php else : ?>
                <button
                    @click="showModal = true"
                    class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                    > Setup File
                </button>
            <?php endif ?>
                
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
                            Setup File Parameter
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
                        <form id="upload-form" enctype="multipart/form-data">
                            <div class="mx-5 my-2 grid grid-cols-1 gap-4">                           
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Leads List File</label>
                                <input class="files block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="leads" type="file" required>                            
                                <div class="text-sm text-gray-500 dark:text-gray-300">Data Preview:</div>                            
                            </div>
                            <div class="min-w-full overflow-x-auto">                                                                       
                                <div class="mx-5 my-2" style="max-height: 240px;">
                                    <div class="min-w-full overflow-x-auto rounded-lg border border-slate-200 dark:border-navy-500">
                                        <table class="w-full text-left" style="font-size: 10px">
                                            <thead>
                                                <tr class="th-xls">
                                                    <th class="whitespace-nowrap border border-t-0 border-l-0 border-slate-200 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100" style="width: 3%;"></th>                        
                                                </tr>
                                            </thead>
                                            <tbody class="tbody-xls">                                      
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                                 
                            </div>   
                            <hr class="my-2">                    
                            <div class="mx-5 my-2">   
                                <div class="flex flex-col divide-y divide-slate-150 dark:divide-navy-500">
                                    <div x-data="{expanded:true}">
                                        <div @click="expanded = !expanded" class="flex cursor-pointer items-center justify-between py-4 text-base font-medium text-slate-700 dark:text-navy-100">
                                            <p>Customize Data</p>
                                            <div :class="expanded && '-rotate-180'"
                                                class="text-sm font-normal leading-none text-slate-400 transition-transform duration-300 dark:text-navy-300">
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                        <div x-collapse x-show="expanded">
                                            <div class="pb-4">
                                                <div class="space-y-4">   
                                                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">                                                
                                                        <label class="block">
                                                            <span>File Name</span>
                                                            <span class="relative mt-1.5 flex">
                                                                <input type="text" class="filename form-input peer w-full rounded-lg border bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"  disabled>                                        
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="far fa-file-excel text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>   
                                                        <label class="block">
                                                            <span>
                                                                Template Name 
                                                                <button   
                                                                    type="button"                                         
                                                                    x-tooltip.duration.1000="'This template will be used for next files with same type and similar file name.'"
                                                                    >
                                                                    <em class="fas fa-info-circle"></em>
                                                                </button>
                                                            </span>
                                                            <span class="relative mt-1.5 flex">
                                                                <input type="text"                                             
                                                                    name="template"
                                                                    class="template form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                                    autocomplete="off" 
                                                                    required>                                        
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-file-import text-base"></i>
                                                                </span>
                                                            </span>
                                                        </label>                             
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">                                
                                                        <label class="block">
                                                            <span>Product Title</span>
                                                            <span class="relative mt-1.5 flex">                                        
                                                                <select name="title[]" class="title1 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                    <option>...</option>                                        
                                                                </select>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-paragraph text-base"></i>
                                                                </span>
                                                            </span>                          
                                                        </label>                                                       
                                                        <label class="block">
                                                            <span>ASIN</span>
                                                            <span class="relative mt-1.5 flex">                                        
                                                                <select name="title[]" class="title3 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                    <option>...</option>                                        
                                                                </select>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-paragraph text-base"></i>
                                                                </span>
                                                            </span>                                
                                                        </label>
                                                        <label class="block">
                                                            <span>Retail Link</span>
                                                            <span class="relative mt-1.5 flex">                                        
                                                                <select name="title[]" class="title4 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                    <option>...</option>                                        
                                                                </select>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-paragraph text-base"></i>
                                                                </span>
                                                            </span>                                                                                                
                                                        </label> 
                                                    </div>       
                                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">                                                                                                    
                                                        <label class="block">
                                                            <span>Amazon Link</span>
                                                            <span class="relative mt-1.5 flex">                                        
                                                                <select name="title[]" class="title5 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                    <option>...</option>                                        
                                                                </select>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-paragraph text-base"></i>
                                                                </span>
                                                            </span>
                                                                                                
                                                        </label> 
                                                        <label class="block">
                                                            <span>Buy Cost</span>
                                                            <span class="relative mt-1.5 flex">
                                                                <select name="title[]" class="title6 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                    <option>...</option>                                        
                                                                </select>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-paragraph text-base"></i>
                                                                </span>
                                                            </span>                                                                        
                                                        </label>                      
                                                        <label class="block">
                                                            <span>Promo Code</span>
                                                            <span class="relative mt-1.5 flex">                                        
                                                                <select name="title[]" class="title7 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                    <option>...</option>                                        
                                                                </select>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-paragraph text-base"></i>
                                                                </span>
                                                            </span>
                                                                                                
                                                        </label>
                                                        <label class="block">
                                                            <span>Profit</span>
                                                            <span class="relative mt-1.5 flex">                                        
                                                                <select name="title[]" class="title8 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">
                                                                    <option>...</option>                                        
                                                                </select>
                                                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                    <i class="fas fa-paragraph text-base"></i>
                                                                </span>
                                                            </span>
                                                                                                
                                                        </label>

                                                        
                                                    </div>                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                     
                                
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
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>                
                </template>
            </div>
            <div style="margin-top: 2rem">
                <table class="table stripe datatable-init2">
                    <thead>
                        <tr class="tb-tnx-head">
                            <th class="tb-tnx-id" style="width: 3%;"><span class="">#</span></th>
                            <th class="tb-tnx-info">Template Name</th>
                            <th class="tb-tnx-info"></th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($templates->getResultObject() as $tmpl) : ?>
                            <tr class="tb-tnx-item border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="tb-tnx-id">
                                    <span><?= $no++ ?></span>
                                </td>
                                <td class="tb-tnx-info"><span class="title"><?= $tmpl->template_name ?></span></td>
                                <td class="tb-tnx-info text-center">
                                    <?php if ($subscription['plan'] == 0) : ?>

                                    <?php else : ?>
                                        <button type="button" data-id="<?= $tmpl->id ?>" class="edit-pattern"> 
                                            <em class="far fa-edit"></em> 
                                        </button>
                                    <?php endif ?>
                                    
                                </td>                                
                                
                            </tr><!-- .tb-tnx-item -->
                        <?php endforeach; ?>
                    </tbody>
                </table>        
            </div>
        </div>
        <div x-data="{showModal:false}">
            <button
                @click="showModal = true"
                class="edit-template"
                style="display: none;"
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
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 asin-code">
                        Edit File Parameter
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
                    <form id="edit-form">                            
                        <hr class="my-2">                    
                        <div class="mx-5 my-2">   
                            <div class="flex flex-col divide-y divide-slate-150 dark:divide-navy-500">
                                <div x-data="{expanded:true}">
                                    <div @click="expanded = !expanded" class="flex cursor-pointer items-center justify-between py-4 text-base font-medium text-slate-700 dark:text-navy-100">
                                        <p>Customize Data</p>
                                        <div :class="expanded && '-rotate-180'"
                                            class="text-sm font-normal leading-none text-slate-400 transition-transform duration-300 dark:text-navy-300">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div x-collapse x-show="expanded">
                                        <div class="pb-4">
                                            <div class="space-y-4">   
                                                <div class="grid grid-cols-1 gap-2 sm:grid-cols-1">                                                  
                                                    <label class="block">
                                                        <span>
                                                            Template Name 
                                                            <button   
                                                                type="button"                                         
                                                                x-tooltip.duration.1000="'This template will be used for next files with same type and similar file name.'"
                                                                >
                                                                <em class="fas fa-info-circle"></em>
                                                            </button>
                                                        </span>
                                                        <span class="relative mt-1.5 flex">
                                                            <input type="hidden" name="template-id" class="template-id">
                                                            <input type="text"                                             
                                                                name="template"
                                                                class="template-edit form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                                autocomplete="off" 
                                                                required>                                        
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-file-import text-base"></i>
                                                            </span>
                                                        </span>
                                                    </label>                             
                                                </div>
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">                                
                                                    <label class="block">
                                                        <span>Product Title</span>
                                                        <span class="relative mt-1.5 flex">                                        
                                                            <input type="number" name="title[]" class="edit-title1 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">                                                                
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-paragraph text-base"></i>
                                                            </span>
                                                        </span>
                                                                                            
                                                    </label>
                                                    <label class="block">
                                                        <span>ASIN</span>
                                                        <span class="relative mt-1.5 flex">                                        
                                                            <input type="number" name="title[]" class="edit-title2 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">                                                                
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-paragraph text-base"></i>
                                                            </span>
                                                        </span>                                
                                                    </label>
                                                    <label class="block">
                                                        <span>Retail Link</span>
                                                        <span class="relative mt-1.5 flex">                                        
                                                            <input type="number" name="title[]" class="edit-title3 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">                                                                
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-paragraph text-base"></i>
                                                            </span>
                                                        </span>                           
                                                    </label>     
                                                </div>       
                                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">                                                                                            
                                                    <label class="block">
                                                        <span>Amazon Link</span>
                                                        <span class="relative mt-1.5 flex">                                        
                                                            <input type="number" name="title[]" class="edit-title4 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">                                                                
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-paragraph text-base"></i>
                                                            </span>
                                                        </span>
                                                                                            
                                                    </label> 
                                                    <label class="block">
                                                        <span>Buy Cost</span>
                                                        <span class="relative mt-1.5 flex">
                                                            <input type="number" name="title[]" class="edit-title5 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">                                                                
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-paragraph text-base"></i>
                                                            </span>
                                                        </span>                                                                        
                                                    </label>                      
                                                    <label class="block">
                                                        <span>Promo Code</span>
                                                        <span class="relative mt-1.5 flex">                                        
                                                            <input type="number" name="title[]" class="edit-title6 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">                                                           
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-paragraph text-base"></i>
                                                            </span>
                                                        </span>                   
                                                    </label>
                                                    <label class="block">
                                                        <span>Profit</span>
                                                        <span class="relative mt-1.5 flex">                                        
                                                            <input type="number" name="title[]" class="edit-title7 title-select form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent buyer1">                                                           
                                                            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                                <i class="fas fa-paragraph text-base"></i>
                                                            </span>
                                                        </span>                   
                                                    </label>                                                    
                                                </div>                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-2 mx-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">                                            
                            <div class="flex items-center">
                                <p class="text-error">* Coloumn start at index 0 not 1</p>
                            </div>            
                            <button type="submit" class="upload-btn btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 save-buyers">
                                <div class="spinner h-4 w-4 mr-2 animate-spin text-slate-100 dark:text-navy-300" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 28 28">
                                        <path fill="currentColor" fill-rule="evenodd" d="M28 14c0 7.732-6.268 14-14 14S0 21.732 0 14 6.268 0 14 0s14 6.268 14 14zm-2.764.005c0 6.185-5.014 11.2-11.2 11.2-6.185 0-11.2-5.015-11.2-11.2 0-6.186 5.015-11.2 11.2-11.2 6.186 0 11.2 5.014 11.2 11.2zM8.4 16.8a2.8 2.8 0 100-5.6 2.8 2.8 0 000 5.6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                Update
                            </button>
                        </div>
                    </form>
                </div>                
            </template>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
<script>
    let formStat = false;
    window.addEventListener("beforeunload", function (ev) {
        var confirmationMessage = 'It looks like you have been editing something. '
                                + 'If you leave before saving, your changes will be lost.';

        if (formStat == true) {
            (ev || window.event).returnValue = confirmationMessage; //Gecko + IE
            return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
        }
                                
    });
    $(document).on('submit', '#upload-form', function(e) {   
        var formData = new FormData(this);        
        formStat = true;
        
        $('.spinner').css('display', 'block'); 
        e.preventDefault();                
        $.ajax({
            url:'/upload-template-files',
            type: 'POST',
            data: formData,
            success: function (data) {
                const resp = JSON.parse(data);
                formStat = false;
                $('.spinner').css('display', 'none');
                swal("Good job!", "The files have been uploaded successfully", "success");
                $('#upload-form')[0].reset();
                $('.th-xls').html("");
                $('.tbody-xls').html("");
                setTimeout(function(){ 
                    location.reload();
                }, 2000);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).on('submit', '#edit-form', function(e) {   
        var formData = new FormData(this);        
        formStat = true;
        
        $('.spinner').css('display', 'block'); 
        e.preventDefault();                
        $.ajax({
            url:'/edit-template-files',
            type: 'POST',
            data: formData,
            success: function (data) {
                formStat = false;
                $('.spinner').css('display', 'none');
                swal("Good job!", "The parameters have been updated successfully", "success");
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).on('click', '.edit-pattern', function() {
        const id = $(this).data('id');
        
        $.get('/get-pattern', {id: id})
            .done(function(data) {
                const resp = JSON.parse(data);
                console.log(resp);
                $('.template-id').val(resp['id']);
                $('.template-edit').val(resp['name']);
                for (var i = 0; i < resp['pattern'].length; i++) {
                    $('.edit-title'+ (i+1)).val(parseInt(resp['pattern'][i]));
                }
            });
        $('.edit-template').click();
    });
    
    $(document).on('change', '.files', function() {                
        $('.th-xls').html('<th class="whitespace-nowrap border border-t-0 border-l-0 border-slate-200 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100" style="width: 3%;"></th> ');
        $('.tbody-xls').html("");
        const alphabet = 'abcdefghijklmnopqrstuvwxyz'.split('');        

        for (var i = 0; i < this.files.length; i++) {            
            let fileName = this.files[i].name;            
            $('.filename').val(fileName);              
            fileName = fileName.replace(/[0-9]/g, '');
            fileName = fileName.replace(/-/g, ' ');
            fileName = fileName.replace(/_/g, ' ');   
            fileName = fileName.replace(/.xlsx/g, '');
            let fileNameArr = fileName.split(" ");
            fileNameArr = fileNameArr.filter(function (arr) { return arr != "" });
            
            const template = fileNameArr[0]; 
            $('.template').val(template);   
            readXlsxFile(this.files[i]).then(function(rows) {                
                // create coloumn
                if (i == 1) {
                    for (var j = 0; j < rows[0].length; j++) {                        
                        $('.th-xls').append('<th class="whitespace-nowrap font-semibold text-center border border-t-0 border-slate-200 px-1 py-1 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100">'+alphabet[j]+'</th>');
                    }
                    
                }               
                // create row
                var count = 1;
                var coloumn = 1;
                const title = [];
                for (var k = 0; k < rows.length; k++) {
                    // console.log(rows[k]);            
                    totalTitle = 0;        
                    $('.tbody-xls').append('<tr>');
                    $('.tbody-xls').append('<td class="whitespace-nowrap text-center border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+ count +'</td>');
                    for (var l = 0; l < rows[k].length; l++) {
                        
                        if (rows[k][l] == null) {
                            totalTitle--;
                            $('.tbody-xls').append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500"></td>');
                        } else {
                            totalTitle++;
                            $('.tbody-xls').append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+ rows[k][l].toString().substr(0, 15)+' </td>');
                        }
                        
                    }                    
                    title.push(totalTitle);                    
                    $('.tbody-xls').append('</tr>');                    
                    count++;
                    if (k == 50) {
                        $('.tbody-xls').append('<tr>');
                        $('.tbody-xls').append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+count+'</td>');
                        $('.tbody-xls').append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">... and more</td>');
                        $('.tbody-xls').append('</tr>');
                        break;
                    }
                }
                
                const max_val = Math.max(...title);
                const titlePredict = title.indexOf(max_val);        
                const startPredict = parseInt(titlePredict) + 2;
                $.post('/sync-pattern', {search: fileNameArr})
                    .done(function(data) {
                        const resp = JSON.parse(data);                 
                        
                        if (resp['pattern_id'] != null) {
                            const pattern = resp['pattern'];
                            for (var i = 0; i < pattern.length; i++) {
                                $('.title' + (i+1)).val(pattern[i]);
                            }
                        } else {
                            $('.title-select').val("");                                                  
                        } 
                    });
                $('.title-select')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option>...</option>');
                for (var t = 0; t < rows[titlePredict].length; t++) {                    
                    if (rows[titlePredict][t] != null) {
                        $('.title-select').append('<option value="'+t+'">'+ rows[titlePredict][t] +'</option>');
                    }
                }   

                for (var c = 0; c < rows[0].length; c++) {
                    $('.title-select').append('<option value="'+c+'">Column '+ alphabet[c].toUpperCase() +'</option>');
                }                                           
            });
            
        }       
    });
    
</script>
<?= $this->endSection() ?>