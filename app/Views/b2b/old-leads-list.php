<?= $this->extend('layout/component') ?>
<?php 

// dd(str_contains(strtolower("[BUNDLE] Bath & Body Works Aromatherapy Energy - O"), 'bundle'));
?>
<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
            Upload File
            </h2>   
        </div>
        <hr>
        <div class="my-3  max-w-full">
            <div class="flex justify-between">                
                <div x-data="{showModal:false}">
                    <button
                        @click="showModal = true"
                        class="btn bg-primary font-medium text-white shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90"
                        > Upload File
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
                                Upload File
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
                                    <input class="files block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="leads[]" type="file" multiple required>                                                            
                                </div>
                                <hr>
                                <div style="overflow: auto; max-height: 640px">
                                    <div class="first-file" style="display: none;">
                                        <div class="flex justify-between mx-5 my-2 text-sm text-gray-500 dark:text-gray-300">
                                            <div style="align-self: center;">
                                                <div class="avatar h-5 w-5 mr-2">
                                                    <div class="is-initial rounded-full bg-error text-sm uppercase text-white">1</div>
                                                </div>
                                                Data Preview: &nbsp <span class="file-name-1"></span>
                                                <div class="warning-msg-1" style="display: none;"> 
                                                    <div class="skeleton animate-wave badge space-x-2.5 rounded-full bg-error/10 text-error dark:bg-error/15"> 
                                                        <div class="animate-bounce h-2 w-2 rounded-full bg-current"></div>
                                                        <span>Error: Can't find any template/source for this file. Please go to File Parameter</span> 
                                                    </div>
                                                </div>  
                                            </div> 
                                            <div class="flex items-center">
                                                <span class="mx-2">Source Detected as:</span>
                                                <span class="relative flex">
                                                    <select style="width: 160px; font-size: 12px" name="alias-name[]" data-id="0" class="alias alias-1 text-right form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-2 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option>-</option>
                                                    </select>
                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                        <i class="fas fa-file-signature text-base"></i>
                                                    </span>
                                                </span>
                                                
                                            </div>                                    
                                        </div>                            
                                        <div class="min-w-full overflow-x-auto">                                                                                                       
                                            <div class="mx-5 my-2" style="max-height: 120px;">                                        
                                                <div class="min-w-full overflow-x-auto rounded-lg border border-slate-200 dark:border-navy-500">
                                                    <table class="w-full text-left" style="font-size: 10px">
                                                        <thead>
                                                            <tr class="th-xls-1">
                                                                <th class="whitespace-nowrap border border-t-0 border-l-0 border-slate-200 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100" style="width: 3%;"></th>                        
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbody-xls-1">                                      
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>                                                                                     
                                        </div>   
                                        <div class="flex justify-between items-center p-2 mx-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">                                                                            
                                            <input type="hidden" name="keyword[]" class="keyword-1">
                                            <div class="flex items-center" style="margin: 0">
                                                <span class="mx-2">Sheet Name:</span>
                                                <span class="relative flex">
                                                    <select 
                                                        style="width: 160px; font-size: 12px"
                                                        name="sheet-name[]" 
                                                        data-id="test"
                                                        class="sheet-list sheet-list-1 text-right form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-2 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">                                                        
                                                    </select>                                                    
                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                        <i class="far fa-file-excel text-base"></i>
                                                    </span>
                                                </span>
                                                <span class="mx-2">Store data starting from row:</span>
                                                <span class="relative flex">
                                                    <input type="number"   
                                                        name="start[]"     
                                                        data-id="0"                                     
                                                        class="start-row-1 start text-right form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-2 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                        autocomplete="off" required>    
                                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                        <i class="fas fa-list-ol text-base"></i>
                                                    </span>
                                                </span>                                                                                          
                                            </div>                                                               
                                        </div>
                                    </div>                                 
                                    <div class="more-file">                          
                                    </div>
                                    <div class="end-file">

                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center p-2 mx-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">                                                                               
                                    <div style="width: -webkit-fill-available;">
                                        <div class="progress-bar" style="display: none;">                                        
                                        
                                        </div>
                                    </div>
                                    <div style="flex: none;">
                                        <button type="button" class="btn bg-slate-150 shadow-lg shadow-slate/50 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 reset-btn">                                                                      
                                            Reset
                                        </button>
                                        <button type="button" class="upload-btn btn bg-primary font-medium text-white shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90">
                                            <div class="spinner h-4 w-4 mr-2 animate-spin text-slate-100 dark:text-navy-300" style="display: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 28 28">
                                                    <path fill="currentColor" fill-rule="evenodd" d="M28 14c0 7.732-6.268 14-14 14S0 21.732 0 14 6.268 0 14 0s14 6.268 14 14zm-2.764.005c0 6.185-5.014 11.2-11.2 11.2-6.185 0-11.2-5.015-11.2-11.2 0-6.186 5.015-11.2 11.2-11.2 6.186 0 11.2 5.014 11.2 11.2zM8.4 16.8a2.8 2.8 0 100-5.6 2.8 2.8 0 000 5.6z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>                                        
                                            Upload
                                        </button>
                                    </div>                                    
                                </div> 
                                <hr>
                                <div class="mx-3 px-2 pt-2 data-upload" style="display: none;">
                                    <div>
                                        Data Uploaded: <span class="font-semibold total-uploaded"></span>
                                        <br>
                                        Data Failed/Error: <span class="font-semibold font-error total-error"></span>
                                        <div>
                                    </div>
                                    <div x-data="{showModal:false}" class="error-details-modal" style="display: none;">                                        
                                        <button type="button" @click="showModal = true" class="btn h-6 rounded px-3 mt-2 border-warning/30 bg-warning/10 text-xs font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                            <i class="fas fa-clipboard-list mr-2"></i>
                                            Show Details
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
                                                class="relative w-full max-w-2xl origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"
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
                                                    Erorr Details
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
                                                <div class="min-w-full overflow-x-auto" style="max-height: 720px;">
                                                    <table class="w-full text-left">
                                                        <thead>
                                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">                                                                
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    Row
                                                                </th>
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    ASIN
                                                                </th>
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    Status
                                                                </th>
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    Status Message
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="error-details-tbody">                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </form>
                        </div>                
                    </template>                    
                </div>
                
            </div>
            <div style="margin-top: 2rem">
                <table class="table stripe datatable-init">
                    <thead>
                        <tr class="tb-tnx-head">
                            <th class="tb-tnx-id"><span class="">#</span></th>
                            <th class="tb-tnx-info">Upload Date</th>
                            <th class="tb-tnx-info">Lead List</th>
                            <!-- <th class="tb-tnx-info">Download Result</th> -->
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($historyUpload->getResultObject() as $file) : ?>
                            <tr class="tb-tnx-item border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="tb-tnx-id">
                                    <span><?= $no++ ?></span>
                                </td>
                                <td class="tb-tnx-info"><span class="title"><?= date('m/d/Y H:m:s', strtotime($file->created_at)) ?></span></td>
                                <td class="tb-tnx-info"><span class="date"><a href="/files/<?= $file->filename ?>" download><?= $file->filename ?></a></span></td>                                
                                <!-- <td class="tb-tnx-info text-center">
                                    <a href="/download-file/<?= $file->file_id ?>"  class="btn h-9 w-9 border border-warning/30 bg-warning/10 p-0 font-medium text-warning hover:bg-warning/20 hover:shadow-lg hover:shadow-warning/50 focus:bg-warning/20 focus:shadow-lg focus:shadow-warning/50 active:bg-warning/25">
                                        <i class="fa-solid fas fa-cloud-download-alt text-base"></i>
                                    </a>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                        
                        
                    </tbody>
                </table>        
            </div>
        </div>
        
        
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script type="module" src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
<script type="module">

    let files = [];
    let keywords = [];
    let keywordIds = [];
    let sourceName = [];
    let fileNames = [];    
    let products = [];
    let start = [];
    let start2 = [];
    let totalRows = 0;
    let rowEntry = [];

    var totalUpload = 0;
    var totalError = 0;
    

    export default function readSheetNames(file) {
        return readXlsxFile(file, { getSheets: true })
            .then(sheets => sheets.map(sheet => sheet.name))
    }

    let formStat = false;
    window.addEventListener("beforeunload", function (ev) {
        var confirmationMessage = 'It looks like you have been editing something. '
                                + 'If you leave before saving, your changes will be lost.';

        if (formStat == true) {
            (ev || window.event).returnValue = confirmationMessage; //Gecko + IE
            return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
        }
                                
    });
    
    $(document).on('click', '.reset-btn', function(e) {
        swal({
            title: "Are you sure?",
            text: "All data will be reset",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $('#upload-form')[0].reset();
                $('.first-file').css('display', 'none');
                $('.th-xls-1').html("");
                $('.tbody-xls-1').html("");
                $('.more-file').html("");
                $('.warning-msg-1').css('display', 'none');  

                $('.total-uploaded').html('-');
                $('.total-error').html('-');            

                files = [];
                keywords = [];
                keywordIds = [];
                sourceName = [];
                fileNames = [];    
                products = [];
                start = [];
                start2 = [];
                totalRows = 0;
                rowEntry = [];

                totalUpload = 0;
                totalError = 0;
            } else {
                
            }
        });
    })

    $(document).on('submit', '#upload-asin-form', function(e) {   
        var formData = new FormData(this);        
        formStat = true;
        
        $('.spinner').css('display', 'block'); 
        e.preventDefault();                
        $.ajax({
            url:'/upload-asin-file',
            type: 'POST',
            data: formData,
            success: function (data) {
                const resp = JSON.parse(data);
                formStat = false;
                $('.spinner').css('display', 'none');
                swal("Good job!", "The files have been uploaded successfully", "success");
                $('#upload-asin-form')[0].reset();
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    
    
    $(document).on('change', '.sheet-list', function() {
        const sheetName = $(this).val();
        const id = $(this).data('id');
        const alphabet = 'abcdefghijklmnopqrstuvwxyz'.split(''); 
        let keywordList = [];                
        var counter = 1;
        $('.th-xls-' + (id+1)).html('');
        $('.tbody-xls-' + (id+1)).html('');
        
        
        readXlsxFile(files[id], {sheet: sheetName}).then(function(rows) {                    
            // create coloumn
            products[id] = rows;
            for (var j = 0; j < rows[0].length; j++) {                        
                $('.th-xls-'+ (id+1) ).append('<th class="whitespace-nowrap font-semibold text-center border border-t-0 border-slate-200 px-1 py-1 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100">'+alphabet[j]+'</th>');
            }                                            
            // create row
            var count = 1;
            var coloumn = 1;
            const title = [];
            for (var k = 0; k < rows.length; k++) {
                // console.log(rows[k]);            
                var totalTitle = 0;        
                $('.tbody-xls-'+ (id+1) ).append('<tr>');
                $('.tbody-xls-'+ (id+1) ).append('<td class="whitespace-nowrap text-center border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+ count +'</td>');
                for (var l = 0; l < rows[k].length; l++) {
                    if (rows[k][l] == null) {
                        totalTitle--;
                        $('.tbody-xls-'+ (id+1) ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500"></td>');
                    } else {
                        totalTitle++;
                        $('.tbody-xls-'+ (id+1) ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+ rows[k][l].toString().substr(0, 15)+' </td>');
                    }
                    
                }                    
                title.push(totalTitle);                    
                $('.tbody-xls-'+ (id+1) ).append('</tr>');                    
                count++;
                if (k == 50) {
                    $('.tbody-xls-'+ (id+1) ).append('<tr>');
                    $('.tbody-xls-'+ (id+1) ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+count+'</td>');
                    $('.tbody-xls-'+ (id+1) ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">... and more</td>');
                    $('.tbody-xls-'+ (id+1) ).append('</tr>');
                    break;
                }
            }

            const max_val = Math.max(...title);
            const titlePredict = title.indexOf(max_val);        
            const startPredict = parseInt(titlePredict) + 2;            
            $('.start-row-'+ (id+1)  ).val(startPredict);    
            $('.start2-row-'+ (id+1)  ).val('');    
            start.push(startPredict-1);
            start2.push(0);
            console.log(products);
        });
    });

    $(document).on('change', '.start', function() {
        const id = $(this).data('id');        
        start[id] = parseInt($(this).val());        
    });

    $(document).on('change', '.start2', function() {
        const id = $(this).data('id');        
        start2[id] = parseInt($(this).val());
    });

    $(document).on('change', '.files', function() {        
        files = [];
        keywords = [];
        keywordIds = [];
        sourceName = [];
        fileNames = [];    
        products = [];
        start = [];
        start2 = [];

        let totalRows = 0;        
        const alphabet = 'abcdefghijklmnopqrstuvwxyz'.split(''); 
        let keywordList = [];
        
        if (this.files.length > 20) {
            swal("warning!", "You are only allowed to upload a maximum of 20 files", "warning");
            $('#upload-form')[0].reset();
            $('.first-file').css('display', 'none');
            $('.th-xls-1').html("");
            $('.tbody-xls-1').html("");
            $('.more-file').html("");
        } else {
            $('.first-file').css('display', 'block');
            var fileNumb = 1;
            var fileError = false;
            for (var i = 0; i < this.files.length; i++) {     
                rowEntry = [];
                files.push(this.files[i]); 
                var fileData = new FormData();
                fileData.append('file', this.files[i]); 
                let fileName = this.files[i].name;                
                $.ajax({
                    url: "/read-excel",
                    type: "post",
                    data: fileData,
                    async: false,
                    processData: false,
                    contentType: false,
                    success : function(data) {
                        // console.log(data);
                        const resp = JSON.parse(data);
                        for (var i = 0; i < resp.length; i++) {
                            rowEntry.push(resp[i]);
                        }
                        console.log(rowEntry);
                        products.push(rowEntry);
                    },
                    error: function(e) {
                        swal('Warning', 'This file doesn\'t converted properly. File: '+ fileName, 'warning');
                        fileError = true;
                    }
                });   

                fileNames.push(fileName);        
                $('.file-name-'+ (i+1)).html(fileName);  
                
                fileName = fileName.replace(/.xlsx/g, '');
                let fileNameArr = fileName.split(" ");
                fileNameArr = fileNameArr.filter(function (arr) { return arr != "" });
                const template = fileNameArr[0]; 
                $('.template').val(template);   
                var counter = 1;
                var warningCount = 1;
                            
                readSheetNames(this.files[i]).then((sheetNames) => {
                    for (var s = 0; s < sheetNames.length; s++) {                        
                        $('.sheet-list-' + fileNumb).append('<option value="'+ sheetNames[s] +'">'+ sheetNames[s] +'</option>');
                    }

                    $('.sheet-list-' + fileNumb).attr('data-id', (fileNumb-1));
                    
                    fileNumb++;
                })
                readXlsxFile(this.files[i]).then(function(rows) {                                        
                    if (fileError == true) {
                        products.push(rows);
                        fileError = false;
                        console.log(rows);
                    }
                    for (var j = 0; j < rows[0].length; j++) {                        
                        $('.th-xls-'+ counter ).append('<th class="whitespace-nowrap font-semibold text-center border border-t-0 border-slate-200 px-1 py-1 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100">'+alphabet[j]+'</th>');
                    }                                        
                    // create row
                    var count = 1;
                    var coloumn = 1;
                    const title = [];          
                    totalRows = totalRows + rows.length;
                    for (var k = 0; k < rows.length; k++) {
                        // console.log(rows[k]);                                     
                        var totalTitle = 0;        
                        $('.tbody-xls-'+ counter ).append('<tr>');
                        $('.tbody-xls-'+ counter ).append('<td class="whitespace-nowrap text-center border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+ count +'</td>');
                        for (var l = 0; l < rows[k].length; l++) {
                            
                            if (rows[k][l] == null) {
                                totalTitle--;
                                $('.tbody-xls-'+ counter ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500"></td>');
                            } else {
                                totalTitle++;
                                $('.tbody-xls-'+ counter ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+ rows[k][l].toString().substr(0, 15)+' </td>');
                            }
                            
                        }                    
                        title.push(totalTitle);                    
                        $('.tbody-xls-'+ counter ).append('</tr>');                    
                        count++;
                        if (k == 50) {
                            $('.tbody-xls-'+ counter ).append('<tr>');
                            $('.tbody-xls-'+ counter ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">'+count+'</td>');
                            $('.tbody-xls-'+ counter ).append('<td class="whitespace-nowrap text-left border border-l-0 border-slate-200 px-1 py-1 dark:border-navy-500">... and more</td>');
                            $('.tbody-xls-'+ counter ).append('</tr>');  
                            break;                          
                        }
                    }                    
                    const max_val = Math.max(...title);
                    const titlePredict = title.indexOf(max_val);        
                    const startPredict = parseInt(titlePredict) + 2;
                    // keywords.push(fileNameArr);
                    $('.keyword-'+ (counter)).val(fileNameArr);                                        
                    $('.start-row-'+ counter  ).val(startPredict);    
                    counter++;  
                    fileNameArr = fileNameArr.join();
                    start.push(startPredict-1);
                    start2.push(0);
                });
                
                keywordList.push(fileName);
                // create data privew and table
                
                if (i >= 1) {
                    $('.more-file').append('<div class="my-2 flex items-center space-x-3"> <div class="h-px flex-1 bg-error dark:bg-navy-500"></div><i class="fas fa-file-medical text-error"></i> <div class="h-px flex-1 bg-error dark:bg-navy-500"></div></div>');
                    $('.more-file').append('<div class="flex justify-between mx-5 my-2 text-sm text-gray-500 dark:text-gray-300"> <div style="align-self: center;"> <div class="avatar h-5 w-5 mr-2"> <div class="is-initial rounded-full bg-error text-sm uppercase text-white"> '+ (i+1) +' </div></div>Data Preview: &nbsp<span class="file-name-'+ (i+1) +'">'+ this.files[i].name +'</span> <div class="warning-msg-'+ (i+1) +'" style="display: none"> <div class="mx-2 skeleton animate-wave badge space-x-2.5 rounded-full bg-error/10 text-error dark:bg-error/15"> <div class="animate-bounce h-2 w-2 rounded-full bg-current"></div><span>Error: Cant find any template/source for this file. Please go to File Parameter</span> </div></div></div><div class="flex items-center"> <span class="mx-2">Source Detected as:</span> <span class="relative flex"> <select style="width: 160px; font-size: 12px" name="alias-name[]" data-id="'+ (i+1) +'" class="alias alias-'+ (i+1) +' text-right form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-2 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"> <option>-</option> </select> <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"> <i class="fas fa-file-signature text-base"></i> </span> </span> </div></div>');
                    $('.more-file').append('<div class="min-w-full overflow-x-auto"><div class="mx-5 my-2" style="max-height:120px"><div class="min-w-full overflow-x-auto rounded-lg border border-slate-200 dark:border-navy-500"><table class="w-full text-left" style="font-size:10px"><thead><tr class="th-xls-'+ (i+1) +'"><th class="whitespace-nowrap border border-t-0 border-l-0 border-slate-200 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100" style="width:3%"></th></tr></thead><tbody class="tbody-xls-'+ (i+1) +'"></tbody></table></div></div></div>');
                    $('.more-file').append('<div class="flex justify-between items-center p-2 mx-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"> <div class="flex items-center"> <input type="hidden" name="keyword[]" class="keyword-'+ (i+1) +'"> <span class="mx-2">Sheet Name:</span><span class="relative flex"><select style="width:160px;font-size:12px" name="sheet-name[]" data-id="test2" class="sheet-list sheet-list-'+ (i+1) +' text-right form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-2 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></select><span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"><i class="far fa-file-excel text-base"></i></span></span><span class="mx-2">Store data starting from row:</span> <span class="relative flex"> <input type="number" name="start[]" data-id="'+ i +'" class="start-row-'+ (i+1) +' start text-right form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-2 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" autocomplete="off" required> <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"> <i class="fas fa-list-ol text-base"></i> </span> </span>  </div></div>');
                }
            }    
            
        }          
        
        
        $.ajax({
            url: '/sync-pattern',
            type: 'post',
            data: {search: keywordList},            
            success : function(data) {
                const resp = JSON.parse(data);
                for (var i = 0; i < resp.length; i++) {
                    $('.alias-' + (i+1)).html('');
                    for (var j = 0; j < resp[i].length; j++) {
                        $('.alias-' + (i+1)).append('<option value="'+ resp[i][j]['id'] +'">'+ resp[i][j]['source'] +'</option>');
                        // if (resp[i]['pattern_id'] == null) {                            
                        //     $('.warning-msg-' + (i+1)).css('display', 'block');                        
                        // }
                        // keywords[i] = resp[i]['pattern'];                    
                        keywordIds[i] = resp[i][j]['id'];
                        sourceName[i] = resp[i][j]['source'];
                    }    
                }
            },
            error: function(e) {
                console.log(e);
            }
        });   

        
        (function($) {
            // jQuery on an empty object, we are going to use this as our Queue
            var ajaxQueue = $({});
            $.ajaxQueue = function( ajaxOpts ) {
                var jqXHR,
                    dfd = $.Deferred(),
                    promise = dfd.promise();

                // queue our ajax request
                ajaxQueue.queue( doRequest );

                // add the abort method
                promise.abort = function( statusText ) {

                    // proxy abort to the jqXHR if it is active
                    if ( jqXHR ) {
                        return jqXHR.abort( statusText );
                    }

                    // if there wasn't already a jqXHR we need to remove from queue
                    var queue = ajaxQueue.queue(),
                        index = $.inArray( doRequest, queue );

                    if ( index > -1 ) {
                        queue.splice( index, 1 );
                    }

                    // and then reject the deferred
                    dfd.rejectWith( ajaxOpts.context || ajaxOpts,
                        [ promise, statusText, "" ] );

                    return promise;
                };

                // run the actual query
                function doRequest( next ) {
                    jqXHR = $.ajax( ajaxOpts )
                        .then( next, next )
                        .done( dfd.resolve )
                        .fail( dfd.reject );
                }

                return promise;
            };
        })(jQuery);

    
        
        
        $(document).on('click', '.upload-btn', function(e) {
            $('.progress-bar').html('');
            $('.spinner').css('display', 'block'); 
            $('.progress-bar').css('display', 'block');            
            $('.progress-bar').css('display', 'contents');
            $('.progress-bar').append('<div class="progress h-2 bg-slate-150 dark:bg-navy-500"><div class="progress-bar-inside is-indeterminate relative w-4/12 rounded-full bg-slate-500 dark:bg-navy-400"></div></div>');
            $('.data-upload').css('display', 'block');            
            $('.total-uploaded').html('...');
            $('.total-error').html('...');            

            var callCounter1 = 0;
            var callCounter2 = 0;
            var totalCurrProduct = 0;
            
            if (fileNames.length > 0) {
                setTimeout(function(){
                    for (var i = 0; i < fileNames.length; i++) {                    
                        let fileId = 0;
                        let pattern = [];
                        $.ajax({
                            url: "/upload-file",
                            type: "post",
                            data: {file: fileNames[i], pattern_id: keywordIds[i]},
                            async: false,
                            success : function(data) {
                                const resp = JSON.parse(data);
                                fileId = resp['file_id'];
                                pattern = resp['pattern'];                                                        
                            },
                            error: function(e) {
                                console.log(e);                            
                            }
                        });                           
                        var next = false;    
                                        
                        for (var j = start[i]; j < products[i].length; j++) {                                                                                                                               
                            if ((products[i][j][pattern[1]] != null)) {                        
                                if (!products[i][j][pattern[1]].includes('asin') && !products[i][j][pattern[1]].includes('ASIN')) {
                                    totalCurrProduct++;
                                    $.ajaxQueue({
                                        url: "/upload-data",
                                        type: "post",
                                        data: {keyword: pattern, product: products[i][j], file_id: fileId, source: sourceName[i], row: j},                                           
                                        success : function(data) {                                                                 
                                            const resp = JSON.parse(data);                                        
                                            if (resp['status'] == '429') {
                                                totalError = totalError + 1; 
                                                $('.total-error').html(totalError);
                                                $('.error-details-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"><td class="whitespace-nowrap px-3 py-3">'+ (parseInt(resp['row']) + 1) +'</td><td class="whitespace-nowrap px-3 py-3">'+ resp['asin'] +'</td><td class="whitespace-nowrap px-3 py-3"><div class="badge space-x-2.5 rounded-full bg-error/10 text-error dark:bg-error/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>Error</span></div></td><td class="whitespace-nowrap px-3 py-3 text-sm">'+resp['message']+'</td></tr>');
                                                $('.error-details-modal').css('display', 'block');
                                                totalCurrProduct--;
                                                callCounter2--;
                                            } else if(resp['status'] == '400' || resp['status'] == '204') {
                                                totalError = totalError + 1; 
                                                $('.total-error').html(totalError);
                                                $('.error-details-tbody').append('<tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"><td class="whitespace-nowrap px-3 py-3">'+ (parseInt(resp['row']) + 1) +'</td><td class="whitespace-nowrap px-3 py-3">'+ resp['asin'] +'</td><td class="whitespace-nowrap px-3 py-3"><div class="badge space-x-2.5 rounded-full bg-warning/10 text-warning dark:bg-warning/15"><div class="h-2 w-2 rounded-full bg-current"></div><span>Failed</span></div></td><td class="whitespace-nowrap px-3 py-3 text-sm">'+resp['message']+'</td></tr>');
                                                $('.error-details-modal').css('display', 'block');
                                                totalCurrProduct--;
                                                callCounter2--;
                                            } else {
                                                totalUpload = totalUpload + 1; 
                                                callCounter2++; 
                                                $('.total-uploaded').html(totalUpload);
                                            }
                                            
                                            console.log(callCounter2);
                                            console.log(totalCurrProduct);          
                                            if ((callCounter2 >= totalCurrProduct)) {
                                                $('.progress-bar-inside').removeClass('w-4/12');
                                                $('.progress-bar-inside').removeClass('is-indeterminate');
                                                $('.progress-bar-inside').css({                
                                                    width: "100%"                    
                                                });
                                                $('.spinner').css('display', 'none'); 
                                                swal("Good job!", "All Data have been uploaded completely, please refresh the page", "success");
                                            }
                                        },
                                        error: function(e) {
                                            console.log(e);
                                            callCounter2++;
                                        }
                                    });    
                                }                  
                            }                         
                        }
                        
                    }
                }, 1000);
            } else {
                $('.progress-bar-inside').removeClass('w-4/12');
                $('.progress-bar-inside').removeClass('is-indeterminate');
                $('.progress-bar-inside').css({                
                    width: "100%"                    
                });
                $('.spinner').css('display', 'none'); 
                swal("Alert!", "Please upload your file first", "warning");
            }
            
        });

        

        $(document).on('change', '.alias', function(e) {
            const id = $(this).data('id');
            const sourceId = $(this).val();
            keywordIds[id] = sourceId;
            sourceName[id] = sourceId;
        });

        
        
    });        
</script>
<?= $this->endSection() ?>