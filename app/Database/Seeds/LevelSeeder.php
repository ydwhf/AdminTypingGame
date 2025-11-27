<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'level_name' => 'Level 1',
            ],
            [
                'level_name' => 'Level 2',
            ],
            [
                'level_name' => 'Level 3',
            ],
        ];

        $this->db->table('levels')->insertBatch($data);
    }
}
