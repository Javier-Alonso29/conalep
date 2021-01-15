<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    public $table = 'tipodocumento';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'codigo', 'descripcion',
    ];

}