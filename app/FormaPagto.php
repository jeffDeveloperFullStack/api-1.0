<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPagto extends Model
{
    protected $table = 'formapagto';

    protected $fillable = 
    [
      'fpg_nome',
      'fpg_ativo'
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
}
