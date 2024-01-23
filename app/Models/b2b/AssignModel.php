<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class AssignModel extends Model
{
    protected $table = 'assigned_items';
    protected $allowedFields = ['fnsku', 'item_id', 'order_id', 'qty', 'vendor', 'assigned_notes', 'assigned_date', 'updated_at'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function getAssignedData($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')                                                
                ->join('users', 'lead_lists.file_id = users.id')                                                 
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')                
                ->where('orders_status.allocated_date > NOW() - INTERVAL 7 day')
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('orders_status.purchased_item_id')   
                ->groupBy('DATE(orders_status.purchased_date)')                      
                ->orderBy('assigned_items.order_id', 'DESC')         
                ->get();
        } else {
            if (is_null($end)) {
                
                $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->where('orders_status.allocated_date >=', $start.' 00:00:00')
                ->where('orders_status.allocated_date <=', $start.' 23:59:59')
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('orders_status.purchased_item_id')   
                ->groupBy('DATE(orders_status.purchased_date)')                      
                ->orderBy('assigned_items.order_id', 'DESC')         
                ->get();       
            } else {
                
                $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->where('orders_status.allocated_date >=', $start.' 00:00:00')
                ->where('orders_status.allocated_date <=', $end.' 23:59:59')
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('orders_status.purchased_item_id')   
                ->groupBy('DATE(orders_status.purchased_date)')                      
                ->orderBy('assigned_items.order_id', 'DESC')         
                ->get();       
            }
        } 
        return $query;
    }

    public function getAssignedData2($start = null, $end = null, $user = null) {
        if (is_null($start)) {
            $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, shipment_details.id as sid, shipment_details.created_at as sent_date, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->join('shipment_details', 'shipment_details.assigned_id = assigned_items.id', 'left')
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('assigned_items.item_id')
                ->groupBy('orders_status.id')
                ->orderBy('purchased_date, title', 'DESC')             
                ->get();
        } else {
            if (is_null($end)) {
                $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, shipment_details.id as sid, shipment_details.created_at as sent_date, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->join('shipment_details', 'shipment_details.assigned_id = assigned_items.id', 'left')
                ->groupBy('assigned_items.item_id')
                ->where('orders_status.allocated_date >=', $start.' 00:00:00')
                ->where('orders_status.allocated_date <=', $start.' 23:59:59')                                 
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->orderBy('purchased_date, title', 'DESC')         
                ->get();       
            } else {                
                $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, shipment_details.id as sid, shipment_details.created_at as sent_date, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')     
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->join('shipment_details', 'shipment_details.assigned_id = assigned_items.id', 'left')
                ->where('orders_status.allocated_date >=', $start.' 00:00:00')
                ->where('orders_status.allocated_date <=', $end.' 23:59:59')           
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('assigned_items.item_id')       
                ->orderBy('purchased_date, title', 'DESC')         
                ->get();       
            }                 
        } 
        return $query;
    }

    public function getAssignedDataAll($user) {
        $query = $this->db->table('orders_status')
            ->select('orders_status.*, lead_lists.id as lid, shipment_details.id as sid, shipment_details.created_at as sent_date, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('users', 'lead_lists.file_id = users.id')
            ->join('clients', 'clients.id = assigned_items.order_id', 'left')
            ->join('shipment_details', 'shipment_details.assigned_id = assigned_items.id', 'left')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('assigned_items.item_id')
            ->groupBy('orders_status.id')
            ->orderBy('assigned_items.item_id', 'DESC')         
            ->get();
        return $query;
    }

    public function getAssignmentData($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, shipment_details.id as sid, shipment_details.created_at as sent_date, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->join('shipment_details', 'shipment_details.assigned_id = assigned_items.id', 'left')                                
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('assigned_items.id')
                ->orderBy('assigned_items.item_id', 'DESC')         
                ->get();
        } else {
            if (is_null($end)) {
                $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, shipment_details.id as sid, shipment_details.created_at as sent_date, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->join('shipment_details', 'shipment_details.assigned_id = assigned_items.id', 'left')                                                
                ->where('DATE(orders_status.allocated_date)', $start)                                             
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('assigned_items.id')
                ->orderBy('assigned_items.item_id', 'DESC')         
                ->get();       
            } else {                
                $query = $this->db->table('orders_status')
                ->select('orders_status.*, lead_lists.id as lid, shipment_details.id as sid, shipment_details.created_at as sent_date, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid')
                ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
                ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('users', 'lead_lists.file_id = users.id')                
                ->join('clients', 'clients.id = assigned_items.order_id', 'left')
                ->join('shipment_details', 'shipment_details.assigned_id = assigned_items.id', 'left')
                ->where('DATE(orders_status.allocated_date) >=', $start)                                             
                ->where('DATE(orders_status.allocated_date) <=', $end)                                                             
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('assigned_items.id')
                ->orderBy('assigned_items.item_id', 'DESC')         
                ->get();       
            }                 
        } 
        return $query;
    }

    

    public function getAssignedData3($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('shipment_details')                
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid, shipments.id as sid, shipments.fba_number, shipments.shipment_number')                
                ->join('assigned_items', 'shipment_details.assigned_id = assigned_items.id')
                ->join('shipments', 'shipments.id = shipment_details.shipment_id')                
                ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')                                
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->join('clients', 'clients.id = assigned_items.order_id') 
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id') 
                                
                ->groupBy('assigned_items.id')  
                ->where('orders_status.allocated_date > NOW() - INTERVAL 7 day')
                ->where('assigned_items.order_id is NOT NULL', NULL, FALSE)
                ->where('assigned_items.order_id != 0 ')
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->orderBy('assigned_items.order_id, assigned_items.assigned_date', 'ASC')               
                ->get();
        } else {
            if (is_null($end)) {                                
                $query = $this->db->table('shipment_details')
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid, shipments.id as sid, shipments.fba_number, shipments.shipment_number')                
                ->join('assigned_items', 'shipment_details.assigned_id = assigned_items.id')
                ->join('shipments', 'shipments.id = shipment_details.shipment_id')                
                ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')                                
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->join('clients', 'clients.id = assigned_items.order_id') 
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')    
                ->join('users', 'lead_lists.file_id = users.id')
                ->groupBy('assigned_items.id')    
                ->where('DATE(assigned_items.assigned_date) >=', $start)
                ->where('DATE(assigned_items.assigned_date) <=', $start)    
                ->where('assigned_items.order_id is NOT NULL', NULL, FALSE)
                ->where('assigned_items.order_id != 0 ')               
                ->where('purchase_items.activation', '1')
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->orderBy('assigned_items.order_id, assigned_items.assigned_date', 'ASC')             
                ->get();       
            } else {                
                $query = $this->db->table('shipment_details')                
                ->select('orders_status.*, lead_lists.id as lid, lead_lists.title, lead_lists.asin, market_price, purchase_items.qty as qty_ordered, buy_cost, purchase_items.lead_id as uid, purchase_items.id as pid, client_name, company, assigned_items.*, assigned_items.id as aid, shipments.id as sid, shipments.fba_number, shipments.shipment_number, assigned_date')                
                ->join('assigned_items', 'shipment_details.assigned_id = assigned_items.id')
                ->join('shipments', 'shipments.id = shipment_details.shipment_id')                
                ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')                                
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->join('clients', 'clients.id = assigned_items.order_id') 
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')    
                ->join('users', 'lead_lists.file_id = users.id')
                ->groupBy('assigned_items.id')                               
                ->where('DATE(assigned_items.assigned_date) >=', $start)   
                ->where('DATE(assigned_items.assigned_date) <=', $end)
                ->where('assigned_items.order_id is NOT NULL', NULL, FALSE)
                ->where('assigned_items.order_id != 0 ')             
                ->where('purchase_items.activation', '1')         
                ->where('lead_lists.file_id', session()->get('user_id'))                    
                ->orderBy('assigned_items.order_id, assigned_items.assigned_date', 'ASC')         
                ->get();       
            }                 
        } 
        return $query;
    }

    public function getTotalQtyToday() {
        $query = $this->db->table('orders_status')
            ->select('DATE(purchase_items.created_at), SUM(purchase_items.qty) as total_qty, SUM(purchase_items.qty * buy_cost) as total_price')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')            
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('DATE(purchase_items.created_at) = DATE(CURDATE())')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('DATE(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query->getFirstRow();  
    }

    public function getPurchaseDataToday() {
        $query = $this->db->table('orders_status')
        ->select('lead_lists.asin, lead_lists.title, lead_lists.buy_cost, lead_lists.market_price, lead_lists.profit, purchase_items.qty ')
        ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
        ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')            
        ->join('users', 'lead_lists.file_id = users.id')
        ->where('DATE(purchase_items.created_at) = DATE(CURDATE())')   
        ->where('purchase_items.activation', '1')
        ->orderBy('purchase_items.created_at', 'DESC')      
        ->get();
    return $query;
    }

    public function getTotalPurchaseWeek() {
        $query = $this->db->table('orders_status')
            ->select('DATE(purchase_items.created_at) as day, SUM(purchase_items.qty * buy_cost) as total_price')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('YEARWEEK(purchase_items.created_at, 1) = YEARWEEK(CURDATE(), 1)')
            ->where('purchase_items.activation', '1')
            
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;                              
    }

    public function getTotalPurchaseMonth() {
        $query = $this->db->table('orders_status')
            ->select('DATE_FORMAT(purchase_items.created_at, "%d") as day, SUM(purchase_items.qty * buy_cost) as total_price')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('MONTH(purchase_items.created_at) = MONTH(CURRENT_DATE())')
            ->where('YEAR(purchase_items.created_at) = YEAR(CURRENT_DATE())')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('DATE(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;                              
    }

    public function getTotalPurchaseYear() {
        $query = $this->db->table('orders_status')
            ->select('DATE_FORMAT(purchase_items.created_at, "%b") as month, SUM(purchase_items.qty * buy_cost) as total_price')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('YEAR(purchase_items.created_at) = YEAR(CURRENT_DATE())')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('YEAR(purchase_items.created_at), MONTH(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;                              
    }

    public function getTotalAssignWeek() {
        $query = $this->db->table('orders_status')
            ->select('DATE(purchase_items.created_at) as day, SUM(qty_received - qty_remaining) as total_assigned')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('YEARWEEK(purchase_items.created_at, 1) = YEARWEEK(CURDATE(), 1)')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('DATE(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;       
    }

    public function getTotalAssignedMonth() {
        $query = $this->db->table('orders_status')
            ->select('DATE_FORMAT(purchase_items.created_at, "%d") as day, SUM(qty_received - qty_remaining) as total_assigned')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('MONTH(purchase_items.created_at) = MONTH(CURRENT_DATE())')
            ->where('YEAR(purchase_items.created_at) = YEAR(CURRENT_DATE())')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('DATE(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;                              
    }

    public function getTotalAssignedYear() {
        $query = $this->db->table('orders_status')
            ->select('DATE_FORMAT(purchase_items.created_at, "%b") as month, SUM(qty_received - qty_remaining) as total_assigned')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')            
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('YEAR(purchase_items.created_at) = YEAR(CURRENT_DATE())')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('YEAR(purchase_items.created_at), MONTH(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;                              
    }

    public function getTotalNTUWeek() {
        $query = $this->db->table('orders_status')
            ->select('DATE(purchase_items.created_at) as day, SUM((qty_received - qty_remaining) * buy_cost) as total_cost')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')            
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('YEARWEEK(purchase_items.created_at, 1) = YEARWEEK(CURDATE(), 1)')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('DATE(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;       
    }

    public function getTotalNTUMonth() {
        $query = $this->db->table('orders_status')
            ->select('DATE_FORMAT(purchase_items.created_at, "%d") as day, SUM((qty_received - qty_remaining) * buy_cost) as total_cost')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')            
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('MONTH(purchase_items.created_at) = MONTH(CURRENT_DATE())')
            ->where('YEAR(purchase_items.created_at) = YEAR(CURRENT_DATE())')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('DATE(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;                              
    }

    public function getTotalNTUYear() {
        $query = $this->db->table('orders_status')
            ->select('DATE_FORMAT(purchase_items.created_at, "%b") as month, SUM((qty_received - qty_remaining) * buy_cost) as total_cost')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')            
            ->join('users', 'lead_lists.file_id = users.id')
            ->where('YEAR(purchase_items.created_at) = YEAR(CURRENT_DATE())')
            ->where('purchase_items.activation', '1')
            ->where('lead_lists.file_id', session()->get('user_id'))
            ->groupBy('YEAR(purchase_items.created_at), MONTH(purchase_items.created_at)')
            ->orderBy('purchase_items.created_at', 'DESC')      
            ->get();
        return $query;                              
    }

    public function saveQtyRemaind($qty) {

    }

    public function addBoxName($id, $boxName) {
        $this->db->query("INSERT INTO boxes(assign_id, box_name) VALUES('$id', '$boxName')");
    }

    public function updateBoxName($id, $boxName) {        
        $this->db->query("UPDATE boxes SET box_name = '$boxName' WHERE assign_id = '$id' ");
    }

    public function addTotalAllocation($id, $total) {
        $this->db->query("INSERT INTO boxes(assign_id, allocation) VALUES('$id', '$total')");
    }

    public function updateTotalAllocation($id, $total, $boxId = null) {
        $this->db->query("UPDATE boxes SET allocation = '$total' WHERE id = '$boxId' ");
    }

    public function isBoxExist($id) {
        $query = $this->db->query("SELECT * FROM boxes WHERE assign_id='$id' ");
        return $query;
    }


}
