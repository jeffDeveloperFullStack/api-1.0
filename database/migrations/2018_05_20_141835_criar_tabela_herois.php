<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaHerois extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herois', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('vida');
            $table->integer('defesa');
            $table->integer('dano');
            $table->double('velocidade_ataque');
            $table->integer('velocidade_movimento');
            $table->integer('classe_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('herois', function($table) {
           $table->foreign('classe_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('herois');
    }
}
