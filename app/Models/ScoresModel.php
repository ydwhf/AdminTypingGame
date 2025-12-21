<?php

namespace App\Models;

use CodeIgniter\Model;

class ScoresModel extends Model
{
    protected $table            = 'scores';
    protected $primaryKey       = 'id_score';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_level', 'score', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function countScores()
    {
        return $this->countAllResults();
    }

    public function getScores()
    {
        return $this->select('scores.id_score, scores.id_user, scores.id_level, scores.score, scores.created_at, users.name, levels.level_name')
            ->join('users', 'users.id_user = scores.id_user', 'left')
            ->join('levels', 'levels.id_level = scores.id_level', 'left')
            ->orderBy('scores.id_user, scores.id_score')
            ->groupBy('scores.id_score')
            ->findAll();
    }

    public function getAverageScoreByDate($idLevel = null)
    {
        $builder = $this->select("
                DATE(created_at) as play_date,
                AVG(score) as avg_score
            ")
            ->groupBy('DATE(created_at)')
            ->orderBy('play_date', 'ASC');

        if ($idLevel !== null) {
            $builder->where('id_level', $idLevel);
        }

        return $builder->findAll();
    }

    public function top3PerLevel()
    {
        return $this->select('
            scores.id_user,
            scores.id_level,
            MAX(scores.score) as best_score,
            users.name,
            levels.level_name
        ')
            ->join('users', 'users.id_user = scores.id_user', 'left')
            ->join('levels', 'levels.id_level = scores.id_level', 'left')
            ->groupBy('scores.id_level, scores.id_user')
            ->orderBy('scores.id_level', 'ASC')
            ->orderBy('best_score', 'DESC')
            ->findAll();
    }

    public function getScoreProgressByUser($idUser)
    {
        return $this->select('
            scores.score,
            scores.created_at,
            levels.level_name
        ')
            ->join('levels', 'levels.id_level = scores.id_level', 'left')
            ->where('scores.id_user', $idUser)
            ->orderBy('scores.created_at', 'ASC')
            ->findAll();
    }
}
