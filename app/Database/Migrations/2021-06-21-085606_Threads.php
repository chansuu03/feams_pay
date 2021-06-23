<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Threads extends Migration
{
	private $table = 'threads';
	public function up() {
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'subject' => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
			'creator' => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'visibility' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'comment'     	 => '0 for all and other numbers will be the role',
			],
			'link' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'status' => [
				'type'           => 'CHAR',
				'constraint'     => 1,
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
		$this->forge->dropTable('threads');
	}
}
