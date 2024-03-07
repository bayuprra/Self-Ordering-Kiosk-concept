<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
                $path = 'image/menu/' . $data->gambar;

                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }

            $name = $this->random_string() . ".png";
            $request->file('gambar')->move('image/menu/', $name);
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

    public function findById(Request $request)
    {
        $data = $request->input('data');
        $id = $data['id'];
        $dataMenu = $this->menuModel->where('id', $id)->first();
        if ($dataMenu) {
            return response()->json(['data' => $dataMenu]);
        }
        return response()->json(['data' => false]);
    }

    public function todaysMenu()
    {
        $data = array(
            'title'         => "Today's Menu",
            'folder'        => "Home",
            'menu'     => $this->menuModel->all(),
        );
        return view('layout/admin_layout/todayMenu', $data);
    }

    public function setUnavailbleMenu(Request $request)
    {
        try {
            $data = $request->input('data');
            $dataUnavailable = $data['unavail'] ?? [];
            $allmenu = $this->menuModel->all()->toArray();
            $allmenuIds = array_column($allmenu, 'id');
            if (!empty($dataUnavailable)) {
                foreach ($dataUnavailable as $unav) {
                    $this->menuModel->setAvailableMenu($unav, 0);
                    if (($key = array_search(intval($unav), $allmenuIds)) !== false) {
                        unset($allmenuIds[$key]);
                    }
                }
            }
            foreach ($allmenuIds as $ava) {
                $this->menuModel->setAvailableMenu($ava, 1);
            }
            return response()->json([
                'success' => true,
                'message' => 'Updated Menu Success!',
                'data' => true,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Updated Menu Failed!',
                'error' => $e->getMessage(),
            ], 200);
        }
    }
}
