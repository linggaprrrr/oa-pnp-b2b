<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class SubscriptionModel extends Model
{
    protected $table = 'subscriptions';
    protected $allowedFields = ['user_id', 'payment_id', 'plan', 'total', 'valid_date', 'expire_date', 'status'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

}
