<?= $this->extend('admin/layout/component') ?>

<?= $this->section('content') ?>
<?php 
    use function App\Helpers\timeSpan;
    helper('time');
?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                User Activity
            </h2>            
        </div>
        <div class="max-w-full">
            <ol class="mt-4 timeline line-space px-4 [--size:1.5rem] sm:px-5">                
            <?php if ($logs->getNumRows() > 0) : ?>
                <?php $number = 1; ?>
                <?php foreach($logs->getResultObject() as $log) : ?>
                    <li class="timeline-item">
                        <?php switch($log->title) : 
                            case 'login' :
                                    ?>
                                        <div class="timeline-item-point rounded-full border border-current bg-white text-success dark:bg-navy-700">
                                            <i class="fas fa-sign-in-alt text-tiny"></i>
                                        </div>
                                    <?php
                                break;
                            case 'upload-file' :
                                    ?>
                                        <div class="timeline-item-point rounded-full border border-current bg-white text-info dark:bg-navy-700">
                                            <i class="fas fa-file-upload text-tiny"></i>
                                        </div>
                                    <?php
                                break;
                            case 'upload-asin' :
                                    ?>
                                        <div class="timeline-item-point rounded-full border border-current bg-white text-secondary dark:bg-navy-700">
                                            <i class="fas fa-file-upload text-tiny"></i>
                                        </div>
                                    <?php
                                break;
                            case 'purchase-item' :
                                    ?>
                                        <div class="timeline-item-point rounded-full border border-current bg-white text-error dark:bg-navy-700">
                                            <i class="fas fa-box text-tiny"></i>
                                        </div>
                                    <?php
                                break;
                            case 'assignments' :
                                    ?>
                                        <div class="timeline-item-point rounded-full border border-current bg-white text-success dark:bg-navy-700">
                                            <i class="fas fa-file-import text-tiny"></i>
                                        </div>
                                    <?php
                                break;
                            case 'create-ntu' :
                                    ?>
                                        <div class="timeline-item-point rounded-full border border-current bg-white text-success dark:bg-navy-700">
                                            <i class="fas fa-file-alt text-tiny"></i>
                                        </div>
                                    <?php
                                break;
                            ?>
                            
                        <?php endswitch ?>                        
                        <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                            <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                                <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                                <?= strtoupper($log->title) ?>
                                </p>
                                <span class="text-xs text-slate-400 dark:text-navy-300"><?= timeSpan(strtotime($log->created_at)) ?> ago</span>
                            </div>
                            <p class="py-1"><?= $log->description ?></p>  
                            <?php if (!empty($log->items) || !is_null($log->items)) : ?>                    
                                <div>
                                    <p class="text-xs text-slate-400 dark:text-navy-300">
                                    ASIN:
                                    </p>
                                    <div class="flex text-xs">
                                        <?= substr($log->items, 0, 120) ?><?= (strlen($log->items) > 120) ? '...' : '' ?>                                                
                                    </div>
                                </div>  
                            <?php endif ?>
                            <div class="">
                                <?php switch($log->title) : 
                                    case 'upload-file' :
                                            ?>
                                                <a href="/admin/leads-list" class="tag rounded-full border border-info/30 bg-info/10 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                    Upload File
                                                </a>
                                                <a href="/admin/selections" class="tag rounded-full border border-error/30 bg-error/10 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                    Selections
                                                </a>
                                            <?php
                                        break;
                                    case 'upload-asin' :
                                            ?>
                                                <a href="/admin/selections" class="tag rounded-full border border-error/30 bg-error/10 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                    Selections
                                                </a>
                                            <?php
                                        break;
                                    case 'purchase-item' :
                                            ?>
                                                <a href="/admin/selections" class="tag rounded-full border border-error/30 bg-error/10 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                    Selections
                                                </a>
                                                <a href="/admin/purchases-list" class="tag rounded-full border border-success/30 bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                    Purchase List
                                                </a>
                                                
                                            <?php
                                        break;
                                    case 'assignments' :
                                            ?>
                                                <a href="/admin/assignments" class="tag rounded-full border border-info/30 bg-info/10 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                                    Assignments
                                                </a>  
                                                <a href="/admin/need-to-upload" class="tag rounded-full border border-success/30 bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                    Need To Upload
                                                </a>                                                        
                                            <?php
                                        break;
                                    case 'create-ntu' :
                                            ?>
                                                <a href="/admin/need-to-upload" class="tag rounded-full border border-success/30 bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                    Need To Upload
                                                </a>                                                        
                                            <?php
                                        break;
                                    ?>
                                    
                                <?php endswitch ?>
                            </div>
                        </div>
                    </li>  
                    <?php $number++; ?> 
                    
                    
                <?php endforeach ?>
            <?php endif ?>                    
        </ol>      
        </div>
    </div>
</div>
<?= $this->endSection() ?>