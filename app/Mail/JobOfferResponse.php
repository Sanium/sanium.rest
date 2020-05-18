<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobOfferResponse extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'Someone has applied to your offer.';
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $text;
    /**
     * @var string
     */
    private $pathToCV;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $text
     * @param string $pathToCV
     */
    public function __construct($name, $email, $text, $pathToCV)
    {
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
        $this->pathToCV = $pathToCV;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->markdown('emails.jor.response', [
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->text,
            'pathToCV' => $this->pathToCV
        ]);
    }
}
