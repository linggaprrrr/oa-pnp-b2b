<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'purchase_items';
    protected $allowedFields = ['lead_id', 'qty', 'size', 'selling_price', 'order_staff', 'notes', 'created_at'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getPurchaseData($date) {
        $query = $this->db->table('lead_lists')
            ->select('purchase_items.*, lead_lists.*, purchase_items.id as uid, buyer_details.id as buyers_id, users.username, users.name, SUM(buyer_details.buyer_qty) as buyer_qty')
            
            ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')
            ->join('buyer_details', 'buyer_details.purchase_id = purchase_items.id', 'left')            
            ->join('users', 'users.id = purchase_items.order_staff')
            ->where('purchase_items.created_at >=', $date . ' 00:00:00')
            ->where('purchase_items.created_at <=', $date . ' 23:59:59') 
            ->where('purchase_items.order_staff', session()->get('user_id'))
            ->where('purchase_items.activation', '1')
            ->groupBy('purchase_items.id')
            ->orderBy('purchase_items.id', 'DESC')
            ->get();
        return $query;
    }

    public function getRestQty($id) {
        $query = $this->db->table('lead_lists')
            ->select('purchase_items.qty, SUM(buyer_details.buyer_qty) as buyer_qty')        
            ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')
            ->join('buyer_details', 'buyer_details.purchase_id = purchase_items.id', 'left')                        
            ->where('purchase_items.id', $id)
            ->where('purchase_items.order_staff', session()->get('user_id'))
            ->groupBy('purchase_items.id')
            ->orderBy('purchase_items.id', 'DESC')
            ->get();
        return $query->getFirstRow();
    }

    public function getPurchaseItem($id) {
        $query = $this->db->table('lead_lists')
            ->select('lead_lists.asin, purchase_items.qty, market_price, purchase_items.id as uid, buyer_details.*, tracking_number')            
            ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')                       
            ->join('buyer_details', 'buyer_details.purchase_id = purchase_items.id', 'left')            
            ->join('tracking_items', 'tracking_items.buyer_id = buyer_details.id', 'left')
            ->join('tracking_shipments', 'tracking_shipments.id = tracking_items.shipment_id', 'left')            

            ->where('purchase_items.id', $id)
//            ->where('buyer_details.user_id', $id)         
            ->orderBy('purchase_items.id', 'DESC')
            ->get();
        return $query;
    }

    public function getPurchaseList($limit = null) {
        $query = $this->db->table('purchase_items')
            ->select('COUNT(purchase_items.lead_id) as purchased_item, purchase_items.created_at as purch_date')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')            
            ->where('purchase_items.activation', '1')
            ->where('purchase_items.order_staff', session()->get('user_id'))
            ->groupBy('purchase_items.order_staff')
            ->groupBy('DATE(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')
            ->get();
        return $query;
    }

    public function getTotalCost($id) {
        $query = $this->db->table('purchase_items')
            ->select('(lead_lists.buy_cost * assigned_items.qty) as total_buy_cost')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->where('assigned_items.id', $id)
            ->get();
        return $query->getFirstRow();
    }
}
