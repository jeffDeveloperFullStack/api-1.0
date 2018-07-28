<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer   ('id_usuario');
            $table->integer   ('id_fornecedor');
            $table->decimal   ('cpr_valor',    18, 2)->default(0);
            $table->decimal   ('cpr_desconto', 18, 2)->default(0);
            $table->decimal   ('cpr_total',    18, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('usuario')->onDelete('cascade');
            $table->foreign('id_fornecedor')->references('id')->on('fornecedor')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
