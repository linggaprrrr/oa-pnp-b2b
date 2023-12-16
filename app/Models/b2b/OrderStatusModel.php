<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class OrderStatusModel extends Model
{
    protected $table = 'orders_status';
    protected $allowedFields = ['purchased_item_id', 'qty_received', 'qty_returned', 'qty_remaining', 'allocated_date', 'status', 'purchased_date', 'order_notes'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getOrderedData($date = null) {
        if (is_null($date)) {
            $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('files', 'files.id = lead_lists.file_id')
                ->join('scan_unlimited', 'scan_unlimited.asin = lead_lists.asin')   
                ->where('files.activation', 'actived')
                ->where('files.oauth_uid', session()->get('user_id'))  
                ->groupBy('orders_status.purchased_item_id')   
                ->groupBy('DATE(orders_status.purchased_date)')                      
                ->orderBy('orders_status.purchased_date', 'DESC')         
                ->get();
        } else {
            $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('files', 'files.id = lead_lists.file_id')
                ->join('scan_unlimited', 'scan_unlimited.asin = lead_lists.asin')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->where('orders_status.purchased_date >=', $date . ' 00:00:00')
                ->where('orders_status.purchased_date <=', $date . ' 23:59:59')
                ->where('files.activation', 'actived')
                ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->groupBy('orders_status.purchased_item_id')   
                ->groupBy('DATE(orders_status.purchased_date)')                      
                ->orderBy('orders_status.purchased_date', 'DESC')         
                ->get();
        }
        return $query;
    }    

    public function totalReceivedCompleted() {
        $query = $this->table('orders_status')
            ->select('SUM(orders_status.qty_received) as total')
            ->join('lead_lists', 'lead_lists.id = orders_status.purchased_item_id')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->where('orders_status.status', 'delivered')
            ->get();

        return $query->getFirstRow();
    }

    public function totalUnReceivedCompleted() {
        $query = $this->table('orders_status')
            ->select('SUM(purchase_items.qty - orders_status.qty_received) as total')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = orders_status.purchased_item_id')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->where('orders_status.status !=', 'delivered')
            ->get();

        return $query->getFirstRow();
    }

    public function totalReceivedUncompleted() {
        $query = $this->table('orders_status')
            ->select('SUM(orders_status.qty_received) as total')
            ->join('lead_lists', 'lead_lists.id = orders_status.purchased_item_id')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->where('orders_status.status !=', 'delivered')
            ->get();

        return $query->getFirstRow();
    }

    public function totalUnassigned() {
        $query = $this->table('orders_status')
            ->select('SUM(orders_status.qty_remaining) as total')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = orders_status.purchased_item_id')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->where('orders_status.status !=', 'delivered')
            ->get();

        return $query->getFirstRow();
    }

    public function shippedNoClient() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')
            
            ->where('clients.client_name =', null)
            ->where('orders_status.status', 'shipped')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

    public function deleiveredNoClient() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date, ')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')
            
            ->where('clients.client_name =', null)
            ->where('orders_status.status', 'delivered')
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

    public function orderedNoClient() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date, ')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->where('clients.client_name =', null)
            ->where('orders_status.status', 'ordered')
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

    public function orderedCanceled() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date, ')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')
            
            ->where('orders_status.status', 'order_canceled')
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

    public function returned() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date, ')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')
            
            ->where('orders_status.status', 'returned')
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

    public function inProcess() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date, ')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')
            
            ->where('orders_status.status', 'in_process')
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

    public function partiallyShipped() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date, ')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')                        
            ->where('orders_status.status', 'shipped')            
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

    public function outstandingOrdered() {
        $query = $this->table('orders_status')
            ->select('orders_status.purchased_item_id, lead_lists.title, orders_status.purchased_date, ')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')                          
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')                     
            ->where('orders_status.status', 'ordered')            
            ->groupBy('purchase_items.id')
            ->get();

        return $query;
    }

}
