<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Pain Relief',
                'slug'       => 'pain-relief',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Cold & Flu',
                'slug'       => 'cold-flu',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Vitamins & Supplements',
                'slug'       => 'vitamins-supplements',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
