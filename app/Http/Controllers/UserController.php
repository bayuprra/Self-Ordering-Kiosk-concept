<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
