<?php

namespace App\Models\pnp;

use CodeIgniter\Model;

class BoxModel extends Model
{
    protected $table = 'boxes';
    protected $allowedFields = ['box_name', 'allocation', 'dimensions', 'assign_id', 'fba_number', 'shipment_number'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function isBoxExist($id) {
        $query = $this->db->query("SELECT * FROM boxes WHERE assign_id='$id' ");
        return $query;
    }

    public function getBoxes($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('boxes')
                ->select('boxes.*')
                ->join('assigned_items', 'assigned_items.id = boxes.assign_id')            
                ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')
                ->join('orders_status', 'purchase_items.id = orders_status.purchased_item_id')                
                ->get();
        } else {
            if (is_null($end)) {
                $query = $this->db->table('boxes')
                ->select('boxes.*')
                    ->join('assigned_items', 'assigned_items.id = boxes.assign_id')            
                    ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')
                    ->join('orders_status', 'purchase_items.id = orders_status.purchased_item_id')
                    ->where('DATE(orders_status.allocated_date)', $start)                                             
                    ->get();
            } else {
                $query = $this->db->table('boxes')
                    ->select('boxes.*')
                    ->join('assigned_items', 'assigned_items.id = boxes.assign_id')            
                    ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')
                    ->join('orders_status', 'purchase_items.id = orders_status.purchased_item_id')
                    ->where('DATE(orders_status.allocated_date) >=', $start)                                             
                    ->where('DATE(orders_status.allocated_date) <=', $end)
                    ->get();
            }
        }
            return $query;
    }
    public function getAllBox($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('boxes')
                ->join('assigned_items', 'assigned_items.id = boxes.assign_id')
                ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')    
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')   
                ->join('clients', 'clients.id = assigned_items.order_id')   
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')   
                ->where('DATE(assigned_items.assigned_date) >= CURDATE() - INTERVAL 8 day')                
                ->where('assigned_items.order_id is NOT NULL', NULL, FALSE)
                ->where('assigned_items.order_id != 0 ')             
                ->where('purchase_items.activation', '1')         
                ->where('lead_lists.file_id', session()->get('user_id'))  
                ->orderBy('boxes.box_name')                                
                ->get();
        } else {
            $query = $this->db->table('boxes')
                ->join('assigned_items', 'assigned_items.id = boxes.assign_id')
                ->join('purchase_items', 'assigned_items.item_id = purchase_items.id')    
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')   
                ->join('clients', 'clients.id = assigned_items.order_id')   
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')   
                ->where('DATE(assigned_items.assigned_date) >=', $start)   
                ->where('DATE(assigned_items.assigned_date) <=', $end)
                ->where('assigned_items.order_id is NOT NULL', NULL, FALSE)
                ->where('assigned_items.order_id != 0 ')             
                ->where('purchase_items.activation', '1')         
                ->where('lead_lists.file_id', session()->get('user_id'))  
                ->orderBy('boxes.box_name')                                
                ->get();
        }
        return $query;
    }




}
