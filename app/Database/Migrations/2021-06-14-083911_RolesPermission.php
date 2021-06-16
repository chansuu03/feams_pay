<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesPermission extends Migration
{
	private $table = 'role_permissions';
	public function up(){
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
                    'auto_increment' => true,
			],
			'role_id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
			],
			'perm_mod'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 10,
			],
			'perm_id' => [
					'type'           => 'INT',
					'constraint'     => 11,
			],
            'created_at' => [
                    'type'           => 'DATETIME',
            ],
            'updated_at' => [
                    'type'           => 'DATETIME',
                    'null'           => true,
                    'default'        => null,
            ],
            'deleted_at' => [
                    'type'           => 'DATETIME',
                    'null'           => true,
                    'default'        => null,
            ]
		]);
		$this->forge->addPrimaryKey('id',TRUE);
		$this->forge->createTable($this->table);
	}

	public function down() {
		$this->forge->dropTable('role_permissions');
	}
}
