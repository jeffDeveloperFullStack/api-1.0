<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;

class ProdutoController extends Controller
{
    use RestControllerTrait;

    const MODEL = 'App\Produto';

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
        $data = $m::paginate(10);
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
        $data = $m::find($id);
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
            $m = self::MODEL;
            $produto = $m::create($request->all());

            return $this->createdResponse($produto);
        } catch(\Exception $ex) {
            $produto = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($produto);
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
        if (!$produto = $m::find($id)) {
            return $this->notFoundResponse();
        }
        try {
            if($v->fails()) {
                throw new \Exception("ValidationException");
            }
            $produto->fill($request->all());
            $produto->save();

            return $this->showResponse($produto);
        } catch(\Exception $ex) {
            $produto = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($produto);
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
        $data->delete();
        return $this->deletedResponse();
    }
}
