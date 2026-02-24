<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    public function run()
{
    $users = $this->db->table('users')
                      ->where('role', 'pegawai')
                      ->get()
                      ->getResultArray();

    if (count($users) < 2) {
        echo "Minimal butuh 2 user dengan role pegawai.\n";
        return;
    }

    $departments = $this->db->table('departments')->get()->getResultArray();
    $positions   = $this->db->table('positions')->get()->getResultArray();

    if (empty($departments) || empty($positions)) {
        echo "Departments atau Positions masih kosong.\n";
        return;
    }

    $data = [
        [
            'user_id'       => $users[0]['id'],
            'department_id' => $departments[0]['id'],
            'position_id'   => $positions[1]['id'],
            'nip'           => 'EMP001',
            'gender'        => 'L',
            'phone'         => '081234567890',
            'address'       => 'Jakarta',
            'salary'        => 7000000,
            'created_at'    => date('Y-m-d H:i:s')
        ],
        [
            'user_id'       => $users[1]['id'],
            'department_id' => $departments[1]['id'],
            'position_id'   => $positions[2]['id'],
            'nip'           => 'EMP002',
            'gender'        => 'P',
            'phone'         => '082345678901',
            'address'       => 'Bandung',
            'salary'        => 6500000,
            'created_at'    => date('Y-m-d H:i:s')
        ],
        [
            'user_id'       => $users[0]['id'],
            'department_id' => $departments[2]['id'],
            'position_id'   => $positions[0]['id'],
            'nip'           => 'EMP003',
            'gender'        => 'L',
            'phone'         => '083456789012',
            'address'       => 'Surabaya',
            'salary'        => 8000000,
            'created_at'    => date('Y-m-d H:i:s')
        ],
    ];

    $this->db->table('employees')->insertBatch($data);
}
}