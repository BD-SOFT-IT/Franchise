<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Reset Token
     */
    protected $token;
    protected $client;

    /**
     * Create a new message instance.
     * @param
     * @return void
     */
    public function __construct(Client $client, $token)
    {
        $this->token = $token;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset_password')
            ->subject('Reset your ' . config('app.name') . ' Password')
            ->with([
                'token'     => $this->token,
                'name'      => $this->client->first_name,
                'app_name'  => config('app.name')
            ]);
    }
}
