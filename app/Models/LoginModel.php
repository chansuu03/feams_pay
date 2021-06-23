<?php
namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'logins';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'role_id', 'login_date'];

    public function withRole() {
        $this->select('users.first_name, users.last_name, users.username, roles.role_name, login_date');
        $this->join('users', 'users.id = logins.user_id');
        $this->join('roles', 'roles.id = logins.role_id');
        return $this->get()->getResultArray();
    }
}