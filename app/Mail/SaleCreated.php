<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SaleCreated extends Mailable
{
    use Queueable, SerializesModels;
    protected $sale;
    protected $urls;
    protected $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Sale $sale, $urls, $admin = false)
    {
        $this->sale = $sale;
        $this->urls = $urls;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = route('sale.show', $this->sale->id);
        $sale = $this->sale;
        $links = $this->urls;
        $admin = $this->admin;
        return $this->from('aloha@ukelelelandbrand.cl')
            ->markdown('emails.orders.sale')
            ->with(compact('sale', 'links', 'url', 'admin'));
    }
}
