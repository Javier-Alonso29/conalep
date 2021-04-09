<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subproceso extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'codigo', 'descripcion', 'id_proceso',
    ];

    /**
     * Un subproceso pertenece a un proceso
     */
    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    /**
     * Un subproceso tiene muchos documentos
     */
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'id_subproceso', 'id');
    }
}
