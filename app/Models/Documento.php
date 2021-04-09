<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    public $table = 'documento';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'id_tipodocumento', 'id_subproceso',
    ];

    /**
     * Un documento pertenece a un tipo
     */
    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumento::class, 'id_tipodocumento');
    }

    /**
     * Un documento pertenece a un subproceso
     */
    public function subproceso()
    {
        return $this->belongsTo(Subproceso::class, 'id_subproceso');
    }
}