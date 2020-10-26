<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = "Producto";
    protected $primaryKey = 'Codigo';
    public $timestamps = false;
    protected $fillable = [
        'Codigo',
        'CodigoCategoria',
        'CodigoMarca',
        'Tipo',
        'Negociable',
        'Nombre',
        'TipoControl',
        'Vigencia'
    ];
}
