<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) 
        {
            $table->increments('id')->index();
            $table->string    ('log_operacao', 12)->nullable();
            $table->string    ('log_tabela', 30)->nullable();
            $table->json      ('log_old')->nullable();
            $table->json      ('log_new')->nullable();
            $table->timestamp ('log_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log');
    }
}
