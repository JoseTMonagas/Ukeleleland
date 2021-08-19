<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null, Request $request)
    {
        $categories = \App\Categoria::all();
        $banner = setting('site.bannerUkeleles');

        if (isset($slug)) {
            $current = $slug;
            $categoria = \App\Categoria::where('slug', $slug)->first();
            $banner = $categoria->banner;
            $header = $categoria->header;
            $products = Product::with('categoria')->whereHas('categoria', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
            if ($request->has('tipo') && $request->has('precio') && $request->has('orden')) {
                $type = ($request->input('tipo') == 'mayor' ? '>=' : '<=');
                $precio = floatval($request->input('precio'));
                $products = $products->where('price', $type, $precio)->orderBy('price', $request->input('orden'))->paginate(12);
            } else {
                $products = $products->paginate(12);
            }
            return view('products')->with(compact('products', 'categories', 'current', 'banner', 'header'));
        } else {
            if ($request->has('tipo') && $request->has('precio') && $request->has('orden')) {
                $type = ($request->input('tipo') == 'mayor' ? '>=' : '<=');
                $precio = $request->input('precio');
                $price = (isset($precio) && is_numeric($precio)) ? floatval($precio) : 0;
                $products = Product::where('price', $type, $price)->orderBy('price', $request->input('orden'))->paginate(12);
                $current = ($request->has('current') ? $request->input('current') : '');

                return view('products')->with(compact('products', 'categories', 'banner', 'current'));
            } else {
                $products = Product::paginate(12);
                return view('products')->with(compact('products', 'categories', 'banner'));
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $similarProducts = Product::all()->take(12);
        $product = Product::where('slug', $slug)->firstOrFail();
        $pack = (isset($product->pack)) ? $product->pack->accesorios : collect([]);
        $images = $product->images;

        return view('product')->with(compact('similarProducts', 'product', 'images', 'pack'));
    }

    /**
     * Buscar un producto
     *
     * @return \Illuminate\Http\Response
     */
    public function search($string)
    {
        $productos = \App\Producto::where('name', $string)->get();
    }
  
}
