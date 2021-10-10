<?php

namespace App\Mail;

use App\Models\BuyingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyingRequestUpdate extends Mailable
{
    use Queueable, SerializesModels;
    public $buyingRequest;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BuyingRequest $buyingRequest, $message)
    {
        $this->buyingRequest = $buyingRequest;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.buyin-request-update');
    }
}
