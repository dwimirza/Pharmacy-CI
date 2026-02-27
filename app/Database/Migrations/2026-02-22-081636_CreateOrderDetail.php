<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderDetail extends Migration
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
            'order_id' => [
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
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id', '', '');
        $this->forge->addForeignKey('medicine_id', 'medicines', 'id', '', '');
        $this->forge->createTable('order_details');
    }

    public function down()
    {
        //
    }
}
