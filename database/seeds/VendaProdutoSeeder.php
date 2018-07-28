<?php

use Illuminate\Database\Seeder;
use App\Venda_Produto as VendaProduto;

class VendaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('pt_BR');

    	for ($i=0; $i < 400000; $i++) 
    	{ 
	        $vendaProduto = new VendaProduto();
	        $vendaProduto->id_venda     = rand(1, DB::table('venda')->max('id'));
	        $vendaProduto->id_produto   = rand(1, DB::table('produto')->max('id'));
	        $vendaProduto->vep_qtde     = rand(1, 10);
	        $vendaProduto->vep_desconto = $faker->randomFloat(2, 1, 10);
	        $vendaProduto->save();
    	}
    }
}
