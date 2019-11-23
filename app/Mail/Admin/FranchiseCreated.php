<?php

namespace App\Mail\Admin;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FranchiseCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Reset Token
     */
    protected $franchise;
    protected $password;


    /**
     * ClientCreated constructor.
     * @param Admin $franchise
     * @param string $password
     */
    public function __construct(Admin $franchise, string $password) {
        $this->franchise = $franchise;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin.franchiseCreated')
            ->subject(getSiteBasic('site_title', config('app.name')) . ' Franchise Account Created')
            ->with([
                'name'      => $this->franchise->first_name,
                'email'     => $this->franchise->email,
                'password'  => $this->password,
                'app_name'  => config('app.name')
            ]);
    }
}
