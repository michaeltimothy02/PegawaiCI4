<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToDepartments extends Migration
{
public function up()
{
    $this->forge->addColumn('departments', [
        'created_at' => ['type' => 'DATETIME', 'null' => true],
        'updated_at' => ['type' => 'DATETIME', 'null' => true],
    ]);
}

public function down()
{
    $this->forge->dropColumn('departments', 'created_at');
    $this->forge->dropColumn('departments', 'updated_at');
}
}
