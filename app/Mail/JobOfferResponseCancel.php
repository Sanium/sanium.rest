<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobOfferResponseCancel extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'Someone has canceled their application for your offer.';
    /**
     * @var string
     */
    private $offer_name;
    /**
     * @var int
     */
    private $offer_id;
    /**
     * @var string
     */
    private $email;

    /**
     * Create a new message instance.
     *
     * @param $offer_id
     * @param $offer_name
     * @param $email
     */
    public function __construct($offer_id, $offer_name, $email)
    {
        $this->offer_name = $offer_name;
        $this->offer_id = $offer_id;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->markdown('emails.jor.cancel', [
            'offer_id' => $this->offer_id,
            'offer_name' => $this->offer_name,
            'email' => $this->email,
        ]);
    }
}
