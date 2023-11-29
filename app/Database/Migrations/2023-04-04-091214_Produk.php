<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'harga_produk' => [
                'type' => 'INT',
            ],
            'stock_produk' => [
                'type' => 'INT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id_produk');
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
