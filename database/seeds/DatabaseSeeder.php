<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ClienteFornecedorSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(CompraSeeder::class);
        $this->call(CompraProdutoSeeder::class);
        $this->call(VendaSeeder::class);
        $this->call(VendaProdutoSeeder::class);
        $this->call(FormaPagtoSeeder::class);
        $this->call(VendaPagtoSeeder::class);
    }
}
