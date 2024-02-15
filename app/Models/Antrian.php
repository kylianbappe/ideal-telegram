<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;


    protected $table = 'antrian';

    protected $fillable = [
        'nkp',
        'nama',
        'dokter',
        'jenis',
        'selesai',
        'noresep',
    ];
}
