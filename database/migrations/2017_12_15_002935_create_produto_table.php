<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string    ('pro_nome', 80);
            $table->decimal   ('pro_estoque', 18, 2)->default(0)->nullable();
            $table->char      ('pro_unidade', 5);
            $table->decimal   ('pro_preco',   18, 2);
            $table->decimal   ('pro_custo',   18, 2);
            $table->decimal   ('pro_atacado', 18, 2);
            $table->decimal   ('pro_min',     18, 2);
            $table->decimal   ('pro_max',     18, 2);
            $table->string    ('pro_foto', 50)->nullable();
            $table->boolean   ('pro_ativo')->default(TRUE);
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
        Schema::dropIfExists('produto');
    }
}
