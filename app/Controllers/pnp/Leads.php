<?php

namespace App\Controllers\pnp;

use App\Models\pnp\FileModel;
use App\Models\pnp\LeadModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\RESTful\ResourceController;

class Leads extends ResourceController
{
    protected $leadModel;
    protected $fileModel;

    public function __construct()
    {
        $this->leadModel = new LeadModel();
        $this->fileModel = new FileModel();
    }


    public function index($date = null)
    {   
        if (is_null($date)) {
            $leads = $this->leadModel->getSelectionData();  
        } else {
            $leads = $this->leadModel->getSelectionData($date);  
        }
        $data = [
            'message' => 'success',
            'leads' => $leads->getResultObject(),
            
        ];
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $leads = $this->fileModel
            ->select('lead_lists.*, files.filename')
            ->join('lead_lists', 'lead_lists.file_id = files.id')        
            ->where('lead_lists.id', $id)
            ->orderBy('created_at', 'DESC')->get();     
        $data = [
            'message' => 'success',
            'data' => $leads->getResultObject(),
            
        ];
        return $this->respond($data, 200);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    public function downlaodFile($id) {
        $getData = $this->leadModel->getFileData($id);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $getFileName = "";
        $sheet->setCellValue('A1', 'UPC');
		$sheet->setCellValue('B1', 'ITEM DESCRIPTION');
        $sheet->setCellValue('C1', 'ORIGINAL QTY');
		$sheet->setCellValue('D1', 'ORIGINAL COST');
		$sheet->setCellValue('E1', 'TOTAL ORIGINAL COST');
		$sheet->setCellValue('F1', 'ORIGINAL RETAIL');
        $sheet->setCellValue('G1', 'TOTAL ORIGINAL RETAIL');
        $sheet->setCellValue('H1', 'VENDOR / STYLE #');
        $sheet->setCellValue('I1', 'COLOR');
        $sheet->setCellValue('J1', 'SIZE');
        $sheet->setCellValue('K1', 'CLIENT COST');
        $sheet->setCellValue('L1', 'TOTAL CLIENT COST');
        $sheet->setCellValue('M1', 'DIVISION');
        $sheet->setCellValue('N1', 'DEPARTMENT NAME');
        $sheet->setCellValue('O1', 'VENDOR NAME');
        $sheet->setCellValue('P1', 'IMAGE');
        $sheet->setCellValue('Q1', 'ASIN');
        $sheet->setCellValue('R1', 'EAN');
        $sheet->setCellValue('S1', 'Best Sales Rank');
        $sheet->setCellValue('T1', 'Lowest New Price');
        $no = 2;
        foreach ($getData->getResultObject() as $row) {
            $sheet->setCellValue('A' . $no, $row->upc); 
            $sheet->setCellValue('B' . $no, $row->item_description); 
            $sheet->setCellValue('C' . $no, $row->qty); 
            $sheet->setCellValue('D' . $no, '$'. round($row->original_cost, 2)); 
            $sheet->setCellValue('E' . $no, '$'. round($row->total_original_cost, 2)); 
            $sheet->setCellValue('F' . $no, '$'. round($row->original_retail, 2)); 
            $sheet->setCellValue('G' . $no, '$'. round($row->total_original_retail, 2)); 
            $sheet->setCellValue('H' . $no, $row->vendor); 
            $sheet->setCellValue('I' . $no, $row->color); 
            $sheet->setCellValue('J' . $no, $row->size); 
            $sheet->setCellValue('K' . $no, '$'. round($row->client_cost, 2)); 
            $sheet->setCellValue('L' . $no, '$'. round($row->total_client_cost, 2)); 
            $sheet->setCellValue('M' . $no, $row->division); 
            $sheet->setCellValue('N' . $no, $row->department_name); 
            $sheet->setCellValue('O' . $no, $row->vendor_name); 
            $sheet->setCellValue('P' . $no, $row->image); 
            $sheet->setCellValue('Q' . $no, $row->asin);            
            $sheet->setCellValue('R' . $no, $row->ean);            
            $sheet->setCellValue('S' . $no, $row->best_sales_rank); 
            $sheet->setCellValue('T' . $no, '$'. round($row->lowest_price, 2));                     
            $no++;
            $getFileName = $row->filename;
        }
        $fileName = "Result - ". $getFileName;  
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

    public function getAvailDates() {
        $userId = session()->get('email');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oaclients.com/get-avail-dates-email/'. $userId ,
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
        
        // $result = json_encode($response);
        echo $response;
    }


    public function readExcel() {
        $file = $this->request->getFile('file');        
        $spreadsheet = new Spreadsheet();
        $ext = $file->getClientExtension();
        ini_set('memory_limit', '-1');
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file);
        $data = $spreadsheet->getActiveSheet()->toArray(null, true, false,false);
        echo json_encode($data);
    }

    public function updateTokenAPI() {
        $tokenLeft = $this->request->getVar('token');
        $userKey = $this->request->getVar('api');
        $this->fileModel->updateTokenLeftAPI($userKey, $tokenLeft);
    }

    public function getTokenLeft() {
        $key = $this->request->getVar('key');
        $token = $this->fileModel->getTokenLeftAPI($key);
        echo json_encode($token);
    }

}
