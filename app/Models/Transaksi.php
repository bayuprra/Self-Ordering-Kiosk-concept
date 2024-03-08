<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'meja_id',
        'pembayaran',
        'total_belanja',
        'pajak',
        'subtotal',
        'status_pembayaran',
        'status'
    ];
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }
}
