<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string    ('pes_nome', 80);
            $table->string    ('pes_fantasia')->nullable();
            $table->boolean   ('pes_fisica');
            $table->string    ('pes_cpfcnpj', 20);
            $table->string    ('pes_rgie',    20);
            $table->string    ('pes_endereco',120);
            $table->char      ('pes_numero',  6);
            $table->string    ('pes_complemento', 30)->nullable();
            $table->string    ('pes_bairro', 50);
            $table->string    ('pes_cidade', 80);
            $table->char      ('pes_uf',     2);
            $table->string    ('pes_cep',    9);
            $table->string    ('pes_fone',  30);
            $table->string    ('pes_fone2', 30)->nullable();
            $table->string    ('pes_email', 50);
            $table->boolean   ('pes_ativo')->default(TRUE);
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
        Schema::dropIfExists('pessoa');
    }
}
