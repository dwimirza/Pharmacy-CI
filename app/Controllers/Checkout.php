<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\MedicineModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\OrderDetailsModel;
use App\Models\OrdersModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Checkout extends BaseController
{
    public function store()
    {
        $db              = \Config\Database::connect();
        $cartModel       = new CartModel();
        $medicineModel   = new MedicineModel();
        $orderModel      = new OrdersModel();
        $orderDetailModel= new OrderDetailsModel();

        $userId = session('user_id');

        // 1. Ambil semua item cart user
        $cartItems = $cartModel
            ->where('user_id', $userId)
            ->findAll();

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Cart kosong.');
        }

        $db->transBegin();

        try {
            $total = 0;
            $detailsData = [];

            // 2. Hitung total dan siapkan data detail
            foreach ($cartItems as $item) {
                $medicine = $medicineModel->find($item['medicine_id']);
                if (! $medicine) {
                    throw new DatabaseException('Produk tidak ditemukan.');
                }

                $price    = $medicine['price'];
                $subtotal = $price * $item['quantity'];
                $total   += $subtotal;

                $detailsData[] = [
                    'medicine_id' => $item['medicine_id'],
                    'quantity'    => $item['quantity'],
                    'price'       => $price,
                ];
            }

            // 3. Insert ke orders
            $orderId = $orderModel->insert([
                'user_id'      => $userId,
                'total_amount' => $total,
                'status'       => 'completed',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ], true); // true supaya dapat insertID

            // 4. Insert ke order_details
            foreach ($detailsData as $row) {
                $row['order_id'] = $orderId;
                $orderDetailModel->insert($row);
            }

            // 5. Kosongkan cart user
            $cartModel->where('user_id', $userId)->delete();

            $db->transCommit();

            return redirect()
                ->to('cart')
                ->with('success', 'Order berhasil dibuat.');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()
                ->back()
                ->with('error', 'Gagal membuat order: '.$e->getMessage());
        }
    }
}

