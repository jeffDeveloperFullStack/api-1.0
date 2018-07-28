<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produto';

    protected $fillable = 
    [
        'id',
        'pro_nome',
        'pro_estoque',
        'pro_unidade',
        'pro_preco',
        'pro_custo',
        'pro_atacado',
        'pro_min',
        'pro_max',
        'pro_foto',
        'pro_ativo',
    ];

    protected $hidden = 
    [
      'id',
      'created_at',
      'updated_at'
    ];

    public function vendaProduto()
    {
        return $this->hasMany('App\Venda_Produto', 'id');
    }

    public function compraProduto()
    {
        return $this->hasMany('App\Compra_Produto', 'id');
    }
}
