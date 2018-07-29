<?php

namespace App\Http\Controllers;

use App\Pessoa as Pessoa;
use App\Fornecedor as Fornecedor;
use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;

class FornecedorController extends Controller
{
    use RestControllerTrait;

    const MODEL = 'App\Fornecedor';

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
            $pessoaFornecedor = Pessoa::create($request->all());
            $pessoaFornecedor->fornecedor()->create($request->all());

            return $this->createdResponse($pessoaFornecedor);
        } catch(\Exception $ex) {
            $pessoaFornecedor = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($pessoaFornecedor);
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
        if (!$fornecedor = $m::find($id)) {
            return $this->notFoundResponse();
        }
        try {
            if($v->fails()) {
                throw new \Exception("ValidationException");
            }
            $fornecedor->fill($request->all());
            $fornecedor->save();

            $fornecedor->pessoa->fill($request->all());
            $fornecedor->pessoa->save();

            return $this->showResponse($fornecedor);
        } catch(\Exception $ex) {
            $fornecedor = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($fornecedor);
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
