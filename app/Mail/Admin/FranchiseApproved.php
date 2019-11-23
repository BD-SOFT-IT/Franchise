<?php

namespace App\Mail\Admin;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FranchiseApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Reset Token
     */
    protected $franchise;


    /**
     * ClientCreated constructor.
     * @param Admin $franchise
     */
    public function __construct(Admin $franchise) {
        $this->franchise = $franchise;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin.franchiseApproved')
            ->subject(getSiteBasic('site_title', config('app.name')) . ' Franchise Account Approval Confirmation')
            ->with([
                'name'      => $this->franchise->first_name,
                'email'     => $this->franchise->email,
                'app_name'  => config('app.name')
            ]);
    }
}
