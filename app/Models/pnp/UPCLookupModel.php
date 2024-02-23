<?php

namespace App\Models\pnp;

use CodeIgniter\Model;

class UPCLookupModel extends Model
{
    protected $table = 'upc_lookups';
    protected $allowedFields = ['file_upload', 'file_download', 'date'];
    protected $db = "";
    
}
