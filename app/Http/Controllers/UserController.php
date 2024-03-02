<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $table = $request->query('table', 0);
        if (!$this->mejaModel->where('nomor', $table)->first()) {
            return response()->view('404', [], 404);
        }
        return view('layout.user_layout.order', [
            'title'    => "Phoenix Gastrobar",
            'folder'   => "Order",
            'table'    => $table,
            'kategori' => $this->kategoriModel->all(),
            'menu'     => $this->menuModel->getCategory(),
            'pesanan'  => session('ordered_menu')
        ]);
    }

    function bayar(Request $request)
    {
        try {

            $data = $request->input('data');

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $date = date("Y-m-d H:i:s");

            $params = array(
                'transaction_details' => array(
                    'order_id'      => rand(1, 100),
                    'gross_amount'  => $data['amount']
                ),
                'customer_details'  => array(
                    'meja'      => 2,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['data' => $snapToken]);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()]);
        }
    }
}
