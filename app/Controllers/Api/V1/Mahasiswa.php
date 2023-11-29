<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;

class Mahasiswa extends BaseController
{
    public function __construct()
    {
        $this->author = getenv('author');
    }
    public function index()
    {
        $nama = $this->request->getGet('nama');
        if (!$nama) {
            return $this->response->setJSON([
                'status' => false,
                'author' => $this->author,
                'message' => 'Masukkan parameter nama',
            ]);
        }
        $url = 'https://api-frontend.kemdikbud.go.id/hit_mhs'; // URL dari API yang ingin di-request

        $data = array(
            $nama,
        );
        $url .= '/' . http_build_query($data);
        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result['mahasiswa'][0]['text'];
        // $total = $result['data']['count'];
         return $this->response->setJSON(['status' => true,
         'author' => 'ApanyaClay',
        //  'total' => $total,
         'result' => $output_text]); // Tampilkan response dari API
    }
}
