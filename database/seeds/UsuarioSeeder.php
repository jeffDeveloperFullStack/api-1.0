<?php

use Illuminate\Database\Seeder;
use App\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        for ($i=0; $i < 10; $i++) 
        { 
	        $usuario = new Usuario();

	        $usuario->nome  		= $faker->name;
	        $usuario->email 		= $faker->freeEmail;
	        $usuario->senha 		= $faker->password;
	        $usuario->ativo 		= $faker->boolean(70);
	        //$usuario->rememberToken = $faker->iban
	        $usuario->save();
        }
    }
}
