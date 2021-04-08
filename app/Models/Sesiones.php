<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Sesiones extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'ip_address', 'date_time',
    ];

    /**
     * Una sesión pertenece a un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public $timestamps = false;
}
