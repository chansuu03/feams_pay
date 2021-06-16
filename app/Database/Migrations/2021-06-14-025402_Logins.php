<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logins extends Migration
{
        private $table = 'logins';
        public function up(){
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'user_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'role_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'login_date'       => [
                                'type'           => 'DATETIME',
                        ],
                ]);
                $this->forge->addKey('id', TRUE);
                $this->forge->createTable($this->table);
	}

	public function down() {
                $this->forge->dropTable('logins');
	}
}
