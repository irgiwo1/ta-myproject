<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setoran';

    protected $primaryKey = 'id_setoran';

    protected $fillable = [
        'id_user',
        'id_lokasi',
        'jenis_setoran',
        'shift',
        'pendapatan_awal',
        'pengeluaran',
        'pendapatan_akhir',
        'pendapatan_sistem',
        'selisih_setoran',
        'keterangan',
        'tanggal_transaksi',
        'nomor_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id_lokasi');
    }
}
