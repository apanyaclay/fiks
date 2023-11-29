<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function dashboard()
    {
        $data = array(
            'title' => 'Dashboard User',
            'isi'   => 'user/dashboard'
        );
        return view('user/layout/v_wrapper', $data);
    }
}
