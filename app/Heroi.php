<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heroi extends Model
{
    protected $table = 'herois';

    public $timestamps = true;

    protected $fillable = [
		'nome',
		'vida',
		'defesa',
		'dano',
		'velocidade_ataque',
		'velocidade_movimento',
		'classe_id'
	];

    protected $guarded = [
		'created_at',
		'updated_at'
	];

	public function classe()
	{
		return $this->belongsTo(Classe::class, 'classe_id', 'id');
	}

	public function especialidade()
	{
		return $this->belongsToMany(Especialidade::class, 'especialidade_heroi', 'especialidade_id', 'heroi_id');
	}

	public function imagem()
	{
		return $this->hasMany(Imagem::class);
	}
}
