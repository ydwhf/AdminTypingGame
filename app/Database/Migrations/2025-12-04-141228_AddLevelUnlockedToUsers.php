<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLevelUnlockedToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'level_unlocked' => [
                'type' => 'INT',
                'after' => 'role',
                'default' => 1
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'level_unlocked');
    }
}
