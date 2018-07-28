<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendaProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda_produto', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer   ('id_venda');
            $table->integer   ('id_produto');
            $table->decimal   ('vep_qtde',      18, 4);
            $table->decimal   ('vep_preco',     18, 4)->default(0);
            $table->decimal   ('vep_desconto' , 18, 2)->default(0);
            $table->decimal   ('vep_total',     18, 2)->default(0);
            $table->timestamps();

            $table->foreign('id_venda')->references('id')->on('venda')->onDelete('cascade');
            $table->foreign('id_produto')->references('id')->on('produto')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venda_produto');
    }
}
