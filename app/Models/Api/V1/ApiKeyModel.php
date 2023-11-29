<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class ApiKeyModel extends Model
{
    protected $table      = 'api_keys';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'key', 'level', 'limits', 'max_limits', 'last_access', 'is_active'];

    public function generateKey()
    {
        do {
            $salt = bin2hex(random_bytes(20));
            $key = substr($salt, 0, 16);
        } while ($this->where('key', $key)->first() !== null);

        return $key;
    }

    public function insertApiKey($user_id, $level = 3, $limits = 0)
    {
        $data = [
            'user_id' => $user_id,
            'key' => $this->generateKey(),
            'level' => $level,
            'limits' => $limits,
            'max_limits' => 200,
            'is_active' => 1
        ];

        $this->insert($data);

        return $data['key'];
    }

    public function isApiKeyValid($apiKey)
    {
        $apiKeys = $this->findAll();

        foreach ($apiKeys as $keys) {
            if ($keys->key === $apiKey) {
                return true;
            }
        }

        return false;
    }

    public function resetLimit()
    {
        $apiKeys = $this->findAll();

        foreach ($apiKeys as $apiKey) {
        $apiKey->limits = 0;
        $this->save($apiKey);
        }
    }

    // Fungsi untuk mendapatkan informasi API key dari database berdasarkan kunci
    public function getKeyInfo($apiKey)
    {
        return $this->where('key', $apiKey)->first();
    }

    public function getByUserId($user_id)
    {
        $apiKey = $this->where('user_id', $user_id)->first();
        return $apiKey;
    }

    // Fungsi untuk mengurangi jumlah akses API key yang tersisa
    public function decrementLimit($apiKey)
    {
        $this->set('limits', 'limits + 1', false)
             ->where('key', $apiKey)
             ->update();
    }
    public function lastAccess($apiKey, $date)
    {
        $this->set('last_access', $date)
             ->where('key', $apiKey)
             ->update();
    }
    public function get_level($key)
    {
        $query = $this->db->table('api_keys')->where('key', $key)->get();
        $result = $query->getRow();
        
        if ($result) {
            return $result->level;
        }
        
        return false;
    }
}