<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\UserModel;
use App\Models\MessageModel;
use App\Models\pnp\MessageModel as PnpMessageModel;

use function App\Helpers\timeSpan;

class Home extends BaseController
{
    protected $userModel = '';
    protected $messageModel = '';
    protected $logModel = "";

    public function __construct() {
        $this->userModel = new UserModel();
        $this->messageModel = new PnpMessageModel();
        $this->logModel = new LogModel();
    }

    public function users() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        $users = $this->userModel
            ->select('users.*')
            ->where('role !=', 'superadministrator')->get();

        $data = [
            'title' => 'Users',
            'users' => $users
        ];
        return view('admin/users', $data);
    }

    public function history() {
        $userRole = session()->get('user_id');
        if (empty($userRole)) {            
            header("Location: ".base_url('/pnp/login'));
            die();            
        }

        if ($userRole == 'superadministrator') {
            $logs = $this->logModel->getLogData(1);
        } else {
            $logs = $this->logModel->getLogData();
        }
        // check payment
       
        $startSub = null;
        $expSub = null;
      
        $data = [
            'title' => 'User Activity',            
            'logs' => $logs,
        ];

        return view('admin/history', $data);
    }

    public function chat($id = null) {
        $lastMessage = $this->messageModel->getLastMessage();
        $userList = array();
        if ($id == null) {
            $messages = $this->messageModel->getUserMessage($lastMessage->author);
        } else {
            $messages = $this->messageModel->getUserMessage($id);
        }
        $users = $this->messageModel->getUsers($userList);
        $userid = $id;
        
        $data = [
            'title' => 'Chat',
            'users' => $users,
            'userid' => $userid,
            'messages' => $messages            
        ];
        return view('admin/chat', $data);
    }
    
}
