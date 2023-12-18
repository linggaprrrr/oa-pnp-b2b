<?php 
    namespace App\Controllers\b2b;
    use App\Models\b2b\UserModel;
    use App\Models\b2b\UPCLookupModel;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    class API extends BaseController
    {   
        protected $UPCLookupModel = "";

        public function __construct()
        {
            $this->UPCLookupModel = new UPCLookupModel();
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
    }

?>