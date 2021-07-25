<?php
namespace App\Controllers;

use App\Models as userModels;
use Modules\Announcements\Models as announceModels;
use Modules\Sliders\Models as sliderModels;
use Modules\Elections\Models as Election;

class Home extends BaseController
{
    public function __construct() {
        $this->userModel = new userModels\UserModel();
        $this->announceModel = new announceModels\AnnouncementModel();
        $this->sliderModel = new sliderModels\SliderModel();
        $this->electionModel = new Election\ElectionModel();

        foreach($this->electionModel->findAll() as $election) {
            if($election['status'] == 'Application') {
                if(strtotime($election['vote_start']) <= strtotime(date('Y-m-d'))) {
                    $data = [
                        'id' => $election['id'],
                        'status' => 'Voting'
                    ];
                    if($this->electionModel->save($data)) {
                        // echo $election['title'].' starts now';
                    } else {
                        // echo $election['title'].' has an error starting';
                    }
                }
            } elseif($election['status'] == 'Voting') {
                if(strtotime($election['vote_end']) <= strtotime(date('Y-m-d'))) {
                    $data = [
                        'id' => $election['id'],
                        'status' => 'Finished'
                    ];
                    if($this->electionModel->save($data)) {
                        // echo $election['title'].' end now';
                    } else {
                        // echo $election['title'].' has an error starting';
                    }
                }
            }
        }
    }

	public function index() {
		$data['user'] = $this->userModel->forProfile($this->session->get('user_id'));
		$data['announces'] = $this->announceModel->findAll();
		$data['sliders'] = $this->sliderModel->findAll();
		return view('home2', $data);
	}
}
