<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'username', 'password', 'email', 'photo', 'role', 'user_ext', 'oauth_uid', 'locale', 'verify'];
    protected $db = "";

    public function getAllUser()
    {
        $this->db = \Config\Database::connect();
        $query = $this->db->query("SELECT * FROM users WHERE role <> 'administrator' ORDER BY fullname ASC ");
        return $query;
    }



}
