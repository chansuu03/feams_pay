<?php namespace App\Controllers;

use App\Models as Models;

class User extends BaseController {
    public function __construct() {
        $this->userModel = new Models\UserModel();
        $this->loginModel = new Models\LoginModel();
    }

    public function login() {
        if($this->request->getMethod() === 'post') {
            helper(['form']);
            //set rules validation form
            $rules = [
                'username'         => 'required|min_length[3]|max_length[50]',
                'password'      => 'required|min_length[3]|max_length[200]|validateUser[username,password]',
            ];

            if(!$this->validate($rules)) {
                $this->session->setFlashData('failMsg', 'Incorrect username or password');
                return redirect()->back()->withInput(); 
            } else {
                $user = $this->userModel->where('username', $this->request->getVar('username'))
                    ->first();
                if($user['status'] == 'i') {
                    $this->session->setFlashData('failMsg', 'Account deactivated, please contact admin');
                    return redirect()->back()->withInput(); 
                }
                if($user['status'] == 'v') {
                    $this->session->setFlashData('failMsg', 'Email not verified, please verify it first');
                    return redirect()->back()->withInput(); 
                }
                $this->setUserSession($user);
                return redirect()->to(base_url());
            }
        }
        return view('login');
    }

    private function setUserSession($user) {
        $data = [
            'user_id' => $user['id'],
            'isLoggedIn' => true,
            "role" => $user['role'],
        ];

        $this->session->set($data);
        $this->addLoginRecord($user);
        return true;
    }

    // Function that add login details to the database
    // parameters: whole row of the user data
    private function addLoginRecord($user) {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s', time());
        $loginDetails = [
            'user_id' => $user['id'],
            'role_id' => $user['role'],
            'login_date' => $date,
            'created_at' => $date,
        ];

        if ($this->loginModel->save($loginDetails)) {
            return true;
        } else {
            die('there\'s an error');
        }
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to('login');
    }

	public function register() {
        $data[] = array();
        helper(['form', 'url', 'text']);

        if($this->request->getMethod() == 'post') {
            if($this->validate('users')){
                $file = $this->request->getFile('image');
                $date=  date_create($_POST['birthdate']);
                $dates = date_format($date,"Y-m-d");
                $userData = $_POST;
                $userData['status'] = 'v';
                $userData['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                $userData['contact_number'] = $this->request->getVar('contact_number');
                $userData['birthdate'] = $dates;
                $userData['email_code'] = random_string('alnum', 5);
                $userData['profile_pic'] = $file->getRandomName();
                if($this->userModel->insert($userData)){
                    $file->move(ROOTPATH .'/public/uploads/profile_pic/', $userData['profile_pic']);
                    if($file->hasMoved()) {
                        $this->sendMail($userData);
                        return redirect()->to(base_url());
                    } else {
                        $this->session->setFlashdata('failMsg', 'There is an error creating account');
                    }
                } else {
                    $this->session->setFlashdata('failMsg', 'There is an error creating account');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }
        return view('register/register', $data);
	}

    private function sendMail($userData) {
        $this->email->setTo($userData['email']);
        $this->email->setFrom('facultyea@gmail.com', 'Faculty and Employees Association');
        $this->email->setSubject('Account Confirmation');
        $message = view('regiEmail', $userData);
        $this->email->setMessage($message);
        if ($this->email->send()) 
            echo 'Email successfully sent';
		else {
            $data = $this->email->printDebugger(['headers']);
            print_r($data);
        }
    }

    public function activate($code) {
        $user = $this->userModel->where('email_code', $code)->first();
        
        $data = [
            'id' => $user['id'],
            'email_code' => null,
            'status' => 'a',
        ];
        if($this->userModel->save($data)) {
            $this->session->setFlashdata('successMsg', 'Account successfully activated');
            return redirect()->to(base_url());
        } else {
            $this->session->setFlashdata('failMsg', 'Account not activated, please try again');
            return redirect()->to(base_url());
        }
        die();
    }
}