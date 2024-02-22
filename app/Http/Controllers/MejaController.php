<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        return view('layout/admin_layout/meja', [
            'title'         => "Meja",
            'folder'        => "Home",
            'data'          => $this->mejaModel->all(),
        ]);
    }

    /**\ Create */
    public function store(Request $request)
    {
        $data = $request->all();

        $dataToInserted = array(
            'nomor'          => $data['nomor'],
        );
        $inserted = $this->mejaModel::create($dataToInserted);
        if ($inserted) {
            return redirect()->back()->with('success', 'Meja Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Meja Gagal Ditambahkan');
    }

    public function update(Request $request)
    {
        $dataForm = $request->all();
        $id = $dataForm['id'];
        $data = $this->mejaModel->find($id);

        // Check if a file is present in the request

        $updateData = $data->update($dataForm);

        if ($updateData) {
            return redirect()->back()->with('success', 'Meja Berhasil Diubah');
        }

        return redirect()->back()->with('error', 'Meja Gagal Diubah');
    }

    // // /**\ Delete */
    public function delete(Request $request)
    {
        $id = intval($request['id']);
        $data = $this->mejaModel->find($id);
        $deleteData = $data->delete();
        if ($deleteData) {
            return redirect()->back()->with('success', 'Meja Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Meja Gagal Dihapus');
    }
}
