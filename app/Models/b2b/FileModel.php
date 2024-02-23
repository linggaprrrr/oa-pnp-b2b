<?php

namespace App\Models\b2b;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $allowedFields = ['filename', 'file_template_id', 'status', 'activation', 'oauth_uid', 'created_at'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function addPattern($name, $pattern) {
        $this->db->query("INSERT INTO file_templates(template_name, pattern) VALUES('$name', '$pattern') ");
        $lastID = $this->db->insertID();
        return $lastID;
    }

    public function isPatternExist($name) {
        $exist = false;
        $query = $this->db->query("SELECT * FROM file_templates WHERE template_name=" .$this->db->escape($name). " ");
        
        if ($query->getNumRows() > 0) {
            $exist = true;
        }
        return $exist;
    }

    public function getPattern($name) {
        $patternID = null;
        $query = $this->db->query("SELECT * FROM file_templates WHERE template_name=" .$this->db->escape($name). " ");
        if ($query->getNumRows() > 0) {
            $patternID = $query->getFirstRow();
            $patternID = $patternID->id;
        }
        return $patternID;
    }

    public function getAllPattern() {
        $query = $this->db->query("SELECT file_templates.id, filename, template_name FROM files JOIN file_templates ON files.file_template_id = file_templates.id GROUP BY file_templates.id");
        return $query;
    }

    public function syncPattern($keywords) {
        $pattern = null;
        if (isset($keywords[1])) {
            $query = $this->db->table('files')
            ->join('file_templates', 'file_templates.id = files.file_template_id')
            ->like('filename', $keywords[0])
            ->Like('filename', $keywords[1])
            ->get();
        } else {
            $query = $this->db->table('files')
            ->join('file_templates', 'file_templates.id = files.file_template_id')
            ->like('filename', $keywords[0])
            ->get();
        }
        if ($query->getNumRows() > 0) {
            $pattern = $query->getFirstRow();            
        }
        return $pattern;
    }

    public function getPatternById($id) {
        $query = $this->db->table('file_templates')
            ->where('id', $id)
            ->get();
        return $query->getFirstRow();
    }

    public function getAllPatterndata() {
        $query = $this->db->table('files')
            ->select('file_templates.*') 
            ->join('file_templates', 'file_templates.id = files.file_template_id')        
            ->where('files.oauth_uid', session()->get('oauth_uid'))   
            ->groupBy('file_templates.id')
            ->orderBy('file_templates.id', 'DESC')
            ->get();
        return $query;
    }

    public function updateTemplate($id, $name, $pattern) {
        $this->db->query("UPDATE file_templates SET template_name='$name', pattern='$pattern' WHERE id='$id' ");
    }

    public function getTokenLeft($userKey) {
        $query = $this->db->query("SELECT * FROM asinscope_token WHERE user_key = '$userKey' ");
        return $query->getFirstRow();
    }

    public function updateTokenLeftAPI($userKey, $token) {
        $this->db->query("UPDATE asinscope_token SET token_left = '$token', updated_at = NOW() WHERE user_key = '$userKey' ");
    }

    public function getTokenLeftAPI($key) {
        $query = $this->db->query("SELECT * FROM asinscope_token WHERE user_key='$key' ");
        return $query->getFirstRow();
    }

    public function getASINScopeAPI() {
        $query = $this->db->query("SELECT * FROM asinscope_token ");
        return $query;
    }

    public function restoreData($date) {
        $this->db->query("UPDATE purchase_items SET activation = 0 WHERE DATE(created_at) > ". $date ." AND order_staff = ". session()->get('user_id') ." ");
    }

  



}
