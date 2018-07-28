<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = 
    [
      'id_pessoa',
      'cli_limitecred'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function venda()
    {
        return $this->hasMany('App\Venda', 'id');
    }
    
    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa', 'id_pessoa');
    }
}
