<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nip',
        'name',
        'department_id',
        'position_id',
        'salary',
        'photo'
    ];

    protected $useTimestamps = false;
}