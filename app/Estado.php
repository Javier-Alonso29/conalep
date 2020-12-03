<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class State
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];
}
