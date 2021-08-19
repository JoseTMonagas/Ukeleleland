<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
  /**
   * Get All Regions
   *
   * @return \Illuminate\Http\Response
   */
  public function getAll()
  {
    $regions = Region::all();
    return $regions->toJson();
  }

  /**
   * Get Region by Id.
   *
   * @return \Illuminate\Http\Response
   */
  public function getById($id)
  {
    $region = Region::findOrFail($id);
    return $region;
  }
  
  
}
