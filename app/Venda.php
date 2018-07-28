<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'venda';

    protected $fillable = 
    [
      'id_user',
      'id_cliente',
      'vda_valor',
      'vda_desconto',
      'vda_total'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function vendaPagto()
    {
        return $this->hasMany('App\Venda_Pagto', 'id');
    }

    public function vendaProduto()
    {
        return $this->hasMany('App\Venda_Produto', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'id_cliente');
    }
}
