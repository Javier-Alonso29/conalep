<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    public $table = 'documento';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'id_tipodocumento'
    ];

    /**
     * Un documento pertenece a un tipo de documento
     */
    public function tipo_documento()
    {
        return $this->belongsTo(Tipodocumento::class, 'id_tipodocumento');
    }

}