<?php
namespace Modules\FileSharing\Models;

use CodeIgniter\Model;

class FileSharingModel extends Model
{
    protected $table      = 'file_sharing';
    protected $primaryKey = 'id';
  
    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['file_name', 'size', 'extension', 'uploader', 'category' ,'visibility' ,'deleted_at'];
    protected $useSoftDeletes = true;
  
    protected $useTimestamps = true;
    protected $createdField  = 'uploaded_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    public function getUserUpload() {
        $this->select('file_sharing.*, users. first_name, users.last_name');
        $this->where('file_sharing.deleted_at', NULL);
        $this->join('users', 'users.id = file_sharing.uploader', 'left');
        return $this->get()->getResultArray();
    }
}