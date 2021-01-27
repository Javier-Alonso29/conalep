<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PermisosProcesos extends Model
{

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'leer', 'descargar', 'subir', 'borrar', 'id_user', 'id_proceso','id_plantel',
    ];


    /**
     * Los permisos tienen un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    /**
     * Los permisos tienen un proceso
     */
    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    /**
     * Los permisos tienen un plantel
     */
    public function plantel()
    {
        return $this->belongsTo(Planteles::class, 'id_plantel');
    }
}