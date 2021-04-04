<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Planteles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero','clave_trabajo','municipio_id'
    ];

    /**
     * Un plantel pertenece a un municipio
    */
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'municipio_id');
    }

    /**
     * Un plantel tiene muchos usuarios
     */
    public function usuarios()
    {
        return $this->hasMany(User::class,'id_plantel');
    }
}
