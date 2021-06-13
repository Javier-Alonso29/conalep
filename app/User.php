<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Roles;
use App\Models\Planteles;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','apellido_paterno', 'apellido_materno', 'email', 'password','rol_id','id_plantel','created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Un usuario tiene un rol
     */
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'rol_id');
    }

    /**
     * Un usuario pertenece a un plantel
     */
    public function plantel()
    {
        return $this->belongsTo(Planteles::class, 'id_plantel');
    }

    /**
     * Un usuario tiene muchos procesos
     */
    public function procesos()
    {
        return $this->belongsToMany('App\Models\Proceso');
    }
}
