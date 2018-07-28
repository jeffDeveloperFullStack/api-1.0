<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda_Pagto extends Model
{
    protected $table = 'venda_pagto';

    protected $fillable = 
    [
      'id_formapagto',
      'id_venda',
      'vdp_valor'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function formaPagto()
    {
        return $this->belongsTo('App\FormaPagto', 'id_formapagto');
    }

    public function venda()
    {
        return $this->belongsTo('App\Venda', 'id_venda');
    }
}
