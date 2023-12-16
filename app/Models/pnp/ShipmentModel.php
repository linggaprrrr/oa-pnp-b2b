<?php

namespace App\Models\pnp;

use CodeIgniter\Model;

class ShipmentModel extends Model
{
    protected $table = 'shipments';
    protected $allowedFields = ['fba_number', 'shipment_number', 'created_at'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function addItemToShipments($item, $shipment) {        
        $this->db->query("INSERT INTO shipment_details(assigned_id, shipment_id) VALUES('$item', '$shipment') ");
    }

    public function isItemExist($id) {
        $query = $this->db->table('shipment_details')
            ->where('assigned_id', $id)
            ->get();
        return $query;
    }

    public function findClient($id) {
        $query = $this->db->table('clients')
            ->join('assigned_items', 'assigned_items.order_id = .clients.id')
            ->where('assigned_items.item_id', $id)
            
            ->get();
        return $query;
    }

    public function getASINData($id) {
        $query = $this->db->table('orders_status')
            ->select('lead_lists.asin')
            ->join('purchase_items', 'purchase_items.id = orders_status.purchased_item_id')
            ->join('assigned_items', 'assigned_items.item_id = purchase_items.id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')   
            // ->join('files', 'files.id = lead_lists.file_id')       
            // // ->where('files.activation', 'actived')
            // // ->where('files.oauth_uid', session()->get('oauth_uid'))                                       
            ->where('assigned_items.id', $id)            
            ->get();
        return $query->getFirstRow();
    }

    public function findBuyer($id) {
        
    }
}
