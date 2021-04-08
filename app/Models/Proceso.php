<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'codigo', 'descripcion'
    ];

    /**
     * Un proceso tiene muchos subprocesos
     */
    public function subprocesos()
    {
        return $this->hasMany(Subproceso::class, 'id_proceso', 'id');
    }

    /**
     * Un proceso pertenece a varios usuarios
     */
    public function usuarios()
    {
        return $this->belongsToMany('App\User');
    }

}
