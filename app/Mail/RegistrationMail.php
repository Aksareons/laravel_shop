<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $orderItem;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $orderItem)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   //dd($this->order);
        return $this->view('mails.registration')->with([
            'order' => $this->order,
            'orderItem' => $this->orderItem,
        ]);
    }
}
