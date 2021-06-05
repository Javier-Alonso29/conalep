<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcesoPersonal extends Model
{
    public $table = 'proceso_personal';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_subproceso', 'nombre', 'codigo', 'descripcion'
    ];

    /**
     * Un subproceso pertenece a un proceso
     */
    public function subproceso()
    {
        return $this->belongsTo(Subproceso::class, 'id_subproceso');
    }

    /**
     * Un subproceso tiene muchos documentos
     */
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'id_proceso_personal', 'id');
    }

}