<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permissions extends Migration
{
	private $table = 'permissions';
	public function up() {
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
					'auto_increment' => true,
			],
			'perm_mod'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '10',
			],
			'desc'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable($this->table);

	}

	public function down() {
		$this->forge->dropTable('permissions');
	}
}
