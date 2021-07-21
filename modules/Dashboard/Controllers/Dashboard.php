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
        // for file counts per category
        $data['fileCat'] = $this->dashboardModel->fileCategories();
        $data['fileCats'] = [];
        foreach($data['fileCat'] as $file) {
            $data['fileCats']['label'][] = $file['label'];
            $data['fileCats']['count'][] = $file['count'];
        }
        $data['fileCategories'] = json_encode($data['fileCats']);
        // overall file counts this month
        $data['files'] = $this->dashboardModel->fileCount();
        // logins count
        $data['logins'] = $this->dashboardModel->logins();
        // activity logs
        $data['activities'] = $this->dashboardModel->getActivity();


        // echo date('t').'<br>';
        $ctr = 0;
        // for($i = 1; $i <= date('t'); $i++) {
        //     echo $i.' ';
        //     if($data['logins'][$ctr]['login_day'] == $i) {
        //         echo $data['logins'][$ctr]['count'].'<br>';
        //         $ctr++;
        //     } else {
        //         echo '0 <br>';
        //         $ctr++;
        //     }
        // }
        // for($i = 1; $i <= date('t'); $i++) {
        //     echo $i.' ';
        //     foreach($data['logins'] as $login) {
        //         if((int)$login['login_day'] == $i) {
        //             echo $login['count'].'<br>';
        //         } else {
        //             echo '0 <br>';
        //         }
        //     }
        // }
        // echo '<pre>';
        // print_r($data['activities']);
        // die();
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'dashboard';
        $data['title'] = 'Dashboard';
        return view('Modules\Dashboard\Views\index', $data);
	}
}