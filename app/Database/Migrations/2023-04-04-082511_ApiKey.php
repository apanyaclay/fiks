<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiKey extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 15,
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'level' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'limits' => [
                'type' => 'TINYINT',
                'constraint' => 3,
                'default' => 0,
            ],
            'max_limits' => [
                'type' => 'TINYINT',
                'constraint' => 3,
            ],
            'last_access' => [
                'type' => 'DATETIME',
                'defaul' => null
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('api_keys');
    }

    public function down()
    {
        $this->forge->dropTable('api_keys');
    }
}
