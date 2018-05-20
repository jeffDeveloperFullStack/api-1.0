<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $table = 'especialidades';

    public $timestamps = true;

    protected $fillable= [
		'nome',
		'descricao'
	];

    protected $guarded = [
		'created_at',
		'updated_at'
	];

	public function heroi()
	{
		return $this->belongsToMany(Heroi::class, 'especialidade_heroi', 'especialidade_id', 'heroi_id');
	}
}
