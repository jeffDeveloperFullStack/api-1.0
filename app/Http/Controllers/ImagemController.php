<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;

class ImagemController extends Controller
{
    use RestControllerTrait;

    const MODEL = 'App\Imagem';

    protected $validationRules = [];
}
