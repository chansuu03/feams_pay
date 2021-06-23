<?php
namespace Modules\Discussions\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use Modules\Discussions\Models as Models;
use App\Models\UserModel;

class Comments2 extends BaseController
{
    function __construct() {
        $this->session = session();
        $this->threadModel = new Models\ThreadModel();
        $this->userModel = new UserModel();
        $this->commentModel = new Models\CommentModel();
    }

    public function index($thread) { 
        // checking roles and permissions
        $data['perm_id'] = check_role('', '', $this->session->get('role'));
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        $threadData = $this->threadModel->where('link', $thread)->first();
        if($threadData['visibility'] != 0 && $threadData['visibility'] != $this->session->get('role')) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        if(empty($threadData)) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }

        if($this->request->getMethod() == 'post') {
            $comment = $_POST;
            $comment['user_id'] = $this->session->get('user_id');
            $comment['thread_id'] = $threadData['id'];
            $comment['comment_date'] = date('Y-m-d H:i:s');
            
            if($this->validate('comment')) {
                if($this->commentModel->save($comment)) {
                    return redirect()->back();
                }
                else {
                    $this->session->setFlashdata('failMsg', 'Failed to add comment, please try again');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['comments'] = $this->commentModel->viewComment($threadData['id']);
        $data['threadData'] = $threadData;

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'discussions';
        $data['title'] = 'Discussions';
        return view('Modules\Discussions\Views\thread2', $data);
    }

    public function delete($link, $id) {
        $data['comment'] = $this->commentModel->where(['id' => $id])->first();
        // echo '<pre>';
        // print_r($data['comment']);
        // die();
        // checking roles and permissions
        $data['perm_id'] = check_role('35', 'COMM', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            if($data['comment']['user_id'] != $this->session->get('user_id')) {
                $this->session->setFlashdata('sweetalertfail', true);
                return redirect()->to(base_url());
            } else {
                $this->deleteModel($link, $id);
                return redirect()->to(base_url('discussions'));
            }
        }
        $this->deleteModel($link, $id);
        return redirect()->to(base_url('discussions'));
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
    }

    private function deleteModel($link, $id) {
        $data = [
            'id' => $id,
            'deleted_by' => $this->session->get('user_id'),
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        if($this->commentModel->save($data)) {
            $this->session->setFlashdata('successMsg', 'Comment deleted successfully');
            return redirect()->to(base_url('discussions'));
        } else {
            $this->session->setFlashdata('failMsg', 'Failed to delete comment');
            return redirect()->to(base_url('discussions'));
        }
    }
}