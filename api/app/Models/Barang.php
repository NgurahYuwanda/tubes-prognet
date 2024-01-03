<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'namabarang', 'harga', 'stok', 'satuan_id'];
    protected $with = ['satuan'];

    public function satuan()
    {
        return $this->belongsTo(Satuanbarang::class, 'satuan_id');
    }
}
