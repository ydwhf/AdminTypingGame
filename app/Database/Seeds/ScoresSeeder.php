<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ScoresSeeder extends Seeder
{
    public function run()
    {
        $scores = [];

        for ($i = 1; $i <= 20; $i++) {

            $scores[] = [
                'id_user'   => rand(2, 20),     // Hindari admin (id = 1)
                'id_level'  => rand(1, 3),      // Level 1-3
                'score'     => rand(50, 100),   // Skor random
                'created_at' => date('Y-m-d H:i:s', time() - rand(0, 86400 * 3)),
            ];
        }

        $this->db->table('scores')->insertBatch($scores);
    }
}
