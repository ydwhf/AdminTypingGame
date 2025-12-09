<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = $this->userModel->findAll();
        $data = [
            'active' => 'kelola_siswa',
            'user' => $user
        ];
        return view('User/index', $data);
    }

    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->userModel->insert($data)) {
            session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data!');
        }

        return redirect()->to('/kelolaSiswa');
    }

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'level_unlocked' => $this->request->getPost('level_unlocked'),
            'role' => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($this->userModel->update($id, $data)) {
            session()->setFlashdata('success', 'Data berhasil diupdate!');
        } else {
            session()->setFlashdata('error', 'Gagal mengupdate data!');
        }

        return redirect()->to('/kelolaSiswa');
    }

    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data!');
        }

        return redirect()->to('/kelolaSiswa');
    }

    public function get($id)
    {
        $user = $this->userModel->find($id);
        return $this->response->setJSON($user);
    }
}
