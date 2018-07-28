<?php

use Illuminate\Database\Seeder;
use App\FormaPagto as FormaPagto;

class FormaPagtoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        $formaPagto = new FormaPagto();
        $formaPagto->fpg_nome = 'BOLETO BANCÁRIO';
        $formaPagto->save();

        $formaPagto = new FormaPagto();
        $formaPagto->fpg_nome = 'CARTÃO DE CREDITO';
        $formaPagto->save();

        $formaPagto = new FormaPagto();
        $formaPagto->fpg_nome = 'CARTÃO DE DEBIDO';
        $formaPagto->save();
    }
}
