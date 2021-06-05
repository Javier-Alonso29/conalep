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
        'nombre', 'id_tipodocumento', 'id_proceso_personal',
    ];

    /**
     * Un documento pertenece a un tipo
     */
    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumento::class, 'id_tipodocumento');
    }

    /**
     * Un documento pertenece a un proceso personal
     */
    public function procesopersonal()
    {
        return $this->belongsTo(ProcesoPersonal::class, 'id_proceso_personal');
    }
}