<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topup', function (Blueprint $table) {
            $table->id();
            $table->string('kd_topup');
            $table->integer('no_va');
            $table->datetime('tgl_topup');
            $table->foreignId('customer_id');
            $table->decimal('nilai');
            $table->integer('status_bayar');
            $table->datetime('expired_date');
            $table->string('tgl_bayar')->nullable();
            $table->string('via_bayar')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('topup');
    }
}
