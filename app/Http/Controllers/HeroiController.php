<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;

class HeroiController extends Controller
{
    use RestControllerTrait;

    const MODEL = 'App\Heroi';

    protected $validationRules = [];

    /**
     * Manage index request
     * @param Request $request
     * @return type
     */
    public function index()
    {
        $m = self::MODEL;
        $data = $m::with('imagem', 'especialidade', 'classe')->get();
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
        $data = $m::where('id', $id)->with('imagem', 'especialidade', 'classe')->get();
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
            $heroi = Heroi::create($request->all());

            $heroi->imagem()->sync($request->input('imagens'));
            $heroi->especialidade()->sync($request->input('especialidades'));

            return $this->createdResponse($heroi);
        } catch(\Exception $ex) {
            $heroi = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($heroi);
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
        if (!$data = $m::find($id)) {
            return $this->notFoundResponse();
        }
        try {
            if($v->fails()) {
                throw new \Exception("ValidationException");
            }
            $data->fill($request->all());

            $data->imagem()->sync($request->input('imagens') ?? []);
            $data->especialidade()->sync($request->input('especialidades') ?? []);

            $data->save();
            return $this->showResponse($data);
        } catch(\Exception $ex) {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
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

        $imagemHeroi = Imagem::where('heroi_id', $id)->delete();

        $data->delete();
        return $this->deletedResponse();
    }
}
