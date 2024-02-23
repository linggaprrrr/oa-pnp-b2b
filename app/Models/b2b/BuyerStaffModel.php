<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class BuyerStaffModel extends Model
{
    protected $table = 'buyers';
    protected $allowedFields = ['buyer_name', 'cc', 'user_id'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


}
