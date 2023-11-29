<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class Quote extends ResourceController
{
    protected $modelName = '\App\Models\Api\V1\QuoteModel';
    
    public function __construct()
    {
        $this->author = getenv('author');
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function random()
    {
        $data = $this->model->getRandomDataByID();
        $result = $data->text;
        return $this->respond([
            'status' => true,
            'author' => $this->author,
            'result' => [
                'quote' => $result,
                'by' => $data->author,
            ],
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->model->getRandomDataByID($id);
        if (!$this->model->find($data)) {
            return $this->respond([
                'status' => false,
                'author' => $this->author,
                'message' => 'Data Quote tidak ditemukan'
            ]);
        };
        return $this->respond([
            'status' => true,
            'author' => $this->author,
            'data' => $this->model->find($data)
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
