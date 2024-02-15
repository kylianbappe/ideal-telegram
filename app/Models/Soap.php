<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soap extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'soap';

    protected $fillable = [
        'pasien',
        'dokter',
        'subjektif',
        'objektif',
        'assesment',
        'plan',
        'tindakan',
        'biaya',
        'tanggal',
        'jenis_pasien',
        'noresep',
        'reminder',
        'status_pembayaran',
        'invoice_id',
    ];

}
