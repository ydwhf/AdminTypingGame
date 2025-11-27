<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [];

        // Guru default
        $users[] = [
            'name'       => 'Admin Guru',
            'username'   => 'admin',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'guru',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Generate 19 siswa random
        for ($i = 1; $i <= 19; $i++) {
            $users[] = [
                'name'       => 'Siswa ' . $i,
                'username'   => null,
                'password'   => null,
                'role'       => 'murid',
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('users')->insertBatch($users);
    }
}
