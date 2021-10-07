<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';

    protected $fillable = [
        'tipo','descripcion'
    ];

    public $timestamps = false;

    public function libros()
    {
        return $this->hasMany('App\Libros');
    }
}
