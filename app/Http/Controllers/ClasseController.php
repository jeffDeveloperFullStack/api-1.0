<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;

class ClasseController extends Controller
{
    use RestControllerTrait;

    const MODEL = 'App\Classe';

    protected $validationRules = [];
}
