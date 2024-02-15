<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';

    protected $fillable = [
        'admin',
        'pasien',
        'jenis_pasien',
        'tindakan',
        'dokter',
        'modepembayaran',
        'totalharga',
        'tanggal',
        'id_invoice',
    ];
}
