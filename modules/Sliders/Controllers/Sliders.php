<?php
namespace Modules\Sliders\Controllers;

use App\Controllers\BaseController;
use Modules\Sliders\Models as Models;

class Sliders extends BaseController
{
    public function __construct() {
        $this->sliderModel = new Models\SliderModel();
    }

    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('15', 'SLID', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        $data['sliders'] = $this->sliderModel->viewUploader();
        // echo '<pre>';
        // print_r($data['announcements']);
        // die();
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'sliders';
        $data['title'] = 'Sliders';
        return view('Modules\Sliders\Views\index', $data);
    }

    public function add() {
        // checking roles and permissions
        $data['perm_id'] = check_role('16', 'SLID', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        helper('text');
        $data['edit'] = false;
        if($this->request->getMethod() == 'post') {
            if($this->validate('sliders')){
                $file = $this->request->getFile('image');
                $slider = $_POST;
                $slider['image'] = $file->getRandomName();
                $slider['uploader'] = $this->session->get('user_id');
                if($this->sliderModel->insert($slider)) {
                    $file->move('uploads/sliders', $slider['image']);
                    if ($file->hasMoved()) {
                        $this->session->setFlashData('successMsg', 'Adding slider successful');
                    } else {
                        $this->session->setFlashData('failMsg', 'There is an error on adding slider. Please try again.');
                    }
                    return redirect()->to(base_url('admin/sliders'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on adding slider. Please try again.');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'sliders';
        $data['title'] = 'Sliders';
        return view('Modules\Sliders\Views\form', $data);
    }

    public function edit($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('17', 'SLID', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        helper('text');
        $data['edit'] = true;
        $data['value'] = $this->sliderModel->where('id', $id)->first();
        $data['id'] = $data['value']['id'];
        if($this->request->getMethod() == 'post') {
            if($this->validate('announcements')){
                $file = $this->request->getFile('image');
                $slider = $_POST;
                $slider['image'] = $file->getRandomName();
                $slider['uploader'] = $this->session->get('user_id');
                if($this->sliderModel->update($data['id'], $slider)) {
                    $file->move('uploads/sliders', $slider['image']);
                    if ($file->hasMoved()) {
                        $this->session->setFlashData('successMsg', 'Editing slider successful.');
                    } else {
                        $this->session->setFlashData('failMsg', 'There is an error on editing slider. Please try again.');
                    }
                    return redirect()->to(base_url('admin/sliders'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on editing slider. Please try again.');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'sliders';
        $data['title'] = 'Sliders';
        return view('Modules\Sliders\Views\form', $data);
    }

    public function delete($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('18', 'SLID', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        if($this->sliderModel->where('id', $id)->delete()) {
          $this->session->setFlashData('successMsg', 'Successfully deleted announcement');
        } else {
          $this->session->setFlashData('errorMsg', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/sliders'));
    }
}