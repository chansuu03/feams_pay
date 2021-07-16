<?php
namespace Modules\Dashboard\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use Modules\Dashboard\Models as Models;

class Dashboard extends BaseController
{
	function __construct() {
		$this->dashboardModel = new Models\DashboardModel();
	}
	
	public function index() {
        $data['perm_id'] = check_role('', '', $this->session->get('role'));
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        if($this->session->get('role') != '1') {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
		$data['userCount'] = $this->dashboardModel->allUsers();
		$data['fileCount'] = $this->dashboardModel->allFiles();
		$data['activeElections'] = $this->dashboardModel->activeElection();
		$data['discussions'] = $this->dashboardModel->discussions();
        $data['fileCategories'] = json_encode($this->dashboardModel->fileCategories());
        $data['fileCategories2'] = json_encode($this->dashboardModel->fileCategories2());
        // echo '<pre>';
        // print_r($data['activeElections']);
        // die();
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'dashboard';
        $data['title'] = 'Dashboard';
        return view('Modules\Dashboard\Views\index', $data);
	}
}