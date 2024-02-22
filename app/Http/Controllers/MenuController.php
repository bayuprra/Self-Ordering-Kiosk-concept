<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function index()
    {
        return view('layout/admin_layout/menu', [
            'title'         => "Menu",
            'folder'        => "Home",
            'kategori'      => $this->kategoriModel->all(),
            'data'          => $this->menuModel->getCategory()
        ]);
    }


    function random_string($length = 15)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**\ Create */
    public function store(Request $request)
    {
        $data = $request->all();
        $name = "prev.png";
        if ($request->hasFile('gambar')) {
            $name = $this->random_string() . ".png";
            $request->file('gambar')->move('image/menu/', $name);
        }

        $dataToInserted = array(
            'nama'          => $data['nama'],
            'kategori_id'   => $data['kategori'],
            'Harga'         => $data['harga'],
            'deskripsi'     => $data['deskripsi'],
            'gambar'        => $name,
        );
        $inserted = $this->menuModel::create($dataToInserted);
        if ($inserted) {
            return redirect()->back()->with('success', 'Menu Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Menu Gagal Ditambahkan');
    }
    public function update(Request $request)
    {
        $dataForm = $request->all();
        $id = $dataForm['id'];
        $data = $this->menuModel->find($id);

        // Check if a file is present in the request
        if ($request->hasFile('gambar')) {
            $dataForm['gambar'] = $request->file('gambar');
            if ($data->gambar !== "prev.png") {
                $path = public_path('image/menu/' . $data->gambar);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $name = $this->random_string() . ".png";
            $dataForm['gambar']->move('image/menu/', $name);
            $dataForm['gambar'] = $name;
        } else {
            unset($dataForm['gambar']);
        }
        $updateData = $data->update($dataForm);

        if ($updateData) {
            return redirect()->back()->with('success', 'Menu Berhasil Diubah');
        }

        return redirect()->back()->with('error', 'Menu Gagal Diubah');
    }

    // /**\ Delete */
    public function delete(Request $request)
    {
        $id = intval($request['id']);
        $data = $this->menuModel->find($id);
        $deleteData = $data->delete();
        if ($deleteData) {
            return redirect()->back()->with('success', 'Menu Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Menu Gagal Dihapus');
    }
}
