<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedor';

    protected $fillable = 
    [
        'id_pessoa',
        'for_contato'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function compra()
    {
        return $this->hasMany('App\Compra', 'id');
    }

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa', 'id_pessoa');
    }
}
