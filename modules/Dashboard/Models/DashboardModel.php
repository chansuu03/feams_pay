<?php 
namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function allUsers() {
        $db      = \Config\Database::connect();
        $table = $db->table('users');
        return $table->where('status', 'a')->countAllResults(false);
    }

    public function allFiles() {
        $db      = \Config\Database::connect();
        $table = $db->table('files');
        return $table->where('deleted_at', null)->countAllResults(false);
    }

    public function activeElection() {
        $db      = \Config\Database::connect();
        $table = $db->table('elections');
        $data['count'] = $table->where(['deleted_at' => null, 'status' => 'a'])->countAllResults(false);
        $data['list'] = $table->where(['deleted_at' => null, 'status' => 'a'])->get()->getResultArray();
        return $data;
    }

    public function discussions() {
        $db      = \Config\Database::connect();
        $table = $db->table('threads');
        return $table->where(['deleted_at' => null, 'status' => 'a', 'visibility' => '0'])->countAllResults(false);
    }

    public function fileCategories() {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT file_categories.name, count(1) as count FROM files JOIN file_categories ON file_categories.id = files.category_id GROUP BY category_id");
        return $query->getResult();
    }
}