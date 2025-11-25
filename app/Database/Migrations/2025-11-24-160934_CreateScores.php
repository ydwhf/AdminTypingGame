<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateScores extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_score' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_level' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'score' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_score', true);

        // Foreign Keys
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_level', 'levels', 'id_level', 'CASCADE', 'CASCADE');

        $this->forge->createTable('scores');
    }

    public function down()
    {
        $this->forge->dropTable('scores');
    }
}
