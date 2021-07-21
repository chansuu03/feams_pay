<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActivityLog extends Migration
{
	private $table = 'activity_log';
	public function up() {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'user'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'description'          => [
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
		$this->forge->dropTable('activity_log');
	}
}
