<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('ipc_id')->default(0);
            $table->string('ipc_pn')->default('hz');
            $table->string('msk_t')->default(0);
            $table->string('msk_f')->default(0);
            $table->string('spb_t')->default(0);
            $table->string('spb_f')->default(0);
            $table->string('nsk_t')->default(0);
            $table->string('nsk_f')->default(0);
            $table->string('kja_t')->default(0);
            $table->string('kja_f')->default(0);
            $table->string('oms_t')->default(0);
            $table->string('oms_f')->default(0);
            $table->string('vvo_t')->default(0);
            $table->string('vvo_f')->default(0);
            $table->string('ikt_t')->default(0);
            $table->string('ikt_f')->default(0);
            $table->string('ekb_t')->default(0);
            $table->string('ekb_f')->default(0);
            $table->string('cek_t')->default(0);
            $table->string('cek_f')->default(0);
            $table->string('prm_t')->default(0);
            $table->string('prm_f')->default(0);
            $table->string('tjm_t')->default(0);
            $table->string('tjm_f')->default(0);
            $table->string('rst_t')->default(0);
            $table->string('rst_f')->default(0);
            $table->string('krr_t')->default(0);
            $table->string('krr_f')->default(0);
            $table->string('tot_t')->default(0);
            $table->string('tot_f')->default(0);
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
        Schema::dropIfExists('stocks');
    }
}
