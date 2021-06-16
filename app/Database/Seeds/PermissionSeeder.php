<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
	public function run() {
		$data = [
            [
                'perm_mod' => 'USR',
                'desc' => 'View Users'
            ],
            [
                'perm_mod' => 'USR',
                'desc' => 'Delete Users'
            ],
            [
                'perm_mod' => 'USR',
                'desc' => 'Change User Status'
            ],
            [
                'perm_mod' => 'ROLE',
                'desc' => 'Add role'
            ],
            [
                'perm_mod' => 'ROLE',
                'desc' => 'Edit role'
            ],
            [
                'perm_mod' => 'ROLE',
                'desc' => 'Delete role'
            ],
            [
                'perm_mod' => 'ROLE',
                'desc' => 'View roles'
            ],
            [
                'perm_mod' => 'PERM',
                'desc' => 'View permissions'
            ],
            [
                'perm_mod' => 'PERM',
                'desc' => 'Edit permissions'
            ],
            [
                'perm_mod' => 'ANN',
                'desc' => 'View announcements'
            ],
            [
                'perm_mod' => 'ANN',
                'desc' => 'Add announcements'
            ],
            [
                'perm_mod' => 'ANN',
                'desc' => 'Edit announcements'
            ],
            [
                'perm_mod' => 'ANN',
                'desc' => 'Delete announcements'
            ],
        ];
		$this->db->table('permissions')->insertBatch($data);
	}
}
