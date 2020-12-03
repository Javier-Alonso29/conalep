<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Models
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','estado_id'];
}
