<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalKuliah extends Migration
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
            'kode_mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'nama_mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'hari' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'jam_mulai' => [
                'type' => 'TIME',
            ],
            'jam_selesai' => [
                'type' => 'TIME',
            ],
            'pertemuan' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('jadwal_kuliah');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_kuliah');
    }
}
