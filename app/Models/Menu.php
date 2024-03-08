<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;
    protected $table = "menu";
    protected $fillable = [
        'nama',
        'kategori_id',
        'available',
        'Harga',
        'deskripsi',
        'gambar'
    ];
    public $timestamps = false;

    function getCategory()
    {
        return DB::table("menu as m")
            ->leftJoin('kategori as k', 'm.kategori_id', '=', 'k.id')
            ->select(
                'm.*',
                'k.nama as kategori'
            )
            ->orderBy('m.available', 'DESC')
            ->get();
    }
    function setAvailableMenu($id, $conn)
    {
        $c = 1;
        try {
            $menu = Menu::find($id);
            if ($conn != 1) {
                $c = 0;
            }
            if ($menu) {
                $menu->available = $c;
                $menu->save();

                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
