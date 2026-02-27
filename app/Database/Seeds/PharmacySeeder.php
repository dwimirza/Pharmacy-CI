<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PharmacySeeder extends Seeder
{
    public function run()
    {
        // 1. DATA KATEGORI
        $categories = [
            ['id' => 1, 'name' => 'Pain Relief', 'slug' => 'pain-relief'],
            ['id' => 2, 'name' => 'Cold & Flu', 'slug' => 'cold-flu'],
            ['id' => 3, 'name' => 'Vitamins & Supplements', 'slug' => 'vitamins-supplements'],
            ['id' => 4, 'name' => 'Digestive Health', 'slug' => 'digestive-health'],
            ['id' => 5, 'name' => 'First Aid & Antiseptics', 'slug' => 'first-aid-antiseptics'],
            ['id' => 6, 'name' => 'Eye & Ear Care', 'slug' => 'eye-ear-care'],
            ['id' => 7, 'name' => 'Skin Care & Dermatology', 'slug' => 'skin-care-dermatology'],
        ];

        // Memasukkan kategori (Menggunakan ignore() agar tidak error kalau ID sudah ada)
        $this->db->table('categories')->ignore(true)->insertBatch($categories);


        // 2. DATA OBAT (MEDICINES)
        $medicines = [
            // --- KATEGORI 2: Cold & Flu ---
            [
                'name'                  => 'OBH Combi Plus Batuk Flu',
                'generic_name'          => 'Diphenhydramine, Paracetamol',
                'brand_name'            => 'OBH Combi',
                'manufacturer'          => 'Combiphar',
                'category_id'           => 2, 
                'requires_prescription' => 0, // No
                'status'                => 'active',
                'price'                 => 18500,
                'stock'                 => 100,
                'description'           => 'Sirup obat batuk dan flu untuk meredakan hidung tersumbat, bersin, dan demam.',
                'image_url'             => null,
            ],
            [
                'name'                  => 'Rhinos SR Capsule',
                'generic_name'          => 'Loratadine, Pseudoephedrine',
                'brand_name'            => 'Rhinos',
                'manufacturer'          => 'Dexa Medica',
                'category_id'           => 2,
                'requires_prescription' => 1, // Yes
                'status'                => 'active',
                'price'                 => 65000,
                'stock'                 => 50,
                'description'           => 'Kapsul lepas lambat untuk meredakan gejala rinitis alergi yang parah.',
                'image_url'             => null,
            ],

            // --- KATEGORI 3: Vitamins & Supplements ---
            [
                'name'                  => 'Imboost Force Tablet',
                'generic_name'          => 'Echinacea purpurea, Zinc',
                'brand_name'            => 'Imboost',
                'manufacturer'          => 'Soho Global Health',
                'category_id'           => 3,
                'requires_prescription' => 0,
                'status'                => 'active',
                'price'                 => 45000,
                'stock'                 => 150,
                'description'           => 'Suplemen daya tahan tubuh yang bekerja cepat untuk memulihkan kondisi setelah sakit.',
                'image_url'             => null,
            ],
            [
                'name'                  => 'Sangobion Kapsul',
                'generic_name'          => 'Ferrous Gluconate, Vitamin C',
                'brand_name'            => 'Sangobion',
                'manufacturer'          => 'Merck',
                'category_id'           => 3,
                'requires_prescription' => 0,
                'status'                => 'active',
                'price'                 => 22000,
                'stock'                 => 80,
                'description'           => 'Suplemen penambah darah untuk mencegah anemia dan kelelahan.',
                'image_url'             => null,
            ],

            // --- KATEGORI 4: Digestive Health ---
            [
                'name'                  => 'Promag Tablet Kunyah',
                'generic_name'          => 'Hydrotalcite, Magnesium',
                'brand_name'            => 'Promag',
                'manufacturer'          => 'Kalbe Farma',
                'category_id'           => 4,
                'requires_prescription' => 0,
                'status'                => 'active',
                'price'                 => 9500,
                'stock'                 => 200,
                'description'           => 'Obat maag cepat tanggap untuk meredakan nyeri lambung, mual, dan perut kembung.',
                'image_url'             => null,
            ],
            [
                'name'                  => 'Diapet Kapsul',
                'generic_name'          => 'Psidium Guajava (Daun Jambu)',
                'brand_name'            => 'Diapet',
                'manufacturer'          => 'Soho',
                'category_id'           => 4,
                'requires_prescription' => 0,
                'status'                => 'active',
                'price'                 => 15000,
                'stock'                 => 120,
                'description'           => 'Obat diare herbal alami untuk memadatkan feses dan meredakan mulas.',
                'image_url'             => null,
            ],

            // --- KATEGORI 5: First Aid & Antiseptics ---
            [
                'name'                  => 'Betadine Antiseptic Solution 15ml',
                'generic_name'          => 'Povidone Iodine 10%',
                'brand_name'            => 'Betadine',
                'manufacturer'          => 'Mundipharma',
                'category_id'           => 5,
                'requires_prescription' => 0,
                'status'                => 'active',
                'price'                 => 16000,
                'stock'                 => 85,
                'description'           => 'Cairan antiseptik untuk membunuh kuman penyebab infeksi pada luka robek atau gores.',
                'image_url'             => null,
            ],
            [
                'name'                  => 'Hansaplast Plester Kain (Isi 10)',
                'generic_name'          => 'Wound Plaster',
                'brand_name'            => 'Hansaplast',
                'manufacturer'          => 'Beiersdorf',
                'category_id'           => 5,
                'requires_prescription' => 0,
                'status'                => 'active',
                'price'                 => 6500,
                'stock'                 => 300,
                'description'           => 'Plester penutup luka yang elastis dan memiliki sirkulasi udara yang baik.',
                'image_url'             => null,
            ],

            // --- KATEGORI 6: Eye & Ear Care ---
            [
                'name'                  => 'Insto Regular Eye Drops 7.5ml',
                'generic_name'          => 'Tetrahydrozoline HCl',
                'brand_name'            => 'Insto',
                'manufacturer'          => 'Pharma Healthcare',
                'category_id'           => 6,
                'requires_prescription' => 0,
                'status'                => 'active',
                'price'                 => 14500,
                'stock'                 => 110,
                'description'           => 'Obat tetes mata untuk meredakan mata merah dan perih akibat iritasi ringan.',
                'image_url'             => null,
            ],

            // --- KATEGORI 1: Pain Relief ---
            [
                'name'                  => 'Asam Mefenamat 500 mg',
                'generic_name'          => 'Mefenamic Acid',
                'brand_name'            => 'Generic',
                'manufacturer'          => 'Kimia Farma',
                'category_id'           => 1,
                'requires_prescription' => 1, // Yes
                'status'                => 'active',
                'price'                 => 12000,
                'stock'                 => 90,
                'description'           => 'Obat pereda nyeri tingkat sedang hingga berat, seperti sakit gigi atau nyeri haid.',
                'image_url'             => null,
            ],
        ];

        $this->db->table('medicines')->insertBatch($medicines);
    }
}
