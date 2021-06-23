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
}