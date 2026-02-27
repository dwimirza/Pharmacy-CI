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
        // Tolak jika belum login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $db               = \Config\Database::connect();
        $cartModel        = new CartModel();
        $medicineModel    = new MedicineModel();
        $orderModel       = new OrdersModel();
        $orderDetailModel = new OrderDetailsModel();

        $userId = session('user_id');

        // Tangkap data tambahan dari form modal Checkout
        $address       = $this->request->getPost('address');
        $paymentMethod = $this->request->getPost('payment_method');

        // 1. Ambil semua item cart user
        $cartItems = $cartModel->where('user_id', $userId)->findAll();

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $db->transBegin();

        try {
            $total = 0;
            $detailsData = [];

            // 2. Hitung total, siapkan detail, dan KURANGI STOK
            foreach ($cartItems as $item) {
                $medicine = $medicineModel->find($item['medicine_id']);
                
                if (!$medicine) {
                    throw new DatabaseException('Produk tidak ditemukan.');
                }

                // Pengamanan Ekstra: Cek apakah stok mencukupi
                if ($medicine['stock'] < $item['quantity']) {
                    throw new DatabaseException('Stok untuk obat ' . $medicine['name'] . ' tidak mencukupi.');
                }

                $price     = $medicine['price'];
                $subtotal  = $price * $item['quantity'];
                $total    += $subtotal;

                // Siapkan data untuk tabel order_details
                $detailsData[] = [
                    'medicine_id' => $item['medicine_id'],
                    'quantity'    => $item['quantity'],
                    'price'       => $price,
                ];

                // Proses Kurangi Stok
                $newStock = $medicine['stock'] - $item['quantity'];
                $medicineModel->update($item['medicine_id'], ['stock' => $newStock]);
            }

            // 3. Insert ke tabel orders (Masukan Address & Payment Method)
            $orderModel->insert([
                'user_id'          => $userId,
                'total_amount'     => $total,
                'status'           => 'completed', // Ubah jadi pending menunggu konfirmasi admin
                'shipping_address' => $address,
                'payment_method'   => $paymentMethod,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]); 
            
            $orderId = $orderModel->getInsertID();

            // 4. Insert ke order_details
            foreach ($detailsData as $row) {
                $row['order_id'] = $orderId;
                $orderDetailModel->insert($row);
            }

            // 5. Kosongkan cart user
            $cartModel->where('user_id', $userId)->delete();

            $db->transCommit();

            return redirect()->to('/products')->with('success', 'Checkout successful! Stock has been updated and your order is saved.');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
}

