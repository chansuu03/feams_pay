<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
	public function run()
	{
		$data = [
            [
                'role_name' => 'Administrator',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'role_name' => 'Member',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];
		$this->db->table('roles')->truncate();
		$this->db->table('roles')->insertBatch($data);
	}
}
