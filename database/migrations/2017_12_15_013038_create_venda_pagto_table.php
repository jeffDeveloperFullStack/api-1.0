<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendaPagtoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda_pagto', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer   ('id_formapagto');
            $table->integer   ('id_venda');
            $table->decimal   ('vdp_valor', 18, 2)->nullable();
            $table->timestamps();
            
            $table->foreign('id_formapagto')->references('id')->on('formapagto')->onDelete('cascade');
            $table->foreign('id_venda')->references('id')->on('venda')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venda_pagto');
    }
}
