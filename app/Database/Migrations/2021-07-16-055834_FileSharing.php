<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FileSharing extends Migration
{
	private $table = 'file_sharing';
	public function up() {
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'file_name'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 150,
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
				'comment'        => 'user id of the uploader',
			],
			'category' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50,
				'comment'        => 'file category',
			],
			'visibility' => [
				'type'           => 'ENUM',
                'constraint'     => ['for all', 'admin'],
				'comment'        => 'visibility of the file',
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
		$this->forge->dropTable('file_sharing');
	}
}
