<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'pessoa';

    protected $guarded = ['id'];

    protected $fillable = 
    [
      'pes_nome',
      'pes_fantasia',
      'pes_fisica',
      'pes_cpfcnpj',
      'pes_rgie',
      'pes_endereco',
      'pes_numero',
      'pes_complemento',
      'pes_bairro',
      'pes_cidade',
      'pes_uf',
      'pes_cep',
      'pes_fone',
      'pes_fone2',
      'pes_email',
      'pes_ativo'
    ];

    protected $hidden = 
    [
      'created_at',
      'updated_at'
    ];

    public function cliente()
    {
        return $this->hasOne('App\Cliente', 'id_pessoa', 'id');
    }

    public function fornecedor()
    {
        return $this->hasOne('App\Fornecedor', 'id_pessoa', 'id');
    }
}
