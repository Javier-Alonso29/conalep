<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    public $table = 'ciclo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'inicio', 'conclusion',
    ];

    /**
     * Un cilo tiene muchos documentos
     */
    public function documentos()
    {
        return $this->hasMany(Documento::class,'id_ciclo');
    }
}
