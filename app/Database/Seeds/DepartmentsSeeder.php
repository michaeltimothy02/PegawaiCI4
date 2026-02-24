<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['department_name' => 'IT'],
            ['department_name' => 'HRD'],
            ['department_name' => 'Keuangan'],
        ];

        $this->db->table('departments')->insertBatch($data);
    }
}