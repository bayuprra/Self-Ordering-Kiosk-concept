<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('layout/admin_layout/dataTransaksi', [
            'title'         => "Data Transaksi",
            'folder'        => "Home",
            'data'          => $this->transaksiModel::with('meja')->orderBy('created_at', 'DESC')->get(),
            'order'         => $this->orderModel->all()
        ]);
    }
    public function store(Request $request)
    {
        try {
            $data = $request->input('data');

            $dataToInserted = array(
                'id'                    => Str::uuid(),
                'meja_id'               => intval($data['meja_id']),
                'pembayaran'            => "",
                'total_belanja'         => intval($data['total']),
                'pajak'                 => intval($data['pajak']),
                'subtotal'              => intval($data['subtotal']),
                'status_pembayaran'     => "Pending",
            );
            $inserted = $this->transaksiModel::create($dataToInserted);
            if ($inserted) {
                return response()->json([
                    'success' => true,
                    'id'      => $inserted->id
                ], 200);
            }
            return response()->json([
                'success' => false,
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->input('data');
            $id = $data['transaksiId'];
            $tranData = $this->transaksiModel->find($id);

            // Check if a file is present in the request

            $dataToUpdate = array(
                'pembayaran'            => $data['metode'],
                'status_pembayaran'     => $data['status_pembayaran'],
                'status'                => intval($data['status'])
            );
            $updateData = $tranData->update($dataToUpdate);

            if ($updateData) {
                return response()->json([
                    'success' => true,
                ], 200);
            }
            return response()->json([
                'success' => false,
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function history()
    {
        try {
            $today = Carbon::today();
            $trans = $this->transaksiModel::with('meja')->whereDate('created_at', $today)->where('status_pembayaran', 'Success')->orderBy('created_at', 'DESC')->get();
            return response()->json([
                'success'   => true,
                'data'      => $trans
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function kasir()
    {
        $today = Carbon::today();
        $data = array(
            'title'         => "History Payment",
            'folder'        => "Home",
            'data'          => $this->transaksiModel::with('meja')->whereDate('created_at', $today)->where('status_pembayaran', 'Success')->orderBy('created_at', 'DESC')->get()
        );
        return view('layout/admin_layout/history', $data);
    }
}
