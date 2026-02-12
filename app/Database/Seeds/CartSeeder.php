<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'    => 3,  // Customer One
                'address_id' => 1,  // Home address from AddressSeeder
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('carts')->insertBatch($data);
    }
}
