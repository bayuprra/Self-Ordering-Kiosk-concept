<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class KitchenController extends Controller
{
    public function index()
    {
        $data = array(
            'title'         => "Kitchen",
            'folder'        => "Home",
        );
        return view('layout/kitchen_layout/kitchen', $data);
    }

    public function order()
    {
        try {
            $data = [];
            $dataTran = $this->transaksiModel->where('status_pembayaran', 'Success')->where('status', 0)->get();

            foreach ($dataTran as $datat) {
                $dataTO = [
                    'transaksi' => $datat['id'],
                    'order' => []
                ];

                $dataOrd = $this->orderModel->where('transaksi_id', $datat['id'])->get();

                foreach ($dataOrd as $dato) {
                    $dataTO['order'][] = $dato;
                }

                $data[] = $dataTO;
            }
            return response()->json([
                'success' => true,
                'data'      => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function orderForKitchen()
    {
        try {
            $data = $this->transaksiModel::where('status_pembayaran', 'Success')->where('status', 0)->count();

            return response()->json([
                'success' => true,
                'data'      => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function checklist(Request $request)
    {
        try {
            $data = $request->input('data');
            $id = $data['id'];
            $con = intval($data['con']);
            $dataSpec = $this->orderModel->find($id);

            $dataToUpdate = [
                'status'     => $con,
            ];

            $updateData = $dataSpec->update($dataToUpdate);
            return response()->json([
                'success' => true,
                'data'      => $updateData
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function allFinish(Request $request)
    {
        try {
            $data = $request->input('data');
            $id = $data['id'];
            $returned = $this->orderModel::where('transaksi_id', $id)->where('status', 0)->count();
            $counter = true;
            if ($returned > 0) {
                $counter = false;
            }
            return response()->json([
                'success' => true,
                'data'      => $counter
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function Finish(Request $request)
    {
        try {
            $data = $request->input('data');
            $id = $data['id'];
            $dataSpec = $this->transaksiModel->find($id);

            $dataToUpdate = [
                'status'     => true,
            ];
            $updateData = $dataSpec->update($dataToUpdate);
            return response()->json([
                'success' => true,
                'data'      => $updateData
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
