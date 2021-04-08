<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DateTime;
use Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Sesiones;
use Request;


class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $sesion = new Sesiones();
        $sesion->id_user = Auth::user()->id;
        $sesion->ip_address = Request::ip();
        $sesion->date_time = new DateTime();
        $sesion->save();
    }
}
