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

    public function __construct()
    {
        $this->scoresModel = new ScoresModel();
    }

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

        $userModel = new UserModel();

        // CARI apakah nama sudah ada
        $existing = $userModel->where('name', $name)->first();

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

    public function save()
    {
        $json = $this->request->getJSON(true);

        if (!isset($json['idUser']) || !isset($json['idLevel']) || !isset($json['score'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Missing required fields!'
            ]);
        }

        $model = new ScoresModel();

        $model->insert([
            'id_user'   => $json['idUser'],
            'id_level'  => $json['idLevel'],
            'score'     => $json['score'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Score saved!'
        ]);
    }

    public function history()
    {
        $skor = $this->scoresModel->getScores();

        return $this->response->setJSON($skor);
    }
}
