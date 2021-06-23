<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Files extends Migration
{
	private $table = 'files';
	public function up() {
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'name'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
			'size'          => [
				'type'           => 'INT',
				'constraint'     => 25,
			],
			'extension' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'uploader' => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'category_id' => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'uploaded_at' => [
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
		$this->forge->dropTable('files');
	}
}
