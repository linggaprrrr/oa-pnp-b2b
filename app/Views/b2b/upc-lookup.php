<?= $this->extend('layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
            UPC Lookup
            </h2>            
        </div>

        <div class="max-w-full">
            <div class="mb-1" x-data="{showModal:false}">
                <button @click="showModal = true" class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                Upload File
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
                            Upload File
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
                            <form class="upload-form" enctype="multipart/form-data">
                                <?php csrf_field() ?>      
                                <div class="mt-4 grid grid-cols-1 gap-4">                           
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">List Of UPC File</label>
                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="upc_file" type="file">                                    
                                    <div class="spinner is-elastic h-7 w-7 animate-spin rounded-full border-[3px] border-slate-500 border-r-transparent dark:border-navy-300 dark:border-r-transparent" style="justify-self: center; display: none"></div>                                      
                                        <div class="text-sm text-gray-500 dark:text-gray-300" style="color: transparent" id="user_avatar_help">Obcaecati mollitia ut voluptates possimus est nulla dolorum natus praesentium?.</div>
                                    </div>
                                <div class="mt-4 text-right">
                                    <button
                                    @click="showModal = false"
                                    class="btn h-8 rounded-full text-xs+ font-medium text-slate-700 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25"
                                    >
                                    Cancel
                                    </button>
                                    <button
                                    type="submit"
                                    class="btn-submit btn h-8 rounded-full bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                    >
                                    Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </template>
            </div>  
            <div style="margin-top: 2rem">
                   
            </div>
        </div>
        
    </div>
    <div class="card px-4 pb-4 sm:px-5">
            <div class="max-w-full my-3">
                <table class="table stripe datatable-init2">
                    <thead>
                        <tr class="tb-tnx-head">
                            <th class="tb-tnx-id" style="width: 5%; text-align: center">#</th>
                            <th class="tb-tnx-info">Upload Date</th>
                            <th class="tb-tnx-info">Uploaded File</th>
                            <th class="tb-tnx-info">Generated File</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($logUPCLookup->getResultObject() as $file) : ?>
                            <tr class="tb-tnx-item border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="tb-tnx-id text-center">
                                    <span><?= $no++ ?></span>
                                </td>
                                <td class="tb-tnx-info"><span class="title"><?= date('d M, Y H:i:s', strtotime($file->date)) ?></span></td>
                                <td class="tb-tnx-info"><span class="date"><a href="/files/<?= $file->file_upload ?>" download><i class="fas fa-file-download mr-1"></i><?= $file->file_upload ?></a></span></td>
                                <td class="tb-tnx-info"><span class="date"><a href="/files/<?= $file->file_download ?>" download><i class="fas fa-file-download mr-1"></i><?= $file->file_download ?></a></span></td>                            
                                
                            </tr><!-- .tb-tnx-item -->
                        <?php endforeach; ?>
                        
                        
                    </tbody>
                </table>     
            </div>
        </div>
</div>
<?= $this->endSection() ?>
