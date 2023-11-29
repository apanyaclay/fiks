<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class JadwalKuliahModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jadwal_kuliah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_mata_kuliah', 'nama_mata_kuliah', 'tanggal','hari', 'jam_mulai', 'jam_selesai', 'pertemuan'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'kode_mata_kuliah' => [
            'label' => 'Kode Mata Kuliah',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'nama_mata_kuliah' => [
            'label' => 'Nama Mata Kuliah',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'tanggal' => [
            'label' => 'Tanggal',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'hari' => [
            'label' => 'Hari',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'jam_mulai' => [
            'label' => 'Jam Mulai',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'jam_selesai' => [
            'label' => 'Jam Selesai',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'pertemuan' => [
            'label' => 'Pertemuan',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getOrdersByDate($date) 
    {
        $builder = $this->db->table('jadwal_kuliah');
        $builder->where('tanggal', $date);
        $query = $builder->get();
        return $query->getResult();
    }


}