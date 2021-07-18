<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Constitutions extends Migration
{
	private $table = 'constitutions';
	public function up() {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'area'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 150,
			],
			'content'          => [
				'type'           => 'TEXT',
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
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable($this->table);
	}

	public function down() {
		$this->forge->dropTable('constitutions');
	}
}
