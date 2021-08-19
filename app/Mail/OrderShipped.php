<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    protected $sale;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sale)
    {
        $this->sale = $sale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sale = $this->sale;
        $url = route('sale.show', $sale->id);
        return $this->from('aloha@ukelelelandbrand.cl')
            ->markdown('emails.orders.shipped')
            ->with(compact('sale', 'url'));
    }
}
