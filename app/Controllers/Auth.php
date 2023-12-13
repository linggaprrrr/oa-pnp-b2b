<?php

namespace App\Controllers;

use App\Models\BuyerModel;
use App\Models\BuyerStaffModel;
use App\Models\LogModel;
use App\Models\SubscriptionModel;
use App\Models\UserModel;
use Google\Client;
use PHPMailer\PHPMailer\PHPMailer;

class Auth extends BaseController
{
    protected $userModel = "";
    protected $logModel = "";
    protected $googleClient;
    protected $subsModel;
    protected $buyerModel = "";
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->logModel = new LogModel();
        $this->subsModel = new SubscriptionModel();
        $this->buyerModel = new BuyerStaffModel();
        
        helper('cookie');        
        $this->googleClient = new Client();
        
        $this->googleClient->setClientId("1031790131862-1s3hp335h9h2foe8rkbpok31sfsri3m0.apps.googleusercontent.com");
        $this->googleClient->setClientSecret("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");
        $this->googleClient->setRedirectUri("https://swinternal.net/login/process");
        $this->googleClient->addScope('https://www.googleapis.com/auth/userinfo.email');
        $this->googleClient->addScope('https://www.googleapis.com/auth/userinfo.profile');
        $this->userModel = new UserModel();
    }

    public function homepage() {
        return view('welcome_message');
    }

    public function index()
    {
        $userId = session()->get('user_id');
        
        if (is_null($userId)) {            
            $data['googleAuth'] = $this->googleClient->createAuthUrl();
            return view('login', $data);
        } else {            
            return redirect()->to(base_url('/dashboard'))->with('message', 'Login Successful!');
        }
    }

    public function googleOAuth() {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token);                                    
            $googleService = new \Google\Service\Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();

            $findUser = $this->userModel->getWhere(['oauth_uid' => $data->id])->getRow();
            $row = [
                'oauth_uid' => $data->id,
                'name' => $data->givenName .' '.$data->familyName,            
                'email' => $data->email,
                'locale' => $data->locale,
                'photo' => $data->picture,
                'verify' => $data->verifiedEmail,          
                'role' => 'administrator'  
            ];
            
            if (is_null($findUser)) {
                // $this->greetingEmail($data->email, $data->givenName.' '.$data->familyName);
                $this->userModel->save($row);   
                $params = [
                    'user_id' => $this->userModel->getInsertID(),
                    'name' => $data->givenName .' '.$data->familyName,      
                    'username' => $data->email,
                    'email' => $data->email,
                    'locale' => $data->locale,
                    'photo' => $data->picture,
                    'verify' => $data->verifiedEmail,          
                    'role' => 'administrator'  
                ];       
                $userId = $this->userModel->getInsertID();
                $data = [
                    [
                        'buyer_name' => 'CC1',
                        'cc'  => '0001',
                        'user_id'  => $userId,
                    ],
                    [
                        'buyer_name' => 'CC2',
                        'cc'  => '0002',
                        'user_id'  => $userId,
                    ],
                    [
                        'buyer_name' => 'CC3',
                        'cc'  => '0003',
                        'user_id'  => $userId,
                    ],
                    [
                        'buyer_name' => 'CC4',
                        'cc'  => '0004',
                        'user_id'  => $userId,
                    ],
                    [
                        'buyer_name' => 'CC5',
                        'cc'  => '0005',
                        'user_id'  => $userId,
                    ],
                    [
                        'buyer_name' => 'CC6',
                        'cc'  => '0006',
                        'user_id'  => $userId,
                    ],
                    [
                        'buyer_name' => 'CC7',
                        'cc'  => '0007',
                        'user_id'  => $userId,
                    ],
                ];
                
                $this->buyerModel->insertBatch($data);  
            } else {
                $params = [
                    'oauth_uid' => $data->id,
                    'user_id' => $findUser->id,
                    'role' => $findUser->role,
                    'username' => $findUser->username,
                    'email' => $findUser->email,
                    'name' => $findUser->name,
                    'photo' => $findUser->photo,
                    'user_ext' => $findUser->user_ext
                ];
            }
            session()->set($params);
            return redirect()->to(base_url('/dashboard'))->with('message', 'Login Successful!');
        }
    }

    public function loginProcess() {
        $post = $this->request->getVar();
        $user = $this->userModel->getWhere(['email' => $post['email']])->getRow();
        
        if ($user) {
            if (isset($post['rememberme'])) {            
                setcookie("username", $post['email'], time()+ (10 * 365 * 24 * 60 * 60));            
                setcookie("password", $post['password'], time()+ (10 * 365 * 24 * 60 * 60)); 
                setcookie("remember", "checked", time()+ (10 * 365 * 24 * 60 * 60));            
            } else {
                setcookie("username", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
                setcookie("remember", "", time() - 3600, "/");
            }
            // dd(password_verify($post['password'], $user->password));
            if (password_verify($post['password'], $user->password)) {
                $params = [
                    'oauth_uid' => $user->oauth_uid,
                    'user_id' => $user->id,
                    'role' => $user->role,
                    'username' => $user->username,
                    'email' => $user->email,
                    'name' => $user->name,
                    'photo' => $user->photo,
                    'user_ext' => $user->user_ext
                ];
                session()->set($params);
                
                $ip = getenv('HTTP_CLIENT_IP')?: getenv('HTTP_X_FORWARDED_FOR')?: getenv('HTTP_X_FORWARDED')?: getenv('HTTP_FORWARDED_FOR')?: getenv('HTTP_FORWARDED')?: getenv('REMOTE_ADDR');                
                if ($ip == false) {
                    $ip = "127.0.0.1";
                }
                $this->logModel->save([
                    'user_id' => $user->id,
                    'title' => 'login',
                    'description' => '['. strtoupper($user->role) .'] '. $user->username. ' has logged in using IP: '. $ip,
                    'level' => '1'
                ]);

                if ($user->role == 'superadministrator') {
                    return redirect()->to(base_url('admin/users'))->with('message', 'Login Successful!');
                    
                }
                return redirect()->to(base_url('dashboard'))->with('message', 'Login Successful!');
                
            } else {
                
                return redirect()->to(base_url('/login'))->with('error', 'Wrong Password!');
            }
        } else {
            return redirect()->to(base_url('/login'))->with('error', 'Username Not Found!');
        }
    }

    public function signup() {
        $data['googleAuth'] = $this->googleClient->createAuthUrl();
        return view('signup', $data);
    }

    public function signupProcess() {
        $post = $this->request->getVar();
        try {
            $this->userModel->save(array(      
                "name" => $post['name'],                              
                "email" => $post['email'],
                "password" => password_hash($post['password'], PASSWORD_BCRYPT),
            ));

            $this->subsModel->save([
                'user_id' => $this->userModel->getInsertID(),
                'payment_id' => 'free',
                'plan' => 'free',
                'total' => 0,
                'valid_date' => date('Y-m-d'),
                'expire_date' => date('Y-m-d', strtotime('+1 month')),
                'status' => 1,
            ]);
            $userId = $this->userModel->getInsertID();
            $data = [
                [
                    'buyer_name' => 'CC1',
                    'cc'  => '0001',
                    'user_id'  => $userId,
                ],
                [
                    'buyer_name' => 'CC2',
                    'cc'  => '0002',
                    'user_id'  => $userId,
                ],
                [
                    'buyer_name' => 'CC3',
                    'cc'  => '0003',
                    'user_id'  => $userId,
                ],
                [
                    'buyer_name' => 'CC4',
                    'cc'  => '0004',
                    'user_id'  => $userId,
                ],
                [
                    'buyer_name' => 'CC5',
                    'cc'  => '0005',
                    'user_id'  => $userId,
                ],
                [
                    'buyer_name' => 'CC6',
                    'cc'  => '0006',
                    'user_id'  => $userId,
                ],
                [
                    'buyer_name' => 'CC7',
                    'cc'  => '0007',
                    'user_id'  => $userId,
                ],
            ];
            
            $this->buyerModel->insertBatch($data);

            $this->userModel->set('oauth_uid', $this->userModel->getInsertID())
                ->where('email', $post['email'])
                ->update();            
            // $this->greetingEmail($post['email'], $post['email']);
            return redirect()->to(base_url('/login'))->with('message', 'Please sign in with your registered email');
        } catch (\Throwable $th) {
            return redirect()->to(base_url('/sign-up'))->with('error', 'Email has been used');
        }
        
    }

    public function forgotPassword() {
        return view('forgot-password');
    }

    public function resetPassword() {
        return view('reset-password');
    }

    public function forgotPasswordProcess() {
        $email = $this->request->getVar('email');
        $user = $this->userModel->getWhere(['email' => $email])->getRow();
        $link = base_url()."reset-password?uid=".$user->oauth_uid;
        
        $this->forgotPasswordEmail($user->email, $user->first_name, $link);
        return redirect()->to(base_url('/login'))->with('message', 'Please check your email');
    }

    public function resetPasswordProcess() {
        $uid = $this->request->getVar('uid');
        $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        $this->userModel->set('password', $password)
            ->where('oauth_uid', $uid)
            ->update();
        return redirect()->to(base_url('/login'))->with('message', 'Please sign in with your new password');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }

    public function profile() {
        $userId = session()->get('user_id');
        $userRole = session()->get('role');

        if (is_null($userId)) {            
            return view('login'); 
        }

        $getUser = $this->userModel->find($userId);
        
        $data = [
            'title' => 'Profile',
            'user' => $getUser
        ];

        if ($userRole == 'administrator') {
            return view('profile', $data);
        } else if ($userRole == 'warehouse') {
            return view('warehouse/profile', $data);
        } else if ($userRole == 'purchase') {
            return view('purchase/profile', $data);
        } else {
            return view('profile', $data);
        }
    }

    public function updateProfile() {
        $post = $this->request->getVar();
        $photo = $this->request->getFile('photo');
        $fileName = "";
        if (!empty($photo->getTempName())) {
            $fileName = time() . $photo->getName();
            $photo->move('photos', $fileName);
        }

        // $user = $this->userModel->find($post['id']); 
        if (!empty($post['new-password'])) {
            if ($fileName != "") {
                $this->userModel->save(array(
                    "id" => $post['id'],
                    "name" => isset($post['name']) ? $post['name'] : null,
                    "email" => isset($post['email']) ? $post['email'] : null,                        
                    "photo" => $fileName,                        
                    "password" => password_hash($post['new-password'], PASSWORD_BCRYPT),
                ));
                $params = [                    
                    'photo' => $fileName,
                ];
                session()->set($params);
            } else {
                $this->userModel->save(array(
                    "id" => $post['id'],
                    "name" => isset($post['name']) ? $post['name'] : null,
                    "email" => isset($post['email']) ? $post['email'] : null,                                           
                    "password" => password_hash($post['new-password'], PASSWORD_BCRYPT),
                ));
            }
            return redirect()->back()->with('success', 'User Successfully Updated!');
        } else {
            if ($fileName != "") {
                $this->userModel->save(array(
                    "id" => $post['id'],
                    "name" => isset($post['name']) ? $post['name'] : null,
                    "email" => isset($post['email']) ? $post['email'] : null,                            
                    "photo" => $fileName,  
                ));
                $params = [                    
                    'photo' => $fileName,
                ];
                session()->set($params);
            } else {
                $this->userModel->save(array(
                    "id" => $post['id'],
                    "name" => isset($post['name']) ? $post['name'] : null,
                    "email" => isset($post['email']) ? $post['email'] : null,           
                ));
            }
        }
        return redirect()->back()->with('success', 'User Successfully Updated!');
    }

    public function documentation() {
        $userId = session()->get('user_id');
        $userRole = session()->get('role');
        if (is_null($userId)) {            
            return view('login'); 
        }

        $getUser = $this->userModel->find($userId);
        
        $data = [
            'title' => 'Documentation',
            'user' => $getUser
        ];

        if ($userRole == 'administrator') {
            return view('admin/documentation', $data);
        } else if ($userRole == 'warehouse') {
            return view('warehouse/documentation', $data);
        } else if ($userRole == 'purchase') {
            return view('purchase/documentation', $data);
        }
    }

   

    public function updateUser() {
        $post = $this->request->getVar();

        $this->userModel->save([
            'id' => $post['id'],
            'role' => $post['role'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
        ]);
        return redirect()->back()->with('success', 'User Successfully Updated!');
    }

    public function greetingEmail($email, $name) {        
        $message = 'Greetings';
        $mail = new PHPMailer;
        $mail->isSMTP();        
        $mail->IsHTML(true);
        $mail->Host = 'smtp.titan.email';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Subject = 'Your registration is completed.';
        $mail->Username = 'admin@ezleadslist.com';
        $mail->Password = 'm5E9O3pBg!cV';
        $mail->setFrom('admin@ezleadslist.com', 'EZLeads');
        $mail->addAddress($email, $name);
        $mail->Body = $message;
        $mail->send();
    }

    public function forgotPasswordEmail($email, $name, $link) {            
        $message = 'Please Click link for reset your password <br> <a href="'.$link.'" target="_blank">'.$link.'</a>';
        
        $mail = new PHPMailer;
        $mail->isSMTP();        
        $mail->IsHTML(true);
        $mail->Host = 'smtp.titan.email';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Subject = 'Password Reset';
        $mail->Username = 'admin@ezleadslist.com';
        $mail->Password = 'm5E9O3pBg!cV';
        $mail->setFrom('admin@ezleadslist.com', 'EZLeads');
        $mail->addAddress($email, $name);
        $mail->Body = $message;
        $mail->send();
    }

    public function features() {
        return view('features');
    }

    public function pricing() {
        return view('pricing');
    }

    public function about() {
        return view('about');
    }

    public function getUser() {
        $id = $this->request->getVar('id');
        $getUser = $this->userModel
            ->join('subscriptions', 'subscriptions.user_id = users.oauth_uid')
            ->getWhere(['users.id' => $id])->getRow();
        echo json_encode($getUser);
    }

}
