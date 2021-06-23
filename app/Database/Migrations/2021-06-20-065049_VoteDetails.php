<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VoteDetails extends Migration
{
	private $table = 'vote_details';
	public function up() {
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'votes_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'position_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'candidate_id' => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable($this->table);
	}

	public function down() {
		$this->forge->dropTable('vote_details');
	}
}
