<?php

namespace App\Notifications;

use App\RbtMobileSms\Notifications\MobileSmsChannel;
use App\RbtMobileSms\Notifications\MobileSmsMessage;
use Illuminate\Notifications\Notification;

class ClientVerifyMobile extends Notification
{
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [MobileSmsChannel::class];
    }


    public function toMobileSms($notifiable) {
        $msg = "Your verification Code: " . $this->token . ".\n-" . getSiteBasic('site_title');

        return (new MobileSmsMessage)
            ->content($msg);
    }
}
