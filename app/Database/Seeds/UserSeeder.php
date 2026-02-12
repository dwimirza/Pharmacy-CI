<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Admin User',
                'email'         => 'admin@example.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'phone'         => '081234567890',
                'role'          => 'admin',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Pharmacist User',
                'email'         => 'pharmacist@example.com',
                'password_hash' => password_hash('pharma123', PASSWORD_DEFAULT),
                'phone'         => '081234567891',
                'role'          => 'pharmacist',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Customer One',
                'email'         => 'customer1@example.com',
                'password_hash' => password_hash('customer123', PASSWORD_DEFAULT),
                'phone'         => '081234567892',
                'role'          => 'customer',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
