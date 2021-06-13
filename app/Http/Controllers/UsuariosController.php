<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsuariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function validaUsuarios()
    {
        $user = User::findOrFail(Auth::user()->id);

        if($user->rol_id === 1){

            return redirect('/superusuario');

        }elseif($user->rol_id == 2){

            return redirect('/administrador');

        }elseif($user->rol_id == 3){
            
            return redirect('/SUEstatal');

        }else{
            return view('404');
        }
    }
}
