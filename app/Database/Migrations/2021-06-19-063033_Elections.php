<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Elections extends Migration
{
	private $table = 'elections';
	public function up() {
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'title'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 50,
			],
			'vote_start'          => [
				'type'           => 'DATE',
			],
			'vote_end'          => [
				'type'           => 'DATE',
			],
			'status'          => [
				'type'           => 'ENUM',
                'constraint'     => ['Application', 'Voting', 'Finished'],
                'default'        => 'Application',
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
		$this->forge->dropTable('elections');
	}
}
