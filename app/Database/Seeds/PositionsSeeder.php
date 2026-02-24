<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PositionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['position_name' => 'Manager'],
            ['position_name' => 'Staff'],
            ['position_name' => 'Supervisor'],
        ];

        $this->db->table('positions')->insertBatch($data);
    }
}