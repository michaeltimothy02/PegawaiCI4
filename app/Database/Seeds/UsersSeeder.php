<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'Admin Utama',
                'email'    => 'admin@mail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'     => 'Budi Santoso',
                'email'    => 'budi@mail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role'     => 'pegawai',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'     => 'Siti Rahma',
                'email'    => 'siti@mail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role'     => 'pegawai',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}