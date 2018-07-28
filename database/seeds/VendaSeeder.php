<?php

use Illuminate\Database\Seeder;
use App\Venda as Venda;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        for ($i=0; $i < 900; $i++) 
        { 
	        $venda = new Venda();
	        $venda->id_usuario   = rand(1, DB::table('usuario')->max('id'));
	        $venda->id_cliente   = rand(1, DB::table('cliente')->max('id'));

            $venda->save();
            
            if($i === ($i / 10)) {
				DB::statement('COMMIT;');
			}
        }

    }
}
