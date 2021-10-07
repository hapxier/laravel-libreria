<?php

namespace App\Http\Controllers;

use App\Genero;
use App\Http\Requests\CreateGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    
    public function index()
    {
        return Genero::all();
    }

    
    public function store(CreateGeneroRequest $request)
    {
        $input = $request->all();
        Genero::create($input);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro creado!'
        ], 200);
    }

    
    public function show($id)
    {
        return Genero::findOrfail($id);
    }

    
    public function update(UpdateGeneroRequest $request, $id)
    {
        $input = $request->all();
        $genero = Genero::findOrfail($id);
        $genero->update($input);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro actualizado!'
        ], 200);
    }

    
    public function destroy($id)
    {
        Genero::destroy($id);
        return response()->json([
            'res'=>true,
            'msj'=>'Registro eliminado!'
        ], 200);
    }
}
