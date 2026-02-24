<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDepartmentIdToPositions extends Migration
{
public function up()
{
    $this->forge->addColumn('positions', [
        'department_id' => ['type' => 'INT', 'null' => true, 'after' => 'position_name'],
    ]);
}

public function down()
{
    $this->forge->dropColumn('positions', 'department_id');
}
}
