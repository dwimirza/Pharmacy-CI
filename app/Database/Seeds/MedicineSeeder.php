<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'                 => 'Paracetamol 500 mg',
                'generic_name'         => 'Paracetamol',
                'brand_name'           => 'Paracetamol Generic',
                'description'          => 'Obat penurun demam dan pereda nyeri ringan sampai sedang.',
                'category_id'          => 1, // Pain Relief
                'manufacturer'         => 'Generic Pharma',
                'requires_prescription'=> 0,
                'price'                => 1500.00,
                'stock'                => 200,
                'image_url'            => null,
                'status'               => 'active',
                'created_at'           => date('Y-m-d H:i:s'),
            ],
            [
                'name'                 => 'Ibuprofen 400 mg',
                'generic_name'         => 'Ibuprofen',
                'brand_name'           => 'Ibu-400',
                'description'          => 'Anti-inflamasi non-steroid untuk nyeri dan peradangan.',
                'category_id'          => 1,
                'manufacturer'         => 'HealthCare Labs',
                'requires_prescription'=> 0,
                'price'                => 3500.00,
                'stock'                => 150,
                'image_url'            => null,
                'status'               => 'active',
                'created_at'           => date('Y-m-d H:i:s'),
            ],
            [
                'name'                 => 'Vitamin C 500 mg',
                'generic_name'         => 'Ascorbic Acid',
                'brand_name'           => 'Vit-C 500',
                'description'          => 'Suplemen vitamin C untuk membantu menjaga daya tahan tubuh.',
                'category_id'          => 3, // Vitamins & Supplements
                'manufacturer'         => 'NutriLabs',
                'requires_prescription'=> 0,
                'price'                => 2500.00,
                'stock'                => 300,
                'image_url'            => null,
                'status'               => 'active',
                'created_at'           => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('medicines')->insertBatch($data);
    }
}
