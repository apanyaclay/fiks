<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Api\V1\ApiKeyModel;

class ApiKeyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $apiKeyModel = new ApiKeyModel();
        

        // Ambil nilai apikey dari parameter
        $apiKey = $request->getGet('apikey');

        // Cek apakah apikey kosong atau tidak ada
        if (!$apiKey) {
            $response = service('response');
            return $response->setStatusCode(401)
                            // ->setBody('Unauthorized');
                            ->setJSON([
                                'status' => false,
                                'message' => 'Unauthorized'
                            ]);
        }
        if (!$apiKeyModel->isApiKeyValid($apiKey)) {
           $response = service('response');
            return $response->setStatusCode(401)
                            // ->setBody('Unauthorized');
                            ->setJSON([
                                'status' => false,
                                'message' => 'Api Key salah'
                            ]);
        }

        $keyInfo = $apiKeyModel->getKeyInfo($apiKey);
        if (!$keyInfo->is_active == 1) {
            $response = service('response');
            return $response->setStatusCode(429)
                            // ->setBody('API key rate limit exceeded');
                            ->setJSON([
                                'status' => false,
                                'message' => 'API key tidak aktif'
                            ]);
        }
        // // Mengecek apakah limit akses sudah mencapai batas
        if ($keyInfo->limits >= $keyInfo->max_limits)
        {
            // Jika sudah mencapai batas, maka membatalkan request dan memberikan pesan kesalahan
            $response = service('response');
            return $response->setStatusCode(429)
                            // ->setBody('API key rate limit exceeded');
                            ->setJSON([
                                'status' => false,
                                'message' => 'API key telah mencapai limit'
                            ]);
        }

        // Mengurangi jumlah limit akses
        $apiKeyModel->decrementLimit($apiKey);
        $date = date("Y-m-d H:i:s");
        $apiKeyModel->lastAccess($apiKey, $date);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah request
    }
}
