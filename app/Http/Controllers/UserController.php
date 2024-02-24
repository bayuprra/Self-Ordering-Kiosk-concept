<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, $table = null)
    {
        $tableFromRequest = $request->input('table');
        return view('layout/user_layout/order', [
            'title'         => "Phoenix Gastrobar",
            'folder'        => "Order",
            'table'         => $tableFromRequest ?? 0,
            'kategori'      => $this->kategoriModel->all(),
            'menu'          => $this->menuModel->getCategory()
        ]);
    }
}
