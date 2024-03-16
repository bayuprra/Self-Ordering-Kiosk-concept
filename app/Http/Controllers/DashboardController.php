<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $data = array(
            'title'             => "Dashboard",
            'folder'            => "Home",
            'todayOrder'        => $this->transaksiModel::whereDate('created_at', $today)->count(),
            'servedOrder'       => $this->transaksiModel::whereDate('created_at', $today)->where('status_pembayaran', "Success")->where('status', 1)->count(),
            'progressOrder'     => $this->transaksiModel::whereDate('created_at', $today)->where('status_pembayaran', "Success")->where('status', 0)->count(),
            'cancelOrder'       => $this->transaksiModel::whereDate('created_at', $today)->where('status_pembayaran', "!=", "Success")->count(),
            'todaysIncome'      => $this->transaksiModel::whereDate('created_at', $today)->where('status_pembayaran', 'Success')->select("total_belanja")->get(),
            'yesterdayIncome'   => $this->transaksiModel::whereDate('created_at', $yesterday)->where('status_pembayaran', 'Success')->select("total_belanja")->get(),
            'monthlyIncome'     => $this->transaksiModel::where('status_pembayaran', 'Success')->select(DB::raw("MONTH(created_at) as month"), DB::raw("SUM(total_belanja) as total"))->groupBy(DB::raw("MONTH(created_at)"))->get(),
        );
        return view('layout/admin_layout/dashboard', $data);
    }
}
