<?php

namespace App\Mail\Admin;

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
    protected $password;


    /**
     * Client Created constructor.
     * @param Client $client
     * @param string $password
     */
    public function __construct(Client $client, string $password) {
        $this->client = $client;
        $this->password = $password;
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
                'password'  => $this->password,
                'app_name'  => config('app.name')
            ]);
    }
}
