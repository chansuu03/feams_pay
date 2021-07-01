<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Positions extends Migration
{
	private $table = 'positions';
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
			'name'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
			'vote_count'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'default'        => null,
			],
			'max_candidate'          => [
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
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable($this->table);
	}

	public function down() {
		$this->forge->dropTable('positions');
	}
}
