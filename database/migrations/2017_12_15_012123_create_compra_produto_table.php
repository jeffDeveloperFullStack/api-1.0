<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_produto', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer   ('id_compra');
            $table->integer   ('id_produto');
            $table->decimal   ('cpp_qtde',    18 , 4);
            $table->decimal   ('cpp_preco',   18, 2);
            $table->decimal   ('cpp_desconto',18, 2)->default(0);
            $table->decimal   ('cpp_total',   18, 2);
            $table->timestamps();
            
            $table->foreign('id_compra')->references('id')->on('compra')->onDelete('cascade');
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
        Schema::dropIfExists('compra_produto');
    }
}
