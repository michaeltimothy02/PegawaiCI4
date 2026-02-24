<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToPositions extends Migration
{
public function up()
{
    $this->forge->addColumn('positions', [
        'created_at' => ['type' => 'DATETIME', 'null' => true],
        'updated_at' => ['type' => 'DATETIME', 'null' => true],
    ]);
}

public function down()
{
    $this->forge->dropColumn('positions', 'created_at');
    $this->forge->dropColumn('positions', 'updated_at');
}
}
