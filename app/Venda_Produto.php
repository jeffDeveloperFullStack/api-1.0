<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda_Produto extends Model
{
    protected $table = 'venda_produto';

    protected $fillable = 
    [
      'id_venda',
      'id_produto',
      'vep_qtde',
      'vep_preco',
      'vep_desconto',
      'vep_total'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function venda()
    {
        return $this->belongsTo('App\Venda', 'id_venda');
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'id_produto');
    }
}
