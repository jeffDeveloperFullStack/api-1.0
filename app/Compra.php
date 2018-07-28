<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';

    protected $fillable = 
    [
      'id_user',
      'id_fornecedor',
      'cpr_valor',
      'cpr_desconto',
      'cpr_total'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function compraProduto()
    {
        return $this->hasMany('App\Compra_Produto', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    
    public function fornecedor()
    {
        return $this->belongsTo('App\Fornecedor', 'id_fornecedor');
    }

}
