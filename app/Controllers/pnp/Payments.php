<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\pnp\SubscriptionModel;

class Payments extends BaseController
{
    protected $subsModel;

    public function __construct()
    {
        $this->subsModel = new SubscriptionModel();
    }

    public function index()
    {
        return view('payment');
    }

    public function transaction() {
        $post = $this->request->getVar();

        if ($post['plan'] == 'monthly') {
            $this->subsModel->save([
                'user_id' => session()->get('oauth_uid'),
                'payment_id' => $post['payment_id'],
                'status' => 1,
                'plan' => $post['plan'],
                'total' => $post['total'],
                'valid_date' => date('Y-m-d'),
                'expire_date' => date('Y-m-d', strtotime('next month'))
            ]);
        } else {
            $this->subsModel->save([
                'user_id' => session()->get('oauth_uid'),
                'payment_id' => $post['payment_id'],
                'status' => 1,
                'plan' => $post['plan'],
                'total' => $post['total'],
                'valid_date' => date('Y-m-d'),
                'expire_date' => date('Y-m-d', strtotime('+1 year'))
            ]);
        }

    }

    public function updateSubscription() {
        $post = $this->request->getVar();
        $dates = explode('to', $post['date']);
        $this->subsModel
            ->set('plan', $post['plan'])
            ->set('valid_date', trim($dates[0]))
            ->set('expire_date', trim($dates[1]))
            ->where('user_id', $post['id'])
            ->update();

        return redirect()->to(base_url('/admin/users'))->with('message', 'User Successfully Added!');
    }
    

}
