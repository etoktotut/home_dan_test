<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIPCSTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipcs', function (Blueprint $table) {
            $table->id();
            $table->string('pn');
            $table->unsignedTinyInteger('vendor_id');
            $table->unsignedTinyInteger('type_id');
            $table->string('small_image');
            $table->unsignedTinyInteger('lenstype_id');
            $table->string('sens_size');
            $table->string('resolution');
            $table->unsignedTinyInteger('resolution_MP');
            $table->float('near_fl',4,2);
            $table->float('far_fl',6,2)->nullable();
            $table->float('zoomx',4,1)->nullable();
            $table->float('h_angle_wide',5,2)->default(0);
            $table->float('h_angle_tele',5,2)->nullable();
            $table->unsignedTinyInteger('streams')->default(1);
            $table->string('codecs')->default('H.264');
            $table->string('power_type')->default('PoE');
            $table->float('power_consumption',5,2)->default(0);
            $table->unsignedTinyInteger('lighttype_id')->default(1);
            $table->unsignedSmallInteger('light_distance')->default(0);
            $table->boolean('mic')->default(false);
            $table->boolean('audion_in')->default(false);
            $table->boolean('audio_out')->default(false);
            $table->unsignedTinyInteger('alarm_in')->default(0);
            $table->unsignedTinyInteger('alarm_out')->default(0);
            $table->unsignedTinyInteger('hight_temp')->default(40);
            $table->tinyInteger('low_temp')->default(-1);
            $table->string('protection_class')->nullable();
            $table->integer('micro_sd')->default(0);
            $table->boolean('wifi')->default(false);
            $table->boolean('is_rchive')->default(false);
            $table->boolean('is_eol')->default(false);
            $table->text('fromprice_description',500)->nullable();
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
        Schema::dropIfExists('ipcs');
    }
}
