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

        $medicineModel = new MedicineModel();
        $data['products'] = $medicineModel
        ->select('medicines.*, categories.name as category_name')
        ->join('categories', 'categories.id = medicines.category_id', 'left')
        ->orderBy('medicines.id', 'DESC')
        ->findAll(4); // <- pakai findAll(limit)

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
}
