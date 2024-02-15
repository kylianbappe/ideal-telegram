<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PasienTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pasien')->insert([
            'nama'=>'Haaland',
            'kelamin'=> 'Laki-laki',
            'lahir'=>'16 Agustus 2001',
            'alamat'=>'Jakarta, SCBD',
            'nik'=>'33242572899',
            'nkp'=>'1252445936',
            'telpon'=>'0825626843',
            'jenis'=>'Asuransi Admedika',
            'dokter'=>'Drg. Alan',
            'tanggal'=>'10/02/2024',
        ]);
    }
}
