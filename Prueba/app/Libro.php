<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';

    protected $fillable = [
        'id_tipo', 'id_genero', 'id_autor', 'titulo'
    ];

    public function tipo()
    {
        return $this->belongsTo('App\Tipo');
    }

    public function genero()
    {
        return $this->belongsTo('App\genero');
    }
    
    public function autor()
    {
        return $this->belongsTo('App\autor');
    }
}
