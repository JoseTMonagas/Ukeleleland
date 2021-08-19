<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function solicitar()
    {
        $profile = \Auth::user()->profile;
        return view('solicitar')->with(compact('profile'));
    }

    public function realizarSolicitud(Request $request, \App\Profile $profile)
    {
        $profile->price = $request->input('price');
        $profile->description = $request->input('description');
        $profile->modalidad = $request->input('modalidad');
        $profile->cantidad = $request->input('cantidad');
        $profile->user->role_id = 4;
        $profile->push();

        if($profile->saveOrFail()) {
            $msg = [
                "icon" => "success",
                "title" => "Tu solicitud fue recibida",
                "msg" => "Si eres aprobado, podras empezar a dar clases en nuestra plataforma, de lo contrario te contactaremos"
            ];

            return redirect()->route('home')->with(compact('msg'));
        } else {
            $msg = [
                "icon" => "error",
                "title" => "Tu solicitud no fue recibida",
                "msg" => "Ocurrio un error procesando tu solicitud, intenta de nuevo mas tarde"
            ];

            return redirect()->route('home')->with(compact('msg'));
        }
    }

    public function index()
    {
        $solicitantes = \App\User::where('role_id', 4)->get()->map(function($user) {
            return $user->profile;
        });
        return view('admin.solicitudes')->with(compact('solicitantes'));
    }

    public function revisar(\App\Profile $profile)
    {
        return view('admin.revision')->with(compact('profile'));
    }

    public function estado(\App\Profile $profile, $estado)
    {
        if ($estado) {
            $profile->user->role_id = 3;
        } else {
            $profile->user->role_id = 2;
        }

        $profile->push();

        return redirect()->route('tutor.index');
    }

}
