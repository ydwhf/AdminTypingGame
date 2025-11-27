<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('Auth/login');
    }

    public function loginProcess()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        // Set session
        session()->set([
            'logged_in' => true,
            'user_id'   => $user['id_user'],
            'username'  => $user['username']
        ]);

        return redirect()->to('/skorSiswa');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
