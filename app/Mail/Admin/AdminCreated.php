<?php

namespace App\Mail\Admin;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The Reset Token
     */
    protected $admin;
    protected $initial_password;

    /**
     * AdminCreated constructor.
     * @param Admin $admin
     * @param $initial_password
     */
    public function __construct(Admin $admin, $initial_password)
    {
        $this->admin = $admin;
        $this->initial_password = $initial_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.admin.created')
            ->subject(config('app.name') . ' Account Created')
            ->with([
                'name'      => $this->admin->name,
                'email'     => $this->admin->email,
                'password'  => $this->initial_password,
                'role'      => $this->admin->role->ar_title,
                'app_name'  => getSiteBasic('site_title')
            ]);
    }
}
