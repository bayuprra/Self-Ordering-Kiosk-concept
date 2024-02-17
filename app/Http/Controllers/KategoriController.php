<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('layout/admin_layout/kategori', [
            'title'         => "Kategori",
            'folder'        => "Home",
            'data'          => $this->kategoriModel->all()
        ]);
    }

    /**\ Create */
    public function store(Request $request)
    {
        $data = $request->all();
        $dataToInserted = array(
            'nama'     => $data['nama'],
        );
        $inserted = $this->kategoriModel::create($dataToInserted);
        if ($inserted) {
            return redirect()->back()->with('success', 'Kategori Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Kategori Gagal Ditambahkan');
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $dataSpec = $this->kategoriModel->find($id);

        $dataToUpdate = [
            'nama'     => $data['nama'],
        ];

        $updateData = $dataSpec->update($dataToUpdate);
        if ($updateData) {
            return redirect()->back()->with('success', 'Kategori Berhasil Diubah');
        }
        return redirect()->back()->with('error', 'Kategori Gagal Diubah');
    }

    /**\ Delete */
    public function delete(Request $request)
    {
        $id = intval($request['id']);
        $data = $this->kategoriModel->find($id);
        $deleteData = $data->delete();
        if ($deleteData) {
            return redirect()->back()->with('success', 'Kategori Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Kategori Gagal Dihapus');
    }
}
