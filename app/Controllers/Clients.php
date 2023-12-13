<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use Google\Service\CloudFunctions\Retry;

class Clients extends BaseController
{
    protected $clientModel = "";

    public function __construct()
    {
        $this->clientModel = new ClientModel();
    }

    public function index()
    {
        //
    }

    public function addClient() {
        $post = $this->request->getVar();
        $this->clientModel->save([
            'client_name' => $post['name'],
            'company' => $post['company'],
            'total_order' => $post['total_order'],
            'cost_left' => $post['total_order'],
            'order_date' => $post['order_date'],
            'oauth_uid' => session()->get('user_id'),
            'checked' => 'checked',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('clients'))->with('message', 'Login Successful!');
    }

    public function getClient() {
        $id = $this->request->getVar('id');     
        
        $getUser = $this->clientModel->getWhere(['id' => $id])->getRow();
        echo json_encode($getUser);
        
    }

    public function updateClient() {
        $post = $this->request->getVar();
        $this->clientModel
            ->set('client_name', $post['name'])
            ->set('company', $post['company'])
            ->set('total_order', $post['total_order'])            
            ->set('order_date', $post['order_date'])            
            ->where('id', $post['id'])
            ->update();
        return redirect()->to(base_url('clients'))->with('message', 'Login Successful!');
    }

}
