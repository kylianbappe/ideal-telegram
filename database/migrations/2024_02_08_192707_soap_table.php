<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soap', function (Blueprint $table) {
            $table->id();
            $table->string('pasien');
            $table->string('dokter');
            $table->text('subjektif');
            $table->text('objektif');
            $table->text('assesment');
            $table->text('plan');
            $table->text('tindakan');
            $table->string('biaya');
            $table->string('jenis_pasien');
            $table->string('tanggal');
            $table->integer('noresep');
            $table->integer('invoice_id')->nullable();
            $table->boolean('reminder')->default(false)->nullable();
            $table->boolean('status_pembayaran')->default(false)->nullable();
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
        Schema::dropIfExists('soap');
    }
}