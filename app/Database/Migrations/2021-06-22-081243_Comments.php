<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Comments extends Migration
{
	private $table = 'comments';
	public function up() {
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'user_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'thread_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'comment'          => [
				'type'           => 'TEXT',
			],
			'deleted_by'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'default'        => null,
			],
			'comment_date' => [
				'type'           => 'DATETIME',
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
		$this->forge->dropTable('comments');
	}
}
