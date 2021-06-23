<?php
namespace Modules\Reports\Controllers;

use App\Controllers\BaseController;
use App\Models as Models;
use App\Libraries as Libraries;

class LoginReport extends BaseController
{
    public function __construct() {
        $this->loginModel = new Models\LoginModel();
        $this->pdf = new Libraries\Pdf();
    }

    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('8', 'PERM', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        if($this->request->getMethod() == 'post') {
            $this->generatePDF();
        }
        $data['logins'] = $this->loginModel->withRole();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'reports';
        $data['title'] = 'Login Reports';
        return view('Modules\Reports\Views\login\index', $data);
    }

    public function generatePDF() {
		$this->pdf->AliasNbPages();
		$details = $this->loginModel->withRole();
		
		$this->pdf->AddPage('l', 'Legal');
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(70,10,'Login Reports');
		$this->pdf->Ln();

		$this->pdf->SetFont('Arial', 'B' ,8);
		$this->pdf->SetX(55);
		$this->pdf->Cell(50,10,'First Name',1);
		$this->pdf->Cell(50,10,'Last Name',1);
		$this->pdf->Cell(50,10,'Username',1);
		$this->pdf->Cell(30,10,'Role',1);
		$this->pdf->Cell(60,10,'Login Date',1);
		$this->pdf->Ln();
		foreach($details as $detail) {
			$this->pdf->SetX(55);
			$this->pdf->SetFont('Arial', '' ,8);
			$date = date_create($detail['login_date']);
			$datelogged = date_format($date, 'F d, Y H:i:s');

			$this->pdf->Cell(50,8,$detail['first_name'],1);
			$this->pdf->Cell(50,8,$detail['last_name'],1);
			$this->pdf->Cell(50,8,$detail['username'],1);
			$this->pdf->Cell(30,8,$detail['role_name'],1);
			$this->pdf->Cell(60,8,$datelogged,1);
			$this->pdf->Ln();
		}
		$date = date('F d,Y', time());
        $this->response->setHeader('Content-Type', 'application/pdf');
		$this->pdf->Output('D', 'Login Report ['.$date.'].pdf'); 
    }
}