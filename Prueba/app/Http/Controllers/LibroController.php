<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Libro;
use App\Tipo;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    
    public function index()
    {
        // return Libro::all();
        $libros = Libro::join('tipos','libros.id_tipo','=','tipos.id')
            ->join('generos','libros.id_genero','=','generos.id')
            ->join('autores','libros.id_autor','=','autores.id')
            ->select('libros.id', 'libros.id_tipo', 'libros.id_genero', 'libros.id_autor', 'libros.titulo', 'tipos.tipo', 'generos.genero', 'autores.nombre',)
            ->orderBy('libros.id','asc')
            ->get();
        return $libros;
    }

    
    public function store(CreateLibroRequest $request)
    {
        $input = $request->all();
        Libro::create($input);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro creado!'
        ],200);
    }

    public function show($id)
    {
        // return Libro::findOrfail($id);
        $libro = Libro::join('tipos','libros.id_tipo','=','tipos.id')
            ->join('generos','libros.id_genero','=','generos.id')
            ->join('autores','libros.id_autor','=','autores.id')
            ->select('libros.id', 'libros.id_tipo', 'libros.id_genero', 'libros.id_autor', 'libros.titulo', 'tipos.tipo', 'generos.genero', 'autores.nombre',)
            ->where('libros.id','=',$id)
            ->orderBy('libros.id','asc')
            ->get();

        return $libro;
    }

    
    public function update(UpdateLibroRequest $request, $id)
    {
        $input = $request->all();
        $libro = Libro::findOrfail($id);
        $libro->update($input);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro actualizado!'
        ],200);
    }

    public function destroy($id)
    {
        Libro::destroy($id);

        return response()->json([
            'res'=>true,
            'msj'=>'Registro eliminado!'
        ],200);
    }

}
