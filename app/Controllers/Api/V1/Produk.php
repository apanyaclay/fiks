<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class Produk extends ResourceController
{
    protected $modelName = '\App\Models\Api\V1\ProdukModel';
    
    public function __construct()
    {
        $this->author = getenv('author');
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //menampilkan semua data produk
        return $this->respond([
            'status' => true,
            'author' => $this->author,
            'data' => $this->model->findAll()
        ], 200);
    }

    public function show($id_produk = null)
    {
        //menampilkan data pasien berdasarkan id
        if (!$this->model->find($id_produk)) {
            return $this->respond([
                'status' => false,
                'author' => $this->author,
                'message' => 'Data produk tidak ditemukan'
            ]);
        };
        return $this->respond([
            'status' => true,
            'author' => $this->author,
            'data' => $this->model->find($id_produk)
        ]);
    }

    public function create()
    {
        //menambahkan data pasien
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'kategori' => $this->request->getVar('kategori'),
            'harga_produk' => $this->request->getVar('harga_produk'),
            'stock_produk' => $this->request->getVar('stock_produk'),
        ];

        if ( $this->model->save($data) ){
            return $this->respond([
                'status' => true,
                'message' => 'Data produk berhasil disimpan'
            ], 200);
        }else {
            return $this->respond([
                'status' => false,
                'errors' => $this->model->errors()
            ], 422);
        }

    }

    public function update($id_produk = null)
    {
        //mengupdate data pasien
        if (!$this->model->find($id_produk)) {
            return $this->respond([
                'status' => false,
                'message' => 'Data produk tidak ditemukan'
            ]);
        };

        $data = [
            'id_produk' => $id_produk,
            'nama_produk' => $this->request->getVar('nama_produk'),
            'kategori' => $this->request->getVar('kategori'),
            'harga_produk' => $this->request->getVar('harga_produk'),
            'stock_produk' => $this->request->getVar('stock_produk'),
        ];

        if ( $this->model->update($id_produk, $data) ){
            return $this->respond([
                'status' => true,
                'message' => 'Data produk berhasil diupdate'
            ], 200);
        }else {
            return $this->respond([
                'status' => false,
                'errors' => $this->model->errors()
            ], 422);
        }
    }

    public function delete($id_produk = null)
    {
        //menghapus data pasien

        $this->model->delete($id_produk);
        return $this->respond([
            'status' => true,
            'message' => 'Data produk berhasil dihapus'
        ], 200);
    }
}
