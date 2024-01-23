<?= $this->extend('b2b/layout/component') ?>

<?= $this->section('content') ?>

<div class="nk-content-body">
    <div class="nk-content-wrap">    
        <div class="nk-block-between">
            <div class="nk-block-head-content">   
                <!-- <a href="/warehouse/master-lists" class="btn btn-secondary"><em class="icon ni ni-back-arrow-fill me-1"></em> back</a>              -->
            </div><!-- .nk-block-head-content --> 
            <div class="nk-block-head-content">   
                <a href=""  data-bs-toggle="modal" data-bs-target="#modalDefault" class="btn btn-danger"><em class="icon ni ni-user-list-fill me-1"></em> Company Lists</a>             
                <div class="modal fade" id="modalDefault" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <form id="formClient">
                                <?php csrf_field() ?>                               
                                <div class="modal-header">
                                    <h5 class="modal-title">Company Lists</h5>
                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <table class="datatable-init table"> 
                                        <thead>
                                            <tr>
                                                <th class="text-center">Client Name</th>
                                                <th class="text-center">Company Name</th>
                                                <th class="text-center">Order Date</th>
                                                <th class="text-center">Cost Left</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center"><em class="icon ni ni-more-h-alt"></em></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $ids = array(); ?>
                                            <?php foreach($clients as $client) : ?>                                                
                                                <?php if ($client_id->getNumRows() > 0) : ?>
                                                    <?php foreach($client_id->getResultObject() as $cid) : ?>
                                                        <?php if ($client->order_id == $cid->order_id) : ?>
                                                            <?php array_push($ids, $cid->order_id) ?>
                                                            <tr>
                                                                <td class="text-center align-middle"><?= $client->fullname ?></td>
                                                                <td class="text-center align-middle"><?= $client->company ?></td>
                                                                <td class="text-center align-middle"><?= date('m/d/Y', strtotime($client->investment_date)) ?></td>
                                                                <td class="text-center align-middle">$<?= number_format($client->cost_left, 2) ?></td>
                                                                <td class="text-center align-middle">
                                                                    <select  data-order_id="<?= $client->order_id ?>" data-name="<?= $client->fullname ?>" data-company="<?= $client->company ?>" data-client_id="<?= $client->client_id ?>" class="form-control text-center tick-client-status" id="">
                                                                        <option value="">...</option>
                                                                        <option value="close_out" <?= ($cid->status == 'close_out') ? 'selected' : '' ?>>Close Out</option>
                                                                        <option value="storage_limit" <?= ($cid->status == 'storage_limit') ? 'selected' : '' ?>>OA only / storage limits</option>
                                                                        <option value="closed" <?= ($cid->status == 'closed') ? 'selected' : '' ?>>Closed</option>
                                                                        <option value="priority" <?= ($cid->status == 'priority') ? 'selected' : '' ?>>Priority</option>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                    <div class="custom-control custom-control-sm custom-checkbox">                                                    
                                                                        <input type="checkbox" name="ceklist[]" data-name="<?= $client->fullname ?>" data-company="<?= $client->company ?>" value="<?= $client->order_id ?>" data-client="<?= $client->client_id ?>" class="custom-control-input tick-client" id="customCheck<?= $client->order_id ?>" <?= ($cid->check_flag == 'checked') ? 'checked' : '' ?> ?>  
                                                                        <label class="custom-control-label" for="customCheck<?= $client->order_id ?>"></label>                                                                          
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $client->fullname ?></td>
                                                        <td class="text-center align-middle"><?= $client->company ?></td>
                                                        <td class="text-center align-middle"><?= date('m/d/Y', strtotime($client->investment_date)) ?></td>
                                                        <td class="text-center align-middle">$<?= number_format($client->cost_left, 2) ?></td>
                                                        <td class="text-center align-middle">
                                                            <select data-order_id="<?= $client->order_id ?>" data-name="<?= $client->fullname ?>" data-company="<?= $client->company ?>" data-client_id="<?= $client->client_id ?>" class="form-control text-center tick-client-status" id="">
                                                                <option value="">...</option>
                                                                <option value="close_out">Close Out</option>
                                                                <option value="storage_limit">OA only / storage limits</option>
                                                                <option value="closed">Closed</option>
                                                                <option value="priority">Priority</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="custom-control custom-control-sm custom-checkbox">                                                    
                                                                <input type="checkbox" name="ceklist[]" data-name="<?= $client->fullname ?>" data-company="<?= $client->company ?>" value="<?= $client->order_id ?>" data-client="<?= $client->client_id ?>" class="custom-control-input tick-client" id="customCheck<?= $client->order_id ?>" ?>  
                                                                <label class="custom-control-label" for="customCheck<?= $client->order_id ?>"></label>                                                                          
                                                            </div>
                                                        </td>
                                                    </tr>                                                    
                                                <?php endif ?>
                                                <?php if ($client_id->getNumRows() > 0) : ?>
                                                    
                                                    <?php if (!in_array($client->order_id, $ids)) : ?>
                                                        <tr>
                                                            <td class="text-center align-middle"><?= $client->fullname ?></td>
                                                            <td class="text-center align-middle"><?= $client->company ?></td>
                                                            <td class="text-center align-middle"><?= date('m/d/Y', strtotime($client->investment_date)) ?></td>
                                                            <td class="text-center align-middle">$<?= number_format($client->cost_left, 2) ?></td>
                                                            <td class="text-center align-middle">
                                                                <select  data-order_id="<?= $client->order_id ?>" data-client_id="<?= $client->client_id ?>" class="form-control text-center tick-client-status" id="">
                                                                    <option value="">...</option>
                                                                    <option value="close_out">Close Out</option>
                                                                    <option value="storage_limit">OA only / storage limits</option>
                                                                    <option value="closed">Closed</option>
                                                                    <option value="priority">Priority</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="custom-control custom-control-sm custom-checkbox">                                                    
                                                                    <input type="checkbox" name="ceklist[]" data-name="<?= $client->fullname ?>" data-company="<?= $client->company ?>" value="<?= $client->order_id ?>" data-client="<?= $client->client_id ?>" class="custom-control-input tick-client" id="customCheck<?= $client->order_id ?>" ?>  
                                                                    <label class="custom-control-label" for="customCheck<?= $client->order_id ?>"></label>                                                                          
                                                                </div>
                                                            </td>
                                                        </tr>   
                                                    <?php endif ?>
                                                <?php endif ?>
                                                
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer bg-light">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->             
        </div>
        <div class="nk-block mt-4">
            <div class="card card-bordered">                
                <div class="card-inner">                    
                    <div class="nk-help">                        
                        <div class="nk-help-text">
                            <h5>Master List</h5>
                            <p class="text-soft">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis officiis iusto earum commodi reiciendis. Magni, quisquam, exercitationem necessitatibus, illo iusto rerum unde fuga distinctio ea possimus a! A, reiciendis animi..</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        <div class="nk-block">            
            <div class="card card-bordered">            
                <div class="card-inner card-inner-md" style="overflow-x:auto;">     
                <!-- <h6 class="mb-4">Purchase List [  <small class="fw-bold"><?= isset($_GET['date']) ? date('F jS, Y', strtotime($_GET['date'])) : date('m-d-Y') ?></small> ]</h6>                 -->
                    <table class="datatable-init table" style="font-size: 11px; "> 
                        <thead>
                            <tr>                                 
                                <th>Item Description</th>         
                                <th class="text-center">ASIN</th>                   
                                <th class="text-center">Order Number</th>                                                   
                                <th class="text-center">Qty Ordered</th>                   
                                <th class="text-center" style="width: 5%">Qty Returned</th>                   
                                <th class="text-center" style="width: 5%">Qty Received</th>                   
                                <th class="text-center">Qty Remaining</th>             
                                <th class="text-center">Amazon Price</th>
                                <th class="text-center">Cost Per Unit</th>
                                <th class="text-center">Cost Total</th>
                                <th class="text-center">Allocate Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Client</th>
                                <th class="text-center">Purchase Date</th>
                                <th class="text-center" style="width: 12%">Notes</th>
                                
                            </tr>                            
                        </thead>
                        <tbody>
                            <?php $id = ""; $date = "";?>
                            <?php foreach($purchased_items as $purch) : ?>
                                <?php if ($date != date('F jS, Y', strtotime($purch['purchased_date']))) : ?>
                                    <tr>
                                        <td class="text-center align-middle table-primary fw-bold"><?= date('F jS, Y', strtotime($purch['purchased_date'])) ?></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                        <td class="table-primary"></td>
                                    </tr>
                                    <?php $date = date('F jS, Y', strtotime($purch['purchased_date'])) ?>
                                <?php else : ?>
                                    <tr>
                                        <td class="align-middle"><?= substr($purch['title'], 0, 55) ?><?= (strlen($purch['title']) > 55) ? '..' : '' ?></td>
                                        <td class="text-center align-middle"><b><?= $purch['asin'] ?></b></td>
                                        <td class="text-center align-middle">
                                            <a href="" data-bs-toggle="modal" class="orderModal" data-asin="<?= $purch['asin'] ?>" data-order_number="<?= implode('<br>',$purch['order_number']) ?>"><em class="icon ni ni-cc-alt2-fill"></em></a>                                        
                                        </td>
                                        <td class="text-center align-middle fw-bold"><?= $purch['qty_ordered'] ?></td>
                                        <td class="align-middle">
                                            <div class="form-group">                                            
                                                <div class="form-control-wrap number-spinner-wrap">                                                
                                                    <input type="number" min="0" class="form-control p-1 text-center form-control-sm qty_returned qty_returned_<?= $purch['id'] ?>" data-ordered="<?= $purch['qty_ordered'] ?>" data-id="<?= $purch['id'] ?>" data-cost="<?= $purch['buy_cost'] ?>"  data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_returned'] == 0) ? '0' : $purch['qty_returned']  ?>">
                                                
                                                </div>
                                            </div> 
                                        </td>  
                                        <td class="text-center align-middle">
                                            <div class="form-group">                                            
                                                <div class="form-control-wrap number-spinner-wrap">                                
                                                    <input type="number" min="0" class="form-control p-1 text-center form-control-sm qty_received qty_received_<?= $purch['id'] ?>" data-ordered="<?= $purch['qty_ordered'] ?>" data-id="<?= $purch['id'] ?>" data-cost="<?= $purch['buy_cost'] ?>"  data-price="<?= $purch['price'] ?>" value="<?= ($purch['qty_received'] == 0) ? '0' : $purch['qty_received']  ?>">                                                
                                                </div>
                                            </div>     
                                        </td>
                                        <td class="text-center align-middle remain_<?= $purch['id'] ?>">
                                            <?php if ($purch['qty_ordered'] - ($purch['qty_received'] + $purch['qty_returned']) == 0) : ?>
                                                <span class="text-success fw-bold">Complete</span>
                                            <?php else : ?>
                                                <span class="text-danger fw-bold"><?= $purch['qty_ordered'] - (($purch['qty_received'] + $purch['qty_returned'])) ?></span>
                                            <?php endif ?>
                                        </td>
                                        <td class="text-center align-middle total_price_<?= $purch['id'] ?>">$<?= round($purch['price'] * $purch['qty_received'], 2) ?></td>                                    
                                        <td class="text-center align-middle">$<?= round($purch['buy_cost'], 2) ?></td>
                                        <td class="text-center align-middle"><span class="total_buy_cost_<?= $purch['id'] ?>">$<?= round($purch['qty_received'] * $purch['buy_cost'], 2) ?></span></td>
                                        <td class="text-center align-middle"><?= is_null($purch['allocated_date']) ? '-' : date('m/d/Y', strtotime($purch['allocated_date'])) ?></td>
                                        <td class="text-center align-middle">                                    
                                            <select name="status[]" class="form-control text-center status-order" data-id="<?= $purch['purchased_item_id'] ?>" style="font-size: 10px" id="">
                                                <option value="">...</option>
                                                <option value="order_canceled" <?= ($purch['status'] == 'order_canceled') ? 'selected' : ''?>>Order Canceled</option>
                                                <option value="returned" <?= ($purch['status'] == 'returned') ? 'selected' : ''?> >Returned</option>
                                                <option value="in_process" <?= ($purch['status'] == 'in_process') ? 'selected' : ''?> >In process</option>
                                                <option value="shipped" <?= ($purch['status'] == 'shipped') ? 'selected' : ''?> >Shipped/Partially Shipped</option>
                                                <option value="ordered" <?= ($purch['status'] == 'ordered') ? 'selected' : ''?> >Ordered</option>
                                                <option value="delivered" <?= ($purch['status'] == 'delivered') ? 'selected' : ''?> >Delivered/Received</option>
                                            </select>
                                        </td>
                                        <td class="text-center align-middle">
                                            <select name="client[]" class="form-control text-center select-client" data-id="<?= $purch['lid'] ?>" data-item="<?= $purch['purchased_item_id'] ?>" style="font-size: 10px" id="">
                                                <option>...</option>
                                                <?php foreach ($client_list->getResultObject() as $cl) : ?>
                                                    <option value="<?= $cl->order_id ?>" <?= $cl->order_id == $purch['order_id'] ? 'selected' : '' ?>><?= $cl->client_name ?> (<?= $cl->company ?>) <?= (!empty($cl->status) ? ' - '. strtoupper($cl->status) : '') ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </td>
                                        <td class="text-center align-middle"><?= ($purch['purchased_date']) ? date('m/d/Y', strtotime($purch['purchased_date'])) : '-' ?></td>
                                        <td class="text-center align-middle">
                                            <input type="text" name="notes" class="form-control notes" data-id="<?= $purch['purchased_item_id'] ?>" style="font-size: 11px;" value="<?= $purch['order_notes'] ?>">
                                        </td>                                    
                                            
                                    </tr>   
                                <?php endif ?>
                            <?php endforeach ?>                                                    
                        </tbody>
                    </table>
                    <div class="modal fade" tabindex="-1" id="modalOrders" aria-modal="true" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">                                                     
                                <div class="modal-header">
                                    <h5 class="modal-title">Order Number [<span class="fst-italic asin-code"></span>]</h5>
                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <div class="order-list fw-bold text-center">

                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
            <?php if ($master_list->getNumrows() > 0) : ?>
                <?php foreach ($master_list->getResultObject() as $mlist) : ?>
                    
                <?php endforeach ?>                
            <?php endif ?>
            
        </div><!-- .nk-block -->
    </div>
   
</div>
<?= $this->endSection() ?>