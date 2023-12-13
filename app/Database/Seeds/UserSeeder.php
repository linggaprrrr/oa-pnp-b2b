<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $data = [                    
            'username' => 'mike',
            'password' => password_hash('mike123', PASSWORD_BCRYPT),
            'role' => 'warehouse'
        ];
        $userModel->insert($data);
    }
}
