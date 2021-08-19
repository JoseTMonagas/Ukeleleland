<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::paginate(12);
        $msg = [
            "icon" => "info",
            "title" => "<h5 class='h1 text-primary'>Proximamente</h5>",
            'msg' => "<b>Metodos y cancioneros de Uke</b> <br /><div class='progress'><div class='progress-bar' role='progressbar' style='width: 75%;' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'>75%</div></div> <br /> Estamos en fase de pruebas. <br/ > <small class='text-muted'>Gracias por tu paciencia</small>"

        ];

        return view('assets')->with(compact('assets', 'msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        $similarAssets = Asset::all()->take(12);
        $msg = [
            "icon" => "info",
            "title" => "<h5 class='h1 text-primary'>Proximamente</h5>",
            'msg' => "<b>Metodos y cancioneros de Uke</b> <br /><div class='progress'><div class='progress-bar' role='progressbar' style='width: 75%;' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'>75%</div></div> <br /> Estamos en fase de pruebas. <br/ > <small class='text-muted'>Gracias por tu paciencia</small>"

        ];

        return view('asset')->with(compact('similarAssets', 'asset', 'msg'));
    }
}
