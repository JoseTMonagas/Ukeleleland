<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowMiPerfil extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        if (!isset($user->profile)) {
            return redirect()->route('profile.create');
        }
        $profile = $user->profile()->first();
        $historial = $user->sales()->get();

        return view('mi-perfil')->with(compact('user', 'profile', 'historial'));
    }
}
