<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeders::class);
        $this->call(PasienTableSeeders::class);
        $this->call(SoapTableSeeders::class);
        $this->call(ResepTableSeeders::class);
    }
}
