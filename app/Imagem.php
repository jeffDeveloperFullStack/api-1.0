<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    protected $table = 'imagens';

    public $timestamp = true;

    protected $fillable = [
    	'path',
    	'imagem',
    	'heroi_id'
    ];

    protected $guarded = [
    	'created_at',
    	'updated_at'
    ];

    public function heroi()
    {
        return $this->belongsTo(Heroi::class, 'heroi_id', 'id');
    }
}
