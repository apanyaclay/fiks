<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Api\V1\ApiKeyModel;

class LevelFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $apiKeyModel = new ApiKeyModel();
        

        // Ambil nilai apikey dari parameter
        $apiKey = $request->getGet('apikey');

        $keyInfo = $apiKeyModel->getKeyInfo($apiKey);
        
        if ($keyInfo->level > 1) {
            $response = service('response');
            return $response->setStatusCode(429)
                            // ->setBody('API key rate limit exceeded');
                            ->setJSON([
                                'status' => false,
                                'message' => 'Level akun tidak mencukupi'
                            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah request
    }
}
