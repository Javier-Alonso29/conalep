<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Models
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'municipio_id','numero','clave_trabajo'
    ];
}
