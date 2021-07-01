<?php
namespace App\Controllers;

use App\Models as userModels;
use Modules\Announcements\Models as announceModels;
use Modules\Sliders\Models as sliderModels;

class Home extends BaseController
{
    public function __construct() {
        $this->userModel = new userModels\UserModel();
        $this->announceModel = new announceModels\AnnouncementModel();
        $this->sliderModel = new sliderModels\SliderModel();
    }

	public function index() {
		$data['user'] = $this->userModel->forProfile($this->session->get('user_id'));
		$data['announces'] = $this->announceModel->findAll();
		$data['sliders'] = $this->sliderModel->findAll();
		return view('home2', $data);
	}
}
