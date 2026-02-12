<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'        => 3, // Customer One
                'label'          => 'Home',
                'recipient_name' => 'Customer One',
                'phone'          => '081234567892',
                'address_line'   => 'Jl. Contoh No. 123',
                'city'           => 'Depok',
                'province'       => 'Jawa Barat',
                'postal_code'    => '16412',
                'is_default'     => 1,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 3,
                'label'          => 'Office',
                'recipient_name' => 'Customer One',
                'phone'          => '081234567892',
                'address_line'   => 'Jl. Perusahaan No. 45',
                'city'           => 'Jakarta Selatan',
                'province'       => 'DKI Jakarta',
                'postal_code'    => '12940',
                'is_default'     => 0,
                'created_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('addresses')->insertBatch($data);
    }
}
    