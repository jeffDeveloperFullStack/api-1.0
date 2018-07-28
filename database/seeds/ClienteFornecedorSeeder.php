<?php

use Illuminate\Database\Seeder;
use App\Cliente as Cliente;
use App\Pessoa  as Pessoa;
use App\Fornecedor  as Fornecedor;

class ClienteFornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

      	for ($i=0; $i < 500; $i++) 
      	{ 
      		$pessoa = new Pessoa();

	      	$pessoa->pes_nome 		 = $faker->name;
	      	$pessoa->pes_fantasia 	 = $faker->company;
	      	$pessoa->pes_fisica 	 = $faker->randomElement(array(0, 1));
	      	$pessoa->pes_cpfcnpj 	 = $faker->regexify('[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}');
	      	$pessoa->pes_rgie 		 = $faker->regexify('[0-9]{3}\.[0-9]{3}\-[0-9]{1}');
	      	$pessoa->pes_endereco 	 = $faker->address;
	      	$pessoa->pes_numero 	 = $faker->buildingNumber;
	      	$pessoa->pes_complemento = $faker->streetSuffix;
	      	$pessoa->pes_bairro 	 = $faker->citySuffix;
	      	$pessoa->pes_cidade 	 = $faker->city;
	      	$pessoa->pes_uf 		 = $faker->stateAbbr;
	      	$pessoa->pes_cep 		 = $faker->postcode;
	      	$pessoa->pes_fone 		 = $faker->phoneNumber;
	      	$pessoa->pes_fone2 		 = $faker->phoneNumber;
	      	$pessoa->pes_email 		 = $faker->freeEmail;
	      	$pessoa->pes_ativo 		 = $faker->boolean(70);

	      	$pessoa->save();

	      	if ($faker->boolean(80))
	      	{
		      	$cliente = new Cliente();
		      	$cliente->id_pessoa 	 = $pessoa->id;
		      	$cliente->cli_limitecred = $faker->regexify('[0-9]{5}\.[0-9]{2}');
		      	$cliente->save();
	      	}
	      	else
	      	{
		      	$fornecedor = new Fornecedor();
		      	$fornecedor->id_pessoa   = $pessoa->id;
		      	$fornecedor->for_contato = $faker->phoneNumber;
		      	$fornecedor->save();
			}
			  
			if($i === ($i / 10)) {
				DB::statement('COMMIT;');
			}
		}
	}
}