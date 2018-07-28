<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra_Produto extends Model
{
    protected $table = 'compra_produto';

    protected $fillable = 
    [
      'id_compra',
      'id_produto',
      'cpr_qtde',
      'cpr_preco',
      'cpr_desconto',
      'cpr_total'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function compra()
    {
        return $this->belongsTo('App\Compra', 'id_compra');
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'id_produto');
    }
}
