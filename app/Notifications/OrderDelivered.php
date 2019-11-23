<?php

namespace App\Notifications;

use App\RbtMobileSms\Notifications\MobileSmsChannel;
use App\RbtMobileSms\Notifications\MobileSmsMessage;
use Illuminate\Notifications\Notification;

class OrderDelivered extends Notification
{
    protected $order_no;

    /**
     * Create a new notification instance.
     *
     * @param $order_no
     */
    public function __construct($order_no) {
        $this->order_no = $order_no;
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
        $msg = "Your Order #" . $this->order_no . " has been successfully delivered.\n";
        $msg .= ("If you've any complain or query please call " . mobileNumber(getSiteBasic('site_mobile')));
        $msg .= ".\nThanks for shopping with us.\n-";
        $msg .= getSiteBasic('site_title');

        return (new MobileSmsMessage)
            ->content($msg);
    }
}
