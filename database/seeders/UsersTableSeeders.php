<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama'=>'Drg. Alan',
            'password'=> Hash::make('alan'),
            'email'=>'alan@dentika.co.id',
            'telpon'=>'0216333312',
            'isAdmin'=>false,
        ]);
    }
}
