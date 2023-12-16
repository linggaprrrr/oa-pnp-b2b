<?php

namespace App\Models\pnp;

use CodeIgniter\Model;

class AssignmentModel extends Model
{
    protected $table = 'assignments';
    protected $allowedFields = ['assign_date'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
}
