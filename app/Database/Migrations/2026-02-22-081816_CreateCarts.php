<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCarts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'medicine_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', '');
        $this->forge->addForeignKey('medicine_id', 'medicines', 'id', '', '');
        $this->forge->createTable('carts');
    }

    public function down()
    {
        //
    }
}
