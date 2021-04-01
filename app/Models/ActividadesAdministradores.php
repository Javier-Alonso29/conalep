<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ActividadesAdministradores extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','id_user', 'accion','created_at'
    ];


    /**
     * Los permisos tienen un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public $increments = true;

    

}