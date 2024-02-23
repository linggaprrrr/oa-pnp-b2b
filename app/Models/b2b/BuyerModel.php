<?php

namespace App\Models\b2b;

use CodeIgniter\Model;
use PHPUnit\TextUI\XmlConfiguration\Group;

class BuyerModel extends Model
{
    protected $table = 'buyer_details';
    protected $allowedFields = ['id', 'buyer', 'cc', 'buyer_qty', 'buyer_price', 'order_number', 'buyer_notes', 'purchase_id'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getCCUsage($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('buyer_details')
                ->select('buyers.id, buyer_name, buyer_details.cc as cc, SUM(buyer_details.buyer_qty) as total_qty, SUM(buy_cost) as buy_cost, SUM(buy_cost * buyer_details.buyer_qty) as total_buy_cost')
                ->join('buyers', 'buyers.id = buyer_details.buyer')
                ->join('purchase_items', 'purchase_items.id = buyer_details.purchase_id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                // ->join('files', 'lead_lists.file_id = files.id')                                                 
                ->where('MONTH(purchase_items.created_at) = MONTH(CURDATE())')
                // ->where('files.activation', 'actived')
                // ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('buyer_details.cc')
                ->get();
        } else {
            $query = $this->db->table('buyer_details')
                ->select('buyers.id, buyer_name, buyer_details.cc as cc, SUM(buyer_details.buyer_qty) as total_qty, SUM(buy_cost) as buy_cost, SUM(buy_cost * buyer_details.buyer_qty) as total_buy_cost')
                ->join('buyers', 'buyers.id = buyer_details.buyer')
                ->join('purchase_items', 'purchase_items.id = buyer_details.purchase_id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                // ->join('files', 'lead_lists.file_id = files.id')                                                 
                ->where('purchase_items.created_at >=', $start . ' 00:00:00')
                ->where('purchase_items.created_at <=', $end . ' 23:59:59')
                // ->where('files.activation', 'actived')
                // ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('buyer_details.cc')
                ->get();
        }
        
        return $query;
    }   

}
