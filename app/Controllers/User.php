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
                $userData['profile_pic'] = $file->getRandomName();
                if($this->userModel->insert($userData)){
                    $file->move(ROOTPATH .'/public/uploads/profile_pic/', $userData['profile_pic']);
                    if($file->hasMoved()) {
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
}