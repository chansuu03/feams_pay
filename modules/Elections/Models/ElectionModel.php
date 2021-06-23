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
}