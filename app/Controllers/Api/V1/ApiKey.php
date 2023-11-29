<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;
use App\Models\Api\V1\ApiKeyModel;

class ApiKey extends BaseController
{
    public function generateApiKey()
    {
        $user_id = session()->get('user_id');
        $apiKeyModel = new ApiKeyModel();
        $apiKey = $apiKeyModel->insertApiKey($user_id);

        return $this->response->setJSON([
            'user_id' => $user_id,
            'apikey' => $apiKey
        ]);
    }

    public function index()
    {
        $user_id = session()->get('user_id');
        $apiKeyModel = new ApiKeyModel();
        $apikey = $apiKeyModel->getByUserId($user_id);

        $data = $apikey->key;

        echo "Api key : {$data}";
        echo "user_id : {$user_id}";
    }
}
