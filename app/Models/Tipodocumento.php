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


    /**
     * Un tipo de documento puede tener muchos documentos
     */
    public function documento()
    {
        return $this->hasMany(Documento::class, 'id_tipodocumento');
    }

}