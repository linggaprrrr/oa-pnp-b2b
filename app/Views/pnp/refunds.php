<?= $this->extend('pnp/layout/component') ?>
<?= $this->section('content') ?>
<div class="justify-between" style="display: flex;">
<div class="mb-1">        
        <form action="/pnp/refunds/" method="GET" style="display: flex;">
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
</div>   
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-2 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between flex">
            <div>
                <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                    Refunds Page
                </h2>   
            </div>         
            <div>
                <?php if (!is_null($start)) : ?>
                    <?php if (!is_null($end)) : ?>
                        <a href="/pnp/export-refunds/<?= $start ?>&<?= $end ?>" class="btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90"><em class="fas fa-file-pdf mr-1"></em> Export</a>           
                    <?php else : ?>
                        <a href="/pnp/export-refunds/<?= $start ?>" class="btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90"><em class="fas fa-file-pdf mr-1"></em> Export</a>           
                    <?php endif ?>
                <?php else : ?>
                    <a href="/pnp/export-refunds" class="btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90"><em class="fas fa-file-pdf mr-1"></em> Export</a>             
                <?php endif ?>
                    
                </div>   
        </div>
        <hr>
        <div class="my-3 max-w-full">
            <table class="datatable-init stripe table" style="font-size: 11px; "> 
                <thead>
                    <tr>
                        <th class="text-center">Purchase Date</th>                                                         
                        <th class="text-left" style="width: 20%">Item Description</th>         
                        <th class="text-center">ASIN</th>                                           
                        <th class="text-center" style="width: 5%">Total Returned</th>                                                                    
                        <th class="text-center">Shipping Cost</th>
                        <th class="text-center">Notes</th>
                    </tr>
                </thead>
                <tbody>                     
                    <?php foreach($items->getResultObject() as $item) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= date('m/d/Y H:i:s', strtotime($item->purchased_date)) ?></td>
                            <td class="text-left align-middle"><?= $item->title ?></td>
                            <td class="text-center align-middle"><?= $item->asin ?></td>
                            <td class="text-center align-middle"><?= $item->qty_returned ?></td>
                            <td class="text-center align-middle">
                                <input type="text" data-id="<?= $item->id ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  class="form-input shipping-cost w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" value="<?= $item->shipping_cost ?>">
                            </td>
                            <td class="text-center align-middle">
                                <input type="text" data-id="<?= $item->id ?>" class="form-input shipping-note w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" value=" <?= $item->shipping_notes ?>">
                            </td>
                        </tr>
                    <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    let inputTimer;
    $(document).on("input propertychange", ".shipping-cost", function() {
        const id = $(this).data('id');
        const cost = $(this).val();
        clearTimeout(inputTimer);
        // Set a new timer to execute after 500 milliseconds (adjust as needed)
        inputTimer = setTimeout(function() {
            $.post('/update-shipping-cost', {id: id, cost: cost})
                .done(function (data) {

                })
            
        }, 200);
    })

    $(document).on("input propertychange", ".shipping-note", function() {
        const id = $(this).data('id');
        const notes = $(this).val();
        clearTimeout(inputTimer);
        // Set a new timer to execute after 500 milliseconds (adjust as needed)
        inputTimer = setTimeout(function() {
            $.post('/update-shipping-notes', {id: id, notes: notes})
                .done(function (data) {

                })
            
        }, 500);
    })
</script>
<?= $this->endSection() ?>

