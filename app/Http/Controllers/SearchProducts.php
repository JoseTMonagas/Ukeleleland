<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Http\Requests\SearchQuery;
use App\Product;
use Illuminate\Http\Request;

class SearchProducts extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SearchQuery $request)
    {
        $query = '%' . $request->validated()['query'] . '%';

        $ukeleles = Product::where('name', 'like', $query)->orWhere('slug', 'like', $query)->get();
        $ebooks = Asset::where('title', 'like', $query)->orWhere('title_sort', 'like', $query)->get();

        return view('busqueda')->with(compact('ukeleles', 'ebooks'));
    }
}
