<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ScoresModel;
use CodeIgniter\HTTP\ResponseInterface;

class SkorController extends BaseController
{
    protected $scoresModel;

    public function __construct()
    {
        $this->scoresModel = new ScoresModel();
    }

    public function index()
    {
        $skor = $this->scoresModel->getScores();

        $data = [
            'skor' => $skor
        ];

        return view('Skor/index', $data);
    }

    public function delete($id)
    {
        if ($this->scoresModel->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data!');
        }

        return redirect()->to('/skorSiswa');
    }
}
