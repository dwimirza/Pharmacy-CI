<?php

namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class Medicines extends ResourceController
{
    protected $modelName = 'App\Models\MedicineModel';
    protected $format    = 'json';

    /**
     * GET /medicines
     */
    public function index()
    {
        $medicines = $this->model->findAll();

        return $this->respond($medicines);
    }

    /**
     * GET /medicines/{id}
     */
    public function show($id = null)
    {
        $medicine = $this->model->find($id);

        if (! $medicine) {
            return $this->failNotFound('Medicine not found');
        }

        return $this->respond($medicine);
    }

    /**
     * POST /medicines
     */
    public function create()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $data['id'] = $this->model->getInsertID();

        return $this->respondCreated($data);
    }

    /**
     * PUT/PATCH /medicines/{id}
     */
    public function update($id = null)
    {
        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }

        $existing = $this->model->find($id);
        if (! $existing) {
            return $this->failNotFound('Medicine not found');
        }

        $data = $this->request->getJSON(true) ?? $this->request->getRawInput();
        $data['id'] = $id;

        if (! $this->model->save($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond($data);
    }

    /**
     * DELETE /medicines/{id}
     */
    public function delete($id = null)
    {
        $existing = $this->model->find($id);
        if (! $existing) {
            return $this->failNotFound('Medicine not found');
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Medicine deleted']);
    }
}
