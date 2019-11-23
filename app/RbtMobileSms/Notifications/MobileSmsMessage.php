<?php

namespace App\RbtMobileSms\Notifications;


class MobileSmsMessage {
    /**
     * The message content.
     *
     * @var string
     */
    public $content;
    /**
     * Additional Parameters.
     *
     * @var array
     */
    public $params = [];
    /**
     * Add Headers.
     *
     * @var array
     */
    public $headers = [];

    /**
     * Create a new message instance.
     *
     * @param string $content
     * @param array $params
     * @param array $headers
     */
    public function __construct(string $content = "", array $params = ['type' => 'text'], array $headers = []) {
        $this->content = $content;
        $this->params = $params;
        $this->headers = $headers;
    }
    /**
     * Set the message content.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content) {
        $this->content = $content;
        return $this;
    }
    /**
     * Set the message params.
     *
     * @param  array  $params
     * @return $this
     */
    public function params($params)
    {
        $this->params = $params;
        return $this;
    }
    /**
     * @param $headers
     * @return $this
     */
    public function headers($headers)
    {
        $this->headers = $headers;
        return $this;
    }
    /**
     * Set the message type.
     *
     * @return $this
     */
    public function unicode() {
        $this->params['type'] = 'unicode';
        return $this;
    }
}
