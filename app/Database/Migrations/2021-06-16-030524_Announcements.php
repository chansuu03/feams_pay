<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Announcements extends Migration
{
	private $table = 'announcements';
	public function up() {
		$this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'title' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 100,
                        ],
                        'description' => [
                                'type'           => 'TEXT',
                        ],
                        'image' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 100,
                        ],
                        'uploader' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'link' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 10,
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
		$this->forge->addPrimaryKey('id',TRUE);
		$this->forge->createTable($this->table);
	}

	public function down() {
		$this->forge->dropTable('announcements');
	}
}
