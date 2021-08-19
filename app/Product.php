<?php

namespace App;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = ['CREATED_AT', 'UPDATED_AT'];
    protected $guarded = ['id'];


    /**
     * Retorna la Categoria de ese Producto
     *
     * @return \App\Categoria
     */
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }
  
    /**
     * Retorna el Pack de ese Producto
     *
     * @return \App\Pack
     */
    public function pack()
    {
        return $this->hasOne('App\Pack');
    }
  
    public function promos()
    {
        return $this->belongsToMany('App\Promo')->withTimestamps();
    }

    public function sales()
    {
        return $this->morphToMany('App\Sale', 'sellable')->withTimestamps()->withPivot('cantidad', 'precio');
    }

    public function getDisplayImgAttribute()
    {
        return asset('storage/' . $this->img[0]);
    }

    public function getDisplayPriceAttribute()
    {
	if ($this->hasDescuento()) {
		return  '$ ' . strval(number_format($this->descuento, 0, ",", ".")); 
	}
        return  '$ ' . strval(number_format($this->price, 0, ",", "."));
    }

    public function getImgAttribute($value)
    {
        $filter = json_decode($value);
        if (is_array($filter)) {
            return $filter;
        } else {
            return json_decode($filter);
        }
    }

    public function getDescuentoAttribute()
    {
        $promociones = $this->promos()->whereDate('inicio', '<=', date("Y-m-d"))->whereDate('fin', '>=', date("Y-m-d"))->latest()->get()->first();
	$discount = $promociones->discount()->get()->first();
        $tipo = $discount->tipo;
        $value = $discount->value;
        switch ($tipo) {
        case "percent":
            return $this->price - (($this->price * $value) / 100);
            break;
        case "fixed":
            return $this->price - $value;
            break;
        default:
            return $this->price;
            break;
        }
    }

    public function hasDescuento()
    {
        $promociones = $this->promos()->whereDate('inicio', '<=', date("Y-m-d"))->whereDate('fin', '>=', date("Y-m-d"))->get();
        if ($promociones->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStock($cantidad)
    {
        $this->stock -= $cantidad;

        if ($this->pack->count() > 0 && $this->pack->accesorios->count() > 0) {
            $accesorios = $this->pack->accesorios;
            $accesorios->map(function($acc) use ($cantidad) {
                $acc->stock -= $cantidad;
                $acc->saveOrFail();
            });
        }

        return $this->saveOrFail();
    }
}
