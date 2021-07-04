<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
	public function run() {
		$data = [
              [
                'role_id' => '1',
                'perm_mod' => 'USR',
                'perm_id' => '1'
              ],
              [
                'role_id' => '1',
                'perm_mod' => 'USR',
                'perm_id' => '2'
              ],
              [
                'role_id' => '1',
                'perm_mod' => 'USR',
                'perm_id' => '3'
              ],
              [
                'role_id' => '1',
                'perm_mod' => 'USR',
                'perm_id' => '4'
              ],
              [
                'role_id' => '1',
                'perm_mod' => 'ROLE',
                'perm_id' => '5'
              ],
              [
                'role_id' => '1',
                'perm_mod' => 'ROLE',
                'perm_id' => '6'
              ],
              [
                'role_id' => '1',
                'perm_mod' => 'ROLE',
                'perm_id' => '7'
              ],
              [
                'role_id' => '1',
                'perm_mod' => 'ROLE',
                'perm_id' => '8'
              ],
              [
                'perm_mod' => 'PERM',
                'role_id' => '1',
                'perm_id' => '9'
              ],
              [
                'perm_mod' => 'PERM',
                'role_id' => '1',
                'perm_id' => '10'
              ],
              [
                'perm_mod' => 'ANN',
                'role_id' => '1',
                'perm_id' => '11'
              ],
              [
                'perm_mod' => 'ANN',
                'role_id' => '1',
                'perm_id' => '12'
              ],
              [
                'perm_mod' => 'ANN',
                'role_id' => '1',
                'perm_id' => '13'
              ],
              [
                'perm_mod' => 'ANN',
                'role_id' => '1',
                'perm_id' => '14'
              ],
              [
                'perm_mod' => 'SLID',
                'role_id' => '1',
                'perm_id' => '15'
              ],
              [
                'perm_mod' => 'SLID',
				        'role_id' => '1',
				        'perm_id' => '16'
              ],
              [
                'perm_mod' => 'SLID',
				        'role_id' => '1',
				        'perm_id' => '17'
              ],
              [
                'perm_mod' => 'SLID',
                'role_id' => '1',
                'perm_id' => '18'
              ],
              [
                'perm_mod' => 'ELEC',
                'role_id' => '1',
                'perm_id' => '19'
            ],
            [
                'perm_mod' => 'ELEC',
				'role_id' => '1',
				'perm_id' => '20'
            ],
            [
                'perm_mod' => 'ELEC',
				'role_id' => '1',
				'perm_id' => '21'
            ],
            [
                'perm_mod' => 'ELEC',
				'role_id' => '1',
				'perm_id' => '22'
            ],
            [
                'perm_mod' => 'POS',
				'role_id' => '1',
				'perm_id' => '23'
            ],
            [
                'perm_mod' => 'POS',
				'role_id' => '1',
				'perm_id' => '24'
            ],
            [
                'perm_mod' => 'POS',
				'role_id' => '1',
				'perm_id' => '25'
            ],
            [
                'perm_mod' => 'POS',
				'role_id' => '1',
				'perm_id' => '26'
            ],
            [
                'perm_mod' => 'CAN',
				'role_id' => '1',
				'perm_id' => '27'
            ],
            [
                'perm_mod' => 'CAN',
				'role_id' => '1',
				'perm_id' => '28'
            ],
            [
                'perm_mod' => 'CAN',
				'role_id' => '1',
				'perm_id' => '29'
            ],
            [
                'perm_mod' => 'CAN',
				'role_id' => '1',
				'perm_id' => '30'
            ],
            [
                'perm_mod' => 'FILES',
				'role_id' => '1',
				'perm_id' => '31'
            ],
            [
                'perm_mod' => 'FILES',
				'role_id' => '1',
				'perm_id' => '32'
            ],
            [
                'perm_mod' => 'FICAT',
				'role_id' => '1',
				'perm_id' => '33'
            ],
            [
                'perm_mod' => 'FICAT',
				'role_id' => '1',
				'perm_id' => '34'
            ],
            [
                'perm_mod' => 'DISC',
				'role_id' => '1',
				'perm_id' => '35'
            ],
            [
                'perm_mod' => 'COMM',
				'role_id' => '1',
				'perm_id' => '36'
            ],
            [
                'perm_mod' => 'REPO',
				'role_id' => '1',
				'perm_id' => '37'
            ],
            [
                'perm_mod' => 'USR',
				'role_id' => '1',
				'perm_id' => '38'
            ],
        ];
		$this->db->table('role_permissions')->truncate();
		$this->db->table('role_permissions')->insertBatch($data);
	}
}
