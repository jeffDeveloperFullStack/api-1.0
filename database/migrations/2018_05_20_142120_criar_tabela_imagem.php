<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaImagem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('imagem');
            $table->integer('heroi_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('imagens', function($table) {
           $table->foreign('heroi_id')->references('id')->on('herois');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imagens');
    }
}
