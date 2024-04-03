<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoices';
    protected $allowedFields = ['id', 'invoice_no', 'client', 'date', 'prep_id', 'storage_id', 'wholesale_id', 'return_inv_id', 'additional_id' , 'created_at', 'total_amount', 'invoice_file'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function saveInvPrep($unit, $unitPrice, $bundling, $bundlingPrice, $material, $materialQty, $materialPrice) {
        $id = null;
        $id = $this->db->query("INSERT INTO inv_prep(unit, unit_price, bundling, bundling_price, boxes_and_materials, boxes_and_materials_qty, boxes_and_materials_price) VALUES('$unit', '$unitPrice', '$bundling', '$bundlingPrice', '$material', '$materialQty', '$materialPrice')");        

        $id = $this->db->query("SELECT id FROM inv_prep ORDER BY id DESC LIMIT 1");
        $id = $id->getFirstRow();
        return $id;
    }

    public function saveInvWholesale($receiving_pallet, $receiving_price, $unload_container, $unload_qty, $unload_price, $pallet, $pallet_qty, $pallet_price) {
        $id = null;
        $this->db->query("INSERT INTO inv_wholesale(receiving_pallet, receiving_price, unload_container, unload_qty, unload_price, pallet, pallet_qty, pallet_price) VALUES('$receiving_pallet', '$receiving_price', '$unload_container', '$unload_qty', '$unload_price', '$pallet', '$pallet_qty', '$pallet_price') ");
        $id = $this->db->query("SELECT id FROM inv_wholesale ORDER BY id DESC LIMIT 1");
        $id = $id->getFirstRow();
        return $id;
    }

    public function saveInvStorage($days, $price) {
        $id = null;
        $this->db->query("INSERT INTO inv_storage(days, price) VALUES('$days', '$price')");
        $id = $this->db->query("SELECT id FROM inv_storage ORDER BY id DESC LIMIT 1");
        $id = $id->getFirstRow();
        return $id;
    }

    public function saveInvReturn($unit, $unitPrice) {
        $id = null;
        $this->db->query("INSERT INTO inv_returns(unit, unit_price) VALUES('$unit', '$unitPrice')");
        $id = $this->db->query("SELECT id FROM inv_returns ORDER BY id DESC LIMIT 1");
        $id = $id->getFirstRow();
        return $id;
    }

    public function saveInvAdditional($desc, $qty, $price) {
        $id = null;
        $this->db->query("INSERT INTO inv_additional(description, qty, price) VALUES('$desc', '$qty', '$price')");
        $id = $this->db->query("SELECT id FROM inv_additional ORDER BY id DESC LIMIT 1");
        $id = $id->getFirstRow();
        return $id;

    }

    public function getInvoicesData() {
        $query = $this->db->table('invoices')
            ->select('invoices.*, users.name, users.email')
            ->join('inv_prep', 'inv_prep.id = invoices.prep_id')
            ->join('inv_wholesale', 'inv_wholesale.id = invoices.wholesale_id')
            ->join('inv_storage', 'inv_storage.id = invoices.storage_id')
            ->join('inv_returns', 'inv_returns.id = invoices.return_inv_id')
            ->join('inv_additional', 'inv_additional.id = invoices.additional_id')
            ->join('users', 'users.id = invoices.client')
            ->orderBy('invoices.id', 'DESC')
            ->get();
        return $query;
    }


    public function getItems($id, $start, $end = null) {
        if (is_null($end)) {
            $query = $this->db->table('purchase_items')
                ->select('lead_lists.asin, lead_lists.title, qty_received as qty')
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->where('purchase_items.order_staff', $id)
                ->where('purchase_items.created_at', $start)                
                ->get();
        } else {
            $query = $this->db->table('purchase_items')
                ->select('lead_lists.asin, lead_lists.title, qty_received as qty')
                ->join('orders_status', 'orders_status.purchased_item_id = purchase_items.id')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->where('purchase_items.order_staff', $id)
                ->where('purchase_items.created_at >=', $start)
                ->where('purchase_items.created_at <=', $end)                
                ->get();
        }
        return $query;
    }

}
