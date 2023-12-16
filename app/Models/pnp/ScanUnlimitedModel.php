<?php

namespace App\Models\pnp;

use CodeIgniter\Model;

class ScanUnlimitedModel extends Model{
    protected $table = 'scan_unlimited';
    protected $allowedFields = ['upc', 'asin', 'item_description', 'qty', 'original_cost', 'total_original_cost', 'original_retail', 'total_original_retail', 'vendor', 'color', 'size', 'client_cost', 'total_client_cost', 'division', 'department_name', 'vendor_name', 'image', 'best_sales_rank', 'market_price', 'martket_place_fees', 'fba_selling_fees', 'profit', 'roi', 'ean', 'lowest_price', 'file_id'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function addTemplate() {
        $this->db->query("INSERT INTO file_templates(template_name, pattern) VALUES() ");
    }
}
