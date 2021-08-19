<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutoriaStore;
use App\Tutoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tutorias = $user->tutorias()->get();

        return view('tutoria.index')->with(compact('tutorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $estudiantes = $user->conversations->map(function($conversation) use ($user) {
            return $conversation->getOther($user);
        });
        return view('tutoria.create_edit')->with(compact('estudiantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TutoriaStore $request)
    {
        $data = collect($request->validated());
        $tutoria = \App\Tutoria::create($data->except('user_id')->toArray());
        $tutoria->users()->attach(Auth::user()->id, ["tipo" => "tutor"]);
        $tutoria->users()->attach($data['user_id'], ["tipo" => "estudiante"]);

        return redirect()->route('tutorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tutoria  $tutoria
     * @return \Illuminate\Http\Response
     */
    public function show(Tutoria $tutoria)
    {
        return view('tutoria.show')->with(compact('tutoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tutoria  $tutoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutoria $tutoria)
    {
        return view('tutoria.create_edit')->with(compact('tutoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tutoria  $tutoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutoria $tutoria)
    {
        //
    }
}
