<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';

    protected $fillable = ['nombre','correo'];

    public $timestamps = false;

    public function libros()
    {
        return $this->hasMany('App\Libros');
    }
}
