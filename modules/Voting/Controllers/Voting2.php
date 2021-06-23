<?php
namespace Modules\Voting\Controllers;

use App\Controllers\BaseController;
use Modules\Voting\Models as Models;
use Modules\Elections\Models as Election;

class Voting extends BaseController
{
    public function __construct() {
        $this->electionModel = new Election\ElectionModel();
        $this->positionModel = new Election\PositionModel();
        $this->candidateModel = new Election\CandidateModel();
        $this->voteModel = new Models\VotingModel();
    }
    
    public function index() {
        $data['elecID'] = $this->electionModel->active();
        if(empty($data['elecID'])) {
            $this->session->setFlashdata('failMsg', 'There is no election right now.');
            return redirect()->to(base_url('admin/elections'));
        }
        if($this->voteModel->findUser($this->session->get('user_id'), $data['elecID'])) {
            $this->session->setFlashdata('failMsg', 'You have voted, please wait for the results.');
            $data['voted'] = true;
        }
        
        $data['positions'] = $this->positionModel->findAll();
        if($this->request->getMethod() == 'post') {
            // echo '<pre>';
            // print_r($_POST);
            // die();
            foreach($data['positions'] as $position) {
                if($this->request->getVar($position['id']) != 0) {
                    $voteData = [
                        'election_id' => $this->request->getVar('election_id'),
                        'position_id' => $position['id'],
                        'candidate_id' => $this->request->getVar($position['id']),
                        'voters_id' => $this->session->get('user_id'),
                    ];
                } else {
                    $voteData = [
                        'election_id' => $this->request->getVar('election_id'),
                        'position_id' => $position['id'],
                        'voters_id' => $this->session->get('user_id'),
                    ];
                }
                if($this->voteModel->save($voteData)) {
                    $this->session->setFlashdata('successMsg', 'Vote casted.');
                    return redirect()->to(base_url('admin/elections'));
                } else {
                    $this->session->setFlashdata('failMsg', 'Vote not casted, please try again.');
                    return redirect()->to(base_url('admin/elections'));
                }
            }
        }
        $data['candidates'] = $this->candidateModel->view($data['elecID']);
        $data['logged_in']['role'] = 1;
        $data['active'] = 'elections';
        return view('Modules\Voting\Views\index', $data);
    }
}
