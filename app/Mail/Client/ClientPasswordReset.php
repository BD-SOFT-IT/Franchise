<?php

namespace App\Mail\Client;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientPasswordReset extends Mailable
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
        $title = getSiteBasic('site_title', config('app.name'));
        return $this->view('emails.client.password-reset')
            ->subject('Reset your "' . $title . '" Account Password')
            ->with([
                'name'      => $this->client->first_name,
                'email'     => $this->client->email,
                'url'       => route('password.reset', ['token' => $this->token, 'email' => $this->client->email]),
                'app_name'  => $title,
                'code'      => $this->token
            ]);
    }
}
