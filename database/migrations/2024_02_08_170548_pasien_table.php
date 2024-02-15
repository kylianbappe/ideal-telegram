<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('lahir');
            $table->string('alamat');
            $table->string('nik')->unique();
            $table->string('nkp')->unique();
            $table->string('telpon')->unique();
            $table->string('jenis')->default('Pasien Umum')->nullable();
            $table->string('dokter')->nullable()->default(null);
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien');
    }
}
