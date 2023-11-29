<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function dashboard()
    {
        $data = array(
            'title' => 'Dashboard Admin',
            'isi'   => 'admin/dashboard'
        );
        return view('admin/layout/v_wrapper', $data);
    }
}
