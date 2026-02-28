<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CartModel;
use App\Models\MedicineModel;

class Cart extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first to view your cart.');
        }

        $cartModel = new CartModel();
        $userId = session()->get('user_id');

        $cartItems = $cartModel->select('carts.id as cart_id, carts.quantity, medicines.id as medicine_id, 
                                         medicines.name, medicines.price, medicines.image_url, medicines.stock')
                               ->join('medicines', 'medicines.id = carts.medicine_id')
                               ->where('carts.user_id', $userId)
                               ->findAll();

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $data = [
            'title' => 'Shopping Cart',
            'cart'  => $cartItems,
            'total' => $total
        ];

        return view('cart/index', $data);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login to add products to your cart.');
        }

        $cartModel = new CartModel();
        
        $medicineId = $this->request->getPost('id');
        $quantity   = (int) $this->request->getPost('qty') ?? 1;
        $userId     = session()->get('user_id');

        $existingItem = $cartModel->where('user_id', $userId)
                                  ->where('medicine_id', $medicineId)
                                  ->first();

        if ($existingItem) {
            $cartModel->update($existingItem['id'], [
                'quantity' => $existingItem['quantity'] + $quantity
            ]);
        } else {
            $cartModel->save([
                'user_id'     => $userId,
                'medicine_id' => $medicineId,
                'quantity'    => $quantity
            ]);
        }

        return redirect()->to('/cart')->with('success', 'Product successfully added to cart!');
    }

    public function update()
    {
        if (!session()->get('logged_in')) return redirect()->to('/login');

        $cartModel = new CartModel();
        $medicineModel = new MedicineModel();

        $cartId = $this->request->getPost('cart_id');
        $action = $this->request->getPost('action'); 
        $userId = session()->get('user_id');

        $item = $cartModel->where('id', $cartId)->where('user_id', $userId)->first();

        if ($item) {
            $medicine = $medicineModel->find($item['medicine_id']);

            if ($action == 'plus' && $item['quantity'] < $medicine['stock']) {
                $cartModel->update($cartId, ['quantity' => $item['quantity'] + 1]);
            } elseif ($action == 'minus' && $item['quantity'] > 1) {
                $cartModel->update($cartId, ['quantity' => $item['quantity'] - 1]);
            }
        }

        return redirect()->to('/cart');
    }

    public function remove($cartId)
    {
        if (!session()->get('logged_in')) return redirect()->to('/login');

        $cartModel = new CartModel();
        $userId = session()->get('user_id');

        $cartModel->where('id', $cartId)->where('user_id', $userId)->delete();

        return redirect()->to('/cart')->with('success', 'Product removed from cart.');
    }

    public function checkout()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $cartModel = new CartModel();
        $medicineModel = new MedicineModel();

        $cartItems = $cartModel->where('user_id', $userId)->findAll();

        if (empty($cartItems)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            $medicine = $medicineModel->find($item['medicine_id']);
            
            if ($medicine) {
                $newStock = $medicine['stock'] - $item['quantity'];
                if ($newStock < 0) $newStock = 0; 
                
                $medicineModel->update($item['medicine_id'], ['stock' => $newStock]);
            }
        }

        $address = $this->request->getPost('address');
        $paymentMethod = $this->request->getPost('payment_method');

        $cartModel->where('user_id', $userId)->delete();

        return redirect()->to('/products')->with('success', 'Payment successful! Thank you for your order.');
    }
}