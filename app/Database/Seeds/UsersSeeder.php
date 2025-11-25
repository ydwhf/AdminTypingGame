<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Insert akun guru (admin)
        $data = [
            [
                'name'      => 'Admin Guru',
                'username'  => 'admin',
                'password'  => password_hash('admin123', PASSWORD_DEFAULT),
                'role'      => 'guru',
                'created_at' => date('Y-m-d H:i:s'),
            ],

            // Optional: contoh siswa (kalau mau)
            [
                'name'      => 'Siswa Percobaan',
                'username'  => null,
                'password'  => null,
                'role'      => 'murid',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
