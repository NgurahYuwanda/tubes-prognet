<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = ['nomortransaksi', 'totalharga', 'user_id'];
    protected $with = ['user'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
