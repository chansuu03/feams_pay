<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
	private $table = 'payments';
	public function up() {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
            'user_id' => [
                'type'           => 'INT',
				'constraint'     => 11,
            ],
            'photo' => [
                'type'           => 'VARCHAR',
                'constraint'     => 150,
            ],
            'contri_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'amount' => [
                'type'           => 'DOUBLE',
            ],
            'added_by' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'comment'        => 'User that added the transaction',
            ],
            'is_approved' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'comment'        => 'Is the transaction approved',
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
		$this->forge->dropTable('payments');
	}
}
