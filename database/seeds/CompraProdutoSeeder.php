<?php

use Illuminate\Database\Seeder;
use App\Compra_Produto as Compra_Produto;

class CompraProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('pt_BR');

        for ($i=0; $i < 100; $i++) 
        { 
        	$compraProduto = new Compra_Produto();

        	$id_produto 			   = rand(1, DB::table('produto')->max('id'));
        	$compraProduto->id_compra  = rand(1, DB::table('compra')->max('id'));
        	$compraProduto->id_produto = $id_produto;
        	$compraProduto->cpp_qtde   = rand(1, DB::table('produto')->select('pro_estoque')->where('id', $id_produto)->first()->pro_estoque);
            $compraProduto->cpp_desconto = $faker->randomFloat(2, 1, 10);
        	
            $compraProduto->save();
        }
    }
}
