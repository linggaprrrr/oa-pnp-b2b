<?php 
namespace App\Models\pnp;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $allowedFields = ['message', 'is_read', 'author', 'receiver', 'created_at'];
    protected $db = "";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getUserMessage($user) {
        $query = $this->db->table('messages')
            ->where('author', $user)
            ->orWhere('receiver', $user)
            ->get();
        return $query;
        
    }

    public function getUsers() {
        $query = $this->db->table('messages')            
            ->join('users', 'users.oauth_uid = messages.author')
            ->where('users.role !=', 'superadministrator')
            ->groupBy('users.oauth_uid')
            ->orderBy('messages.id', 'DESC')
            ->get();
        return $query;
    }

    public function getLastMessage() {
        $query = $this->db->table('messages')
            ->orderBy('id', 'DESC')
            ->get();
        return $query->getFirstRow();
    }
    
    public function checkMailNotif($sender) {
        $query = $this->db->table('mail_notif')
            ->where('sender', $sender)
            ->where('DATE(created_at)', date('Y-m-d'))
            ->get();
        return $query;
            
    }

    public function saveNotif($sender) {
        $this->db->query("INSERT INTO mail_notif(sender) VALUES(".$sender.") ");
    }

}
?>
