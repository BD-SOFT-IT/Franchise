<?php

namespace App\RbtMobileSms\Notifications;

use App\RbtMobileSms\Exception\InvalidMethodException;
use App\RbtMobileSms\MobileSms;
use Illuminate\Notifications\Notification;

class MobileSmsChannel {

    /**
     * @var MobileSms $client
     */
    protected $client;

    /**
     * @param MobileSms $client
     */
    public function __construct(MobileSms $client) {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     * @throws InvalidMethodException
     */
    public function send($notifiable, Notification $notification) {
        if (! $mobile = $notifiable->routeNotificationFor('mobile_sms')) {
            return;
        }

        $message = $notification->toMobileSms($notifiable);

        if (is_string($message)) {
            $message = new MobileSmsMessage($message);
        }

        $this->client->sendMessage($mobile, $message->content, $message->params, $message->headers);
    }
}
