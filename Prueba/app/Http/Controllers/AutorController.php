<?php

namespace App\Http\Controllers;

use App\Autor;
use App\Http\Requests\CreateAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use Illuminate\Http\Request;

class AutorController extends Controller
{

    public function index()
    {
        return Autor::all();
    }

    public function store(CreateAutorRequest $request)
    {
       $input = $request->all();
       Autor::create($input);

       return response()->json([
           'res'=>true,
           'msj'=>'Registro creado!'
       ],200);
    }

    public function show($id)
    {
        return Autor::findOrfail($id);
    }

    public function update(UpdateAutorRequest $request, $id)
    {
        $input = $request->all();
        $autor = Autor::findOrfail($id);
        $autor->update($input);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro actualizado!'
        ],200);

    }

    public function destroy($id)
    {
        Autor::destroy($id);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro eliminado!'
        ],200);

    }
}
