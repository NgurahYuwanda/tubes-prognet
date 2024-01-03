<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpenjualan extends Model
{
    use HasFactory;
    protected $fillable = ['penjualan_id', 'barang_id', 'kuantitas'];
    protected $with = ['penjualan', 'barang'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
