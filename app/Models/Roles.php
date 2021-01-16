<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Roles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Un rol tiene muchos usuarios
     */
    public function users()
    {
        return $this->hasMany(User::class,'rol_id');
    }
}
