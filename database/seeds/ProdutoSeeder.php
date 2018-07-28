<?php

use Illuminate\Database\Seeder;
use App\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        for ($i=0; $i < 200; $i++) 
        { 
            $produto = new Produto();

	        $produto->pro_nome     = $faker->name;
	        $produto->pro_unidade  = $faker->randomElement(array(1, 2));
	        $produto->pro_preco    = $faker->randomFloat(2, 1, 100);
	        $produto->pro_custo    = $faker->randomFloat(2, 1, 100);
	        $produto->pro_atacado  = $faker->randomFloat(2, 1, 100);
	        $produto->pro_min      = $faker->randomFloat(2, 1, 100);
	        $produto->pro_max	   = $faker->randomFloat(2, 1, 100);
	        $produto->pro_foto	   = 'imagem_produto_000'.$i.'.jpg';
	        $produto->pro_ativo    = $faker->boolean(70);
            
			$produto->save();        
        }
    }
}
