<?php
namespace Modules\Elections\Controllers;

use App\Controllers\BaseController;
use Modules\Elections\Models as Models;

class Positions2 extends BaseController
{
    public function __construct() {
        $this->electionModel = new Models\ElectionModel();
        $this->positionModel = new Models\PositionModel();
    }

    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('23', 'POS', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        $data['elections'] = $this->electionModel->where('status', 'Application')->findAll();
        if(empty($data['elections'])) {
            $this->session->setFlashdata('activeElec', 'No elections set, please add elections first');
            return redirect()->to(base_url('admin/elections'));
        }
        $data['firstActiveElec'] = $this->electionModel->where('status', 'Application')->first();
        $data['positions'] = $this->positionModel->where(['election_id' => $data['firstActiveElec']['id']])->findAll();
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'positions';
        $data['title'] = 'Positions';
        return view('Modules\Elections\Views\positions\index2', $data);
    }
    
    public function other($elecID) { 
        // checking roles and permissions
        $data['perm_id'] = check_role('23', 'POS', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        
        $data['elections'] = $this->electionModel->where('status', 'Application')->findAll();
        $data['positions'] = $this->positionModel->where(['election_id' => $elecID])->findAll();

        return view('Modules\Elections\Views\positions\table', $data);
    }

    public function add() {
        // checking roles and permissions
        $data['perm_id'] = check_role('24', 'POS', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        $data['edit'] = false;
        $data['elections'] = $this->electionModel->where(['status' => 'Application'])->findAll();
        if($this->request->getMethod() == 'post') {
            if($this->validate('positions')){
                if($this->positionModel->save($_POST)) {
                    $this->session->setFlashdata('successMsg', 'Successfully added an position');
                    return redirect()->to(base_url('admin/positions'));
                } else {
                    $this->session->setFlashdata('failMsg', 'Failed to add an position');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'positions';
        $data['title'] = 'Positions';
        return view('Modules\Elections\Views\positions\form2', $data);
    }
}