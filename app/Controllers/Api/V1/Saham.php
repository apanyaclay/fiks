<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;

class Saham extends BaseController
{
    public function __construct()
    {
        $this->author = getenv('author');
    }
    public function perusahaan()
    {
        $url = 'https://api.goapi.id/v1/stock/idx/companies?api_key=02tvV2Lq8NOg4P0wysvhLHdlNQiFZP'; // URL dari API yang ingin di-request

        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result['data']['results'];
        $total = $result['data']['count'];
         return $this->response->setJSON(['status' => true,
         'author' => $this->author,
         'total' => $total,
         'result' => $output_text,]); // Tampilkan response dari API
    }

    public function index()
    {
        $url = 'https://api.goapi.id/v1/stock/idx/indices?api_key=02tvV2Lq8NOg4P0wysvhLHdlNQiFZP'; // URL dari API yang ingin di-request

        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result['data']['results'];
         return $this->response->setJSON(['status' => true,
         'author' => $this->author,
         'result' => $output_text,]); // Tampilkan response dari API
    }

    public function indexdetail()
    {
        $index = $this->request->getGet('index');
        if (!$index) {
            return $this->response->setJSON([
                'status' => false,
                'author' => $this->author,
                'message' => 'Masukkan parameter index',
            ]);
        }
        $url = 'https://api.goapi.id/v1/stock/idx/index'; // URL dari API yang ingin di-request

        $data = array(
            $index,
        );
        $dat = array(
             'items?api_key=02tvV2Lq8NOg4P0wysvhLHdlNQiFZP',
        );
        $url .= '/' . http_build_query($data);
        $url .= '/' . http_build_query($dat);
        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result;
         return $this->response->setJSON(['status' => true,
         'author' => $this->author,
         'result' => $output_text]); // Tampilkan response dari API
    }

    public function detailemiten()
    {
        $index = $this->request->getGet('emiten');
        if (!$index) {
            return $this->response->setJSON([
                'status' => false,
                'author' => $this->author,
                'message' => 'Masukkan parameter emiten',
            ]);
        }
        $url = 'https://api.goapi.id/v1/stock/idx'; // URL dari API yang ingin di-request

        $data = array(
            $index,
        );
        $api = array(
            '?api_key=02tvV2Lq8NOg4P0wysvhLHdlNQiFZP',
        );
        $url .= '/' . http_build_query($data);
        $url .= '/' . http_build_query($api);
        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result;
         return $this->response->setJSON(['status' => true,
         'author' => $this->author,
         'result' => $output_text]); // Tampilkan response dari API
    }

    public function trending()
    {
        $url = 'https://api.goapi.id/v1/stock/idx/trending?api_key=02tvV2Lq8NOg4P0wysvhLHdlNQiFZP'; // URL dari API yang ingin di-request

        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result['data']['results'];
         return $this->response->setJSON(['status' => true,
         'author' => $this->author,
         'result' => $output_text]); // Tampilkan response dari API
    }

    public function top_gainer()
    {
        $url = 'https://api.goapi.id/v1/stock/idx/top_gainer?api_key=02tvV2Lq8NOg4P0wysvhLHdlNQiFZP'; // URL dari API yang ingin di-request

        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result['data']['results'];
         return $this->response->setJSON(['status' => true,
         'author' => $this->author,
         'result' => $output_text]); // Tampilkan response dari API
    }

    public function top_loser()
    {
        $url = 'https://api.goapi.id/v1/stock/idx/top_loser?api_key=02tvV2Lq8NOg4P0wysvhLHdlNQiFZP'; // URL dari API yang ingin di-request

        $ch = curl_init(); // Inisialisasi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL target
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set return transfer
        $response = curl_exec($ch); // Eksekusi cURL
        curl_close($ch); // Tutup koneksi cURL
        $result = json_decode($response, true);
        $output_text = $result['data']['results'];
         return $this->response->setJSON(['status' => true,
         'author' => $this->author,
         'result' => $output_text]); // Tampilkan response dari API
    }
}
