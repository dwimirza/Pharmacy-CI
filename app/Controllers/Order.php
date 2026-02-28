<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\OrdersModel;
use App\Models\OrderDetailsModel;

class Order extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $orderModel = new OrdersModel();
        $orderDetailModel = new OrderDetailsModel();
        $userId = session('user_id');

        $orders = $orderModel->where('user_id', $userId)
                             ->orderBy('created_at', 'DESC')
                             ->findAll();

        foreach ($orders as &$order) {
            $order['details'] = $orderDetailModel->select('order_details.*, medicines.name, medicines.image_url')
                                                 ->join('medicines', 'medicines.id = order_details.medicine_id', 'left')
                                                 ->where('order_id', $order['id'])
                                                 ->findAll();
        }

        $data = [
            'title'  => 'My Orders',
            'orders' => $orders
        ];

        return view('order/index', $data);
    }
}
