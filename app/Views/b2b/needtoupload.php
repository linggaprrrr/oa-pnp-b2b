<?= $this->extend('b2b/layout/component') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="mb-1">        
        <form action="/need-to-upload/" method="GET" style="display: flex;">
        <?php csrf_field() ?>
            <div class="mr-4">
                <?php $last = date('m-d-Y', strtotime('-7 days')) ?>
                <?php $now = date('m-d-Y') ?>            
                    <label class="relative flex" style="width: 420px;">
                        <input
                        <?php if (!is_null($start)) : ?>
                            <?php if (!is_null($end)) : ?>                                    
                                x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $end ?>', '<?= $start ?>'] })"
                            <?php else : ?>
                                x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $start ?>', '<?= $start ?>'] })"
                            <?php endif ?>
                        <?php else : ?>
                            x-init="$el._x_flatpickr = flatpickr($el,{mode: 'range',dateFormat: 'm-d-Y',defaultDate: ['<?= $last ?>', '<?= $now ?>'] })"
                        <?php endif ?>
                        class="text-center form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        placeholder="Choose date..."
                        type="text"
                        name="date"
                        
                        />
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
            <div>
                <button type="submit" class="btn border border-info/30 bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">Apply</button>
            </div>
        </form>
    </div>
    
    
    <div class="card px-4 pb-2 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between" style="display: flex; ">
            <div>
                <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                    Need To Upload
                </h2> 
            </div>           
            <div>
                <?php if (date('Y-m-d') < $subscription['exp']) : ?>
                    <button disabled="" class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                        <em class="fas fa-file-excel mr-1"></em> Export
                    </button>  
                <?php else : ?>
                    <?php if (!is_null($start)) : ?>
                        <?php if (!is_null($end)) : ?>
                            <a href="/export-need-to-upload/<?= $start ?>&<?= $end ?>"  class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"><em class="fas fa-file-excel mr-1"></em> Export</a>             
                        <?php else : ?>
                            <a href="/export-need-to-upload/<?= $start ?>"  class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"><em class="fas fa-file-excel mr-1"></em> Export</a>             
                        <?php endif ?>
                    <?php else : ?>
                        <a href="/export-need-to-upload"  class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"><em class="fas fa-file-excel mr-1"></em> Export</a>             
                    <?php endif ?>
                <?php endif ?>
                
            </div>            
        </div>
        
        <hr>
        <div class="my-3 max-w-full">
            <table class="datatable-init stripe table" style="font-size: 11px; "> 
                <thead>
                    <tr class="table-warning">
                        <th class="text-center align-middle"></th>                                 
                        <th class="text-center align-middle"></th>  
                        <th class="text-center align-middle" style="width: 400px">CATEGORY</th>
                        <th class="text-center align-middle">CONDITION</th>
                        <th class="text-center align-middle"># OF UNITS</th>
                        <th class="text-center align-middle">AVG UNIT RETAIL</th>
                        <th class="text-center align-middle">TOTAL ORIGINAL RETAIL</th>
                        <th class="text-center align-middle">TOTAL CLIENT COST</th>                        
                    </tr>
                    <tr>
                        <th class="text-center align-middle"></th>                                 
                        <th class="text-center align-middle"></th>  
                        <th class="text-center align-middle" style="width: 400px">OA</th>
                        <th class="text-center align-middle">NEW</th>
                        <th class="text-center align-middle"><?= $summary['totalUnit'] ?></th>
                        <th class="text-center align-middle">$<?= number_format($summary['avgUnitRetail'], 2) ?></th>
                        <th class="text-center align-middle">$<?= number_format($summary['totalOriginalRetail'], 2) ?></th>
                        <th class="text-center align-middle">$<?= number_format($summary['totalClientCost'], 2) ?></th>                        
                    </tr> 
                    <tr class="table-warning">
                        <th class="text-center align-middle">FNSKU</th>                                 
                        <th class="text-center align-middle">ASIN</th>  
                        <th class="text-center align-middle" style="width: 400px">ITEM DESCRIPTION</th>
                        <th class="text-center align-middle">ORIGINAL QTY</th>
                        <th class="text-center align-middle">RETAIL VALUE</th>
                        <th class="text-center align-middle">TOTAL ORIGINAL RETAIL</th>
                        <th class="text-center align-middle">TOTAL CLIENT COST</th>                        
                        <th class="text-center align-middle">NOTES</th>
                    </tr>                            
                </thead>
                <tbody>                
                    <?php $client = ""; $date = ""; $count = 1;?>
                    <?php for ($i = 0; $i < count($purchased_items); $i++) : ?>                        
                        <?php if (($client == $purchased_items[$i]['order_id']) || $i == 0) : ?>
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="text" name="fnsku" placeholder="FNSKU..." class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent fnsku" data-id="<?= $purchased_items[$i]['aid'] ?>" style="font-size: 11px;" value="<?= $purchased_items[$i]['fnsku'] ?>">
                                    </td>                                            
                                    <td class="text-center align-middle"><b><?= $purchased_items[$i]['asin'] ?></b></td>                                                                                
                                    <td class="text-center align-middle">
                                        <button x-tooltip.cursor.x="'<?= str_replace("'", " ", $purchased_items[$i]['title']) ?>'">
                                            <?= substr($purchased_items[$i]['title'], 0, 120) ?><?= (strlen($purchased_items[$i]['title']) > 120) ? '..' : '' ?></td>
                                        </button>                                                                       
                                    <td class="text-center align-middle">
                                        <?= empty($purchased_items[$i]['qty_assigned']) ? '0' : $purchased_items[$i]['qty_assigned'] ?> 
                                    </td>
                                    <td class="text-center align-middle total_price_<?= $purchased_items[$i]['aid'] ?>">$<?= round($purchased_items[$i]['price'], 2) ?></td>                                    
                                    <td class="text-center align-middle total_price_<?= $purchased_items[$i]['aid'] ?>">$<?= round($purchased_items[$i]['price'] * $purchased_items[$i]['qty_assigned'], 2) ?></td>                                                                            
                                    <td class="text-center align-middle"><span class="total_buy_cost_<?= $purchased_items[$i]['aid'] ?>">$<?= round($purchased_items[$i]['qty_assigned'] * $purchased_items[$i]['buy_cost'], 2) ?></span></td>                                                                                                                                                    
                                    <td class="text-center align-middle">
                                        <input type="text" name="notes" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent assigned_notes" data-id="<?= $purchased_items[$i]['aid'] ?>" style="font-size: 11px;" value="<?= $purchased_items[$i]['assigned_notes'] ?>">
                                    </td>    
                                </tr>                             
                            <?php else : ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="grid grid-cols-2 gap-4">
                                            <label class="block">
                                                <span>FBA Number</span>
                                                <input class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent fba-number" data-id="<?= $purchased_items[$i-1]['sid'] ?>" placeholder="FBA172..." value="<?= $purchased_items[$i-1]['fba_number'] ?>" type="text">
                                            </label>

                                            <label class="block">
                                                <span>Shipment Number</span>
                                                <input class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent shipment-number" data-id="<?= $purchased_items[$i-1]['sid'] ?>" placeholder="1ZR726..." value="<?= $purchased_items[$i-1]['shipment_number'] ?>" type="text">
                                            </label>
                                        </div>                                        
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>                                    
                                    <td></td>
                                    <td class="text-center align-middle"><?= (!is_null($purchased_items[$i-1]['updated_at'])) ? date('m/d/Y', strtotime($purchased_items[$i-1]['updated_at'])) : '-' ?> </td>
                                </tr>
                                <tr>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>
                                    <td class="text-center table-success align-middle font-bold"><?= $purchased_items[$i-1]['client_name'] ?> (<?= $purchased_items[$i-1]['company'] ?>)</td>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>                                    
                                </tr>  
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="text" name="fnsku" placeholder="FNSKU..." class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent fnsku" data-id="<?= $purchased_items[$i]['aid'] ?>" style="font-size: 11px;" value="<?= $purchased_items[$i]['fnsku'] ?>">
                                    </td>                                            
                                    <td class="text-center align-middle"><b><?= $purchased_items[$i]['asin'] ?></b></td>                                                                                
                                    <td class="text-center align-middle">
                                        <button x-tooltip.cursor.x="'<?= str_replace("'", " ", $purchased_items[$i]['title']) ?>'">
                                            <?= substr($purchased_items[$i]['title'], 0, 120) ?><?= (strlen($purchased_items[$i]['title']) > 120) ? '..' : '' ?></td>
                                        </button>                                    
                                    <td class="text-center align-middle">
                                        <?= empty($purchased_items[$i]['qty_assigned']) ? '0' : $purchased_items[$i]['qty_assigned'] ?> 
                                    </td>
                                    <td class="text-center align-middle total_price_<?= $purchased_items[$i]['aid'] ?>">$<?= round($purchased_items[$i]['price'], 2) ?></td>                                    
                                    <td class="text-center align-middle total_price_<?= $purchased_items[$i]['aid'] ?>">$<?= round($purchased_items[$i]['price'] * $purchased_items[$i]['qty_assigned'], 2) ?></td>                                                                            
                                    <td class="text-center align-middle"><span class="total_buy_cost_<?= $purchased_items[$i]['aid'] ?>">$<?= round($purchased_items[$i]['qty_assigned'] * $purchased_items[$i]['buy_cost'], 2) ?></span></td>                                                                                                                                                    
                                    <td class="text-center align-middle">
                                        <input type="text" name="notes" class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent assigned_notes" data-id="<?= $purchased_items[$i]['aid'] ?>" style="font-size: 11px;" value="<?= $purchased_items[$i]['assigned_notes'] ?>">
                                    </td>    
                                </tr>                              
                            <?php endif ?>
                            <?php $client = $purchased_items[$i]['order_id'] ?>
                            <?php if ($i == count($purchased_items)-1) : ?>                                 
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="grid grid-cols-2 gap-4">
                                            <label class="block">
                                                <span>FBA Number</span>
                                                <input class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent fba-number" data-id="<?= $purchased_items[$i]['sid'] ?>" placeholder="FBA172..." value="<?= $purchased_items[$i]['fba_number'] ?>" type="text">
                                            </label>

                                            <label class="block">
                                                <span>Shipment Number</span>
                                                <input class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent shipment-number" data-id="<?= $purchased_items[$i]['sid'] ?>" placeholder="1ZR726..." value="<?= $purchased_items[$i]['shipment_number'] ?>" type="text">
                                            </label>
                                        </div>                                      
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center align-middle"><?= (!is_null($purchased_items[$i]['updated_at'])) ? date('m/d/Y', strtotime($purchased_items[$i]['updated_at'])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>
                                    <td class="text-center table-success align-middle font-bold"><?= $purchased_items[$i]['client_name'] ?> (<?= $purchased_items[$i]['company'] ?>)</td>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>
                                    <td class="table-success"></td>                                    
                                    <td class="table-success"></td>
                                </tr>                                             
                            <?php endif ?>
                    <?php endfor ?>                                   
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).on('input propertychange', '.fnsku', function(data) {            
            const item = $(this).data('id');
            const fnsku = $(this).val();

            $.post('/save-fnsku', {item: item, fnsku: fnsku})
                .done(function(data) {
                    
                });
        });

        $(document).on('input propertychange', '.vendor', function(data) {            
            const item = $(this).data('id');
            const vendor = $(this).val();

            $.post('/save-vendor-name', {item: item, vendor: vendor})
                .done(function(data) {
                    
                });
        });

        $(document).on('input propertychange', '.fba-number', function(data) {            
            const item = $(this).data('id');
            const number = $(this).val();

            $.post('/save-fba-number', {item: item, number: number})
                .done(function(data) {
                    
                });
        });

        $(document).on('input propertychange', '.shipment-number', function(data) {            
            const item = $(this).data('id');
            const number = $(this).val();

            $.post('/save-shipment-number', {item: item, number: number})
                .done(function(data) {
                    
                });
        });
        $(document).on('input propertychange', '.assigned_notes', function(data) {            
            const item = $(this).data('id');
            const notes = $(this).val();            

            $.post('/save-assigned-notes', {item: item, notes: notes})
                .done(function(data) {
                    
                });
        });

        $(".upload-form").on('submit', function(e){            
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/upload-upc-files',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(response){   
                    $("#link").attr('href', "/files/" + response['file'])                                     
                    $("#link").trigger('click');
                    $('.spinner').hide(); 
                    
                    window.location.href =  "/files/" + response['file'];
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 2000);
                },
                error: function (request, status, error) {                                        
                    $('.spinner').hide();    
                    
                }
            });                
        });
        <?php 
            if (isset($_GET['date'])) {
                ?>                
                swal("Data Information", "You are viewing data on <?= $_GET['date'] ?>", "info");
                <?php 
            }            
        ?>
</script>
<?= $this->endSection() ?>