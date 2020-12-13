<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'id_pembayaran', 'nama', 'tanggal_bayar', 'jumlah_bayar', 'nama_pengirim','image'
    ];
}
