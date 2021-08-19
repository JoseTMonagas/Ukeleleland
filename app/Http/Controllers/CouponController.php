<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $coupon = \App\Coupon::where('code', $request->input('code'))->get()->first();

      if (!isset($coupon)) {
            $msg = [
                "icon" => "danger",
                "title" => "¡Codigo Equivocado!"
            ];
            return redirect()->back()->with(compact('msg'));
    }

      $code = $coupon->code;
      $value = (floatval(str_replace(",", "", \Cart::subtotal())));
      $discount = $coupon->discountValue($value);
    $request->session()->put('coupon', [
      'name' => $code,
      'discount' => $discount,
    ]);

    $msg = [
        "icon" => "success",
        "title" => "¡Cupon Aplicado!"
    ];
    return redirect()->back()->with(compact('msg', 'discount'));
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    session()->forget('coupon');

    return back()->with('success_message', 'Cupon eliminado');
  }
}
