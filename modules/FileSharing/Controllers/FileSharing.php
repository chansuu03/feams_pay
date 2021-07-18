<?php
namespace Modules\FileSharing\Controllers;

use App\Controllers\BaseController;
use Modules\FileSharing\Models as Models;

class FileSharing extends BaseController
{
    public function __construct() {
        $this->fileSharingModel = new Models\FileSharingModel();
    }
    
    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('', '', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        $data['files'] = $this->fileSharingModel->getUserUpload();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'files';
        $data['title'] = 'File Sharing';
        return view('Modules\FileSharing\Views\index', $data);
    }

    public function add() {
        // checking roles and permissions
        $data['perm_id'] = check_role('', '', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        $data['edit'] = false;

        if($this->request->getMethod() === 'post') {
            if($this->validate('files')){ 
                $file = $this->request->getFile('file');
                $userData['extension'] = $file->getClientExtension();
                $userData['file_name'] = $_POST['name'].'.'.$userData['extension'];
                $userData['size'] = $_FILES["file"]["size"]; 
                $userData['uploader'] = $this->session->get('user_id');
                if(isset($_POST['visibility'])) {
                    $userData['visibility'] = $_POST['visibility'];
                }
                $docs = ['docx', 'txt', 'pdf', 'xlsx', 'pptx', 'csv', 'ppt', 'xml'];
                $media = ['mp3', 'wav', 'm4a', 'mid', 'wma', '3gp', 'avi', 'flv', 'm4v', 'mov', 'mp4', 'mpg'];
                $images = ['bmp', 'gif', 'jpg', 'jpeg', 'png', 'psd', 'tiff', 'svg'];
                if (in_array($userData['extension'], $docs)) {
                    $userData['category'] = 'Documents';
                } elseif (in_array($userData['extension'], $media)) {
                    $userData['category'] = 'Media';
                } elseif (in_array($userData['extension'], $images)) {
                    $userData['category'] = 'Images';
                } else {
                    $userData['category'] = 'Others';
                }
                // echo '<pre>';
                // print_r($userData);
                // print_r($_FILES);
                // die();
                if(file_exists('uploads/files/'.$userData['category'].'/'.$userData['file_name'])) {
                  unlink('uploads/files/'.$userData['category'].'/'.$userData['file_name']);
                }
                $file->move('uploads/files/'.$userData['category'], $userData['file_name']);
                if ($file->hasMoved()) {
                    if($this->fileSharingModel->save($userData)) {
                        $this->session->setFlashData('successMsg', 'Adding file successful');
                    } else {
                        $this->session->setFlashData('failMsg', 'There is an error on adding file. Please try again.');
                    }
                    return redirect()->to(base_url('file_sharing'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on adding file. Please try again.');
                }
                // if($this->fileSharingModel->save($userData)) {
                //     if ($file->hasMoved()) {
                //         $this->session->setFlashData('successMsg', 'Adding file successful');
                //     } else {
                //         $this->session->setFlashData('failMsg', 'There is an error on adding file. Please try again.');
                //     }
                //     return redirect()->to(base_url('file_sharing'));
                // }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'files';
        $data['title'] = 'File';
        return view('Modules\FileSharing\Views\form', $data);
    }
}