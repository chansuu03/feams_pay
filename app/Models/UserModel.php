<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
  protected $table = 'users';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;

  protected $allowedFields = [
      'username',
      'password',
      'role',
      'profile_pic',
      'last_name',
      'first_name',
      'middle_name',
      'gender',
      'birthdate',
      'contact_number',
      'email',
      'status',
      'email_code',
      'created_at'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  public function forProfile($user_id) {
    $this->select('username, profile_pic, last_name, first_name, middle_name, gender, birthdate, contact_number, email');
    $this->where('id', $user_id);
    return $this->get()->getFirstRow('array');
  }
}