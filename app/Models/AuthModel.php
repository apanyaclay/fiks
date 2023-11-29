<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    // protected $DBGroup          = 'default';
    // protected $table            = 'users';
    // protected $primaryKey       = 'user_id';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    // protected $allowedFields    = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
    public function save_register($data)
    {
        $this->db->table('users')->insert($data);
    }

    public function login($email, $password)
    {
        return $this->db->table('users')->where([
            'email' => $email,
            'password' => $password,
        ])->get()->getRowArray();
    }
}
