<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'pasien';

    protected $fillable = [
        'nama',
        'kelamin',
        'lahir',
        'alamat',
        'nik',
        'nkp',
        'telpon',
        'jenis',
        'dokter',
        'tanggal'
    ];

}
