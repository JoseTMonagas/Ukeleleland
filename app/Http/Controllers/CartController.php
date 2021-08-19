<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProduct(\App\Product $product)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            $msg = [
                "icon" => "warning",
                "title" => "¡Este Producto ya esta en tu Carrito!"
            ];
            return redirect()->back()->with(compact('msg'));
        }

        if ($product->stock < 1) {
            $msg = [
                "icon" => "danger",
                "title" => "¡Producto sin stock!",
            ];

            return redirect()->back()->with(compact('msg'));
        }

        if ($product->hasDescuento()) {
            Cart::add($product->id, $product->name, 1, $product->descuento)->associate('App\Product');
        } else {
            Cart::add($product->id, $product->name, 1, $product->price)->associate('App\Product');
        }


        $msg = [
            "icon" => "success",
            "title" => "¡Producto agregado al carrito!",
            "msg" => "Se agrego el producto: {$product->name} a tu carrito.",
            "confirmButtonText" => "<i class='fas fa-money-check-alt'></i> Pagar",
            "cancelButtonText" => "Seguir Comprando",
            "action" => route('sale.index')
        ];

        return redirect()->back()->with(compact('msg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBook($asset)
    {
        $asset = \App\Asset::where('id', $asset)->firstOrFail();
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($asset) {
            return $cartItem->id === $asset->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->back()->with(['msg' => '¡Este producto ya esta en tu carrito!', 'status' => 'error']);
        }

        Cart::add($asset->id, $asset->title, 1, $asset->price)->associate('App\Asset');

        return redirect()->back()->with(['msg' => '¡Producto agregado al carrito!', 'status' => 'ok']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Cart::update($request->input('rowId'), $request->input('qty'));

        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with(['msg' => 'Producto eliminado del carrito', 'status' => 'ok']);
    }

    /**
     * Empty the shopping cart
     *
     */
    public function empty()
    {
        Cart::destroy();
        return back();
    }

    /**
     * Check if the products already exist in the Cart
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function checkIfProductInCart($id)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
        if ($duplicates->isNotEmpty()) {
            return response(['message' => false], 422)->header('Content-Type', 'application/json');
        } else {
            return response(['message' => true], 200)->header('Content-Type', 'application/json');
        }
    }
}
