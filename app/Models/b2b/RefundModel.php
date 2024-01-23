<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class RefundModel extends Model
{
    protected $table = 'refunds';
    protected $allowedFields = ['lead_id', 'shipping_cost', 'notes', 'created_at'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getAllRefundItems($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('lead_lists')
                ->select('lead_lists.id, lead_lists.asin, lead_lists.title, qty_returned, purchased_date, refunds.shipping_cost, refunds.notes as shipping_notes')
                ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->join('refunds', 'refunds.lead_id = lead_lists.id', 'left')
                ->where('qty_returned >', 0)
                ->where('DATE(purchased_date) >= CURDATE() - INTERVAL 8 day')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->get();
        } else {
            $query = $this->db->table('lead_lists')
            ->select('lead_lists.id, lead_lists.asin, lead_lists.title, qty_returned, purchased_date, refunds.shipping_cost, refunds.notes as shipping_notes')
                ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->join('refunds', 'refunds.lead_id = lead_lists.id', 'left')
                ->where('qty_returned >', 0)
                ->where('DATE(purchased_date) >=', $start)
                ->where('DATE(purchased_date) <=', $end)
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->get();
        }
        return $query;
    }
}