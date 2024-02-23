<?php 
    namespace App\Controllers\pnp;

use App\Models\pnp\MessageModel;
use App\Models\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
    
    use function App\Helpers\timeSpan;
    
    class Messages extends BaseController
    {        
        protected $userModel = "";
        protected $messageModel = "";
    
        public function __construct()
        {
            $userId = session()->get('user_id');
            if (is_null($userId)) {
                header("Location: ".base_url('/pnp/login'));
                die();            
            }
            
            $this->userModel = new UserModel();
            $this->messageModel = new MessageModel();
        }

        public function sendMessage() {
            $chat = $this->request->getVar('message');
            $id = $this->request->getVar('id');
            $date = date('Y-m-d H:i:s');
            if (is_null($id)) {
                $this->messageModel->save([
                    'author' => session()->get('user_id'),
                    'message' => $chat,
                    'receiver' => 25,
                    'created_at' => $date
                ]);
                $mailNotifCheck = $this->messageModel->checkMailNotif(session()->get('user_id'));
                if ($mailNotifCheck->getNumRows() == 0) {
                    $message = 'New Messages on quickprep.ai <br>';
                    $message .= '<pre>'.$chat.'</pre>';
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->IsHTML(true);
                    $mail->Host = 'smtp.titan.email';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Subject = 'New Message from ['.session()->get('name').']';
                    $mail->Username = 'quickprep-admin@ezleadslist.com';
                    $mail->Password = ')f}DE<IQh+2= \:';
                    $mail->setFrom('quickprep-admin@ezleadslist.com', 'Quickprep');
                    $mail->addAddress('coral@buysmartwholesale.com', 'Coral');
                    $mail->addAddress('karen@buysmartwholesale.com', 'Karen');
                    $mail->Body = $message;
                    $mail->send();
                    
                    $this->messageModel->saveNotif(session()->get('user_id'));
                }
                
            } else {
                $this->messageModel->save([
                    'author' => session()->get('user_id'),
                    'receiver' => $id,
                    'message' => $chat,    
                    'created_at' => $date             
                ]);
            }
            
            $result = [
                'status' => 200,
                'message' => $chat,
                'sent' => date('H:i', strtotime($date))
            ];
            echo json_encode($result);
        }
        
        public function greetingEmail() {
            $message = 'New Messages on quickprep.ai';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->IsHTML(true);
            $mail->Host = 'smtp.titan.email';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Subject = 'New Message Notification';
            $mail->Username = 'admin@ezleadslist.com';
            $mail->Password = 'm5E9O3pBg!cV';
            $mail->setFrom('admin@ezleadslist.com', 'Quickprep');
            $mail->addAddress('lingga@buysmartwholesale.com', 'Lingga');
            $mail->Body = $message;
            $mail->send();
        }
    }
    
?>
