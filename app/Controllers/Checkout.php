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
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $db               = \Config\Database::connect();
        $cartModel        = new CartModel();
        $medicineModel    = new MedicineModel();
        $orderModel       = new OrdersModel();
        $orderDetailModel = new OrderDetailsModel();

        $userId = session('user_id');

        $address       = $this->request->getPost('address');
        $paymentMethod = $this->request->getPost('payment_method');

        $cartItems = $cartModel->where('user_id', $userId)->findAll();

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $db->transBegin();

        try {
            $total = 0;
            $detailsData = [];

            foreach ($cartItems as $item) {
                $medicine = $medicineModel->find($item['medicine_id']);
                
                if (!$medicine) {
                    throw new DatabaseException('Produk tidak ditemukan.');
                }

                if ($medicine['stock'] < $item['quantity']) {
                    throw new DatabaseException('Stok untuk obat ' . $medicine['name'] . ' tidak mencukupi.');
                }

                $price     = $medicine['price'];
                $subtotal  = $price * $item['quantity'];
                $total    += $subtotal;

                $detailsData[] = [
                    'medicine_id' => $item['medicine_id'],
                    'quantity'    => $item['quantity'],
                    'price'       => $price,
                ];

                $newStock = $medicine['stock'] - $item['quantity'];
                $medicineModel->update($item['medicine_id'], ['stock' => $newStock]);
            }

            $orderModel->insert([
                'user_id'          => $userId,
                'total_amount'     => $total,
                'status'           => 'completed',
                'shipping_address' => $address,
                'payment_method'   => $paymentMethod,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]); 
            
            $orderId = $orderModel->getInsertID();

            foreach ($detailsData as $row) {
                $row['order_id'] = $orderId;
                $orderDetailModel->insert($row);
            }

            $cartModel->where('user_id', $userId)->delete();

            $db->transCommit();

            return redirect()->to('/products')->with('success', 'Checkout successful! Stock has been updated and your order is saved.');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
}

