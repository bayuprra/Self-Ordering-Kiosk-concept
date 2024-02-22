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
            ->get();
    }
}
