<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;

class EspecialidadeController extends Controller
{
    use RestControllerTrait;

    const MODEL = 'App\Especialidade';

    protected $validationRules = [];
}
