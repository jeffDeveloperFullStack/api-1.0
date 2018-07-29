<?php

namespace App\Http\Controllers;

use App\Pessoa as Pessoa;
use App\Cliente as Cliente;
use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;

class ClienteController extends Controller
{
    use RestControllerTrait;

    const MODEL = 'App\Cliente';

    protected $validationRules = [];

    protected $validationPatchRules = [];

    /**
     * Manage index request
     * @param Request $request
     * @return type
     */
    public function index()
    {
        $m = self::MODEL;
        $data = $m::with('pessoa')->paginate(10);
        return $this->listResponse($data);
    }

    /**
     * Manage show profile request
     * @param integer $id
     * @return type
     */
    public function show($id)
    {
        $m = self::MODEL;
        $data = $m::with('pessoa')->find($id);
        return $this->showResponse($data);
    }

    /**
     * Manage store request
     * @param Request $request
     * @return type
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), $this->validationRules);
        try {
            if ($v->fails()) {
                throw new \Exception("ValidationException");
            }
            $pessoa = Pessoa::create($request->all());
            $pessoa->cliente()->create($request->all());

            return $this->createdResponse($pessoa);
        } catch(\Exception $ex) {
            $pessoa = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($pessoa);
        }
    }

    /**
     * Manage update request
     * @param type $id
     * @param Request $request
     * @return type
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $m = self::MODEL;
        $v = \Validator::make($request->all(), $this->validationPatchRules);
        if (!$cliente = $m::find($id)) {
            return $this->notFoundResponse();
        }
        try {
            if($v->fails()) {
                throw new \Exception("ValidationException");
            }
            $cliente->fill($request->all());
            $cliente->save();

            $cliente->pessoa->fill($request->all());
            $cliente->pessoa->save();

            return $this->showResponse($cliente);
        } catch(\Exception $ex) {
            $cliente = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($cliente);
        }
    }

    /**
     * Manage delete request
     * @param type $id
     * @return type
     */
    public function destroy($id)
    {
        $m = self::MODEL;
        if(!$data = $m::find($id)) {
            return $this->notFoundResponse();
        }
        $data->pessoa()->delete();
        return $this->deletedResponse();
    }
}
