<?php

namespace App\Controllers;

use App\Models\AssignmentModel;
use App\Models\AssignModel;
use App\Models\LeadModel;
use App\Models\ScanUnlimitedModel;
use App\Models\FileModel;
use App\Models\OrderModel;
use App\Models\StaffModel;
use App\Models\BuyerStaffModel;
use App\Models\BuyerModel;
use App\Models\ClientModel;
use App\Models\LogModel;
use App\Models\OrderStatusModel;
use App\Models\ShipmentModel;
use App\Models\TrackingModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\Shipment;
use App\Models\SubscriptionModel;

class Order extends BaseController
{
    protected $leadModel = "";
    protected $scanUnlimitedsModel = "";
    protected $fileModel = "";
    protected $orderModel = "";
    protected $staffModel = "";
    protected $buyerModel = "";
    protected $buyerStaffModel = "";
    protected $orderStatusModel = "";
    protected $clientModel = "";
    protected $assignModel = "";
    protected $assignmentModel = "";
    protected $shipmentModel = "";
    protected $userModel = "";
    protected $logModel = "";
    protected $trackingModel = "";
    protected $subsModel = "";

    public function __construct()
    {
        $this->leadModel = new LeadModel();
        $this->scanUnlimitedsModel = new ScanUnlimitedModel();
        $this->fileModel = new FileModel();
        $this->orderModel = new OrderModel();
        $this->staffModel = new StaffModel();
        $this->buyerModel = new BuyerModel();
        $this->orderStatusModel = new OrderStatusModel();
        $this->clientModel = new ClientModel();
        $this->buyerStaffModel = new BuyerStaffModel();
        $this->assignModel = new AssignModel();
        $this->assignmentModel = new AssignmentModel();
        $this->shipmentModel = new ShipmentModel();
        $this->userModel = new UserModel();
        $this->logModel = new LogModel();
        $this->trackingModel = new TrackingModel();
        $this->subsModel = new SubscriptionModel();
    }

    public function savePurchaseList() {
        $userRole = session()->get('role');
        $asinData = array();

        
        $lists = $this->request->getVar('leads');
        
        if (is_null($lists)) {
            return redirect()->back()->with('error', 'Please tick at least 1 item!');
        }

        if (empty($lists)) {
            $date = $this->request->getVar('date'); 
            return redirect()->to('selections/?date=' . $date)->with('success', 'Report Successfully Uploaded!');
        }
        for ($i = 0; $i < count($lists); $i++) {
            $item = json_decode($lists[$i]);
            $leads = array(
                'title' => $item->title,
                'asin' => $item->asin,
                'retail_link' => $item->retail_link,
                'amazon_link' => $item->amazon_link,
                'buy_cost' => $item->buy_cost,
                'promo_code' =>  $item->promo_code,
                'brand' => '-',
                'category' => '-',
                'best_sales_rank' => $item->best_sales_rank,
                'market_price' => $item->market_price,
                'martket_place_fees' => 0,
                'fba_selling_fees' => 0,
                'profit' => $item->profit,
                'roi' => $item->roi,
                'file_id' => session()->get('user_id'),
                'source' => $item->source,
            );
            // insert rows                          
            $this->leadModel->save($leads);        
            
            $leadID = $this->leadModel->getInsertID();

            $this->orderModel->insert([
                'lead_id' => $leadID,
                'order_staff' => session()->get('user_id'), 
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            $this->orderStatusModel->insert([
                'purchased_item_id' => $this->orderModel->getInsertID(),
                'purchased_date' => date('Y-m-d H:i:s')
            ]);
            
            $this->assignModel->insert([
                'item_id' => $this->orderModel->getInsertID()
            ]);
            
            $ASIN = $item->asin;
            array_push($asinData, $ASIN);
        }
        $user = $this->userModel->find(session()->get('user_id'));    
        $this->logModel->save([
            'user_id' => $user['id'],
            'title' => 'purchase-item',
            'description' => '['. strtoupper($user['role']) .'] '. $user['username']. ' purchased items ',
            'items' => implode(', ', $asinData),
            'level' => '2',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $date = $this->request->getVar('date');
        return redirect()->back()->with('success', 'Report Successfully Uploaded!');
        
    }

    public function saveQty() {
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');
        $this->orderModel->set('qty', $qty)->where('id', $id)->update();
    }

    public function saveSize() {
        $id = $this->request->getVar('id');
        $size = $this->request->getVar('size');
        $this->orderModel->set('size', $size)->where('id', $id)->update();
    }

    public function saveStaff() {
        $id = $this->request->getVar('id');
        $staff = $this->request->getVar('staff');
        $this->orderModel->set('order_staff', $staff)->where('id', $id)->update();
    }

    public function getItem() {
        $id = $this->request->getVar('id');
        $item = $this->orderModel->getPurchaseItem($id);
        echo json_encode($item->getResultObject());
    }

    public function saveBuyersItem() {
        $shipment = new Shipment();
        $post = $this->request->getVar();       
        $buyer1 = '';
        $buyer2 = '';
        $buyer3 = '';
        $buyer4 = '';
        $buyer5 = '';
        $buyer6 = '';
        $buyer7 = '';
        // check purchase id
        $isExist = $this->buyerModel->where('purchase_id', $post['purch_id'])->get();
        if ($isExist->getNumRows() > 0) {
            // buyer 1
            $data1 = [
                'buyer' => $post['buyer1'],
                'cc' => $post['cc1'],
                'buyer_qty' => $post['qty1'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number1'],                
                'purchase_id' => $post['purch_id'] 
            ];
            $this->buyerModel->set($data1);
            $this->buyerModel->where('id', $post['buyer-id1']);
            $this->buyerModel->update();            
            $buyer1 = $post['buyer-id1'];
            //save cc numb
            if (!is_null($post['cc1'])) {
                $this->buyerStaffModel
                ->set('cc', $post['cc1'])
                ->where('id', $post['buyer1'])
                ->update();
            }

            $shipment->trackingShipment($buyer1, trim($post['shipping1']), $post['purch_id']);                
            
            // buyer 2
            if (isset($post['buyer2'])) {
                $data2 = [
                    'buyer' => $post['buyer2'],
                    'cc' => $post['cc2'],
                    'buyer_qty' => $post['qty2'],
                    'buyer_price' => $post['price_val'],
                    'order_number' => $post['order_number2'],
                    
                ];
                $this->buyerModel->set($data2);
                $this->buyerModel->where('id', $post['buyer-id2']);
                $this->buyerModel->update();   
                $buyer2 = $post['buyer-id2'];           
                //save cc numb
                if (!is_null($post['cc2'])) {
                    $this->buyerStaffModel
                    ->set('cc', $post['cc2'])
                    ->where('id', $post['buyer2'])
                    ->update();
                }
            }

            // buyer 3
            if (isset($post['buyer3'])) {
                $data3 = [
                    'buyer' => $post['buyer3'],
                    'cc' => $post['cc3'],
                    'buyer_qty' => $post['qty3'],
                    'buyer_price' => $post['price_val'],
                    'order_number' => $post['order_number3'],                    
                    'purchase_id' => $post['purch_id'] 
                ];
                $this->buyerModel->set($data3);
                $this->buyerModel->where('id', $post['buyer-id3']);
                $this->buyerModel->update();
                $buyer3 = $post['buyer-id3'];
                //save cc numb
                if (!is_null($post['cc3'])) {
                    $this->buyerStaffModel
                    ->set('cc', $post['cc3'])
                    ->where('id', $post['buyer3'])
                    ->update();
                }
            }
            

            // buyer 4
            if (isset($post['buyer4'])) {
                $data4 = [
                    'buyer' => $post['buyer4'],
                    'cc' => $post['cc4'],
                    'buyer_qty' => $post['qty4'],
                    'buyer_price' => $post['price_val'],
                    'order_number' => $post['order_number4'],
                    'purchase_id' => $post['purch_id'] 
                ];
                $this->buyerModel->set($data4);
                $this->buyerModel->where('id', $post['buyer-id4']);
                $this->buyerModel->update();     
                $buyer4 = $post['buyer-id4'];           
                //save cc numb
                if (!is_null($post['cc4'])) {
                    $this->buyerStaffModel
                    ->set('cc', $post['cc4'])
                    ->where('id', $post['buyer4'])
                    ->update();
                }
            }
            
            

            // buyer 5
            if (isset($post['buyer5'])) {
                $data5 = [
                    'buyer' => $post['buyer5'],
                    'cc' => $post['cc5'],
                    'buyer_qty' => $post['qty5'],
                    'buyer_price' => $post['price_val'],
                    'order_number' => $post['order_number5'],
                    'purchase_id' => $post['purch_id'] 
                ];
                $this->buyerModel->set($data5);
                $this->buyerModel->where('id', $post['buyer-id5']);
                $this->buyerModel->update();    
                $buyer5 = $post['buyer-id5'];          
                //save cc numb
                if (!is_null($post['cc5'])) {
                    $this->buyerStaffModel
                    ->set('cc', $post['cc5'])
                    ->where('id', $post['buyer5'])
                    ->update();
                }
            }
            
            // buyer 6
            if (isset($post['buyer6'])) {
                $data6 = [
                    'buyer' => $post['buyer6'],
                    'cc' => $post['cc6'],
                    'buyer_qty' => $post['qty6'],
                    'buyer_price' => $post['price_val'],
                    'order_number' => $post['order_number6'],                    
                    'purchase_id' => $post['purch_id'] 
                ];
                $this->buyerModel->set($data6);
                $this->buyerModel->where('id', $post['buyer-id6']);
                $this->buyerModel->update();   
                $buyer6 = $post['buyer-id6'];           
                //save cc numb
                if (!is_null($post['cc6'])) {
                    $this->buyerStaffModel
                    ->set('cc', $post['cc6'])
                    ->where('id', $post['buyer6'])
                    ->update();
                }
            }
            
            // buyer 7
            if (isset($post['buyer7'])) {
                $data7 = [
                    'buyer' => $post['buyer7'],
                    'cc' => $post['cc7'],
                    'buyer_qty' => $post['qty7'],
                    'buyer_price' => $post['price_val'],
                    'order_number' => $post['order_number7'],
                    'purchase_id' => $post['purch_id'] 
                ];
                $this->buyerModel->set($data7);
                $this->buyerModel->where('id', $post['buyer-id7']);
                $this->buyerModel->update();
                $buyer7 = $post['buyer-id7'];
                //save cc numb
                if (!is_null($post['cc7'])) {
                    $this->buyerStaffModel
                    ->set('cc', $post['cc7'])
                    ->where('id', $post['buyer7'])
                    ->update();
                }
            }
            
            
        } else {
            // buyer 1
            $this->buyerModel->save([
                'buyer' => $post['buyer1'],
                'cc' => $post['cc1'],
                'buyer_qty' => $post['qty1'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number1'],                
                'purchase_id' => $post['purch_id'],
                'user_id' => session()->get('user_id')        
            ]);
            $buyer1 = $this->buyerModel->getInsertID();
            
            //save cc numb
            if (!is_null($post['cc1'])) {
                $this->buyerStaffModel
                ->set('cc', $post['cc1'])
                ->where('id', $post['buyer1'])
                ->update();
            }
            
            // buyer 2
            $this->buyerModel->save([
                'buyer' => $post['buyer2'],
                'cc' => $post['cc2'],
                'buyer_qty' => $post['qty2'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number2'],                
                'purchase_id' => $post['purch_id'],
                'user_id' => session()->get('user_id')        
            ]);
            $buyer2 = $this->buyerModel->getInsertID();
               
            //save cc numb
            if (!is_null($post['cc2'])) {
                $this->buyerStaffModel
                ->set('cc', $post['cc2'])
                ->where('id', $post['buyer2'])
                ->update();
            }

            // buyer 3
            $this->buyerModel->save([
                'buyer' => $post['buyer3'],
                'cc' => $post['cc3'],
                'buyer_qty' => $post['qty3'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number3'],                
                'purchase_id' => $post['purch_id'],
                'user_id' => session()->get('user_id')        
            ]);
            $buyer3 = $this->buyerModel->getInsertID();

            //save cc numb
            if (!is_null($post['cc3'])) {
                $this->buyerStaffModel
                ->set('cc', $post['cc3'])
                ->where('id', $post['buyer3'])
                ->update();
            }
            // buyer 4
            $this->buyerModel->save([
                'buyer' => $post['buyer4'],
                'cc' => $post['cc4'],
                'buyer_qty' => $post['qty4'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number4'],
                'purchase_id' => $post['purch_id'],
                'user_id' => session()->get('user_id')        
            ]);
            $buyer4 = $this->buyerModel->getInsertID();

            //save cc numb
            if (!is_null($post['cc4'])) {
                $this->buyerStaffModel
                ->set('cc', $post['cc4'])
                ->where('id', $post['buyer4'])
                ->update();
            }
            // buyer 5
            $this->buyerModel->save([
                'buyer' => $post['buyer5'],
                'cc' => $post['cc5'],
                'buyer_qty' => $post['qty5'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number5'],
                'purchase_id' => $post['purch_id'],
                'user_id' => session()->get('user_id')        
            ]);
            $buyer5 = $this->buyerModel->getInsertID();

            //save cc numb
                if (!is_null($post['cc5'])) {
                    $this->buyerStaffModel
                    ->set('cc', $post['cc5'])
                    ->where('id', $post['buyer5'])
                    ->update();
                }

            // buyer 6
            $this->buyerModel->save([
                'buyer' => $post['buyer6'],
                'cc' => $post['cc6'],
                'buyer_qty' => $post['qty6'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number6'],
                'purchase_id' => $post['purch_id'],
                'user_id' => session()->get('user_id')        
            ]);
            $buyer6 = $this->buyerModel->getInsertID();

            //save cc numb
            if (!is_null($post['cc6'])) {
                $this->buyerStaffModel
                ->set('cc', $post['cc6'])
                ->where('id', $post['buyer6'])
                ->update();
            }

            // buyer 7
            $this->buyerModel->save([
                'buyer' => $post['buyer7'],
                'cc' => $post['cc7'],
                'buyer_qty' => $post['qty7'],
                'buyer_price' => $post['price_val'],
                'order_number' => $post['order_number7'],
                'purchase_id' => $post['purch_id'],
                'user_id' => session()->get('user_id')        
            ]);
            $buyer7 = $this->buyerModel->getInsertID();

            //save cc numb
            if (!is_null($post['cc7'])) {
                $this->buyerStaffModel
                ->set('cc', $post['cc7'])
                ->where('id', $post['buyer7'])
                ->update();
            }
            
        }   
        
        if (!empty(trim($post['shipping1']))) {
            $isTrackingExist = $this->trackingModel->isTrackingExist($post['buyer-id1']);
            if (!is_null($isTrackingExist)) {                
                if (trim($isTrackingExist['id']) != trim($post['shipping1'])) { 
                    $trackId = $isTrackingExist['id'];
                    $this->trackingModel
                        ->set('tracking_number', trim($post['shipping1']))
                        ->where('id', $trackId)
                        ->update();                    
                }                

            } else {          
                $shipment->trackingShipment($buyer1, trim($post['shipping1']), $post['purch_id']);                
            }
        }

        if (!empty(trim($post['shipping2']))) {
            $isTrackingExist = $this->trackingModel->isTrackingExist($post['buyer-id2'], trim($post['shipping2']));
            if (!is_null($isTrackingExist)) {
                if (trim($isTrackingExist['id']) != trim($post['shipping2'])) { 
                    $trackId = $isTrackingExist['id'];
                    $this->trackingModel
                        ->set('tracking_number', trim($post['shipping2']))
                        ->where('id', $trackId)
                        ->update();    
                }
                

            } else {
                $shipment->trackingShipment($buyer2, trim($post['shipping2']), $post['purch_id']);                
            }
        }

        if (!empty(trim($post['shipping3']))) {
            $isTrackingExist = $this->trackingModel->isTrackingExist($post['buyer-id3'], trim($post['shipping3']));
            if (!is_null($isTrackingExist)) {
                if (trim($isTrackingExist['id']) != trim($post['shipping3'])) { 
                    $trackId = $isTrackingExist['id'];
                    $this->trackingModel
                        ->set('tracking_number', trim($post['shipping3']))
                        ->where('id', $trackId)
                        ->update();
                }
                

            } else {
                $shipment->trackingShipment($buyer3, trim($post['shipping3']), $post['purch_id']);                
            }
        }
        
        if (!empty(trim($post['shipping4']))) {
            $isTrackingExist = $this->trackingModel->isTrackingExist($post['buyer-id4'], trim($post['shipping4']), $post['purch_id']);
            if (!is_null($isTrackingExist)) {
                if (trim($isTrackingExist['id']) != trim($post['shippin4'])) { 
                    $trackId = $isTrackingExist['id'];
                    $this->trackingModel
                    ->set('tracking_number', trim($post['shipping4']))
                    ->where('id', $trackId)
                    ->update();    
                }
                

            } else {
                $shipment->trackingShipment($buyer4, trim($post['shipping4']));                
            }
        }

        if (!empty(trim($post['shipping5']))) {
            $isTrackingExist = $this->trackingModel->isTrackingExist($post['buyer-id5'], trim($post['shipping5']), $post['purch_id']);
            if (!is_null($isTrackingExist)) {
                if (trim($isTrackingExist['id']) != trim($post['shipping5'])) { 
                    
                }
                $trackId = $isTrackingExist['id'];
                $this->trackingModel
                    ->set('tracking_number', trim($post['shipping5']))
                    ->where('id', $trackId)
                    ->update();

            } else {
                $shipment->trackingShipment($buyer5, trim($post['shipping5']));                
            }
        }

        if (!empty(trim($post['shipping6']))) {
            $isTrackingExist = $this->trackingModel->isTrackingExist($post['buyer-id6'], trim($post['shipping6']), $post['purch_id']);
            if (!is_null($isTrackingExist)) {
                if (trim($isTrackingExist['id']) != trim($post['shipping6'])) { 
                    $trackId = $isTrackingExist['id'];
                    $this->trackingModel
                        ->set('tracking_number', trim($post['shipping6']))
                        ->where('id', $trackId)
                        ->update();    
                }
                

            } else {
                $shipment->trackingShipment($buyer6, trim($post['shipping6']));                
            }
        }

        if (!empty(trim($post['shipping7']))) {
            $isTrackingExist = $this->trackingModel->isTrackingExist($post['buyer-id7'], trim($post['shipping7']), $post['purch_id']);
            if (!is_null($isTrackingExist)) {
                if (trim($isTrackingExist['id']) != trim($post['shipping7'])) { 
                    $trackId = $isTrackingExist['id'];
                    $this->trackingModel
                        ->set('tracking_number', trim($post['shipping7']))
                        ->where('id', $trackId)
                        ->update();    
                }
                

            } else {
                $shipment->trackingShipment($buyer7, trim($post['shipping7']), $post['purch_id']);                
            }
        }

        $getRestQty = $this->orderModel->getRestQty($post['purch_id']);
        echo json_encode([
            'rest_qty' => $getRestQty
        ]);
    }
    
    public function openFile() {
        $userRole = session()->get('role');
        $date = $this->request->getVar('date');
        $historyUpload = $this->fileModel->orderBy('created_at', 'DESC')->get();
        if ($date == null) {
            $date = date('Y-m-d');
            // $selections = $this->leadModel->getPruchaseData($date);  
            
        } else {
            $temp = explode('-', $date);            
            $date = $temp[2].'-'.$temp[0].'-'.$temp[1];
            
            // $selections = $this->leadModel->getPruchaseData($date);     
        }   
        
        $purchases = $this->orderModel->getPurchaseData($date);         
        $staffs = $this->staffModel->get();
        $buyers = $this->buyerStaffModel->where('user_id', session()->get('user_id'))->get();

        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;

            $plan = $getPaymentData->plan;
                        
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days
            ],
            'title' => 'Purchase Page',
            'historyUpload' => $historyUpload,            
            'purchases' => $purchases,
            'staffs' => $staffs,
            'buyers' => $buyers,            
        ];
    
        return view('open_purchased_item', $data);   
        
    }

    public function openMasterFile() {        
        $date = $this->request->getVar('date');
        $masterList = $this->orderModel->getPurchaseList();
        $purchases = $this->orderStatusModel->getOrderedData();    
        
        $buyers = $this->buyerStaffModel
            ->join('buyer_details', 'buyer_details.buyer = buyers.id')
            ->get();
        $lists = array();        
        
        foreach ($purchases->getResultObject() as $purch) {
            $orderNumbers = array();            
            foreach ($buyers->getResultObject() as $buyer) {
                if ($purch->pid == $buyer->purchase_id) {                                        
                    array_push($orderNumbers, $buyer->order_number);
                }                
            }
            
            $item = [
                'lid' => $purch->lid,
                'id' => $purch->uid,
                'purchased_item_id' => $purch->purchased_item_id,
                'title' => $purch->title,
                'asin' => $purch->asin,
                'order_number' => $orderNumbers,
                'qty_ordered' => $purch->qty_ordered,
                'buy_cost' => $purch->buy_cost,
                'price' => $purch->market_price,
                'qty_returned' => $purch->qty_returned,
                'qty_received' => $purch->qty_received,
                'allocated_date' => $purch->allocated_date,
                'status' => $purch->status,
                'order_id' => $purch->order_id,
                'purchased_date' => $purch->purchased_date,
                'order_notes' => $purch->order_notes,
            ];

            array_push($lists, $item);
        }

        $response = "";      
        ini_set('default_socket_timeout', 900); 
        $api_url = 'https://swclient.site/get-sw-users';        
        $json_data = file_get_contents($api_url);
        $response = json_decode($json_data);
        $clientIDs = $this->clientModel->get();
        $clientList = $this->clientModel            
            ->where('check_flag', 'checked')
            ->get();

        $data = [
            'title' => 'Purchased Item',
            'master_list' => $masterList,
            'purchased_items' => $lists,
            'clients' => $response,
            'client_id' =>  $clientIDs,
            'client_list' => $clientList,
            
        ];
    
        return view('warehouse/open_ordered_item', $data);
    }

    public function saveClients() {
        $id = $this->request->getVar('id');
        $clientID = $this->request->getVar('client_id');
        $orderID = $this->request->getVar('order_id');
        $checkFlag = $this->request->getVar('check_flag');
        $clientName = $this->request->getVar('name');
        $company = $this->request->getVar('company');

        $isOrdered = $this->clientModel
            ->where('order_id', $orderID)            
            ->get();

        if ($isOrdered->getNumRows() > 0) { 
            $this->clientModel->set('check_flag', $checkFlag)
                ->where('order_id', $orderID)
                ->update();
        } else {
            $this->clientModel->save([
                'client_id' => $clientID,
                'order_id' => $orderID,
                'check_flag' => $checkFlag,
                'client_name' => $clientName,
                'company' => $company,   
                'created_at' => date('Y-m-d H:i:s')              
            ]);
        }        
    }

    public function saveClientStatus() {
        $id = $this->request->getVar('id');
        $orderID = $this->request->getVar('order_id');
        $clientID = $this->request->getVar('client_id');
        $status = $this->request->getVar('status');
        $clientName = $this->request->getVar('name');
        $company = $this->request->getVar('company');

        // check 
        $isOrdered = $this->clientModel
            ->where('order_id', $orderID)            
            ->get();
            
        if ($isOrdered->getNumRows() > 0) {
            $this->clientModel->set('status', $status)
                ->where('order_id', $orderID)
                ->update();
        } else {
            $this->clientModel->ignore(true)->insert([
                'status' => $status,
                'client_id' => $clientID,
                'order_id' => $orderID,
                'client_name' => $clientName,
                'company' => $company,                
            ]);
        }
        
    }

    public function saveQtyReceived() {
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');        
        $this->orderStatusModel
            ->set('qty_received', $qty)      
            ->set('allocated_date', date('Y-m-d H:i:s'))      
            ->where('purchased_item_id', $id)
            ->update();
        
    }

    public function saveQtyReturned() {
        $id = $this->request->getVar('id');
        $qty = $this->request->getVar('qty');        
        $this->orderStatusModel
            ->set('qty_returned', $qty)            
            ->where('purchased_item_id', $id)
            ->update();
    }

    public function saveQtyAssigned() {
        $id = $this->request->getVar('id');
        $pid = $this->request->getVar('pid');
        $qty = $this->request->getVar('qty');       
        $received = $this->request->getVar('received');               
         
        $this->assignModel
            ->set('qty', $qty)            
            ->where('id', $id)
            ->update();
        
        $getItem = $this->assignModel->where('item_id', $pid)->get();
        $total = 0;
        foreach ($getItem->getResultObject() as $item) {
            $total = $total + $item->qty;
        }
        
        $this->orderStatusModel
            ->set('qty_remaining', $received - $total)            
            ->where('purchased_item_id', $pid)
            ->update();

        
        echo json_encode([
            'qty_remainder' => $received - $total
        ]);
        
    }

    public function deleteAssignData() {
        $id = $this->request->getVar('id');
        $getQty = $this->assignModel->where('id', $id)->get();
        $getQty = $getQty->getFirstRow();
        
        $this->assignModel->where('id', $id)->delete();
        $this->orderStatusModel->set('qty_remaining', 'qty_remaining+'.$getQty->qty, FALSE)
            ->where('purchased_item_id', $getQty->item_id)
            ->update();

        echo json_encode([
            'qty' => $getQty->qty
        ]);
    }

    public function getClientList() {            
        $orderId = $this->request->getVar('order_id');    
        if (is_null($orderId)) {
            $clients = $this->clientModel            
                ->where('oauth_uid', session()->get('oauth_uid'))
                ->get();

            echo json_encode($clients->getResultObject());
        } else {
            $clients = $this->clientModel            
                ->where('oauth_uid', session()->get('oauth_uid'))
                ->get();

            echo json_encode($clients->getFirstRow());
        }
        
    }

    public function addNewAssign() {
        $id = $this->request->getVar('pid');
        $lastId  = "";
        $remaining = $this->orderStatusModel->where('purchased_item_id', $id)->get();
        $remaining = $remaining->getFirstRow();
        if ($remaining->qty_remaining != 0) {
            $this->assignModel->save([
                'item_id' => $id,
                'qty' => 0            
            ]);
        }
        
        $lastId = $this->assignModel->getInsertID();
        echo json_encode([
            'id' => $lastId,
            'remaining' => $remaining->qty_remaining,
        ]);
    }

    public function saveStatusOrder() {
        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');

        
        $this->orderStatusModel->set('status', $status)
            ->where('purchased_item_id', $id)
            ->update();
    }   

    public function saveItems() {
        $userRole = session()->get('role');
        $id = $this->request->getVar('ceklist');        
        
        for ($i = 0; $i < count($id); $i++) {
            $this->assignModel->save([
                'item_id' => $id[$i],
                'assigned_date' => date('Y-m-d')
            ]);
        }
        
        if ($userRole == 'warehouse') {
            return redirect()->to(base_url('/warehouse/assignments'));
        } else {
            return redirect()->to(base_url('/admin/assignments'));
        }
        
    }

    public function saveClientOrder() {
        $id = $this->request->getVar('id');
        $clientID = $this->request->getVar('client_id');
        $asin = $this->request->getVar('asin');
        $this->assignModel->set('order_id', $clientID)
            ->set('assigned_date', date('Y-m-d'))
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->where('id', $id)
            ->update();       
        
        $user = $this->userModel->find(session()->get('user_id'));    
        
        $client = $this->clientModel->where('id', $clientID)->get();
        $client = $client->getFirstRow();
        
        $getTotalCost = $this->orderModel->getTotalCost($id);

        $this->logModel->save([
            'user_id' => $user['id'],
            'title' => 'assignments',
            'description' => '['. strtoupper($user['role']) .'] '. $user['username']. ' assigned items to '. $client->client_name .' ('. $client->company .')',
            'items' => $asin,
            'level' => '2',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $getClientCostLeft = $this->clientModel->getClientCostLeft($clientID);        
        $status = 'success';

        if ($getClientCostLeft->cost_left < $getTotalCost->total_buy_cost) {
            $status = 'warning';
        } 
        return json_encode([
            'cost_left' => $getClientCostLeft->cost_left,
            'status' => $status
        ]);
    }

    public function saveNotesOrder() {
        $item = $this->request->getVar('item');
        $notes = $this->request->getVar('notes');

        $this->orderStatusModel->set('order_notes', $notes)
            ->where('purchased_item_id', $item)
            ->update();
    }

    public function saveFNSKU() {
        $item = $this->request->getVar('item');
        $fnsku = $this->request->getVar('fnsku');

        $this->assignModel->set('fnsku', $fnsku)
            ->where('id', $item)
            ->update();
    }

    public function saveVendorName() {
        $item = $this->request->getVar('item');
        $vendor = $this->request->getVar('vendor');

        $this->assignModel->set('vendor', $vendor)
            ->where('id', $item)
            ->update();
    }

    public function saveAssignedNotes() {
        $item = $this->request->getVar('item');
        $notes = $this->request->getVar('notes');

        $this->assignModel->set('assigned_notes', $notes)
            ->where('id', $item)
            ->update();
    }

    public function saveFBANumber() {
        $item = $this->request->getVar('item');
        $numb = $this->request->getVar('number');

        $this->shipmentModel->set('fba_number', $numb)
            ->where('id', $item)
            ->update();

        // cek if completed
        // $shipments = $this->shipmentModel
        //     ->where('id', $item)    
        //     ->where('fba_number is NOT NULL', NULL, FALSE)        
        //     ->where('shipment_number is NOT NULL', NULL, FALSE)
        //     ->get();
        // if ($shipments->getNumRows() > 0) {
        //     $this->assignModel->set('updated_at', date('Y-m-d H:i:s'))
        //     ->where('item_id', $item)
        //     ->update();
        // }
        
    }

    public function saveShipmentNumber() {
        $item = $this->request->getVar('item');
        $numb = $this->request->getVar('number');

        $this->shipmentModel->set('shipment_number', $numb)
            ->where('id', $item)
            ->update();

        // cek if completed
        // $shipments = $this->assignModel
        //     ->where('id', $item)    
        //     ->where('fba_number is NOT NULL', NULL, FALSE)        
        //     ->where('shipment_number is NOT NULL', NULL, FALSE)
        //     ->get();
        // if ($shipments->getNumRows() > 0) {
        //     $this->assignModel->set('updated_at', date('Y-m-d H:i:s'))
        //     ->where('item_id', $item)
        //     ->update();
        // }
    }

    public function exportNeedToUpload($date = null) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        
        if (is_null($date)) {
            $assignedData = $this->assignModel->getAssignedData3();                
        } else {
            $start = null;
            $end = null;
            $temp = explode("&", $date);            
            // start
            $startExp = explode('-', $temp[0]);
            $start = $startExp[2].'-'.$startExp[0].'-'.$startExp[1];
            if (count($temp) > 1) {
                $endExp = explode('-', $temp[1]);                
                $end = $endExp[2].'-'.$endExp[0].'-'.$endExp[1];
            }
            $assignedData = $this->assignModel->getAssignedData3($start, $end);   
        }   
        $buyers = $this->buyerStaffModel
                ->join('buyer_details', 'buyer_details.buyer = buyers.id')
                ->get();   
        $lists = array();        
        $totalUnit = 0;
        $avgUnitRetail = 0;
        $totalOriginalRetail = 0;
        $totalClientCost = 0;
        foreach ($assignedData->getResultObject() as $purch) {
            $orderNumbers = array();            
            foreach ($buyers->getResultObject() as $buyer) {
                if ($purch->pid == $buyer->purchase_id) {                          
                    array_push($orderNumbers, $buyer->order_number);
                }                
            }
            
            if ($totalUnit > 0) {
                $avgUnitRetail = round($totalOriginalRetail / $totalUnit, 2);
            }
            
            $item = [
                'lid' => $purch->lid,
                'id' => $purch->pid,
                'purchased_item_id' => $purch->purchased_item_id,
                'title' => $purch->title,
                'asin' => $purch->asin,
                'order_number' => $orderNumbers,
                'qty_ordered' => $purch->qty_ordered,
                'buy_cost' => $purch->buy_cost,
                'price' => $purch->market_price,
                'qty_returned' => $purch->qty_returned,
                'qty_received' => $purch->qty_received,
                'qty_assigned' => $purch->qty,
                'allocated_date' => $purch->allocated_date,
                'status' => $purch->status,
                'order_id' => $purch->order_id,
                'purchased_date' => $purch->purchased_date,
                'order_notes' => $purch->order_notes,
                'client_name' => $purch->client_name,
                'company' => $purch->company,
                'fnsku' => $purch->fnsku,
                'vendor' => $purch->vendor,
                'assigned_notes' => $purch->assigned_notes,
                'fba_number' => $purch->fba_number,
                'shipment_number' => $purch->shipment_number,
                'updated_at' => $purch->updated_at
            ];
            $totalUnit = $totalUnit + $purch->qty; 
            $totalClientCost = $totalClientCost + (round($purch->qty * $purch->market_price, 2));                                
            $totalOriginalRetail = $totalOriginalRetail + (round($purch->qty * $purch->buy_cost, 2));                                
            array_push($lists, $item);
        }

        $spreadsheet->getActiveSheet()->getStyle('A:A')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('B:B')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('C:C')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('D:D')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('E:E')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('F:F')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('G:G')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('H:H')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('I:I')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        
        $spreadsheet->getActiveSheet()->getStyle('A1:H1')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A1:H1')
            ->getFill()->getStartColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_YELLOW);
        $spreadsheet->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->getStyle('A3:H3')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A3:H3')
            ->getFill()->getStartColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_YELLOW);
        $spreadsheet->getActiveSheet()->getStyle('A3:H3')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->getStyle('A:A')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        $spreadsheet->getActiveSheet()->getStyle('B:B')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        $spreadsheet->getActiveSheet()->getStyle('F:F')->getNumberFormat();

        $spreadsheet->getActiveSheet()->getStyle('E:E')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        $spreadsheet->getActiveSheet()->getStyle('F:F')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
        $spreadsheet->getActiveSheet()->getStyle('G:G')->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
        
        

        $sheet->setCellValue('A1', '');
		$sheet->setCellValue('B1', '');
		$sheet->setCellValue('C1', 'CATEGORY');
		$sheet->setCellValue('D1', 'CONDITION');
		$sheet->setCellValue('E1', '# OF UNITS');
        $sheet->setCellValue('F1', 'AVG UNIT RETAIL');
        $sheet->setCellValue('G1', 'TOTAL ORIGINAL RETAIL');
        $sheet->setCellValue('H1', 'TOTAL CLIENT COST');
        // $sheet->setCellValue('I1', '');
        
        $sheet->setCellValue('A2', '');
		$sheet->setCellValue('B2', '');
		$sheet->setCellValue('C2', 'OA');
		$sheet->setCellValue('D2', 'NEW');
		$sheet->setCellValue('E2', $totalUnit);
        $sheet->setCellValue('F2', number_format($avgUnitRetail, 2));
        $sheet->setCellValue('G2', number_format($totalOriginalRetail, 2));
        $sheet->setCellValue('H2', number_format($totalClientCost, 2));
        // $sheet->setCellValue('I2', '');
        
        $spreadsheet->getActiveSheet()->getStyle('E2:E2')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        $spreadsheet->getActiveSheet()->getStyle('H2:H2')->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        $sheet->setCellValue('A3', 'FNSKU');
		$sheet->setCellValue('B3', 'ASIN');
		$sheet->setCellValue('C3', 'ITEM DESCRIPTION');
		$sheet->setCellValue('D3', 'ORIGINAL QTY');
		$sheet->setCellValue('E3', 'RETAIL VALUE');
        $sheet->setCellValue('F3', 'TOTAL ORIGINAL RETAIL');
        $sheet->setCellValue('G3', 'TOTAL CLIENT COST');
        $sheet->setCellValue('H3', 'VENDOR NAME');
        // $sheet->setCellValue('I3', 'NOTES');
        
        $no = 4;
        $client = "";
        for($i = 0; $i < count($lists); $i++) {             
            if ($i == 0) {
                $sheet->setCellValue('A' . $no, $lists[$i]['fnsku']);               
                $sheet->setCellValue('B' . $no, $lists[$i]['asin']);               
                $sheet->setCellValue('C' . $no, $lists[$i]['title']);               
                $sheet->setCellValue('D' . $no, $lists[$i]['qty_assigned']);               
                $sheet->setCellValue('E' . $no, number_format(round($lists[$i]['price'], 2), 2));               
                $sheet->setCellValue('F' . $no, number_format(round($lists[$i]['price'] * $lists[$i]['qty_assigned'], 2), 2));               
                $sheet->setCellValue('G' . $no, number_format(round($lists[$i]['buy_cost'] * $lists[$i]['qty_assigned'], 2), 2));               
                $sheet->setCellValue('H' . $no, $lists[$i]['vendor']); 
                // $sheet->setCellValue('I' . $no, $lists[$i]['assigned_notes']);    
                $no++;
            } else {
                if ($client == $lists[$i]['order_id']) {                    
                    $sheet->setCellValue('A' . $no, $lists[$i]['fnsku']);               
                    $sheet->setCellValue('B' . $no, $lists[$i]['asin']);               
                    $sheet->setCellValue('C' . $no, $lists[$i]['title']);               
                    $sheet->setCellValue('D' . $no, $lists[$i]['qty_assigned']);               
                    $sheet->setCellValue('E' . $no, number_format(round($lists[$i]['price'], 2), 2));               
                    $sheet->setCellValue('F' . $no, number_format(round($lists[$i]['price'] * $lists[$i]['qty_assigned'], 2), 2));               
                    $sheet->setCellValue('G' . $no, number_format(round($lists[$i]['buy_cost'] * $lists[$i]['qty_assigned'], 2), 2));               
                    $sheet->setCellValue('H' . $no, $lists[$i]['vendor']); 
                    // $sheet->setCellValue('I' . $no, $lists[$i]['assigned_notes']);    
                    $no++;
                } else {
                    $sheet->setCellValue('A' . $no, '');               
                    $sheet->setCellValue('B' . $no, '');               
                    $sheet->setCellValue('C' . $no, $lists[$i-1]['fba_number'] . ' / ' . $lists[$i-1]['shipment_number']);               
                    $sheet->setCellValue('D' . $no, '');               
                    $sheet->setCellValue('E' . $no, '');               
                    $sheet->setCellValue('F' . $no, '');               
                    $sheet->setCellValue('G' . $no, '');                                   
                    $sheet->setCellValue('H' . $no, (!is_null($lists[$i-1]['updated_at'])) ? date('m/d/Y', strtotime($lists[$i-1]['updated_at'])) : '-');    
                    $spreadsheet->getActiveSheet()->getStyle('A'.$no.':I'.$no)->getFont()->setBold(true);
                    $no++;
                    $sheet->setCellValue('A' . $no, '');               
                    $sheet->setCellValue('B' . $no, '');               
                    $sheet->setCellValue('C' . $no, $lists[$i-1]['client_name'] . '(' . $lists[$i-1]['company'] . ')');               
                    $sheet->setCellValue('D' . $no, '');               
                    $sheet->setCellValue('E' . $no, '');               
                    $sheet->setCellValue('F' . $no, '');               
                    $sheet->setCellValue('G' . $no, '');               
                    $sheet->setCellValue('H' . $no, ''); 
                    $spreadsheet->getActiveSheet()->getStyle('A'.$no.':I'.$no)->getFont()->setBold(true);
                    $no++;
                    $no++;
                    $sheet->setCellValue('A' . $no, $lists[$i]['fnsku']);               
                    $sheet->setCellValue('B' . $no, $lists[$i]['asin']);               
                    $sheet->setCellValue('C' . $no, $lists[$i]['title']);               
                    $sheet->setCellValue('D' . $no, $lists[$i]['qty_assigned']);               
                    $sheet->setCellValue('E' . $no, number_format(round($lists[$i]['price'], 2), 2));               
                    $sheet->setCellValue('F' . $no, number_format(round($lists[$i]['price'] * $lists[$i]['qty_assigned'], 2), 2));               
                    $sheet->setCellValue('G' . $no, number_format(round($lists[$i]['buy_cost'] * $lists[$i]['qty_assigned'], 2), 2));               
                    $sheet->setCellValue('H' . $no, $lists[$i]['vendor']); 
                    // $sheet->setCellValue('I' . $no, $lists[$i]['assigned_notes']);    
                    $no++;
                    
                }
            }

            if ($i == count($lists)-1) {
                $sheet->setCellValue('A' . $no, '');               
                $sheet->setCellValue('B' . $no, '');               
                $sheet->setCellValue('C' . $no, $lists[$i]['fba_number'] . ' / ' . $lists[$i]['shipment_number']);               
                $sheet->setCellValue('D' . $no, '');               
                $sheet->setCellValue('E' . $no, '');               
                $sheet->setCellValue('F' . $no, '');               
                $sheet->setCellValue('G' . $no, '');                               
                $sheet->setCellValue('H' . $no, (!is_null($lists[$i]['updated_at'])) ? date('m/d/Y', strtotime($lists[$i]['updated_at'])) : '-');    
                $spreadsheet->getActiveSheet()->getStyle('A'.$no.':I'.$no)->getFont()->setBold(true);
                $no++;
                $sheet->setCellValue('A' . $no, '');               
                $sheet->setCellValue('B' . $no, '');               
                $sheet->setCellValue('C' . $no, $lists[$i]['client_name'] . '(' . $lists[$i]['company'] . ')');               
                $sheet->setCellValue('D' . $no, '');               
                $sheet->setCellValue('E' . $no, '');               
                $sheet->setCellValue('F' . $no, '');               
                $sheet->setCellValue('G' . $no, '');               
                $sheet->setCellValue('H' . $no, ''); 
                $spreadsheet->getActiveSheet()->getStyle('A'.$no.':I'.$no)->getFont()->setBold(true);
                $no++;
            }

            
            $client = $lists[$i]['order_id']; 
        }
        $fileName = "Need To Upload.xlsx";  
        $writer = new Xlsx($spreadsheet);
        $writer->save("files/". $fileName);
      
        header("Content-Type: application/vnd.ms-excel");

		header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length:' . filesize("files/". $fileName));
		flush();
		readfile("files/". $fileName);
        unlink("files/".$fileName);
		exit;
    }

}