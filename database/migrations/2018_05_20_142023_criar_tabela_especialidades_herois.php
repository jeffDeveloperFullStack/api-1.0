<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaEspecialidadesHerois extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidade_heroi', function (Blueprint $table) {
            $table->integer('especialidade_id')->unsigned();
            $table->integer('heroi_id')->unsigned();
        });
        
        Schema::table('especialidade_heroi', function($table) {
           $table->foreign('especialidade_id')->references('id')->on('especialidades');
        });

        Schema::table('especialidade_heroi', function($table) {
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
        Schema::drop('especialidade_heroi');
    }
}
