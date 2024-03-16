<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table = "order";
    protected $fillable = [
        'transaksi_id',
        'menu',
        'jumlah',
        'harga',
        'total',
        'status'
    ];
    public $timestamps = false;
}
