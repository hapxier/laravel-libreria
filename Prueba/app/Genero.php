<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'generos';

    protected $fillable = [
        'genero','descripcion'
    ];

    public $timestamps = false;

    public function libros()
    {
        return $this->hasMany('App\Libros');
    }
}
