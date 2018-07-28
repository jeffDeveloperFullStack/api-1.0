<?php

use Illuminate\Database\Seeder;
use App\Compra as Compra;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('pt_BR');

    	for ($i=0; $i < 5000; $i++) 
    	{ 
	    	$compra = new Compra();
	    	
	    	$compra->id_usuario    = rand(1, DB::table('usuario')->max('id'));
	    	$compra->id_fornecedor = rand(1, DB::table('fornecedor')->max('id'));
	    	$compra->cpr_valor     = $faker->randomFloat(2, 1, 100);
	    	$compra->cpr_desconto  = $faker->randomFloat(2, 1, 100);
	    	
	    	$compra->save();
    	}
        
    }
}
