<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class County
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','estado_id'];
}
