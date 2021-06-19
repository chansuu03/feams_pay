<?php
namespace Modules\Users\Controllers;

use App\Controllers\BaseController;
use App\Models as Models;

class Users extends BaseController
{
    public function __construct() {
        $this->userModel = new Models\UserModel();
    }

    public function index() {
        $data['perm_id'] = check_role('1', 'USR', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['users'] = $this->userModel->viewing();
        // echo '<pre>';
        // print_r($data['users']);
        // die();
        $data['active'] = 'users';
        $data['title'] = 'Users';
        return view('Modules\Users\Views\index', $data);
    }

    public function delete($id) {
        $data['perm_id'] = check_role('6', 'ROLE', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        if($this->roleModel->where('id', $id)->delete()) {
          $this->session->setFlashData('successMsg', 'Successfully deleted role');
        } else {
          $this->session->setFlashData('errorMsg', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/roles'));
    }

    public function profile($username) {
        $data['perm_id'] = check_role('1', 'USR', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['user'] = $this->userModel->viewProfile($username);
        // echo '<pre>';
        // print_r($data['user']);
        // die();
        $data['active'] = 'users';
        $data['title'] = $data['user']['first_name'].' '. $data['user']['last_name'];
        return view('Modules\Users\Views\profile', $data);
    }
}