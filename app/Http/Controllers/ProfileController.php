<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Profile;
use App\Region;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdate;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes = Commune::all()->map(function($commune) {
            return ["label" => $commune->name, "value" => $commune->id];
        });
        $profiles = \App\User::where('role_id', 3)->get()->map(function ($user) {
            return $user->profile;
        });

        if(\Auth::user()) {
            $clasesCount = \Auth::user()->tutorias->count();
        } else {
            $clasesCount = 0;
        }
        
        return view('ukeprofe.index')->with(compact('communes', 'profiles', 'clasesCount'));
    }

    /**
     * Muestra el listado de profesores segun la comuna
     *
     * @return \Illuminate\Http\Response
     */
    public function indexComuna(Request $request)
    {
        $comuna = Commune::find($request->input('search'));
        $communes = Commune::all()->map(function($commune) {
            return ["label" => $commune->name, "value" => $commune->id];
        });

        $profiles = $comuna->profiles()->whereHas('user', function($query) {
            return $query->where('role_id', 3);
        })->get();

        return view('ukeprofe.index')->with(compact('communes', 'profiles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('ukeprofe.show')->with(compact('profile'));
    }

    public function create()
    {
        $communes = \App\Commune::all();
        return view('perfil-create')->with(compact('communes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $communes = \App\Commune::all();
        return view('perfil-edit')->with(compact('profile', 'communes'));
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileUpdate $request)
    {
        $data = $request->validated();
        $profile = Profile::create($data);
        $profile->photo = $request->file('photo')->store('photos');
        if ($profile->saveOrFail()) {
            $msg = [
                'icon' => 'success',
                'title' => '¡Perfil Guardado!',
                'msg' => '¡Tu perfil ha sido guardado exitosamente!'
            ];

            return redirect()->route('home')->with(compact('msg'));
        } else {
            $msg = [
                'icon' => 'error',
                'title' => '¡Error!',
                'msg' => '¡Tu perfil no pudo ser guardado, intenta nuevamente mas tarde!'
            ];

            return redirect()->route('home')->with(compact('msg'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdate $request, Profile $profile)
    {
        $data = $request->validated();

        if (isset($data['name'])) {
            $profile->name = $data['name'];
        }
        if (isset($data['surname'])) {
            $profile->surname = $data['surname'];
        }
        if (isset($data['password'])) {
            if ($data['password'] == $data['password_confirmation']) {
                $profile->user->password = bcrypt($data['password']);
            } else {
                return back()->withErrors();
            }
        }
        if (isset($data['commune'])) {
            $profile->commune_id = $data['commune_id'];
        }
        if (isset($data['direccion'])) {
            $profile->address = $data['address'];
        }
        if (isset($data['phone'])) {
            $profile->phone = $data['phone'];
        }
        if (isset($data['photo'])) {
            $profile->photo = $request->file('photo')->store('photos');
        }

        $profile->push();

        $msg = [
            'icon' => 'success',
            'title' => '¡Perfil Guardado!',
            'msg' => '¡Tu perfil ha sido guardado exitosamente!'
        ];
        return redirect()->route('home')->with(compact('msg'));
    }

}
