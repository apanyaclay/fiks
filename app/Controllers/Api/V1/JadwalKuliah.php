<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class JadwalKuliah extends ResourceController
{
    protected $modelName = '\App\Models\Api\V1\JadwalKuliahModel';

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
        //menampilkan semua data jadwal
        return $this->respond([
            'status' => true,
            'author' => $this->author,
            'data' => $this->model->findAll()
        ], 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($kode_mata_kuliah = null)
    {
        //menampilkan data pasien berdasarkan id
        if (!$this->model->find($kode_mata_kuliah)) {
            return $this->respond([
                'status' => false,
                'author' => $this->author,
                'message' => 'Data jadwal kuliah tidak ditemukan'
            ]);
        };
        return $this->respond([
            'status' => true,
            'author' => $this->author,
            'data' => $this->model->find($kode_mata_kuliah)
        ]);
    }
    public function getDataByDate()
    {
        $tanggal = $this->request->getGet('tanggal');
        // melakukan validasi pada $tanggal
        $tgl = date('Y-m-d', strtotime($tanggal));
        $data = $this->model->getOrdersByDate($tgl);
        if (empty($data)) {
            return $this->respond([
                'status' => false,
                'author' => $this->author,
                'message' => "Jadwal kuliah tanggal $tanggal tidak ada",
            ]);
        }
        return $this->respond([
                'status' => true,
                'author' => $this->author,
                'data' => $data]);
    
    }




    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    // public function new()
    // {
    //     //
    // }

    // /**
    //  * Create a new resource object, from "posted" parameters
    //  *
    //  * @return mixed
    //  */
    public function create()
    {
        $data = [
            'kode_mata_kuliah' => $this->request->getVar('kode_mata_kuliah'),
            'nama_mata_kuliah' => $this->request->getVar('nama_mata_kuliah'),
            'tanggal' => $this->request->getVar('tanggal'),
            'hari' => $this->request->getVar('hari'),
            'jam_mulai' => $this->request->getVar('jam_mulai'),
            'jam_selesai' => $this->request->getVar('jam_selesai'),
            'pertemuan' => $this->request->getVar('pertemuan'),
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

    // /**
    //  * Return the editable properties of a resource object
    //  *
    //  * @return mixed
    //  */
    // public function edit($id = null)
    // {
    //     //
    // }

    // /**
    //  * Add or update a model resource, from "posted" properties
    //  *
    //  * @return mixed
    //  */
    // public function update($id = null)
    // {
    //     //
    // }

    // /**
    //  * Delete the designated resource object from the model
    //  *
    //  * @return mixed
    //  */
    // public function delete($id = null)
    // {
    //     //
    // }
}
