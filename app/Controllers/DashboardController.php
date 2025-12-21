<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LevelModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ScoresModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $levelModel;
    protected $scoresModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->scoresModel = new ScoresModel();
        $this->levelModel = new LevelModel();
    }

    public function index()
    {
        $dataUsers = $this->userModel->getUsers();
        $totalUsers = $this->userModel->countUsers();
        $totalLevel = $this->levelModel->countLevel();
        $totalBermain = $this->scoresModel->countScores();
        $dataSkor = $this->scoresModel->getAverageScoreByDate();
        $dataLeaderboard = $this->scoresModel->top3PerLevel();
        // dd($dataUsers);
        // $progressUser = $this->scoresModel->getScoreProgressByUser($idUser);

        $leaderboard = [];

        foreach ($dataLeaderboard as $row) {
            $level = $row['level_name'];

            if (!isset($leaderboard[$level])) {
                $leaderboard[$level] = [];
            }

            if (count($leaderboard[$level]) < 3) {
                $leaderboard[$level][] = $row;
            }
        }
        // dd($leaderboard);
        $labels = [];
        $scores = [];

        foreach ($dataSkor as $row) {
            $labels[] = $row['play_date'];
            $scores[] = round($row['avg_score'], 2);
        }

        // $progressLabels = [];
        // $progressScores = [];

        // foreach ($progressUser as $row) {
        //     $progressLabels[] = date('d M', strtotime($row['created_at']));
        //     $progressScores[] = $row['score'];
        // }

        $data = [
            'active' => 'dashboard',
            'dataUsers' => $dataUsers,
            'totalUsers' => $totalUsers,
            'totalLevel' => $totalLevel,
            'totalBermain' => $totalBermain,
            'labels' => $labels,
            'scores' => $scores,
            'leaderboard' => $leaderboard,
            // 'progressUser' => $progressUser,
            // 'progressLabels' => $progressLabels,
            // 'progressScores' => $progressScores,
        ];
        // dd($data);
        return view('Dashboard/index', $data);
    }

    public function getProgressUser($idUser)
    {
        $progressUser = $this->scoresModel->getScoreProgressByUser($idUser);

        $labels = [];
        $scores = [];

        foreach ($progressUser as $row) {
            $labels[] = date('d M', strtotime($row['created_at']));
            $scores[] = $row['score'];
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'scores' => $scores,
        ]);
    }
}
