<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staffs';
    protected $allowedFields = ['staff_name'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


}
