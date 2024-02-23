<?php 
namespace App\Controllers\b2b;

use App\Models\b2b\AssignModel;
use App\Models\b2b\BoxModel;
use App\Models\b2b\LeadModel;
use App\Models\b2b\OrderModel;
use App\Models\b2b\OrderStatusModel;
use App\Models\b2b\RefundModel;
use App\Models\b2b\UPCLookupModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class API extends BaseController
{   
    protected $UPCLookupModel = "";
    protected $boxModel = "";
    protected $leadModel = "";
    protected $orderModel = "";
    protected $orderStatusModel = "";
    protected $userModel = "";
    protected $assignModel = "";
    protected $refundModel = "";

    public function __construct()
    {
        $this->UPCLookupModel = new UPCLookupModel();
        $this->boxModel = new BoxModel();
        $this->leadModel = new LeadModel();
        $this->orderModel = new OrderModel();
        $this->orderStatusModel = new OrderStatusModel();
        $this->userModel = new UserModel();
        $this->assignModel = new AssignModel();
        $this->refundModel = new RefundModel();
    }

    public function getUPCDetails() {
        $upc = $this->request->getFile('upc_file'); 
        $ext = $upc->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        
        $fileName = 'result-'.$upc->getName();
        
        
        $spreadsheet = $render->load($upc);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $productDetails = array();
        foreach ($data as $idx => $row) {
            if (!is_null($row[0])) {
                $desc = $this->rainforestAPI($row[0]);
                
                if ($desc->request_info->success == false) {
                    $temp = [
                        'upc' => $row[0],
                        'asin' => '-',                            
                        'title' => '-',
                        'description' => '-',
                        'brand' => '-',
                        'price' => '-',
                        'link' => '-',
                        'rating' => '-',
                        'images' => '-'
                    ];
                } else {
                    if (empty($desc->product->rating)) {
                        $temp = [
                            'upc' => $row[0],
                            'asin' => $desc->product->asin,                            
                            'title' => $desc->product->title,
                            'description' => $desc->product->description,
                            'brand' => $desc->product->brand,
                            'price' => $desc->product->buybox_winner->price->raw,
                            'link' => $desc->product->link,
                            'rating' => '-',
                            'images' => $desc->product->images_flat
                        ];
                    } else {
                        $temp = [
                            'upc' => $row[0],
                            'asin' => $desc->product->asin,                            
                            'title' => $desc->product->title,
                            'description' => $desc->product->description,
                            'brand' => $desc->product->brand,
                            'price' => $desc->product->buybox_winner->price->raw,
                            'link' => $desc->product->link,
                            'rating' => $desc->product->rating,                            
                            'images' => $desc->product->images_flat
                        ];

                        print_r($desc);
                    }
                }
                
                array_push($productDetails, $temp);
            }
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'UPC');
        $sheet->setCellValue('B1', 'ASIN');
        $sheet->setCellValue('C1', 'TITLE');
        $sheet->setCellValue('D1', 'DESCRIPTION');
        $sheet->setCellValue('E1', 'BRAND');
        $sheet->setCellValue('F1', 'AMAZON PRICE');
        $sheet->setCellValue('G1', 'AMAZON LINK');
        $sheet->setCellValue('H1', 'RATING');
        $sheet->setCellValue('I1', 'IMAGES');
        $cell = 2;
        foreach($productDetails as $det) {
            $sheet->setCellValue('A' . $cell, $det['upc']);              
            $sheet->setCellValue('B' . $cell, $det['asin']);               
            $sheet->setCellValue('C' . $cell, $det['title']);               
            $sheet->setCellValue('D' . $cell, $det['description']);               
            $sheet->setCellValue('E' . $cell, $det['brand']);               
            $sheet->setCellValue('F' . $cell, $det['price']);                
            $sheet->setCellValue('G' . $cell, $det['link']);               
            $sheet->setCellValue('H' . $cell, $det['rating']);                
            $sheet->setCellValue('I' . $cell, $det['images']);               
            $cell++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save("files/". $fileName);
        $this->UPCLookupModel->insert([
            'file_upload' => $upc->getName(),
            'file_download' => $fileName
        ]);
        echo json_encode(
            ['file' => $fileName]
        );           

    }

    public function rainforestAPI($upc) {
        $queryString = http_build_query([
            'api_key' => '98AEA1D9BA904C9DAA2EBCB42361A4AD',
            'amazon_domain' => 'amazon.com',
            'gtin' => $upc,
            'type' => 'product'
        ]);

        # make the http GET request to Rainforest API
        $ch = curl_init(sprintf('%s?%s', 'https://api.rainforestapi.com/request', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        # the following options are required if you're using an outdated OpenSSL version
        # more details: https://www.openssl.org/blog/blog/2021/09/13/LetsEncryptRootCertExpire/
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_TIMEOUT, 180);

        $api_result = curl_exec($ch);
        curl_close($ch);

        # print the JSON response from Rainforest API
        $product = json_decode($api_result);
        return $product;
    }    


    public function getAllBoxName() {
        $getBoxNames = $this->boxModel->orderBy('id', 'DESC')->groupBy('box_name')->get();
        $suggestions = [];
        // Get the user input
        $term = $_GET['term'];
        foreach ($getBoxNames->getResultObject() as $box) {
            array_push($suggestions, $box->box_name);
            
        } 

        

        // Filter suggestions based on user input
        $filteredSuggestions = array_filter($suggestions, function($item) use ($term) {
            return stripos($item, $term) !== false;
        });

        // Return the filtered suggestions as JSON
        header('Content-Type: application/json');
        echo json_encode($filteredSuggestions);
    }   
    
    public function getLeadData() {
        $id = $this->request->getVar('id');
        $lead = $this->leadModel            
            ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')
            
            ->getWhere(['lead_lists.id' => $id])
            ->getRow();
        echo json_encode($lead);
    }

    public function splitData() {
        $post = $this->request->getVar();
        $getDetails = $this->leadModel
            ->select('lead_lists.*, purchase_items.qty, orders_status.purchased_date')
            ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')
            ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
            ->getWhere(['lead_lists.id' => $post['id']])            
            ->getRow();
        $leads = array(
            'title' => $post['new-desc'],
            'asin' => $post['new-asin'],
            'retail_link' => $getDetails->retail_link,
            'amazon_link' => $getDetails->amazon_link,
            'buy_cost' => $getDetails->buy_cost,
            'promo_code' =>  $getDetails->promo_code,
            'brand' => '-',
            'category' => '-',
            'best_sales_rank' => $getDetails->best_sales_rank,
            'market_price' => $getDetails->market_price,
            'martket_place_fees' => 0,
            'fba_selling_fees' => 0,
            'profit' => $getDetails->profit,
            'roi' => $getDetails->roi,
            'file_id' => session()->get('user_id'),
            'source' => $getDetails->source,
            
        );
        // insert rows                          
        $this->leadModel->save($leads);    

        $leadID = $this->leadModel->getInsertID();

        $this->orderModel->insert([
            'lead_id' => $leadID,
            'qty' => $post['new-qty'],
            'order_staff' => session()->get('user_id'),             
            'created_at' => $getDetails->purchased_date
        ]);
        
        $this->orderStatusModel->insert([
            'purchased_item_id' => $this->orderModel->getInsertID(),
            'purchased_date' =>  $getDetails->purchased_date
        ]);
        
        $this->assignModel->insert([
            'item_id' => $this->orderModel->getInsertID()
        ]);

        // update qty 
        $this->orderModel
            ->set('qty', $getDetails->qty - $post['new-qty'])
            ->where('lead_id', $post['id'])
            ->update();
    }

    public function exportRefund($date = null) {        
        $user = session()->get();
        $start = null;
        $end = null;
        if (!is_null($date)) {
            $temp = explode("&", $date);            
            // start
            $startExp = explode('-', $temp[0]);
            $start = $startExp[2].'-'.$startExp[0].'-'.$startExp[1];
            if (count($temp) > 1) {
                $endExp = explode('-', $temp[1]);                
                $end = $endExp[2].'-'.$endExp[0].'-'.$endExp[1];
            }
        } else {
            $start = date('Y-m-d', strtotime('-8 days'));
            $end = date('Y-m-d');
        }
        $refundData = $this->refundModel->getAllRefundItems($start, $end);
        $path = FCPATH."/assets/img/wholesales-logo.png";
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $data = [
            'user' => $user,
            'logo' => $base64,
            'refundData' => $refundData->getResultObject(),
            'totalUnit'
        ];
        // dd($user);
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('refund-pdf', $data));
        $dompdf->setPaper('legal');
        $dompdf->render();        
        $dompdf->stream("Refunds - ". time() ." .pdf");
        $fileName = "Refunds - ". time() ." .pdf";
        return $fileName;
    }

    public function updateShippingCost() {
        $id = $this->request->getVar('id');
        $cost = $this->request->getVar('cost');
        // check 
        $isExist = $this->refundModel->getWhere(['lead_id' => $id])->getRow();
        
        if (is_null($isExist)) {
            // insert
            $this->refundModel->save([
                'lead_id' => $id,
                'shipping_cost' => $cost
            ]);
        } else {
            $this->refundModel
                ->set('shipping_cost', $cost)
                ->where('id', $isExist->id)
                ->update();
        }
    }
    
    public function updateShippingNotes() {
        $id = $this->request->getVar('id');
        $notes = $this->request->getVar('notes');
        // check 
        $isExist = $this->refundModel->getWhere(['lead_id' => $id])->getRow();
        
        if (is_null($isExist)) {
            // insert
            $this->refundModel->save([
                'lead_id' => $id,
                'notes' => $notes
            ]);
        } else {
            $this->refundModel
                ->set('notes', $notes)
                ->where('id', $isExist->id)
                ->update();
        }
    }
}

?>