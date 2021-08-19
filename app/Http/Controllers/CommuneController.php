<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Region;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
  /**
   * Get Commune by their Id
   *
   * @return \Illuminate\Http\Response
   */
  public function getById($id)
  {
    $commune = Commune::find($id);
    return $commune->toJson();
  }
  
  /**
   * Get Communes by Region Id
   *
   * @return \Illuminate\Http\Response
   */
  public function getByRegion($id)
  {
    $region = Region::find($id);
    return ($region->communes->toJson());
  }
  
}
