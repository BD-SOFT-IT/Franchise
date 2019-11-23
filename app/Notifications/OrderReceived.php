<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\RbtMobileSms\Notifications\MobileSmsChannel;
use App\RbtMobileSms\Notifications\MobileSmsMessage;

class OrderReceived extends Notification
{
    protected $order_no;
    protected $order_total;

    /**
     * Create a new notification instance.
     *
     * @param $order_no
     * @param $total
     */
    public function __construct($order_no, $total) {
        $this->order_no = $order_no;
        $this->order_total = $total;
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
        $msg = "Thanks for placing order with us. Your Order No: #";
        $msg .= ($this->order_no . ". Total: " . $this->order_total . " TK.\n-");
        $msg .= getSiteBasic('site_title');

        return (new MobileSmsMessage)
            ->content($msg);
    }
}
