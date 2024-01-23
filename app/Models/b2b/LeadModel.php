<?php

namespace App\Models\b2b;

use CodeIgniter\Model;

class LeadModel extends Model
{
    protected $table = 'lead_lists';
    protected $allowedFields = ['title', 'asin', 'retail_link', 'buy_cost', 'promo_code', 'source', 'amazon_link', 'brand', 'category', 'best_sales_rank', 'market_price', 'martket_place_fees', 'fba_selling_fees', 'profit', 'roi', 'file_id', 'status', 'notes', 'checked'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getSelectionData($date = null, $target = null) {
        if (is_null($date)){
            $query = $this->db->table('lead_lists')    
            ->select('lead_lists.*, files.created_at')                                
            ->join('files', 'files.id = lead_lists.file_id')                                                         
            ->where('files.activation', 'actived')
            ->where('files.oauth_uid', session()->get('oauth_uid'))
            ->groupBy('lead_lists.id')
            ->orderBy('roi', 'DESC')
            ->get();
        } else {
            $query = $this->db->table('lead_lists')    
            ->select('lead_lists.*, files.created_at')                                
            ->join('files', 'files.id = lead_lists.file_id')                                   
            
            ->where('files.created_at >=', $date . ' 00:00:00')
            ->where('files.created_at <=', $date . ' 23:59:59')
            ->where('files.activation', 'actived')
            ->where('files.oauth_uid', session()->get('oauth_uid'))
            ->groupBy('lead_lists.id')
            ->orderBy('roi', 'DESC')
            ->get();
        }
        return $query;
    }

    public function getPruchaseData($date = null) {
        $query = $this->db->table('lead_lists')
            ->select('lead_lists.*, lead_lists.id as uid, (roi/profit) as roi_percen, purchase_items.created_at')            
            ->join('files', 'files.id = lead_lists.file_id')
            ->join('purchase_items', 'purchase_items.lead_id = lead_lists.id')
            ->where('purchase_items.created_at >=', $date . ' 00:00:00')
            ->where('purchase_items.created_at <=', $date . ' 23:59:59')
            ->where('files.activation', 'actived')
            ->where('files.oauth_uid', session()->get('oauth_uid'))
            ->groupBy('lead_lists.id')
            ->orderBy('roi', 'DESC')
            ->get();
        return $query;
    }

    public function getASINData($date) {
        $query = $this->db->table('lead_lists')
            ->select('lead_lists.id as file_id, asin')
            ->join('files', 'files.id = lead_lists.file_id')
            ->where('files.created_at >=', $date . ' 00:00:00')
            ->where('files.created_at <=', $date . ' 23:59:59')
            ->where('files.activation', 'actived')
            ->where('files.oauth_uid', session()->get('oauth_uid'))
            ->get();
        return $query;
    }

    public function sourceSummary($start = null, $end = null) {
        if (is_null($start)) {
            $query = $this->db->table('purchase_items')
                ->select('template_name as source, SUM(purchase_items.qty) as qty, SUM(purchase_items.qty * lead_lists.buy_cost) as buy_cost, SUM(purchase_items.qty * lead_lists.market_price) as sell_price, SUM(purchase_items.qty * lead_lists.profit) as profit, ((SUM(purchase_items.qty * lead_lists.profit) / SUM(purchase_items.qty * lead_lists.market_price))*0.6) * 100 as margin, ((SUM(purchase_items.qty* lead_lists.profit) / SUM(purchase_items.qty * lead_lists.buy_cost))*100) as roi')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                // ->join('files', 'files.id = lead_lists.file_id')
                // ->join('file_templates', 'file_templates.id = files.file_template_id')
                ->where('MONTH(purchase_items.created_at) = MONTH(CURDATE())')
                // ->where('files.activation', 'actived')
                ->where('lead_lists.file_id', session()->get('oauth_uid'))
                ->groupBy('file_templates.template_name')
                ->get();            
        } else {
            $query = $this->db->table('purchase_items')
                ->select('template_name as source, SUM(purchase_items.qty) as qty, SUM(purchase_items.qty * lead_lists.buy_cost) as buy_cost, SUM(purchase_items.qty * lead_lists.market_price) as sell_price, SUM(purchase_items.qty * lead_lists.profit) as profit, ((SUM(purchase_items.qty * lead_lists.profit) / SUM(purchase_items.qty * lead_lists.market_price))*0.6) * 100 as margin, ((SUM(purchase_items.qty* lead_lists.profit) / SUM(purchase_items.qty * lead_lists.buy_cost))*100) as roi')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('files', 'files.id = lead_lists.file_id')
                ->join('file_templates', 'file_templates.id = files.file_template_id')
                ->where('purchase_items.created_at >=', $start . ' 00:00:00')
                ->where('purchase_items.created_at <=', $end . ' 23:59:59')
                ->where('files.activation', 'actived')
                ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->groupBy('template_name')
                ->get();
        }
        return $query;
    }

    public function getMonthlySummary($year = null) {
        if (is_null($year)) {
            $query = $this->db->table('purchase_items')
                ->select('YEAR(purchase_items.created_at) as year, MONTHNAME(purchase_items.created_at) as month, SUM(purchase_items.qty) as qty, SUM(purchase_items.qty * lead_lists.buy_cost) as buy_cost, SUM(purchase_items.qty * lead_lists.market_price) as sell_price, SUM(purchase_items.qty * lead_lists.profit) as profit, ((SUM(purchase_items.qty * lead_lists.profit) / SUM(purchase_items.qty * lead_lists.market_price))*0.6) * 100 as margin, ((SUM(purchase_items.qty* lead_lists.profit) / SUM(purchase_items.qty * lead_lists.buy_cost))*100) as roi')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                // ->join('files', 'files.id = lead_lists.file_id')
                ->where('YEAR(purchase_items.created_at) = YEAR(NOW())')
                // ->where('files.activation', 'actived')
                // ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->where('lead_lists.file_id', session()->get('user_id'))
                ->groupBy('YEAR(purchase_items.created_at), MONTH(purchase_items.created_at)')
                ->get();
        } else {
            $query = $this->db->table('purchase_items')
                ->select('YEAR(purchase_items.created_at) as year, MONTHNAME(purchase_items.created_at) as month, SUM(purchase_items.qty) as qty, SUM(purchase_items.qty * lead_lists.buy_cost) as buy_cost, SUM(purchase_items.qty * lead_lists.market_price) as sell_price, SUM(purchase_items.qty * lead_lists.profit) as profit, ((SUM(purchase_items.qty * lead_lists.profit) / SUM(purchase_items.qty * lead_lists.market_price))*0.6) * 100 as margin, ((SUM(purchase_items.qty* lead_lists.profit) / SUM(purchase_items.qty * lead_lists.buy_cost))*100) as roi')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')  
                ->join('files', 'files.id = lead_lists.file_id')   
                ->where('YEAR(purchase_items.created_at)', $year)
                ->where('files.activation', 'actived')
                ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->groupBy('YEAR(purchase_items.created_at), MONTH(purchase_items.created_at)')
                ->get();
        }
        return $query;
    }

    public function getAnnualySummary($year = null) {
        if (is_null($year)) {
            $query = $this->db->table('purchase_items')
                ->select('SUM(purchase_items.qty) as qty, SUM(purchase_items.qty * lead_lists.buy_cost) as buy_cost, SUM(purchase_items.qty * lead_lists.market_price) as sell_price, SUM(purchase_items.qty * lead_lists.profit) as profit, ((SUM(purchase_items.qty * lead_lists.profit) / SUM(purchase_items.qty * lead_lists.market_price))*0.6) * 100 as margin, ((SUM(purchase_items.qty * lead_lists.profit) / SUM(purchase_items.qty * lead_lists.buy_cost))) * 100 as roi')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id') 
                ->join('files', 'files.id = lead_lists.file_id')               
                ->where('YEAR(purchase_items.created_at) = YEAR(NOW())')
                ->where('files.activation', 'actived')
                ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->groupBy('YEAR(purchase_items.created_at)')
                ->get();
        } else {
            $query = $this->db->table('purchase_items')
                ->select('SUM(purchase_items.qty) as qty, SUM(purchase_items.qty * lead_lists.buy_cost) as buy_cost, SUM(purchase_items.qty * lead_lists.market_price) as sell_price, SUM(purchase_items.qty * lead_lists.profit) as profit, ((SUM(purchase_items.qty * lead_lists.profit) / SUM(purchase_items.qty * lead_lists.market_price))*0.6) * 100 as margin, ((SUM(purchase_items.qty* lead_lists.profit) / SUM(purchase_items.qty * lead_lists.buy_cost)))*100 as roi')
                ->join('lead_lists', 'lead_lists.id = purchase_items.lead_id')
                ->join('files', 'files.id = lead_lists.file_id')
                ->where('YEAR(purchase_items.created_at)', $year)
                ->where('files.activation', 'actived')
                ->where('files.oauth_uid', session()->get('oauth_uid'))
                ->groupBy('YEAR(purchase_items.created_at)')
                ->get();
        }
        return $query->getFirstRow();
    }

    public function getFileData($id) {
        $query = $this->db->table('scan_unlimited')
            ->select('scan_unlimited.*, filename')
            ->join('files', 'files.id = scan_unlimited.file_id')
            ->where('file_id', $id)
            ->where('files.activation', 'actived')
            ->where('files.oauth_uid', session()->get('oauth_uid'))
            ->get();
        return $query;
    }
}
