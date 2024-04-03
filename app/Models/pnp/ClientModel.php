<?php

namespace App\Models\pnp;

use CodeIgniter\Model;
use Google\Service\CloudFunctions\Retry;

class ClientModel extends Model
{
    protected $table = 'clients';
    protected $allowedFields = ['id', 'client_name', 'company', 'status', 'check_flag', 'purchase_id', 'created_at', 'total_order', 'cost_left', 'order_date', 'total_assign', 'oauth_uid'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getClients($id) {
        $query = $this->db->table('clients')
            ->select('clients.*, SUM(assigned_items.qty * lead_lists.buy_cost) as total_cost, SUM(assigned_items.qty) as qty')
            ->join('assigned_items', 'assigned_items.order_id = clients.id', 'left')
            ->join('purchase_items', 'purchase_items.id = assigned_items.item_id', 'left')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id', 'left')
            ->join('users', 'users.id = clients.oauth_uid')
            ->where('users.id', $id)
//            ->where('purchase_items.activation', '1')
            ->orderBy('clients.id', 'DESC')
            ->groupBy('clients.id')
            ->get();
        return $query;
    }

    public function getClientCostLeft($id) {
        $query = $this->db->table('clients')
            ->select('(total_order - SUM(assigned_items.qty * lead_lists.buy_cost)) as cost_left')
            ->join('assigned_items', 'assigned_items.order_id = clients.id', 'left')
            ->join('purchase_items', 'purchase_items.id = assigned_items.item_id', 'left')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id', 'left')
            ->join('users', 'users.id = clients.oauth_uid')
            ->where('clients.id', $id)
            ->where('purchase_items.activation', '1')
            ->orderBy('clients.id', 'DESC')
            ->groupBy('clients.id')
            ->get();
        return $query->getFirstRow();
    }

    public function getClientUnits($id, $start, $end) {
        if (is_null($end)) {
            $query = $this->db->table('purchase_items')
                ->select('SUM(qty_received) as total_unit, SUM(qty_returned) as total_return')
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->where('purchase_items.order_staff', $id)
                ->where('purchase_items.created_at', $start)
                ->groupBy('purchase_items.order_staff')
                ->get();
        } else {
            $query = $this->db->table('purchase_items')
                ->select('SUM(qty_received) as total_unit, SUM(qty_returned) as total_return')
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->where('purchase_items.order_staff', $id)
                ->where('purchase_items.created_at >=', $start)
                ->where('purchase_items.created_at <=', $end)
                ->groupBy('purchase_items.order_staff')
                ->get();
        }
        return $query->getFirstRow();
    }

}
