<?php

use Illuminate\Database\Seeder;
use App\Venda_Pagto as VendaPagto;

class VendaPagtoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        for ($i=0; $i < 1000; $i++) 
        { 
	        $vendaPagto = new VendaPagto();
	        $vendaPagto->id_formapagto = rand(1, DB::table('formapagto')->max('id'));
	        $vendaPagto->id_venda      = rand(1, DB::table('venda')->max('id'));
            $vendaPagto->save();
            
            if($i === ($i / 10)) {
				DB::statement('COMMIT;');
			}
        }

    }
}
