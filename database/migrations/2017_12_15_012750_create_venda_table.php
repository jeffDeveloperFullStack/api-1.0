<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer   ('id_usuario');
            $table->integer   ('id_cliente');
            $table->decimal   ('vda_valor', 18, 2)->nullable();
            $table->decimal   ('vda_desconto', 18, 2)->default(0);
            $table->decimal   ('vda_total', 18, 2)->nullable();
            $table->timestamps();
            
            $table->foreign('id_usuario')->references('id')->on('usuario')->onDelete('cascade');
            $table->foreign('id_cliente')->references('id')->on('cliente')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venda');
    }
}
