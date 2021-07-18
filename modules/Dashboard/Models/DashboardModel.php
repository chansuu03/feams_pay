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
        $table = $db->table('file_sharing');
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
        $query = $db->query("SELECT category as label, count(*) as count from file_sharing group by category");
        return $query->getResultArray();
    }

    public function fileCount() {
        $db      = \Config\Database::connect();
        $str = "SELECT 
        SUM(MONTH(uploaded_at) = '1') AS 'Jan',
        SUM(MONTH(uploaded_at) = '2') AS 'Feb',
        SUM(MONTH(uploaded_at) = '3') AS 'Mar',
        SUM(MONTH(uploaded_at) = '4') AS 'Apr',
        SUM(MONTH(uploaded_at) = '5') AS 'May',
        SUM(MONTH(uploaded_at) = '6') AS 'Jun',
        SUM(MONTH(uploaded_at) = '7') AS 'Jul',
        SUM(MONTH(uploaded_at) = '8') AS 'Aug',
        SUM(MONTH(uploaded_at) = '9') AS 'Sep',
        SUM(MONTH(uploaded_at) = '10') AS 'Oct',
        SUM(MONTH(uploaded_at) = '11') AS 'Nov',
        SUM(MONTH(uploaded_at) = '12') AS 'Dec',
        SUM(YEAR(uploaded_at) = YEAR(CURDATE())) AS 'total',
        YEAR(CURDATE()) AS currentyear FROM file_sharing WHERE YEAR(uploaded_at) = YEAR(CURDATE()) AND deleted_at is NULL";
        $query = $db->query($str);
        return $query->getResultArray();
    }
}