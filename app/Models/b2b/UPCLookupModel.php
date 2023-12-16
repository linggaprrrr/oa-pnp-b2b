<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class UPCLookupModel extends Model
{
    protected $table = 'upc_lookups';
    protected $allowedFields = ['file_upload', 'file_download', 'date'];
    protected $db = "";
    
}
