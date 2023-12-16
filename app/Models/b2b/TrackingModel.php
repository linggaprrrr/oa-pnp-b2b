<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class TrackingModel extends Model
{
    protected $table = 'tracking_shipments';
    protected $allowedFields = ['tracking_id', 'tracking_number', 'courier_code', 'courier_name', 'courier_logo', 'service_code', 'order_information', 'origin', 'destiny'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function addTrackingDetail($trackingInfo) {
        $this->db->query("INSERT INTO tracking_details(shipment_id, status, location, tracking_details, checkpoint_date, checkpoint_date_format) VALUES ('" .$trackingInfo['shipment_id']. "', '" .$trackingInfo['status']. "', '" .$trackingInfo['location']. "', '" . $this->db->escapeString($trackingInfo['tracking_details']). "', '" .$trackingInfo['checkpoint_date']. "', '" .$trackingInfo['checkpoint_date_format']. "')");
    }

    public function getAllShipments($start = null, $end = null) {
        $query = $this->db->table('tracking_shipments')
            ->select('lead_lists.asin, lead_lists.title, buyer_details.buyer_qty as qty, tracking_shipments.*, tracking_details.status, tracking_details.location, tracking_details.tracking_details, tracking_details.checkpoint_date, buyer_details.order_number, tracking_items.buyer_id')            
            ->join('tracking_details', 'tracking_details.shipment_id = tracking_shipments.id', 'left')
            ->join('tracking_items', 'tracking_items.shipment_id = tracking_shipments.id', 'left')
            ->join('buyer_details', 'buyer_details.id = tracking_items.buyer_id')
            ->join('buyers', 'buyers.id = buyer_details.buyer')            
            ->join('purchase_items', 'purchase_items.id = buyer_details.purchase_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('files', 'files.id = lead_lists.file_id')       
            ->where('files.activation', 'actived')
            ->where('files.oauth_uid', session()->get('oauth_uid'))                                       
            ->where('tracking_shipments.created_at >=', $start . ' 00:00:00')
            ->where('tracking_shipments.created_at <=', $end . ' 23:59:59')
            ->groupBy('tracking_shipments.id')
            ->orderBy('tracking_shipments.id', 'DESC')
            ->get();
        return $query;
    }

    public function getShipmentByItem($id) {
        $query = $this->db->table('tracking_shipments')
            ->select('lead_lists.asin, lead_lists.title, buyer_details.buyer_qty as qty, tracking_shipments.*, tracking_details.status, tracking_details.location, tracking_details.tracking_details, tracking_details.checkpoint_date, buyer_details.order_number, buyers.buyer_name, tracking_items.buyer_id')            
            ->join('tracking_details', 'tracking_details.shipment_id = tracking_shipments.id', 'left')
            ->join('tracking_items', 'tracking_items.shipment_id = tracking_shipments.id', 'left')                        
            ->join('purchase_items', 'purchase_items.id = tracking_items.purch_id')
            ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
            ->join('buyer_details', 'buyer_details.purchase_id = purchase_items.id')
            ->join('buyers', 'buyers.id = buyer_details.buyer')
            // ->join('files', 'files.id = lead_lists.file_id')       
            // ->where('files.activation', 'actived')
            // ->where('files.oauth_uid', session()->get('oauth_uid'))                                       
            ->where('purchase_items.id', $id)            
            ->groupBy('tracking_items.id')
            ->orderBy('tracking_shipments.id', 'DESC')
            ->get();
        return $query;
    }

    public function deleteShipmentDetail($id) {
        $this->db->query("DELETE FROM tracking_details WHERE shipment_id = '$id' ");
    }

    public function isTrackingExist($buyerId = null, $number = null ) {
        if (is_null($buyerId)) {
            $query = $this->table('tracking_shipments')            
                ->where('tracking_number', $number)
                ->get();
        } else {
            $query = $this->table('tracking_shipments')
                ->join('tracking_items', 'tracking_items.shipment_id = tracking_shipments.id')
                ->join('buyer_details', 'buyer_details.buyer = tracking_items.buyer_id')
                ->where('buyer_details.id', $buyerId)            
                ->get();
        }
        return $query->getFirstRow('array');
    }

    public function addDetails($buyerId, $shipmentId, $purchId) {
        $this->db->query("INSERT IGNORE INTO tracking_items(buyer_id, shipment_id, purch_id) VALUES('$buyerId', '$shipmentId', '$purchId')");
    }


}