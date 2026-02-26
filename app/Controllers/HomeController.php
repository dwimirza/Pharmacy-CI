<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MedicineModel;

class HomeController extends BaseController
{
    public function index()
    {
        return view('index'); 
    }

    public function products()
    {
        $medicineModel = new MedicineModel();
        
        $data = [
            'medicines' => $medicineModel->findAll() 
        ];

        return view('product/index', $data);
    }
}
