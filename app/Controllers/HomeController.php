<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MedicineModel;

class HomeController extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        $categories = $categoryModel->findAll(6);

        $medicineModel = new MedicineModel();
        $data['products'] = $medicineModel
        ->select('medicines.*, categories.name as category_name')
        ->join('categories', 'categories.id = medicines.category_id', 'left')
        ->orderBy('medicines.id', 'DESC')
        ->findAll(4); // <- pakai findAll(limit)

        $data = [
            'title'      => 'Home', 
            'categories' => $categories,
            'products'   => $data['products']
        ];

        return view('index', $data); 
    }

    public function products()
    {
        $medicineModel = new MedicineModel();
        
         $data['products'] = $medicineModel
        ->select('medicines.*, categories.name AS category_name')
        ->join('categories', 'categories.id = medicines.category_id', 'left')
        ->orderBy('medicines.id', 'DESC')
        ->paginate(9, 'products');

        $data['pager']      = $medicineModel->pager;
    
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        return view('product/index', $data);
    }

    public function productDetail($id)
    {
        // Panggil model
        $medicineModel = new \App\Models\MedicineModel();
        
        // Cari obat berdasarkan ID, di-JOIN dengan kategori agar namanya muncul
        $product = $medicineModel->select('medicines.*, categories.name as category_name')
                                 ->join('categories', 'categories.id = medicines.category_id', 'left')
                                 ->find($id);

        // Jika obat tidak ditemukan, kembalikan ke halaman products
        if (empty($product)) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        $data = [
            'title'   => $product['name'],
            'product' => $product
        ];

        return view('product/detail', $data);
    }
}
