<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer   ('id_pessoa');
            $table->decimal   ('cli_limitecred', 18, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_pessoa')->references('id')->on('pessoa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
