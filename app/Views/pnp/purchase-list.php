<?= $this->extend('pnp/layout/component') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                Purchase List
            </h2>            
        </div>
        <div class="max-w-full">
            <table class="datatable-init2 stripe table">
                <thead>
                    <tr class="tb-tnx-head">
                        <th class="tb-tnx-id" style="width: 5%"><span class="">#</span></th>
                        <th class="tb-tnx-info">
                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                <span>Purchase Date</span>
                            </span>                                    
                        </th>
                        <th class="text-center">
                            <span>Total Item</span>
                        </th>
                        <th class="text-right">
                            <em class="icon ni ni-more-v"></em>
                        </th>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($purchLists->getResultObject() as $file) : ?>
                        <tr class="tb-tnx-item">
                            <td class="tb-tnx-id">
                                <span><?= $no++ ?></span>
                            </td>
                            <td class="tb-tnx-info">
                                <div class="tb-tnx-desc">
                                    <span class="title"><?= date('m/d/Y H:i:s', strtotime($file->purch_date)) ?></span>
                                </div>
                                
                            </td>
                            <td class="text-center">
                                <span class="fw-bold"><?= $file->purchased_item ?></span>
                            </td>
                            <td class="text-center">
                                <a href="/open-purchased-list/?date=<?= date('m-d-Y', strtotime($file->purch_date))?>" class="btn rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Open</a>
                            </td>        
                        </tr>
                    <?php endforeach; ?>
                                                
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>