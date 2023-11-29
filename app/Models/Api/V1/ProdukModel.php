<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_produk', 'kategori', 'harga_produk', 'stock_produk'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_produk' => [
            'label' => 'Nama Produk',
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama produk harus diisi'
            ]
        ],
        'kategori' => [
            'label' => 'Kategori Produk',
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori Produk harus diisi'
            ]
        ],
        'harga_produk' => [
            'label' => 'Harga Produk',
            'rules' => 'required',
            'errors' => [
                'required' => 'Harga Produk harus diisi'
            ]
        ],
        'stock_produk' => [
            'label' => 'Stock Produk',
            'rules' => 'required',
            'errors' => [
                'required' => 'Stock Produk harus diisi'
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
}
