<?php

namespace App\Models;

use CodeIgniter\Model;

class PositionModel extends Model
{
    protected $table = 'positions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'position_name',
        'department_id'
    ];

    protected $useTimestamps = true;
}