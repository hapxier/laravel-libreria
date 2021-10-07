<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoRequest;
use App\Http\Requests\UpdateTipoRequest;
use App\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
   
    public function index()
    {
        return Tipo::all();
    }

    
    public function store(CreateTipoRequest $request)
    {
        $input = $request->all();
        Tipo::create($input);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro creado!'
        ],200);
    }

    
    public function show($id)
    {
        return Tipo::findOrfail($id);
    }

    
    public function update(UpdateTipoRequest $request, $id)
    {
        $input = $request->all();
        $tipo = Tipo::findOrfail($id);
        $tipo->update($input);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro actualizado!'
        ],200);
    }

    
    public function destroy($id)
    {
        Tipo::destroy($id);
        return response()->json([
            'res'=>true,
            'msj'=>'Registro eliminado!'
        ],200);
    }

}
