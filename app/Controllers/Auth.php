<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->AuthModel = new AuthModel();
    }

    public function register()
    {
        $data = array(
            'title' => 'Register'
        );
        return view('register', $data);
    }

    public function save_register()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
                ],
            'first_name' => [
                'label' => 'Nama depan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'last_name' => [
                'label' => 'Nama depan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'email' => [
                'label' => 'Alamat Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Wajib diisi dan tidak boleh kosong !!!',
                    'valid_email' => '{field} tidak valid',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi dan tidak boleh kosong !!!'
                ]
            ],
            'confirm_password' => [
                'label' => 'Ulangi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Wajib diisi dan tidak boleh kosong !!!',
                    'matches' => '{field} tidak sama'
                ]
            ],
            'address' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
        ])) {
            // jika valid
            $data = array(
                'username' => $this->request->getPost('username'),
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'password' => MD5($this->request->getPost('password')),
                'address' => $this->request->getPost('address'),
                'birth_date' => $this->request->getPost('birth_date'),
                'avatar' => 'user1.jpeg',
                'role' => 'user',
                'created_at' => date("Y-m-d H:i:s"),
            );
            $this->AuthModel->save_register($data);
            session()->setFlashdata('message', 'Daftar Berhasil !!');
            return redirect()->to(base_url('auth/register'));
        }else {
            # jika tidak valid
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }
    }

    public function login()
    {
        if (session()->get('log') == true) {
            return redirect()->to(base_url('dashboard'));
        }
        $data = array(
            'title' => 'Login',
        );
        return view('login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Alamat Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'password' => [
                'label' => "Password",
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
                ],
        ])) {
            # jika valid
            $email = $this->request->getPost('email');
            $password = MD5($this->request->getPost('password'));
            $cek = $this->AuthModel->login($email, $password);
            if ($cek) {
                # jika dapat cocok
                session()->set('log', true);
                session()->set('user_id', $cek['user_id']);
                session()->set('username', $cek['username']);
                session()->set('first_name', $cek['first_name']);
                session()->set('last_name', $cek['last_name']);
                session()->set('email', $cek['email']);
                session()->set('address', $cek['address']);
                session()->set('birth_date', $cek['birth_date']);
                session()->set('role', $cek['role']);
                session()->set('avatar', $cek['avatar']);
                session()->set('token', $cek['token']);

                if (session()->get('role') == 'admin') {
                    return redirect()->to(base_url('admin/dashboard'));
                }elseif (session()->get('role') == 'premium') {
                    return redirect()->to(base_url('premium/dashboard'));
                }else {
                    return redirect()->to(base_url('user/dashboard'));
                }

            }else {
                # jika gagal
                session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
                return redirect()->to(base_url('auth/login'));
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('pesan', 'Logout berhasil !!');
        return redirect()->to(base_url('auth/login'));
    }
}
