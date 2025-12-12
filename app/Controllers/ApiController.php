<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LevelModel;
use App\Models\ScoresModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ApiController extends BaseController
{
    protected $scoresModel;
    protected $userModel;

    public function __construct()
    {
        $this->scoresModel = new ScoresModel();
        $this->userModel = new UserModel();
    }

    //Mengecek user sudah ada di database atau belum
    public function getOrCreate()
    {
        $json = $this->request->getJSON(true);
        $name = $json['name'] ?? null;

        if (!$name) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Name is required'
            ]);
        }

        // CARI apakah nama sudah ada
        $existing = $this->userModel->where('name', $name)->first();

        if ($existing) {
            return $this->response->setJSON([
                'status' => 'success',
                'idUser' => $existing['id_user']
            ]);
        }

        // Kalau tidak ada → buat baru
        $userModel->insert([
            'name' => $name,
            'username' => $name, // supaya ga null
            'password' => '',
            'role' => 'murid',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'idUser' => $userModel->getInsertID()
        ]);
    }

    //Menyimpan Skor
    // public function save()
    // {
    //     $json = $this->request->getJSON(true);

    //     if (!isset($json['idUser']) || !isset($json['idLevel']) || !isset($json['score'])) {
    //         return $this->response->setJSON([
    //             'status' => 'error',
    //             'message' => 'Missing required fields!'
    //         ]);
    //     }

    //     $model = new ScoresModel();

    //     $model->insert([
    //         'id_user'   => $json['idUser'],
    //         'id_level'  => $json['idLevel'],
    //         'score'     => $json['score'],
    //         'created_at' => date('Y-m-d H:i:s')
    //     ]);

    //     return $this->response->setJSON([
    //         'status' => 'success',
    //         'message' => 'Score saved!'
    //     ]);
    // }

    public function history()
    {
        $skor = $this->scoresModel->getScores();

        return $this->response->setJSON($skor);
    }

    public function loginUser()
    {
        $raw = $this->request->getBody();
        $data = json_decode($raw, true);

        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;


        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Password salah'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => [
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'name' => $user['name'],
                'level_unlocked' => $user['level_unlocked'],
            ]
        ]);
    }

    public function save()
    {
        $json = $this->request->getJSON(true);
        log_message('info', 'json : ' . json_encode($json));
        if (!isset($json['idUser']) || !isset($json['idLevel']) || !isset($json['score'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Missing required fields!'
            ]);
        }

        $idUser  = $json['idUser'];
        $idLevel = $json['idLevel'];
        $score   = $json['score'];

        // 1. Simpan skor
        $this->scoresModel->insert([
            'id_user'   => $idUser,
            'id_level'  => $idLevel,
            'score'     => $score,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // 2. Jika skor lebih dari 80 → unlock level berikutnya
        if ($score > 80) {
            $nextLevel = $idLevel + 1;
            log_message('info', 'score : ' . json_encode($score));
            log_message('info', 'next level : ' . json_encode($nextLevel));

            // Ambil data user
            $user = $this->userModel->find($idUser);

            $currentUnlocked = $user['level_unlocked'] ?? 1;

            // Kalau level berikutnya BELUM terbuka → update
            if ($nextLevel > $currentUnlocked) {
                $this->userModel->update($idUser, [
                    'level_unlocked' => $nextLevel
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Score saved & level checked!'
        ]);
    }

    public function getUser($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'level_unlocked' => $user['level_unlocked']
            ]
        ]);
    }
}
