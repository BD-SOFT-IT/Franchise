<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\RbtMobileSms\Notifications\MobileSmsChannel;
use App\RbtMobileSms\Notifications\MobileSmsMessage;

class OrderConfirmed extends Notification
{
    protected $secret;
    protected $order_no;

    /**
     * Create a new notification instance.
     *
     * @param $order_no
     * @param $secret
     */
    public function __construct($order_no, $secret) {
        $this->order_no = $order_no;
        $this->secret = $secret;
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
        $msg = "Your Order #" . $this->order_no . " has been confirmed. Use '" . $this->secret . "' as secret key at the time of
            taking delivery.\nHave a good day.\n-";
        $msg .= getSiteBasic('site_title');

        return (new MobileSmsMessage)
            ->content($msg);
    }
}
