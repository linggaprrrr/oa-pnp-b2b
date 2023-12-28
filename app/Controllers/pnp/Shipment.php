<?php 

namespace App\Controllers\pnp;

use App\Models\LogModel;
use App\Models\pnp\OrderModel;
use App\Models\pnp\ShipmentModel;
use App\Models\pnp\TrackingModel;
use App\Models\UserModel;


class Shipment extends BaseController
{
    protected $shipmentModel = "";
    protected $userModel = "";
    protected $logModel = "";
    protected $trackingModel = "";
    protected $orderModel = "";
    protected $API_KEY = "ueiw0i08-7ywq-22yb-laz2-07m00qrvlqgd";

    public function __construct()
    {
        $userId = session()->get('user_id');
        if (is_null($userId)) {
            header("Location: ".base_url('/pnp/login'));
            die();            
        }
        $this->userModel = new UserModel();
        $this->shipmentModel = new ShipmentModel();  
        $this->logModel = new LogModel();
        $this->trackingModel = new TrackingModel();
        $this->orderModel = new OrderModel();
    }

    public function inputShipment() {
        $id = $this->request->getVar('id');
        $trackingNumber = trim($this->request->getVar('tracking_number'));

        $isExist = $this->trackingModel->where('purchase_id', $id)->get();
        if ($isExist->getNumRows() > 0) {
            $this->shipmentModel
                ->set('tracking_number', $trackingNumber)
                ->where('purchase_id', $id)
                ->update();
        } else {
            if ($trackingNumber != "") {
                $this->trackingShipment($id, $trackingNumber);
            }
        }
    }

    public function addToShipments($trackingNumber = null) {         
        $assignId = $this->request->getVar('assign_id');        
        $client = $this->request->getVar('client');
        $shipments = array();
        $shipmentId = "";
        $id = "";
        $asins = array();
        $itemIds = array();

        if (isset($client)) {
            for ($i = 0; $i < count($client); $i++) {
                if (!empty($client[$i]) || $client[$i] != '') {                
                    $isExist = $this->shipmentModel->isItemExist($assignId[$i]);
                    $getASIN = $this->shipmentModel->getASINData($assignId[$i]);
                    array_push($asins, $getASIN->asin);
                    array_push($itemIds, $assignId[$i]);
                    if ($isExist->getNumRows() == 0) {                    
                        if ($id = array_search($client[$i], $shipments)) {                    
                            $this->shipmentModel->addItemToShipments($assignId[$i], $id);                    
                        } else {
                            $this->shipmentModel->save([
                                'fba_number' => NULL,
                                'shipment_number' => NULL,
                                'created_at' => date('Y-m-d H:i:s')
                            ]);                                     
                            $shipmentId = $this->shipmentModel->getInsertID();                    
                            $this->shipmentModel->addItemToShipments($assignId[$i], $shipmentId);                       
                            $shipments[$shipmentId] = $client[$i];
                        }
                    }
    
                }
            }        
            $resp = [
                'status' => '200',
                'result' => 'success',
                'id' => $itemIds,
                'asins' =>  $asins,                
            ];
        } else {
            $resp = [
                'status' => '200',
                'result' => 'error',                
                'id' => $itemIds,
                'asins' =>  $asins
            ];
        }
        $user = $this->userModel->find(session()->get('user_id'));  
        $this->logModel->save([
            'user_id' => $user['id'],
            'title' => 'create-ntu',
            'description' => '['. strtoupper($user['role']) .'] '. $user['username']. ' created Need To Upload',
            'level' => '2',
            'items' => implode(', ', $asins),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        return json_encode($resp);
        
    }

    public function trackingShipment($buyerId = null, $number = null, $purchId = null) {        
        $info = "";
        if ($buyerId == null) {
            $trackingNumber = $this->request->getVar('tracking_number');
            $info = $this->request->getVar('shipment_information');
        } else {
            $trackingNumber = $number;            
        }
        
        $getCourier = $this->detectCourier($trackingNumber);
        // get courier code
        $courierCode = "";   
        $courierName = "";
        $courierLogo = "";
        
        if ($getCourier['meta']['code'] == '200') {
            $courierCode = $getCourier['data'][0]['courier_code'];
            $courierName = $getCourier['data'][0]['courier_name'];
            $courierLogo = $getCourier['data'][0]['courier_logo'];      
            // get shipment information if exist 
            $getShipment = $this->getShipmentInfo($trackingNumber);
            $courierData = [
                'code' => $courierCode, 
                'name' => $courierName, 
                'logo' => $courierLogo
            ];

            

            
            if ($getShipment['meta']['code'] == 200) {
                $shipmentId = $this->trackingModel->isTrackingExist($trackingNumber);
                
                if (!is_null($shipmentId)) {        
                    $this->trackingModel->addDetails($buyerId, $shipmentId['id'], $purchId);
                }
                return json_encode([
                    'courier' => $courierData,
                    'tracking' => $getShipment['data'][0],
                ]);
            } else {
                // create shipment
                $data = [
                    'trackingNumber' => $trackingNumber,
                    'courierCode' => $courierCode,
                    'shipmentInfo' => $info,
                    'courierName' => $courierName,                
                    'courierLogo' => $courierLogo,
                ];
                $createTracking =  $this->createTracking($data);


                
                if ($createTracking['meta']['code'] == 200) {
                    $this->trackingModel->save([                    
                        'tracking_id' => $createTracking['data']['id'],
                        'tracking_number' => $trackingNumber,
                        'courier_code' => $courierCode,
                        'courier_name' => $courierName,
                        'courier_logo' => $courierLogo,
                        'service_code' => $createTracking['data']['service_code'],
                        'order_information' => $info,
                        'origin' => $createTracking['data']['origin_city'] .' ,'. $createTracking['data']['origin_state'] .' '. $createTracking['data']['origin_country'],
                        'destiny' => $createTracking['data']['destination_city'] .' ,'. $createTracking['data']['destination_state'] .' '. $createTracking['data']['destination_country'],
                    ]);
                    $shipmentId = $this->trackingModel->getInsertID();
                    if (!is_null($buyerId)) {
                        $this->trackingModel->addDetails($buyerId, $shipmentId, $purchId);
                    }
                    for ($i = 0; $i < count($createTracking['data']['origin_info']['trackinfo']); $i++) {
                        $trackingInfo = [
                            'shipment_id' => $this->trackingModel->getInsertID(),
                            'checkpoint_date_format' => $createTracking['data']['origin_info']['trackinfo'][$i]['checkpoint_date'],
                            'checkpoint_date' => date('M d, Y', strtotime($createTracking['data']['origin_info']['trackinfo'][$i]['checkpoint_date'])) .' at '.date('h:i', strtotime($createTracking['data']['origin_info']['trackinfo'][$i]['checkpoint_date'])),
                            'status' => $createTracking['data']['origin_info']['trackinfo'][$i]['checkpoint_delivery_status'],
                            'tracking_details' => $createTracking['data']['origin_info']['trackinfo'][$i]['tracking_detail'],
                            'location' => ($createTracking['data']['origin_info']['trackinfo'][$i]['location'] == null) ? strtoupper($createTracking['data']['origin_info']['trackinfo'][$i]['checkpoint_delivery_status']) : $createTracking['data']['origin_info']['trackinfo'][$i]['location'],
                        ];
                        $this->trackingModel->addTrackingDetail($trackingInfo);
                    }
                    return json_encode([
                        'courier' => $courierData,
                        'tracking' => $createTracking['data'],
                    ]);
                }
            }
        }
    }

    public function trackingCurrentShipment($trackingNumber) {
        $getCourier = $this->detectCourier($trackingNumber);
        // get courier code
        $courierCode = "";   
        $courierName = "";
        $courierLogo = "";

        if ($getCourier['meta']['code'] == '200') {
            $courierCode = $getCourier['data'][0]['courier_code'];
            $courierName = $getCourier['data'][0]['courier_name'];
            $courierLogo = $getCourier['data'][0]['courier_logo'];      
            // get shipment information if exist 
            $getShipment = $this->getShipmentInfo($trackingNumber);
            $courierData = [
                'code' => $courierCode, 
                'name' => $courierName, 
                'logo' => $courierLogo
            ];
        }
    }

    public function getShipmentInfoByItem() {
        $id = $this->request->getVar('id');
        $getShipment = $this->trackingModel->getShipmentByItem($id);

        echo json_encode($getShipment->getResultObject());
    }

    public function createTracking($trackingInfo) {
        $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.trackingmore.com/v4/trackings/create",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'tracking_number' => $trackingInfo['trackingNumber'],
                    'courier_code' => $trackingInfo['courierCode'],
                    'order_number' => '-',
                    'customer_name' => 'Joe',
                    'title' => $trackingInfo['shipmentInfo'],
                    'language' => 'en',
                    'note' => ''
                ]),
                CURLOPT_HTTPHEADER => [
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "Tracking-Api-Key: ". $this->API_KEY. ""
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            return json_decode($response, true);
    }

    public function detectCourier($trackNumber) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.trackingmore.com/v4/couriers/detect",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'tracking_number' => $trackNumber
            ]),

            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "Tracking-Api-Key: ".$this->API_KEY.""
            ],
        ]);

        $response = curl_exec($curl);        
        curl_close($curl);
        return json_decode($response, true);
    }

    public function getShipmentInfo($trackingNumber) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.trackingmore.com/v4/trackings/get?tracking_numbers=".$trackingNumber."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "Tracking-Api-Key: ".$this->API_KEY.""
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return json_decode($response, true);        
    }

    public function getTrackingInfo() {
        $track = $this->request->getVar('tracking');
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.trackingmore.com/v4/trackings/get?tracking_numbers=".$track."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "Tracking-Api-Key: ".$this->API_KEY.""
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        echo $response;    
    }

    public function updateTracking() {
        $trackingNumber = $this->request->getVar('id');

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.trackingmore.com/v4/trackings/get?tracking_numbers=".$trackingNumber."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "Tracking-Api-Key: ".$this->API_KEY.""
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        $getShipment = $this->trackingModel 
            ->select('tracking_shipments.*, tracking_details.checkpoint_date_format')
            ->join('tracking_details', 'tracking_details.shipment_id = tracking_shipments.id')
            ->where('tracking_number', $trackingNumber)
            ->groupBy('tracking_shipments.id')
            ->get();
        $getShipment = $getShipment->getFirstRow();
        $res = json_decode($response);
        
        $diff = '';
        $status = '';
        $location = '';
        $details = '';
        $checkPoint = '';

        if ($res->meta->code == 200) {
            $currentCheckPoint = date_create(date('Y-m-d h:i:s', strtotime($getShipment->checkpoint_date_format)));
            $lastCheckPoint = date_create(date('Y-m-d h:i:s', strtotime($res->data[0]->origin_info->trackinfo[0]->checkpoint_date)));
            $diff = date_diff($currentCheckPoint,$lastCheckPoint);
            $diff = $diff->i;
            $status = $res->data[0]->origin_info->trackinfo[0]->checkpoint_delivery_status;
            $location = $res->data[0]->origin_info->trackinfo[0]->location;
            $details = $res->data[0]->origin_info->trackinfo[0]->tracking_detail;
            $checkPoint = date('M d, Y', strtotime($res->data[0]->origin_info->trackinfo[0]->checkpoint_date)) .' at '.date('h:i', strtotime($res->data[0]->origin_info->trackinfo[0]->checkpoint_date));
            $this->trackingModel->deleteShipmentDetail($getShipment->id);
            for ($i = 0; $i < count($res->data[0]->origin_info->trackinfo); $i++) {
                $trackingInfo = [
                    'shipment_id' => $getShipment->id,
                    'checkpoint_date_format' => $res->data[0]->origin_info->trackinfo[$i]->checkpoint_date,
                    'checkpoint_date' => date('M d, Y', strtotime($res->data[0]->origin_info->trackinfo[$i]->checkpoint_date)) .' at '.date('h:i', strtotime($res->data[0]->origin_info->trackinfo[$i]->checkpoint_date)),
                    'status' => $res->data[0]->origin_info->trackinfo[$i]->checkpoint_delivery_status, 
                    'tracking_details' => $res->data[0]->origin_info->trackinfo[$i]->tracking_detail,
                    'location' => ($res->data[0]->origin_info->trackinfo[$i]->location == null) ? strtoupper($res->data[0]->origin_info->trackinfo[$i]->checkpoint_delivery_status) : $res->data[0]->origin_info->trackinfo[$i]->location,
                ];
                $this->trackingModel->addTrackingDetail($trackingInfo);
            }
        }

        
        if ($diff != 0) {
            $result = json_encode([
                'message' => 'success',
                'status' => $status,
                'check_point' => $checkPoint,
                'location' => $location,
                'details' => $details
            ]);

        } else {
            $result = json_encode([
                'message' => 'nodiff'
            ]);
        }
        echo $result;
    }
}
?>