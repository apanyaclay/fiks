<?php

namespace App\Controllers\Premium;

use App\Controllers\BaseController;

class Premium extends BaseController
{
    public function dashboard()
    {
        $data = array(
            'title' => 'Dashboard Premium',
            'isi'   => 'premium/dashboard'
        );
        return view('premium/layout/v_wrapper', $data);
    }
}
