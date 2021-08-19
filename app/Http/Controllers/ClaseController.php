<?php

namespace App\Http\Controllers;

use App\Clase;
use Illuminate\Http\Request;
use App\Http\Requests\ClaseStore;

class ClaseController extends Controller
{

    public function index(\App\Tutoria $tutoria)
    {
        $clases = $tutoria->clases()->get();
        return view('clases.index')->with(compact('clases', 'tutoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Tutoria $tutoria)
    {
        return view('clases.create_edit')->with(compact('tutoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Tutoria $tutoria, ClaseStore $request)
    {
        $data = $request->validated();
        $clase = $tutoria->clases()->create($data);
        return redirect()->route('clases.index', $tutoria);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Tutoria $tutoria, Clase $clase)
    {
        return view('clases.show')->with(compact('tutoria', 'clase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Tutoria $tutoria, Clase $clase)
    {
        return view('clases.create_edit')->with(compact('tutoria', 'clase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clase $clase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clase $clase)
    {
        //
    }
}
