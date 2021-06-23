<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Votes extends Migration
{
	private $table = 'votes';
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
			'voters_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'date_casted' => [
				'type'           => 'DATETIME',
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable($this->table);
	}

	public function down() {
		$this->forge->dropTable('votes');
	}
}
