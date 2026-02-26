<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MedicineModel;
use App\Models\CategoryModel;

class AdminController extends BaseController
{
    public function medicines()
    {
        $medicineModel = new MedicineModel();
        $categoryModel = new CategoryModel();
        
        $medicines = $medicineModel->select('medicines.*, categories.name as category_name')
                                   ->join('categories', 'categories.id = medicines.category_id', 'left')
                                   ->findAll();

        $data = [
            'title'      => 'Manage Medicines',
            'medicines'  => $medicines,
            'categories' => $categoryModel->findAll()
        ];

        return view('admin/medicines/index', $data);
    }

    public function storeMedicine()
    {
        $medicineModel = new MedicineModel();
        
        $medicineModel->save([
            'name'                  => $this->request->getPost('name'),
            'generic_name'          => $this->request->getPost('generic_name'),
            'brand_name'            => $this->request->getPost('brand_name'),
            'description'           => $this->request->getPost('description'),
            'category_id'           => $this->request->getPost('category_id'),
            'manufacturer'          => $this->request->getPost('manufacturer'),
            'requires_prescription' => $this->request->getPost('requires_prescription'),
            'price'                 => $this->request->getPost('price'),
            'stock'                 => $this->request->getPost('stock'),
            'status'                => $this->request->getPost('status'),
            'image_url'             => null 
        ]);

        return redirect()->to('/admin/medicines')->with('success', 'New medicine added successfully.');
    }

    public function update($id)
    {
        $medicineModel = new MedicineModel();
        $existingMedicine = $medicineModel->find($id);
        if (!$existingMedicine) {
            return redirect()->to('/admin/medicines')->with('error', 'Medicine not found.');
        }

        $imageName = $existingMedicine['image_url'];
        $fileImage = $this->request->getFile('image_url');

        if ($fileImage && $fileImage->isValid() && ! $fileImage->hasMoved()) {
            $rules = [
                'image_url' => [
                    'rules'  => 'is_image[image_url]|mime_in[image_url,image/jpg,image/jpeg,image/png,image/webp]|max_size[image_url,2048]',
                    'errors' => [
                        'is_image' => 'File must be an image.',
                        'mime_in'  => 'Invalid image format. Use JPG, PNG, or WEBP.',
                        'max_size' => 'Image size cannot exceed 2MB.'
                    ]
                ]
            ];
            
        if (!$this->validate($rules)) {
                return redirect()->to('/admin/medicines')->with('error', $this->validator->getError('image_url'));
        }
            $imageName = $fileImage->getRandomName();
            $fileImage->move('uploads/medicines', $imageName);

            if (!empty($existingMedicine['image_url'])) {
                $oldFilePath = FCPATH . 'uploads/medicines/' . $existingMedicine['image_url'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); 
                }
            }
        }

        $data = [
            'name'                  => $this->request->getPost('name'),
            'generic_name'          => $this->request->getPost('generic_name'),
            'brand_name'            => $this->request->getPost('brand_name'),
            'description'           => $this->request->getPost('description'),
            'category_id'           => $this->request->getPost('category_id'),
            'manufacturer'          => $this->request->getPost('manufacturer'),
            'requires_prescription' => $this->request->getPost('requires_prescription'),
            'price'                 => $this->request->getPost('price'),
            'stock'                 => $this->request->getPost('stock'),
            'status'                => $this->request->getPost('status'),
            'image_url'             => $imageName
        ];

        $medicineModel->update($id, $data);

        return redirect()->to('/admin/medicines')->with('success', 'Medicine updated successfully.');
    }

    public function delete($id)
    {
        $medicineModel = new MedicineModel();
        
        $medicine = $medicineModel->find($id);

        if ($medicine) {
            if (!empty($medicine['image_url'])) {
                $imagePath = FCPATH . 'uploads/medicines/' . $medicine['image_url'];
                
                if (file_exists($imagePath)) {
                    unlink($imagePath); 
                }
            }

            $medicineModel->delete($id);

            return redirect()->to('/admin/medicines')->with('success', 'Medicine deleted successfully.');
        }

        return redirect()->to('/admin/medicines')->with('error', 'Medicine not found.');
    }
}
