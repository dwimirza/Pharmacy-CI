<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAddressAndPaymentToOrders extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'shipping_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['shipping_address', 'payment_method']);
    }
}
