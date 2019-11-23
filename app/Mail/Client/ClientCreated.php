<?php

namespace App\Mail\Client;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The Reset Token
     */
    protected $client;
    protected $verification_url;


    /**
     * Client Created constructor.
     * @param Client $client
     * @param string $verification_url
     */
    public function __construct(Client $client, string $verification_url) {
        $this->client = $client;
        $this->verification_url = $verification_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.client.created')
            ->subject(getSiteBasic('site_title', config('app.name')) . ' Account Opening Confirmation')
            ->with([
                'name'      => $this->client->first_name,
                'email'     => $this->client->email,
                'url'       => $this->verification_url,
                'app_name'  => config('app.name')
            ]);
    }
}
