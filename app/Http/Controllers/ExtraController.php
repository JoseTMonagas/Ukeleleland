<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraController extends Controller
{

    public function index()
    {
        return view('index');
    }
    
    
    public function preguntas_frecuentes()
    {
        return view('extras/preguntas_frecuentes');
    }
    
        public function sorteo_y_preventa()
    {
        return view('extras/sorteo_y_preventa');
    }

}