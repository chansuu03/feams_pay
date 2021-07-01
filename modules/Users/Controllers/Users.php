<?php
namespace Modules\Users\Controllers;

use App\Controllers\BaseController;
use App\Models as Models;
use Modules\Files\Models as FileModels;
use Modules\Roles\Models as RoleModels;

class Users extends BaseController
{
    public function __construct() {
        $this->userModel = new Models\UserModel();
        $this->fileModel = new FileModels\FileModel();
        $this->roleModel = new RoleModels\RoleModel();
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
        $data['roles'] = $this->roleModel->findAll();
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
        if($this->userModel->where('id', $id)->delete()) {
          $this->session->setFlashData('successMsg', 'Successfully deleted user');
        } else {
          $this->session->setFlashData('errorMsg', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/users'));
    }

    public function profile($username) {
        $data['perm_id'] = check_role('', '', $this->session->get('role'));
        // if(!$data['perm_id']['perm_access']) {
        //     $this->session->setFlashdata('sweetalertfail', true);
        //     return redirect()->to(base_url());
        // }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['user'] = $this->userModel->viewProfile($username);
        $data['files'] = $this->userModel->getFileUploads($data['user']['id']);
        // echo '<pre>';
        // print_r($data['files']);
        // die();
        $data['active'] = 'users';
        $data['title'] = $data['user']['first_name'].' '. $data['user']['last_name'];
        return view('Modules\Users\Views\profile', $data);
    }

    public function changeStatus($username) {
        $user = $this->userModel->where('username', $username)->first();
        $data = [
            'id' => $user['id'],
            'status' => $this->request->getVar('status_'.$user['id']),
        ];
        if($this->userModel->save($data)) {
            $this->session->setFlashData('successMsg', 'Successfully changed status of '. $user['username']);
            return redirect()->to('admin/users');
        }
    }
}