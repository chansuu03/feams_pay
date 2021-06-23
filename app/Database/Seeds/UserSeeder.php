<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$data = [
            [
                'last_name' => 'Lazaro',
                'first_name' => 'Christian',
                'username' => 'admin',
                'email' => 'ichanpotts@gmail.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'birthdate' => '1999-11-03',
                'contact_number' => (int)"09195252973",
                'gender' => 'Male',
                'profile_pic' => 'admin.jpg',
                'role' => 1,
                'status' => 'a',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'last_name' => 'Member',
                'first_name' => 'Member',
                'username' => 'member',
                'email' => 'wyvern.rhadamanthys11@gmail.com',
                'password' => password_hash('member', PASSWORD_DEFAULT),
                'birthdate' => '1999-11-03',
                'contact_number' => (int)"09195252973",
                'gender' => 'Female',
                'profile_pic' => 'member.png',
                'role' => 2,
                'status' => 'a',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];
		$this->db->table('users')->truncate();
		$this->db->table('users')->insertBatch($data);
	}
}
