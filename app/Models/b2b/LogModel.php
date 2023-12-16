<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'logs';
    protected $allowedFields = ['title', 'description', 'items', 'user_id', 'item_id', 'level', 'created_at'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getLogData($level = null) {
        if ($level == 1) {
            $query = $this->db->table('logs')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $query = $this->db->table('logs')
                ->where('level', '2')
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return $query;
    }
    
    
}
