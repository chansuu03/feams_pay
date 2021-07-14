<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Candidates extends Migration
{
	private $table = 'candidates';
	public function up() {
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'election_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'position_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'user_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'photo'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 60,
				'null'           => true,
				'default'        => null,
			],
			'platform'          => [
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
		$this->forge->dropTable('candidates');
	}
}
