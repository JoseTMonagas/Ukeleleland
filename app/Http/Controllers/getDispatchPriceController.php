<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class getDispatchPriceController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke($id)
  {
    $communePrice = DB::table('dispatch_prices')->where('commune_id', $id)->first();
    return response()->json($communePrice);
  }
}
