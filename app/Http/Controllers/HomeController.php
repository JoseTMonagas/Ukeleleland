<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $latest = Product::latest()->take(12)->get();
    $popular = Product::inRandomOrder()->limit(12)->get();
    $superiorLg = DB::table('carousel_superiors')->where('type', 'lg')->get();
    $superiorXs = DB::table('carousel_superiors')->where('type', 'xs')->get();
    $inferiorLg = DB::table('carousel_inferiors')->where('type', 'lg')->get();
    $inferiorXs = DB::table('carousel_inferiors')->where('type', 'xs')->get();
    $promos = \App\Promo::where('destacado', true)->latest()->get()->take(2);
    return view('home')->with(compact('latest', 'popular', 'promos', 'superiorXs', 'superiorLg', 'inferiorXs', 'inferiorLg'));
  }
}
