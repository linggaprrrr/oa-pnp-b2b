<?php

namespace App\Controllers\pnp;

use App\Models\LogModel;
use App\Models\pnp\AssignModel;
use App\Models\pnp\BoxModel;
use App\Models\pnp\FileModel;
use App\Models\pnp\StaffModel;
use App\Models\pnp\BuyerModel;
use App\Models\pnp\BuyerStaffModel;
use App\Models\pnp\ClientModel;
use App\Models\pnp\LeadModel;
use App\Models\pnp\OrderModel;
use App\Models\pnp\OrderStatusModel;
use App\Models\pnp\RefundModel;
use App\Models\pnp\ScanUnlimitedModel;
use App\Models\pnp\ShipmentModel;
use App\Models\pnp\SubscriptionModel;
use App\Models\pnp\TrackingModel;
use App\Models\pnp\UPCLookupModel;
use App\Models\UserModel;
use App\Models\MessageModel;
use App\Models\pnp\MessageModel as PnpMessageModel;

use function App\Helpers\timeSpan;

class Home extends BaseController
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
    protected $userModel = "";
    protected $assignModel = "";
    protected $shipmentModel = "";
    protected $UPCLookupModel = "";
    protected $logModel = "";
    protected $trackingModel = "";
    protected $subsModel = "";
    protected $boxModel = "";
    protected $refundModel = "";
    protected $messageModel = "";

    public function __construct()
    {
        $userId = session()->get('user_id');
        if (is_null($userId)) {
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        if (session()->get('role') == 'superadministrator') {
            header("Location: ".base_url('/admin/users'));
            die();            
        }
        $this->leadModel = new LeadModel();
        $this->scanUnlimitedsModel = new ScanUnlimitedModel();
        $this->fileModel = new FileModel();
        $this->orderModel = new OrderModel();
        $this->staffModel = new StaffModel();
        $this->buyerModel = new BuyerModel();
        $this->orderStatusModel = new OrderStatusModel();
        $this->clientModel = new ClientModel();
        $this->buyerStaffModel = new BuyerStaffModel();
        $this->userModel = new UserModel();
        $this->assignModel = new AssignModel();
        $this->UPCLookupModel = new UPCLookupModel();
        $this->shipmentModel = new ShipmentModel();
        $this->logModel = new LogModel();
        $this->trackingModel = new TrackingModel();
        $this->subsModel = new SubscriptionModel();
        $this->boxModel = new BoxModel();
        $this->refundModel = new RefundModel();
        $this->messageModel = new PnpMessageModel();
    }

    public function index()
    {
        return view('welcome_message');
    }



    public function leadsList() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        $historyUpload = $this->fileModel
            ->join('lead_lists', 'lead_lists.file_id = files.id')                 
            ->where('files.oauth_uid', session()->get('oauth_uid'))
            ->groupBy('files.id')    
            ->orderBy('created_at', 'DESC')->get();      
        // check payment     
        $startSub = null;
        $expSub = null;
        $plan = 0;
        $days = 0;
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Leads List Files',
            'historyUpload' => $historyUpload
        ];

        return view('pnp/leads-list', $data);
        
    }

    public function leadsListDownloadable() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        $historyUpload = $this->fileModel
            ->select('files.*')
            ->join('scan_unlimited', 'scan_unlimited.file_id = files.id')        
            ->where('files.status', 2)
            ->groupBy('files.id')    
            ->orderBy('created_at', 'DESC')->get();        
        $getASINScopeAPI = $this->fileModel->getASINScopeAPI();
        $data = [
            'title' => 'Leads List Files',
            'ASINScopeAPI' => $getASINScopeAPI,
            'historyUpload' => $historyUpload
        ];

        if ($userRole == 'purchase') {
            return view('pnp/purchase/leads-list2', $data);
        } else {
            return view('pnp/admin/leads-list2', $data);
        }
        
    }

    public function selections($date = null) {
        $userRole = session()->get('user_id');
        $email = session()->get('email');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }        
        
        $date = $this->request->getVar('date');        

        if (is_null($date)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://oaclients.com/get-avail-dates-email/'. $email ,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            
            $response = curl_exec($curl);        
            curl_close($curl);
            $dates = json_decode($response);
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://oaclients.com/get-leads-by-date-email/'.$dates->data[0]->avail_date.'/'.$email,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            
            curl_close($curl);
            $result = json_decode($response);   
            
        } else {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://oaclients.com/get-leads-by-date-email/'.$date.'/'.$email,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            
            curl_close($curl);
            $result = json_decode($response);   
        }



             

        // dd();
        if ($userRole == 'uploader') {
            $target = is_null($this->request->getVar('oa')) ? 'oa1': $this->request->getVar('oa');
        } else {
            $target = session()->get('user_ext');
        }

        $historyUpload = $this->fileModel->orderBy('created_at', 'DESC')->get();
        if ($date == null) {
            $date = date('Y-m-d');
            $selections = $this->leadModel->getSelectionData($date);              
            
        } else {
            // $temp = explode('-', $date);            
            // $date = $temp[2].'-'.$temp[0].'-'.$temp[1];
            $selections = $this->leadModel->getSelectionData($date);     
        }   
        
        
        
        $purchases = $this->orderModel->getPurchaseData(date('Y-m-d')); 
        
        $staffs = $this->staffModel->get();
        $buyers = $this->buyerStaffModel->where('user_id', session()->get('user_id'))->get();
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Leads List Files',
            'historyUpload' => $historyUpload,
            'selections' => $result,
            'byUpload' => $selections,
            'purchases' => $purchases,
            'staffs' => $staffs,
            'buyers' => $buyers,            
        ];

        
        return view('pnp/selections', $data);
        
    }

    public function purchasesList() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        $purchLists = $this->orderModel->getPurchaseList();
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Leads List Files',
            'purchLists' => $purchLists
        ];
        
        return view('pnp/purchase-list', $data);
    }


    public function masterLists() {
        
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }
        $purchases = $this->assignModel->getAssignedData2();    
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
                'id' => $purch->pid,
                'aid' => $purch->aid,
                'purchased_item_id' => $purch->purchased_item_id,
                'title' => $purch->title,
                'asin' => $purch->asin,
                'order_number' => $orderNumbers,
                'qty_ordered' => $purch->qty_ordered,
                'buy_cost' => $purch->buy_cost,
                'price' => $purch->market_price,
                'qty_returned' => $purch->qty_returned,
                'qty_assigned' => $purch->qty_received - $purch->qty_remaining,
                'qty_received' => $purch->qty_received,
                'allocated_date' => $purch->allocated_date,
                'status' => $purch->status,                
                'purchased_date' => $purch->purchased_date,
                'order_notes' => $purch->order_notes,                
              
            ];

            array_push($lists, $item);  
            
        }
        
        // dd($lists);
        
        $response = "";        
        
        $clientIDs = $this->clientModel->get();
        $clientList = $this->clientModel            
            ->where('check_flag', 'checked')
            ->get();
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Master List',
            'purchased_items' => $lists,
            'clients' => $response,   
            'client_id' =>  $clientIDs,
            'client_list' => $clientList,
            
        ];

        return view('pnp/master-lists', $data);        
    }

    public function clients() {
        $uid = session()->get('user_id');
        $clients = $this->clientModel->getClients($uid);

         // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Clients',
            'clients' => $clients
        ];
        return view('pnp/clients', $data);
    }

    public function assignments() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }
        $startTemp = null;
        $endTemp = null;
        $start = null;
        $end = null;   
        $date = $this->request->getVar('date');
    
        if (is_null($date) || empty($date)) {
            $assigned = $this->assignModel->getAssignmentData();    
            
        } else {
            $temp = explode("to", $date);
            $temp = array_map('trim', $temp);
            
            // start
            $startTemp = $temp[0];
            $startExp = explode('-', $temp[0]);

            $start = $startExp[2].'-'.$startExp[0].'-'.$startExp[1];
            
            if (count($temp) > 1) {
                $endExp = explode('-', $temp[1]);                
                $endTemp = $temp[1];
                $end = $endExp[2].'-'.$endExp[0].'-'.$endExp[1];
            }
            $assigned = $this->assignModel->getAssignmentData($start, $end);                
        }
                
        
        $lists = array(); 
        $items = array();        
        $id = null;
        $totalQty = 0;
        $i = 0;

        // calculate qty remaining
        foreach ($assigned->getResultObject() as $purch) {            
            if ($i == 0) {
                $totalQty = $totalQty + $purch->qty;                                        
            } else {
                if ($id == $purch->pid) {
                    $totalQty = $totalQty + $purch->qty;                
                } else {
                    $totalQty = $purch->qty;                                        
                }
            }
            $i++;
            $id = $purch->pid;  
            $this->orderStatusModel->set('qty_remaining', $purch->qty_received - $totalQty)
                    ->where('purchased_item_id', $purch->purchased_item_id)
                    ->update();

        }
        
        if (is_null($date)) {
            $assignItems = $this->assignModel->getAssignmentData(date('Y-m-d'));                    
            $getBoxes = $this->boxModel->getBoxes(date('Y-m-d'));
        } else {                        
            $assignItems = $this->assignModel->getAssignmentData($start, $end);    
            $getBoxes = $this->boxModel->getBoxes($start, $end);
        }
        
        
        // storing all to list
        
        foreach ($assignItems->getResultObject() as $purch) {           
            $boxes = array();          
            foreach ($getBoxes->getResultObject() as $box) {
                if ($box->assign_id == $purch->aid) {
                    array_push($boxes, $box);                    
                }
            }
            $item = [
                'lid' => $purch->lid,
                'id' => $purch->pid,
                'aid' => $purch->aid,
                'sid' => $purch->sid,
                'purchased_item_id' => $purch->purchased_item_id,
                'title' => $purch->title,
                'asin' => $purch->asin,
                'qty_ordered' => $purch->qty_ordered,
                'buy_cost' => $purch->buy_cost,
                'price' => $purch->market_price,
                'qty_returned' => $purch->qty_returned,
                'qty_received' => $purch->qty_received,
                'qty_assigned' => $purch->qty,           
                'qty_remaining' => $purch->qty_remaining,           
                'allocated_date' => $purch->allocated_date,
                'status' => $purch->status,
                'order_id' => $purch->order_id,
                'purchased_date' => $purch->purchased_date,
                'order_notes' => $purch->order_notes,
                'assigned_notes' => $purch->assigned_notes,
                'client_name' => $purch->client_name,
                'company' => $purch->company,
                'sent_date' => $purch->sent_date,
                'boxes' => $boxes
            ];
            array_push($items, $item);
            
        }
            
        

        $uid = session()->get('user_id');
        $clients = $this->clientModel->getClients($uid);

        $clientIDs = $this->clientModel->get();
        $clientList = $this->clientModel            
            ->where('check_flag', 'checked')
            ->get();
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Box Assignments',
            'clients' => $clients,
            'purchased_items' => $lists,
            'assigned_items' => $items,
            'client_id' =>  $clientIDs,
            'client_list' => $clientList,
            'start' => $startTemp,
            'end' => $endTemp
            
        ];
        
        return view('pnp/assignments', $data);
        
    }

    public function inventories() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {                      
            header("Location: ".base_url('/pnp/login'));
            die();            
        }
    
        $purchases = $this->assignModel->getAssignedData2();       
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
                'aid' => $purch->aid,
                'purchased_item_id' => $purch->purchased_item_id,
                'title' => $purch->title,
                'asin' => $purch->asin,
                'order_number' => $orderNumbers,
                'qty_ordered' => $purch->qty_ordered,
                'buy_cost' => $purch->buy_cost,
                'price' => $purch->market_price,
                'qty_returned' => $purch->qty_returned,
                'qty_received' => $purch->qty_received,
                'qty_remaining' => $purch->qty_remaining,
                'allocated_date' => $purch->allocated_date,
                'status' => $purch->status,
                'purchased_date' => $purch->purchased_date,
                'order_notes' => $purch->order_notes,
            ];

            array_push($lists, $item);
        }       
        $clientIDs = $this->clientModel->get();
        $clientList = $this->clientModel            
            ->where('check_flag', 'checked')
            ->get();
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Inventory Page',
            'purchased_items' => $lists,
            'client_id' =>  $clientIDs,
            'client_list' => $clientList,            
        ];

        return view('pnp/inventories', $data);
        
    }

    public function needToUpload() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {                      
            header("Location: ".base_url('/pnp/login'));
            die();            
        }
        $start = null;
        $end = null;
        $startTemp = null;
        $endTemp = null;

        $date = $this->request->getVar('date');
        if (!is_null($date)) {
            $temp = explode("to", $date);
            $temp = array_map('trim', $temp);
            
            // start
            $startTemp = $temp[0];
            $startExp = explode('-', $temp[0]);

            $start = $startExp[2].'-'.$startExp[0].'-'.$startExp[1];
            
            if (count($temp) > 1) {
                $endExp = explode('-', $temp[1]);                
                $endTemp = $temp[1];
                $end = $endExp[2].'-'.$endExp[0].'-'.$endExp[1];
            }
          
        } else {
            $start = date('Y-m-d', strtotime('-7 days'));
            $end = date('Y-m-d');
        }        
        $getBoxes = $this->boxModel->getBoxes($start, $end);
                
        $lists = array();        
        $totalUnit = 0;
        $avgUnitRetail = 0;
        $totalOriginalRetail = 0;
        $totalClientCost = 0;

        $getAllBox = $this->boxModel->getAllBox($start, $end);
        
        foreach ($getAllBox->getResultObject() as $purch) {
            if ($totalUnit > 0) {
                $avgUnitRetail = round($totalOriginalRetail / $totalUnit, 2);
            }
            $totalUnit = $totalUnit + $purch->allocation; 
            $totalClientCost = $totalClientCost + (round( $purch->allocation * $purch->buy_cost, 2));                                
            $totalOriginalRetail = $totalOriginalRetail + (round( $purch->allocation * $purch->market_price, 2));                                
            
        }
    
        $summary = [
            'totalUnit' => $totalUnit,
            'totalOriginalRetail' => $totalOriginalRetail, 
            'totalClientCost' => $totalClientCost,
            'avgUnitRetail' => $avgUnitRetail
        ];
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Need To Upload',
            'purchased_items' => array(),
            'boxes' => $getAllBox,
            'summary' => $summary,
            'start' => $startTemp,
            'end' => $endTemp
        ];

        return view('pnp/needtoupload', $data);        
    }

    public function shipments() {    
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }
        $date = $this->request->getVar('date');
        $startTemp = null;
        $endTemp = null;
        
        if (is_null($date) || empty($date)) {
            $getShipments = $this->trackingModel->getAllShipments(date('Y-m-d'), date('Y-m-d'));            
        } else {
            $temp = explode("to", $date);
            $temp = array_map('trim', $temp);
            
            // start
            $startTemp = $temp[0];
            $startExp = explode('-', $temp[0]);

            $start = $startExp[2].'-'.$startExp[0].'-'.$startExp[1];
            
            if (count($temp) > 1) {
                $endExp = explode('-', $temp[1]);                
                $endTemp = $temp[1];
                $end = $endExp[2].'-'.$endExp[0].'-'.$endExp[1];
            }
            $getShipments = $this->trackingModel->getAllShipments($start, $end);    
        }

        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Shipments',
            'shipments' => $getShipments,
            'start' => $startTemp,
            'end' => $endTemp
        ];
        return view('pnp/shipments', $data);
    }

    // admin
    public function dashboard() {        
        $userRole = session()->get('user_id');
        if (empty($userRole)) {
            header("Location: ".base_url('/pnp/login'));
            die();            
        }
        
        // purchase
        $totalPurchases = $this->assignModel->getTotalPurchaseWeek();        
        $totalPurchaseLastDay = 0;
        $totalPurchaseToday = 0;
        $purchaseData = array();
        $totalPurchaseThisWeek = 0;
        $count = 1;
        foreach ($totalPurchases->getResultArray() as $purch) {
            if ($purch['day'] == date('Y-m-d')) {
                $totalPurchaseToday = $purch['total_price'];
            } else if ($purch['day'] == date('Y-m-d', strtotime("-1 days"))) {                
                $totalPurchaseLastDay = $purch['total_price'];
            }
            if ($totalPurchaseToday == 0 && $count == 1) {
                $item = [
                    'day' => date('d M'),
                    'total_price' => 0,
                ];
                array_push($purchaseData, $item);
                $item = [
                    'day' => date('d M', strtotime($purch['day'])),
                    'total_price' => $purch['total_price'] 
                ];
                array_push($purchaseData, $item);
                
            } else {
                $item = [
                    'day' => date('d M', strtotime($purch['day'])),
                    'total_price' => $purch['total_price'] 
                ];
                array_push($purchaseData, $item);
            }
            $count++;
            $totalPurchaseThisWeek = $totalPurchaseThisWeek + $purch['total_price'];
        }
        

        $totalPurchaseMTD = $this->assignModel->getTotalPurchaseMonth();
        $totalPurchaseYTD = $this->assignModel->getTotalPurchaseYear();
        $purchase = [
            'purchase_data' => $purchaseData,
            'total_this_week' => $totalPurchaseThisWeek,
            'total_last_day' => $totalPurchaseLastDay,
            'total_today' => $totalPurchaseToday,
            'total_mtd' => $totalPurchaseMTD->getResultObject(),
            'total_ytd' => $totalPurchaseYTD->getResultObject()
        ];
        // dd($totalPurchaseYTD->getResultObject());
        // assignment
        $totalAssigned = $this->assignModel->getTotalAssignWeek();        
        $totalAssignedLastDay = 0;
        $totalAssignedToday = 0;
        $assignedData = array();
        $totalAssignedThisWeek = 0; 
        $count = 1;
        foreach ($totalAssigned->getResultArray() as $purch) {
            if ($purch['day'] == date('Y-m-d')) {
                $totalAssignedToday = $purch['total_assigned'];
            } else if ($purch['day'] == date('Y-m-d', strtotime("-1 days"))) {                
                $totalAssignedLastDay = $purch['total_assigned'];
            }
            if ($totalAssignedToday == 0 && $count == 1) {
                $item = [
                    'day' => date('d M'),
                    'total_assigned' => 0,
                ];
                array_push($assignedData, $item);
                $item = [
                    'day' => date('d M', strtotime($purch['day'])),
                    'total_assigned' => $purch['total_assigned'] 
                ];
                array_push($assignedData, $item);
                
            } else {
                $item = [
                    'day' => date('d M', strtotime($purch['day'])),
                    'total_assigned' => $purch['total_assigned']
                ];
                array_push($assignedData, $item);
            }
            $totalAssignedThisWeek = $totalAssignedThisWeek + $purch['total_assigned'];
            $count++;
        }
        

        $totalAssignedMTD = $this->assignModel->getTotalAssignedMonth();
        $totalAssignedYTD = $this->assignModel->getTotalAssignedYear();
        $assigned = [
            'assigned_data' => $assignedData,
            'total_this_week' => $totalAssignedThisWeek,
            'total_last_day' => $totalAssignedLastDay,
            'total_today' => $totalAssignedToday,
            'total_mtd' => $totalAssignedMTD->getResultObject(),
            'total_ytd' => $totalAssignedYTD->getResultObject()
        ];



        // need to upload
        $totalNTU = $this->assignModel->getTotalNTUWeek();        
        $totalNTULastDay = 0;
        $totalNTUToday = 0;
        $NTUData = array();
        $totalNTUThisWeek = 0;
        $count = 1;
        foreach ($totalNTU->getResultArray() as $purch) {
            if ($purch['day'] == date('Y-m-d')) {
                $totalNTUToday = $purch['total_cost'];
            } else if ($purch['day'] == date('Y-m-d', strtotime("-1 days"))) {                
                $totalNTULastDay = $purch['total_cost'];
            }
            if ($totalAssignedToday == 0 && $count == 1) {
                $item = [
                    'day' => date('d M'),
                    'total_cost' => 0,
                ];
                array_push($NTUData, $item);
                $item = [
                    'day' => date('d M', strtotime($purch['day'])),
                    'total_cost' => $purch['total_cost'] 
                ];
                array_push($NTUData, $item);
                
            } else {
                $item = [
                    'day' => date('d M', strtotime($purch['day'])),
                    'total_cost' => $purch['total_cost']
                ];
                array_push($NTUData, $item);
            }
            $count++;
            $totalNTUThisWeek = $totalNTUThisWeek + $purch['total_cost'];
        }
        

        $totalNTUMTD = $this->assignModel->getTotalNTUMonth();
        $totalNTUYTD = $this->assignModel->getTotalNTUYear();
        $NTU = [
            'ntu_data' => $NTUData,
            'total_this_week' => $totalNTUThisWeek,
            'total_last_day' => $totalNTULastDay,
            'total_today' => $totalNTUToday,
            'total_mtd' => $totalNTUMTD->getResultObject(),
            'total_ytd' => $totalNTUYTD->getResultObject()
        ];
   
        
        $totalReceived = $this->orderStatusModel->totalReceivedCompleted();
        $totalUnreceived = $this->orderStatusModel->totalUnReceivedCompleted(); ;
        $totalReceivedCompleted = $this->orderStatusModel->totalReceivedUncompleted();
        $totalUnassigned = $this->orderStatusModel->totalUnassigned();
        $inventory = [
            'total_received' => $totalReceived->total,
            'total_unreceived' => $totalUnreceived->total,
            'total_received_uncomleted' => $totalReceivedCompleted->total,
            'total_unassigned' => $totalUnassigned->total,
        ];
        $buyers = $this->buyerStaffModel
            ->join('buyer_details', 'buyer_details.buyer = buyers.id')
            ->get();

        
        $purchases = $this->assignModel->getAssignedData2();    
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

            $getClients = $this->shipmentModel->findClient($purch->pid);
            $clients = array();  
            $clientQty = array();
            foreach ($getClients->getResultObject() as $cl) {
                array_push($clients, $cl->client_name. ' ('.$cl->company.')' ); 
                array_push($clientQty, $cl->qty);
            }          
            
            $item = [
                'lid' => $purch->lid,
                'id' => $purch->pid,
                'aid' => $purch->aid,
                'purchased_item_id' => $purch->purchased_item_id,
                'title' => $purch->title,
                'asin' => $purch->asin,
                'order_number' => $orderNumbers,
                'qty_ordered' => $purch->qty_ordered,
                'buy_cost' => $purch->buy_cost,
                'price' => $purch->market_price,
                'qty_returned' => $purch->qty_returned,
                'qty_assigned' => $clientQty,
                'qty_received' => $purch->qty_received,
                'allocated_date' => $purch->allocated_date,
                'status' => $purch->status,                
                'purchased_date' => $purch->purchased_date,
                'assigned_date' => $purch->assigned_date,
                'order_notes' => $purch->order_notes,                
                'clients' => $clients,
               
            ];

            array_push($lists, $item);  
            
        }
        $totalQtyToday = $this->assignModel->getTotalQtyToday();
        $purchaseDataToday = $this->assignModel->getPurchaseDataToday();
        

        // source summary
        $start = null;
        $end = null;
        $startTemp = null;
        $endTemp = null;
        $startCC = null;
        $endCC = null;
        $startTempCC = null;
        $endTempCC = null;
        $startQty = null;
        $endQty = null;
        $startTempQty = null;
        $endTempQty = null;

        $date = $this->request->getVar('date');
        $dateCC = $this->request->getVar('dateCC');
        if (!is_null($date)) {
            $temp = explode("to", $date);
            $temp = array_map('trim', $temp);
            
            // start
            $startTemp = $temp[0];
            $startExp = explode('-', $temp[0]);

            $start = $startExp[2].'-'.$startExp[0].'-'.$startExp[1];
            
            if (count($temp) > 1) {
                $endExp = explode('-', $temp[1]);                
                $endTemp = $temp[1];
                $end = $endExp[2].'-'.$endExp[0].'-'.$endExp[1];
            }          
        } else {
            $start = date('Y-m-01');
            $end = date('Y-m-d');
        }

        // $sourceSummary = $this->leadModel->sourceSummary($start, $end);

        if (!is_null($dateCC)) {
            $tempCC = explode("to", $dateCC);
            $tempCC = array_map('trim', $tempCC);
            
            // start
            $startTempCC = $tempCC[0];
            $startExpCC = explode('-', $tempCC[0]);

            $startCC = $startExpCC[2].'-'.$startExpCC[0].'-'.$startExpCC[1];
            
            if (count($tempCC) > 1) {
                $endExpCC = explode('-', $tempCC[1]);                
                $endTempCC = $tempCC[1];
                $endCC = $endExpCC[2].'-'.$endExpCC[0].'-'.$endExpCC[1];
            }          
        } else {
            $startCC = date('Y-m-01');
            $endCC = date('Y-m-d');
        }
        $CCUsages = $this->buyerModel->getCCUsage($startCC, $endCC);
        $totalCCUsage = 0;
        $totalQty = 0;
        foreach ($CCUsages->getResultObject() as $cc) {
            $totalCCUsage = $totalCCUsage + $cc->total_buy_cost;
            $totalQty = $totalQty + $cc->total_qty;
        }

        $logs = $this->logModel->getLogData(1);
        $year = $this->request->getVar('year');
        $getMonthlySummary = $this->leadModel->getMonthlySummary($year);
        $totalBuyCost = 0;
        $totalProfit = 0;
        $totalSellPrice = 0;
        $totalMargin = 0;
        $totalROI = 0;
        $totalQTY = 0;
        
        foreach ($getMonthlySummary->getResultObject() as $summary) {
            $totalBuyCost = $totalBuyCost + $summary->buy_cost; 
            $totalProfit = $totalProfit + $summary->profit; 
            $totalSellPrice = $totalSellPrice + $summary->sell_price; 
            $totalMargin = $totalMargin + $summary->margin; 
            $totalROI = $totalROI + $summary->roi; 
            $totalQTY = $totalQTY + $summary->qty; 
        }

        $getAnnualuSummary = [
            'buy_cost' => $totalBuyCost,
            'sell_price' => $totalSellPrice,
            'profit' => $totalProfit,
            'margin' => $totalMargin,
            'roi' => $totalROI,
            'qty' => $totalQTY
        ];
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }

        $totalQtyReceivedToday = $this->orderStatusModel->getTotalReceived(date('Y-m-d'));
        $totalQtyUnreceivedToday = $this->orderStatusModel->getTotalUnreceived(date('Y-m-d'));
        $totalQtyRefundToday = $this->orderStatusModel->getTotalRefund(date('Y-m-d'));

        $dateQty = $this->request->getVar('date-qty');
        if (!is_null($dateQty)) {
            $tempQty = explode("to", $dateQty);
            $tempQty = array_map('trim', $tempQty);
            
            // start
            $startTempQty = $tempCC[0];
            $startExpQty = explode('-', $tempQty[0]);

            $startQty = $startExpQty[2].'-'.$startExpQty[0].'-'.$startExpQty[1];
            
            if (count($tempQty) > 1) {
                $endExpQty = explode('-', $tempQty[1]);                
                $endTempQty = $tempQty[1];
                $endQty = $endExpQty[2].'-'.$endExpQty[0].'-'.$endExpQty[1];
            }          
        } else {
            $startQty = date('Y-m-01');
            $endQty = date('Y-m-d');
        }
        
        
        $getAllQtyOverview = $this->orderStatusModel->getAllQty($startQty, $endQty);
        $getTotalQtyOverview = $this->orderStatusModel->getTotalAllQty($startQty, $endQty);
        
        
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'Dashboard',
            'totalQtyToday' => $totalQtyToday,
            'purchaseDataToday' => $purchaseDataToday,
            'totalReceivedToday' => $totalQtyReceivedToday,
            'totalUnreceivedToday' => $totalQtyUnreceivedToday,
            'totalRefundToday' => $totalQtyRefundToday,
            'assigned' => $assigned,
            'purchase' => $purchase,            
            'ntu' => $NTU,
            'inventory' => $inventory,
            'reports' => $lists,
            // 'sourceSummary' => $sourceSummary,
            'getMonthlySummary' => $getMonthlySummary,
            'getAnnualuSummary' => $getAnnualuSummary,
            'CCUsages' => $CCUsages,
            'start' => $startTemp,
            'end' => $endTemp,
            'startCC' => $startTempCC,
            'endCC' => $endTempCC,
            'startQty' => $startTempQty,
            'endQty' => $endTempQty,
            'year' => $year,
            'totalCCUsage' => $totalCCUsage,
            'totalQty' => $totalQty,
            'qtyOverView' => $getAllQtyOverview,
            'qtyTotalQtyOverview' => $getTotalQtyOverview,
            'logs' => $logs
            
        ];        
        return view('pnp/dashboard', $data);        
    }

    public function users() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        $users = $this->userModel
            ->select('users.*, valid_date, expire_date, plan')
            ->join('subscriptions', 'subscriptions.user_id = oauth_uid', 'left')
            ->where('role !=', 'superadministrator')->get();

        $data = [
            'title' => 'Users',
            'users' => $users
        ];
        return view('admin/users', $data);
    }

    public function addUser() {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('new_password');
        $role = $this->request->getVar('role');

        $this->userModel->save([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role
        ]);

        return redirect()->to(base_url('/admin/users'))->with('message', 'User Successfully Added!');
    
    }

    public function fileParameter() {
        $userRole = session()->get('user_id');
        
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        $templates = $this->fileModel->getAllPatterndata();
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'File Parameter',
            'templates' => $templates
        ];
        return view('pnp/file-parameter', $data);
    }

    public function UPCLookup() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        $logUPCLookup = $this->UPCLookupModel->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'UPC Lookup',            
            'logUPCLookup' => $logUPCLookup,
        ];
        return view('admin/upc-lookup', $data);
    }

    public function test() {
        $nodes = array('B0BTTVMF4T', 'B0BP2WYHJS');
        $node_count = count($nodes);

        $curl_arr = array();
        $master = curl_multi_init();

        for($i = 0; $i < $node_count; $i++)
        {
            
            $curl_arr[$i] = curl_init();
            curl_setopt_array($curl_arr[$i], array(
                CURLOPT_URL => 'https://api.algopix.com/v3/search?idType=ASIN&markets=AMAZON_US&keywords='.$nodes[$i].'',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-API-KEY: e9I5ltJ8MkDZxhWwkCOLIQleIlygl1aHXLa5mxXZ',
                    'X-APP-ID: AjLlYtXRo9LHnIlpox277B'
                ),
            ));
            curl_multi_add_handle($master, $curl_arr[$i]);
        }

        do {
            curl_multi_exec($master,$running);
        } while($running > 0);

        echo "results: ";
        $no = 1;
        for($i = 0; $i < $node_count; $i++)
        {
            $results = curl_multi_getcontent  ( $curl_arr[$i]  );
            echo $no;
            print_r($results);
            echo "<br>";
            echo "<br>";
            $no++;
        }
        echo 'done';
    }

    public function test2() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.algopix.com/v4/products/details?productId=B0725KXTPS&productIdType=ASIN&channel=AMAZON_US',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-API-KEY: e9I5ltJ8MkDZxhWwkCOLIQleIlygl1aHXLa5mxXZ',
            'X-APP-ID: AjLlYtXRo9LHnIlpox277B'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.algopix.com/v4/products/details?productId=B0BP2WYHJS&productIdType=ASIN&channel=AMAZON_US',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-API-KEY: e9I5ltJ8MkDZxhWwkCOLIQleIlygl1aHXLa5mxXZ',
            'X-APP-ID: AjLlYtXRo9LHnIlpox277B'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function history() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        if ($userRole == 'administrator') {
            $logs = $this->logModel->getLogData(1);
        } else {
            $logs = $this->logModel->getLogData();
        }
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'title' => 'User Activity',            
            'logs' => $logs,
        ];

        return view('pnp/history', $data);
        
    }
    
    public function backuprestore() {
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }

        $lastUpload = $this->userModel
            ->where('id', session()->get('user_id'))                                    
            ->orderBy('id', 'DESC')
            ->get();   
        $lastUpload = $lastUpload->getFirstRow();     
        $data = [
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'lastUpload' => $lastUpload,
            'title' => 'Backup & Restore',            
        ];

        return view('pnp/backup', $data);
    }

    public function refunds() {
        $date = $this->request->getVar('date');
        $start = null;
        $end = null;
        $startTemp = null;
        $endTemp = null;
        if (!is_null($date)) {
            $temp = explode("to", $date);
            $temp = array_map('trim', $temp);
            
            // start
            $startTemp = $temp[0];
            $startExp = explode('-', $temp[0]);

            $start = $startExp[2].'-'.$startExp[0].'-'.$startExp[1];
            
            if (count($temp) > 1) {
                $endExp = explode('-', $temp[1]);                
                $endTemp = $temp[1];
                $end = $endExp[2].'-'.$endExp[0].'-'.$endExp[1];
            }
        } else {
            $start = date('Y-m-d', strtotime('-8 days'));
            $end = date('Y-m-d');
        }
        
        $items = $this->refundModel->getAllRefundItems($start, $end);        
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }        

        $data = [            
            'title' => 'Refund Page',            
            'subscription' => [
                'plan' => $plan,
                'days' => $days,
                'start' => $startSub, 
                'exp' => $expSub, 
            ],
            'start' => $startTemp,
            'end' => $endTemp,
            'items' => $items,            
        ];

        return view('pnp/refunds', $data);
    }

    public function masterListAll() {
        $user = $this->request->getVar('user');
        
        $purchases = $this->assignModel->getAssignedDataAll($user);    
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
                'id' => $purch->pid,
                'aid' => $purch->aid,
                'purchased_item_id' => $purch->purchased_item_id,
                'title' => $purch->title,
                'asin' => $purch->asin,
                'order_number' => $orderNumbers,
                'qty_ordered' => $purch->qty_ordered,
                'buy_cost' => $purch->buy_cost,
                'price' => $purch->market_price,
                'qty_returned' => $purch->qty_returned,
                'qty_assigned' => $purch->qty_received - $purch->qty_remaining,
                'qty_received' => $purch->qty_received,
                'allocated_date' => $purch->allocated_date,
                'status' => $purch->status,                
                'purchased_date' => $purch->purchased_date,
                'order_notes' => $purch->order_notes,                
              
            ];

            array_push($lists, $item);  
            
        }
        
        // dd($lists);
        
        $response = "";        
        
        $clientIDs = $this->clientModel->get();
        $clientList = $this->clientModel            
            ->where('check_flag', 'checked')
            ->get();
        // check payment
        $getPaymentData = $this->subsModel
            ->where('user_id', session()->get('oauth_uid'))
            ->where('expire_date >=', date('Y-m-d'))            
            ->get();
        $getPaymentData = $getPaymentData->getFirstRow();
        $startSub = null;
        $expSub = null;
        if (!is_null($getPaymentData) != 0) {
            $currDate = date_create(date('Y-m-d'));
            $expireDate = date_create(date('Y-m-d', strtotime($getPaymentData->expire_date)));            
            $days = date_diff($currDate,$expireDate);
            $days = $days->days;
            $plan = $getPaymentData->plan;
            $startSub = $getPaymentData->valid_date;
            $expSub = $getPaymentData->expire_date; 
        } else {            
            $plan = 0;
            $days = 0;
        }
        $users = $this->userModel->where('role <>', 'superadministrator')->get();
        $data = [            
            'title' => 'Master List',
            'purchased_items' => $lists,
            'clients' => $response,   
            'client_id' =>  $clientIDs,
            'client_list' => $clientList,
            'users' => $users
            
        ];
        return view('admin/master-lists', $data);
    }

    public function chat() {
        $user = session()->get('oauth_uid');
        $messages = $this->messageModel->getUserMessage($user);
        $data = [            
            'title' => 'Chat',
            'messages' => $messages            
        ];
        return view('pnp/chat', $data);
    }
    
} 
