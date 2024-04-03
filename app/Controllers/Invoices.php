<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\pnp\ClientModel;
use App\Models\UserModel;

class Invoices extends BaseController
{
    protected $clientModel = "";
    protected $invoiceModel = "";
    protected $userModel = "";

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->invoiceModel = new InvoiceModel();
        $this->userModel = new UserModel();
    }

    public function getClientData($comp) {
        $users = $this->userModel
            ->where('role', '')
            ->where('comp', $comp)
            ->orderBy('id', 'DESC')
            ->get();
        echo json_encode([
            'users' => $users->getResultArray()
        ]);
    }

    public function getClientTotalUnit() {
        $id = $this->request->getVar('id');
        $date = $this->request->getVar('date');
        $start = null;
        $end = null;
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
        
        $totalUnit = $this->clientModel->getClientUnits($id, $start, $end);
        echo json_encode([
            'unit' => $totalUnit,
            
        ]);
    }

    public function saveInvoice() {
        $invoice = $this->request->getVar('invoice');
        
        // prep
        $prep = $this->invoiceModel->saveInvPrep($invoice['unit'], $invoice['unit_price'], $invoice['bundling'], $invoice['bundling_price'], $invoice['material'], $invoice['material_qty'], $invoice['material_price']);
        
        // wholesale 
        $wholesale = $this->invoiceModel->saveInvWholesale($invoice['receiving_pallet'], $invoice['receiving_pallet_price'], $invoice['unloading'], $invoice['unloading_qty'], $invoice['unloading_price'], $invoice['pallet'], $invoice['pallet_qty'], $invoice['pallet_price']);

        // storage
        $storage = $this->invoiceModel->saveInvStorage($invoice['storage'], $invoice['storage_price']);
        
        // additional
        $additional = $this->invoiceModel->saveInvAdditional($invoice['additional'], $invoice['additional_qty'], $invoice['additional_price']);

        // return
        $return = $this->invoiceModel->saveInvReturn($invoice['return'], $invoice['return_price']);

        // invoice 
        $start = null;
        $end = null;
        $temp = explode("to", $invoice['date']);
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

        $items = $this->invoiceModel->getItems($invoice['client'], $start, $end);
        $path = FCPATH."/assets/img/wholesales-logo.png";
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);        
        $invoiceNo = 'INV/'.date('Y').'/'.date('m').'/'.time();
        $data = [  
            'invoice_no' => $invoiceNo,          
            'img' => $base64,
            'client' => $invoice['client_name'],
            'items' => $items,
            'date' => $invoice['date'],
            'data' => $invoice,
            
        ];
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('invoice-pdf', $data));
        $dompdf->setPaper('legal');
        $dompdf->render();        
        // $dompdf->stream("Invoice.pdf");
        $output = $dompdf->output();
        $fileName = "Invoice-".time().".pdf";
        file_put_contents('invoices/'.$fileName , $output);
        
        
        $data = [
            'invoice_no' => $invoiceNo,
            'client' => $invoice['client'],
            'date' => $invoice['date'],
            'prep_id' => $prep->id,
            'storage_id' => $storage->id,
            'wholesale_id' => $wholesale->id,
            'return_inv_id' => $return->id, 
            'additional_id' => $additional->id,
            'total_amount' => $invoice['total_amount'],
            'invoice_file' => $fileName,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->invoiceModel->insert($data);

        return $fileName;

    }

}