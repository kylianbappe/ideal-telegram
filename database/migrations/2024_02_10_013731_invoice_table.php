<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function(Blueprint $table) {
            $table->id();
            $table->string('admin');
            $table->string('pasien');
            $table->string('jenis_pasien');
            $table->text('tindakan');
            $table->string('dokter');
            $table->string('modepembayaran');
            $table->string('totalharga');
            $table->string('tanggal');
            $table->integer('id_invoice');
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
        Schema::dropIfExist('invoice');
    }
}
