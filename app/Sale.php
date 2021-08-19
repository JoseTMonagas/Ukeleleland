<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\SaleCreated;

class Sale extends Model
{
    protected $fillable = ['sesion', 'total', 'descuento', 'tipo_pago', 'profile'];

    /**
     * Retorna el Usuario que realizo esa Compra
     *
     * @return \App\User
     */
    public function users()
    {
        return $this->belongsToMany('\App\User');
    }

    public function assets()
    {
        return $this->morphedByMany('\App\Asset', 'sellable')->withTimestamps()->withPivot('cantidad', 'precio');
    }

    public function products()
    {
        return $this->morphedByMany('\App\Product', 'sellable')->withTimestamps()->withPivot('cantidad', 'precio');
    }

    public function getProfileAttribute($value)
    {
        return json_decode($value, true);
    }

    public function actualizarStock()
    {
        $productos = $this->products()->get();
        $productos->map(function($product) {
            $product->stock = $product->stock - $product->pivot->cantidad;
            $product->save();
        });
    }

    public function sendCreated()
    {
        $sale = $this;
        $assets = $this->assets()->get();
        $urls = [];
        foreach($assets as $asset) {
            array_push($urls, ['name' => $asset->title, 'url' => $asset->pivot->url]);
        }
        $email = filter_var($this->profile['email'], FILTER_VALIDATE_EMAIL);
        if ($email) {
            \Mail::to($this->profile['email'])->send(new SaleCreated($sale, $urls));

        }
        \Mail::to('aloha@ukelelandbrand.cl')->send(new SaleCreated($sale, $urls, true));
        
    }

    public function createTransaction()
    {
        $assets = $this->assets()->get();
        $sale = $this;

        foreach($assets as $asset) {
            $asset->openTransaction($sale);
        }
    }

}

