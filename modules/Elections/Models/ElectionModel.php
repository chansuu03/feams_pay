<?php namespace Modules\Elections\Models;

use CodeIgniter\Model;

class ElectionModel extends Model {
    protected $table = 'elections';
    protected $primaryKey = 'id';
  
    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['title', 'description', 'start_date', 'end_date', 'status' ,'deleted_at'];
    protected $useSoftDeletes = true;
  
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function active() {
        $data = $this->where('status', 'a')->first();
        return $data['id'];
    }

    public function electionPositions($id) {
        $this->select('positions.id, positions.name, positions.max_candidate');
        $this->where(['positions.election_id' => $id, 'positions.deleted_at' => null]);
        $this->join('positions', 'positions.election_id = elections.id');
        return $this->get()->getResultArray();
    }

    public function electionCandidates($id) {
        $this->select('candidates.id, users.first_name, users.last_name, platform, photo, position_id, positions.name');
        $this->where(['candidates.election_id' => $id, 'candidates.deleted_at' => NULL]);
        $this->join('candidates', 'candidates.election_id = elections.id');
        $this->join('positions', 'candidates.position_id = positions.id');
        $this->join('users', 'candidates.user_id = users.id');
        return $this->get()->getResultArray();
    }
}