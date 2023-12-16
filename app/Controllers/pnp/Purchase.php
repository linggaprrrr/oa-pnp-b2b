<?php

namespace App\Controllers\pnp;
use App\Models\pnp\LeadModel;
use App\Models\pnp\ScanUnlimitedModel;
use App\Models\pnp\FileModel;
use App\Models\pnp\OrderModel;
use App\Models\pnp\StaffModel;
use App\Models\pnp\BuyerStaffModel;
use App\Models\LogModel;
use App\Models\UserModel;
use LDAP\Result;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Purchase extends BaseController
{
    protected $leadModel = "";
    protected $scanUnlimitedsModel = "";
    protected $fileModel = "";
    protected $orderModel = "";
    protected $staffModel = "";
    protected $buyerModel = "";
    protected $logModel = "";
    protected $userModel = "";

    public function __construct()
    {
        $userId = session()->get('user_id');
        if (is_null($userId)) {
            header("Location: ".base_url('/login'));
            die();            
        }
        $this->leadModel = new LeadModel();
        $this->scanUnlimitedsModel = new ScanUnlimitedModel();
        $this->fileModel = new FileModel();
        $this->orderModel = new OrderModel();
        $this->staffModel = new StaffModel();
        $this->buyerModel = new BuyerStaffModel();
        $this->logModel = new LogModel();
        $this->userModel = new UserModel();
        
    }

    public function index()
    {
        $user = $this->userModel->find(session()->get('user_id'));    
        print_r($user);
    }

    public function uploadFile() {
        $file = $this->request->getVar('file');
        $pattern = $this->request->getVar('pattern_id');
        $getPattern = $this->fileModel->getPatternById($pattern);
        $this->fileModel->save([
            'filename' =>  $file,
            'oauth_uid' => session()->get('oauth_uid'),
            'file_template_id' => $pattern,
            'created_at' => date('Y-m-d H:i:s')
        ]);        
        echo json_encode([
            'file_id' => $this->fileModel->getInsertID(),
            'pattern' => json_decode($getPattern->pattern)
        ]);

    }

    public function uploadFile2() {
        $file = $this->request->getVar('file');
        $pattern = $this->request->getVar('pattern_id');
        $this->fileModel->save([
            'filename' =>  $file,
            'file_template_id' => $pattern,
            'oauth_uid' => session()->get('oauth_uid'),
            'status' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ]);        
        echo json_encode([
            'file_id' => $this->fileModel->getInsertID()
        ]);
    }

    public function addProductDetails() {        
        $pattern = $this->request->getVar('keyword');
        $product = $this->request->getVar('product');
        $fileID = $this->request->getVar('file_id');
        $source = $this->request->getVar('source');
        $row = $this->request->getVar('row');        
        
        $asin = $product[$pattern[1]];

        if (str_contains(strtolower($product[$pattern[0]]), 'bundle') == false) {            
            $cost = str_replace('$', '', $product[$pattern[4]]);
                $cost = str_replace(',', '', $cost);
                if (is_numeric($cost)) {                            
                    $leads = array(
                        'title' => $product[$pattern[0]],
                        'asin' => $product[$pattern[1]],                                
                        'retail_link' => $product[$pattern[2]],                    
                        'amazon_link' => ($pattern[3] == $pattern[1] || $product[$pattern[3]] == '0') ? 'https://www.amazon.com/dp/'.$asin : $product[$pattern[3]],
                        'buy_cost' => $cost,
                        'promo_code' => $product[$pattern[5]],                        
                        'brand' => '-',
                        'category' => '-',
                        'best_sales_rank' => 0,
                        'market_price' => 0,
                        'martket_place_fees' => 0,
                        'fba_selling_fees' => 0,
                        'profit' => $product[$pattern[6]],
                        'roi' => ($product[$pattern[6]]/$cost) * 100,                        
                        'file_id' => $fileID,
                        'source' => $source
                    );
                    // insert rows                          
                    $this->leadModel->save($leads);        
                    $res = [
                        'row' => $row,
                        'asin' => $asin,
                        'status' => '200', 
                        'message' => $leads,                        
                    ];     
                    echo json_encode($res);
                }
        } else {
            $res = [
                'row' => $row,
                'asin' => $asin,
                'status' => '400',
                'message' => 'This is bundle item'
            ];
            echo json_encode($res);
        }
        
    }

    public function addProductDetails2() {                
        $product = $this->request->getVar('product');
        $fileID = $this->request->getVar('file_id');
        $row = $this->request->getVar('row');
        $apiKey = $this->request->getVar('api');
        
        $asin = "";
        $upc = $product[0];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.asinscope.com/products/lookup?key='. $apiKey .'&upc='. $upc .'&domain=com',
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
        $resp = json_decode($response, true);

        if (count($resp['items']) > 0) {
            $leads = array(
                'upc' => $product[0],
                'item_description' => $product[1],
                'qty' => $product[2],
                'original_cost' => $product[3],
                'total_original_cost' => $product[4],
                'original_retail' => $product[5],
                'total_original_retail' => $product[6],
                'vendor' => $product[7],
                'color' => $product[8],
                'size' => $product[9],
                'client_cost' => $product[10],
                'total_client_cost' => $product[11],
                'division' => $product[12],
                'department_name' => $product[13],
                'vendor_name' => $product[14],
                'image' => $product[15],               
                'asin' => $resp['items'][0]['asin'],
                'ean' => (is_null($resp['items'][0]['ean'])) ? '-' : $resp['items'][0]['ean'],                                     
                'best_sales_rank' => $resp['items'][0]['bsr'],            
                'lowest_price' => $resp['items'][0]['lowestNewPrice'],         
                'file_id' => $fileID
            );
            // insert rows                          
            $this->scanUnlimitedsModel->save($leads);        
            $res = [
                'row' => $row,
                'upc' => $upc,
                'status' => '200', 
                'message' => $leads,
                'token_left' => $resp['dailyTokensLeft']
                
            ];
            echo json_encode($res); 
        } else {
            $leads = array(
                'upc' => $product[0],
                'item_description' => $product[1],
                'qty' => $product[2],
                'original_cost' => $product[3],
                'total_original_cost' => $product[4],
                'original_retail' => $product[5],
                'total_original_retail' => $product[6],
                'vendor' => $product[7],
                'color' => $product[8],
                'size' => $product[9],
                'client_cost' => $product[10],
                'total_client_cost' => $product[11],
                'division' => $product[12],
                'department_name' => $product[13],
                'vendor_name' => $product[14],
                'image' => $product[15],               
                'asin' => '-',
                'ean' => '-',          
                'best_sales_rank' => 0,            
                'lowest_price' => 0,         
                'file_id' => $fileID
            );
            // insert rows                          
            $this->scanUnlimitedsModel->save($leads);        
            $res = [
                'row' => $row,
                'upc' => $upc,
                'status' => '204', 
                'message' => $leads,
                'token_left' => $resp['dailyTokensLeft']
                
            ];
            echo json_encode($res); 
        }
    }

    public function uploadFiles() {             
        $leadFile = $this->request->getFiles('leads');         
        $totalFile = 0;
        for ($i = 0; $i < count($leadFile['leads']); $i++) {  
            $start = $this->request->getVar('start');
            $start2 = $this->request->getVar('start2');
            $sheetName = $this->request->getVar('sheet-name');
            $keywords = $this->request->getVar('keyword');           
            
            $splitedKeyword = explode(',', $keywords[$i]);
            $getPattern = $this->fileModel->syncPattern($splitedKeyword);         
            if (!is_null($getPattern)) {
                $pattern = json_decode($getPattern->pattern);
            } else {
                continue;
            }
            $ext = $leadFile['leads'][$i]->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            
            $spreadsheet = $render->load($leadFile['leads'][$i]);
            $sheet = $spreadsheet->getSheetByName($sheetName[$i]);            
            $dataLeads = $sheet->toArray();
            $fileName = $leadFile['leads'][$i]->getName();            
            // save file        
            $this->fileModel->save([
                'filename' =>  $fileName,
                'oauth_uid' => session()->get('oauth_uid'),
                'file_template_id' => $getPattern->file_template_id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $fileID = $this->fileModel->getInsertID();
            $leads = array();
            $next = false; 
            
            
            $curl = curl_init();
            foreach ($dataLeads as $idx => $row) {            
                if ($idx >= $start[$i]-1) {                                                                     
                    if ( (!is_null($row[$pattern[0]]) && !is_null($row[$pattern[1]]) && !is_null($row[$pattern[2]]) && !is_null($row[$pattern[3]]) && !is_null($row[$pattern[4]]) && !is_null($row[$pattern[5]])) && $next == false && (str_contains(strtolower($row[$pattern[0]]), 'bundle') == false) ) {                    
                        // algopix API  
                        $asin = $row[$pattern[2]];                    
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://api.algopix.com/v3/search?idType=ASIN&markets=AMAZON_US&keywords='.$asin.'',
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
                        $response = json_decode($response);
                        if (isset($response->result)) {                        
                            $brand = (isset($response->result->itemDetails->brand)) ? $response->result->itemDetails->brand :'';                           
                            $category = "";
                            if (isset($response->result->offers[0]->marketSpecificData->amazonCategories[0]->name)) {
                                $category = $response->result->offers[0]->marketSpecificData->amazonCategories[0]->name;
                            } elseif (isset($response->result->offers[0]->marketSpecificData->amazonCategories[1]->name)) { 
                                $category = $response->result->offers[0]->marketSpecificData->amazonCategories[1]->name;
                            }
                            $bestSalesRanking = null;
                            if (isset($response->result->offers[0]->marketSpecificData->amazonCategories[0]->bestSellerRanking)) {
                                $bestSalesRanking = $response->result->offers[0]->marketSpecificData->amazonCategories[0]->bestSellerRanking;    
                            }                        
                            $price = (isset($response->result->offers[0]->offers->NEW->marketPrice->amount)) ? $response->result->offers[0]->offers->NEW->marketPrice->amount : 0 ;
                            $marketPlaceFees = (isset($response->result->offers[0]->offers->NEW->marketPlaceFees->amount) ? $response->result->offers[0]->offers->NEW->marketPlaceFees->amount : 0);
                            $fbaSellingFees = (isset($response->result->offers[0]->offers->NEW->fbaSellingFees->amount)) ? $response->result->offers[0]->offers->NEW->fbaSellingFees->amount : 0;
                            $profit = $price - $marketPlaceFees - $fbaSellingFees;
    
                            $cost = str_replace('$', '', $row[$pattern[5]]);
                            $cost = str_replace(',', '', $cost);
                            $leads = array(
                                'title' => $row[$pattern[0]],
                                'source' => $row[$pattern[1]],
                                'asin' => $row[$pattern[2]],                        
                                'retail_link' => $row[$pattern[3]],                    
                                'amazon_link' => $row[$pattern[4]],
                                'buy_cost' => $cost,
                                'promo_code' => $row[$pattern[6]],                        
                                'brand' => $brand,
                                'category' => $category,
                                'best_sales_rank' => $bestSalesRanking,
                                'market_price' => $price,
                                'martket_place_fees' => $marketPlaceFees,
                                'fba_selling_fees' => $fbaSellingFees,
                                'profit' => $profit,
                                'roi' => ($profit/$cost) * 100,
                                'file_id' => $fileID
                            );
                            // insert rows                          
                            $this->leadModel->save($leads);                        
                        }                    
                    } else {
                        if (!empty($start2[$i])) {
                            $next = true;
                            if ($idx >= $start2[$i]-1) {
                                if  (!is_null($row[$pattern[0]]) && !is_null($row[$pattern[1]]) && !is_null($row[$pattern[2]]) && !is_null($row[$pattern[3]]) && !is_null($row[$pattern[4]]) && !is_null($row[$pattern[5]]) && (str_contains(strtolower($row[$pattern[0]]), 'bundle') == false) ) {
                                    // algopix API  
                                    $asin = $row[$pattern[2]];                    
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'https://api.algopix.com/v3/search?idType=ASIN&markets=AMAZON_US&keywords='.$asin.'',
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
                                    $response = json_decode($response);
                                    if (isset($response->result)) {
                                        $brand = (isset($response->result->itemDetails->brand)) ? $response->result->itemDetails->brand :'';                           
                                        $category = "";
                                        if (isset($response->result->offers[0]->marketSpecificData->amazonCategories[0]->name)) {
                                            $category = $response->result->offers[0]->marketSpecificData->amazonCategories[0]->name;
                                        } elseif (isset($response->result->offers[0]->marketSpecificData->amazonCategories[1]->name)) { 
                                            $category = $response->result->offers[0]->marketSpecificData->amazonCategories[1]->name;
                                        }
                                        $bestSalesRanking = null;
                                        if (isset($response->result->offers[0]->marketSpecificData->amazonCategories[0]->bestSellerRanking)) {
                                            $bestSalesRanking = $response->result->offers[0]->marketSpecificData->amazonCategories[0]->bestSellerRanking;    
                                        }                        
                                        $price = (isset($response->result->offers[0]->offers->NEW->marketPrice->amount)) ? $response->result->offers[0]->offers->NEW->marketPrice->amount : 0 ;
                                        $marketPlaceFees = (isset($response->result->offers[0]->offers->NEW->marketPlaceFees->amount) ? $response->result->offers[0]->offers->NEW->marketPlaceFees->amount : 0);
                                        $fbaSellingFees = (isset($response->result->offers[0]->offers->NEW->fbaSellingFees->amount)) ? $response->result->offers[0]->offers->NEW->fbaSellingFees->amount : 0;
                                        $profit = $price - $marketPlaceFees - $fbaSellingFees;
    
                                        $cost = str_replace('$', '', $row[$pattern[5]]);
                                        $cost = str_replace(',', '', $cost);
                                        $leads = array(
                                            'title' => $row[$pattern[0]],
                                            'source' => $row[$pattern[1]],
                                            'asin' => $row[$pattern[2]],                        
                                            'retail_link' => $row[$pattern[3]],                    
                                            'amazon_link' => $row[$pattern[4]],
                                            'buy_cost' => $cost,
                                            'promo_code' => $row[$pattern[6]],                        
                                            'brand' => $brand,
                                            'category' => $category,
                                            'best_sales_rank' => $bestSalesRanking,
                                            'market_price' => $price,
                                            'martket_place_fees' => $marketPlaceFees,
                                            'fba_selling_fees' => $fbaSellingFees,
                                            'profit' => $profit,
                                            'roi' => ($profit/$cost) * 100,
                                            'file_id' => $fileID
                                        );
                                        // insert rows                          
                                        $this->leadModel->save($leads);                                    
                                    }     
                                }
                            }                        
                        } else {
                            break;
                        }    
                    }                  
                    
                }    
                $totalFile = $totalFile + 1;;
            }
            curl_close($curl);               
            $leadFile['leads'][$i]->move('files', $fileName);
        }
        $user = $this->userModel->find(session()->get('user_id'));    
        $this->logModel->save([
            'user_id' => $user['id'],
            'title' => 'upload-file',
            'description' => '['. strtoupper($user['role']) .'] '. $user['username']. ' uploaded lead files',
            'level' => '2'
        ]);
        echo json_encode([
            'status' => 'success',
            'total_file' => $totalFile,
        ]);
    }

    public function uploadTemplateFiles() {
        $leadFile = $this->request->getFile('leads');
        $templateName = $this->request->getVar('template');        
        
        $title = $this->request->getVar('title');
        $pattern = json_encode($title);

        // save file & pattern to db
        $fileName = $leadFile->getName();
        $isPatternExist = $this->fileModel->isPatternExist($templateName);
        $patternID = null;
        if (!$isPatternExist) {            
            $patternID = $this->fileModel->addPattern($templateName, $pattern);
        } else {
            $patternID = $this->fileModel->getPattern($templateName);
        }
        $this->fileModel->save([
            'filename' =>  $fileName,
            'file_template_id' => $patternID,
            'oauth_uid' => session()->get('oauth_uid'),
            'status' => 0
        ]);        
        echo json_encode([
            'status' => 'success'
        ]);
    }

    public function downloadASINData() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $date = date('Y-m-d');
        $getData = $this->leadModel->getASINData($date);
        $no = 2;

        $sheet->setCellValue('A1', 'File ID');
		$sheet->setCellValue('B1', 'ASIN');
		$sheet->setCellValue('C1', 'Can I sell this?');
        foreach ($getData->getResultObject() as $product) {
            $sheet->setCellValue('A' . $no, $product->file_id);
            $sheet->setCellValue('B' . $no, $product->asin); 

            $no++;
        }
        $fileName = "ASIN Data {$date}.xlsx";  
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

    public function uploadASINData() {
        $file = $this->request->getFile('asin-file');
        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file);
        $ASINData = $spreadsheet->getActiveSheet()->toArray();
        
        foreach($ASINData as $idx => $row) {
            if ($idx >= 1) {
                $this->leadModel
                    ->set('status', $row[2])
                    ->where('id', $row[0])
                    ->update();                    
            }
        }

        $user = $this->userModel->find(session()->get('user_id'));    
        $this->logModel->save([
            'user_id' => $user['id'],
            'title' => 'upload-asin',
            'description' => '['. strtoupper($user['role']) .'] '. $user['username']. ' uploaded ASIN Status file',
            'level' => '2'
        ]);
        echo json_encode([
            'status' => '200'
        ]);
    }

    public function getPattern() {
        $id = $this->request->getVar('id');
        $getPattern = $this->fileModel->getPatternById($id);
        $pattern = [
            'id' => $getPattern->id,
            'name' => $getPattern->template_name,
            'pattern' => json_decode($getPattern->pattern),
        ];
        echo json_encode($pattern);
    }
    
    public function syncPattern() {
        $keywords = $this->request->getVar('search');    
    
        $finalRestSort = array();
        for ($i = 0; $i < count($keywords); $i++) {
            $score = 100;
            $result = array();
            $finalRest = array();
            $getPattern = $this->fileModel->getAllPattern();
            if ($getPattern->getNumRows() > 0) {
                foreach ($getPattern->getResultObject() as $pattern) {
                    $temp = levenshtein($pattern->filename, $keywords[$i]);
                    if ($temp <= $score) {
                        $score = $temp;
                        $source = [
                            'id' => $pattern->id,
                            'source' => $pattern->template_name,
                            'score' => $score
                        ];
                        array_push($result, $source);
                    }
                    
                }
                usort($result, fn($a, $b) => strcmp($a['score'], $b['score']));                            
                foreach ($result as $filter) {
                    if ($filter['score'] <= $score) {
                        $score = $filter['score'];
                        $source = [
                            'id' => $filter['id'],
                            'source' => $filter['source'],
                            'score' => $filter['score']
                        ];
                        array_push($finalRest, $source);
                    }
                }
                array_push($finalRestSort, $finalRest);
            }
        }
        echo json_encode($finalRestSort);
        
    }

    public function updateTemplate() {
        $id = $this->request->getVar('template-id');
        $templateName = $this->request->getVar('template');        
        $title = $this->request->getVar('title');
        $pattern = json_encode($title);

        $this->fileModel->updateTemplate($id, $templateName, $pattern);
    }

    public function openFile($id) {
        $selections = $this->leadModel->getSelectionData($id);  
        $purchases = $this->orderModel->getPurchaseData($id);      
        $staffs = $this->staffModel->get();
        $buyers = $this->buyerModel->get();
        $data = [
            'title' => 'Selections',
            'selections' => $selections,
            'purchases' => $purchases,
            'staffs' => $staffs,
            'buyers' => $buyers
        ];
    
        return view('purchase/open_selections', $data);
    }

    public function tickItem() {
        $id = $this->request->getVar('id');
        $getData = $this->leadModel->find($id); 
    }

    public function getItemNotes() {
        $id = $this->request->getVar('id');
        $getData = $this->leadModel->find($id);
        echo json_encode([
            'id' => $id,
            'asin' => $getData['asin'],
            'note' => $getData['notes']
        ]);
    }

    public function saveItemNotes() {
        $id = $this->request->getVar('id');
        $notes = $this->request->getVar('notes');
        $this->leadModel->set('notes', $notes)->where('id', $id)->update();
        echo json_encode([
            'id' => $id,
            'notes' => $notes
        ]);
    }

    public function test() {       
        $pattern = $this->request->getVar('keyword');
        $product = $this->request->getVar('product');
        $fileID = $this->request->getVar('file_id');
         
        

        $mh = curl_multi_init();
        for ($i = 0; $i < 10; $i++) {
            $asin = $product[$pattern[2]];       
            // URL from which data will be fetched
            $fetchURL = 'https://api.algopix.com/v3/search?idType=ASIN&markets=AMAZON_US&keywords='.$asin.'';
            $multiCurl[$i] = curl_init();
            $header =  array(
                'X-API-KEY: e9I5ltJ8MkDZxhWwkCOLIQleIlygl1aHXLa5mxXZ',
                'X-APP-ID: AjLlYtXRo9LHnIlpox277B'
            );
            curl_setopt($multiCurl[$i], CURLOPT_URL,$fetchURL);
            curl_setopt($multiCurl[$i], CURLOPT_HEADER, 0);
            curl_setopt($multiCurl[$i], CURLOPT_HTTPHEADER, $header);
            curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER,1);
            curl_multi_add_handle($mh, $multiCurl[$i]);
        }
        $index=null;
        do {
            curl_multi_exec($mh,$index);
        } while($index > 0);
        // get content and remove handles
        foreach($multiCurl as $k => $ch) {
            $result[$k] = curl_multi_getcontent($ch);
            
            curl_multi_remove_handle($mh, $ch);
        }
        echo json_encode([
            'row' => ($this->request->getVar('row') + 1),
            'asin' => $asin,
            'data' => json_decode($result[$k])
        ]);
        // close
        curl_multi_close($mh);

        // echo $response;
    }

    public function changeProfit() {
        $id = $this->request->getVar('id');
        $value = $this->request->getVar('value');
        $value= str_replace('$', '', $value);
        $value = str_replace(',', '', $value);
        $this->leadModel->set('profit', $value)
            ->where('id', $id)
            ->update();
    }

    public function changeROI() {
        $id = $this->request->getVar('id');
        $value = $this->request->getVar('value');
        $value= str_replace('$', '', $value);
        $value = str_replace(',', '', $value);
        $this->leadModel->set('roi', $value)
            ->where('id', $id)
            ->update();
    }

    public function changeStatus() {
        $id = $this->request->getVar('id');
        $value = $this->request->getVar('value');
        $value= str_replace('$', '', $value);
        $value = str_replace(',', '', $value);
        $this->leadModel->set('status', $value)
            ->where('id', $id)
            ->update();
    }

}