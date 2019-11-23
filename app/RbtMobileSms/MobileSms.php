<?php

namespace App\RbtMobileSms;

use App\RbtMobileSms\Exception\InvalidMethodException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class MobileSms {
    private static $client = null;
    private $config = [];
    private $request;
    private $response;
    private $responseCode;
    private $reasonPhrase;
    private $countryCode;

    /**
     * MobileSms constructor.
     */
    public function __construct() {
        $this->loadConfig();
        $this->createClient();
    }

    /**
     * Create new Guzzle Client
     *
     * @return $this
     */
    protected function createClient() {
        if(empty($this->config)) {
            $this->loadConfig();
        }
        if (!self::$client) {
            self::$client = new Client([
                'base_uri'          => $this->config['base_uri'],
                'timeout'           => $this->config['timeout'],
                'cookies'           => $this->config['cookies'],
                'allow_redirects'   => $this->config['allow_redirects']
            ]);
        }
        return $this;
    }

    /**
     * @return $this
     */
    protected function loadConfig() {
        if( file_exists( config_path('mobile-sms.php') ) ) {
            $this->config = require config_path('mobile-sms.php');
        }
        else {
            $this->config = require app_path('RbtMobileSms/config/mobile-sms.php');
        }
        return $this;
    }

    /**
     * @param $to
     * @param $msg
     * @param array|null $extra_params
     * @param array|null $extra_headers
     * @return $this
     * @throws InvalidMethodException
     */
    public function sendMessage($to, $msg, array $extra_params = null, array $extra_headers = null) {
        $request_method = isset($this->config['method']) ? strtoupper($this->config['method']) : 'GET';
        $uri = $this->config['uri'];

        $mobile = $this->addCountryCode($to);
        if (is_array($mobile)){
            $mobile = $this->composeBulkMobile($mobile, $this->config['array_to_string_connector']);
        }

        $headers = isset($this->config['headers']) ? $this->config['headers'] : [];

        $params = [
            $this->defaultParamName('api_key')  => $this->config['api_key'],
            $this->defaultParamName('sender')   => $this->config['sender'],
            $this->defaultParamName('sms_type') => $this->config['sms_type'],
            $this->defaultParamName('message')  => $msg,
            $this->defaultParamName('to')       => $mobile
        ];

        if($extra_params) {
            $params = array_merge($params, $extra_params);
        }
        if($extra_headers) {
            $headers = array_merge($headers, $extra_headers);
        }
        // Make Request
        $this->request = new Request($request_method, $uri, $headers);
        try {
            $this->request = new Request($request_method, $uri, $headers);
            if($request_method === 'GET') {
                $promise = $this->getClient()->sendAsync($this->request, [
                    'query' => $params
                ]);
            } else if($request_method === 'POST') {
                if(isset($this->config['json']) && $this->config['json']) {
                    $promise = $this->getClient()->sendAsync($this->request, [
                        'body' => json_encode($params)
                    ]);
                } else {
                    $promise = $this->getClient()->sendAsync($this->request, [
                        'body' => $params
                    ]);
                }
            } else {
                throw new InvalidMethodException(
                    sprintf('Only GET and POST methods are allowed!')
                );
            }
            $response = $promise->wait();
            $this->response = $response->getBody()->getContents();
            $this->responseCode = $response->getStatusCode();
            $this->reasonPhrase = $response->getReasonPhrase();

            Log::info('Mobile SMS Gateway Response Code: ' . $this->responseCode);
            Log::info('Mobile SMS Gateway Response Reason Phrase: ' . $this->reasonPhrase);
            Log::info("Mobile SMS Gateway Response Body: \n" . $this->response);

        } catch (RequestException $e) {
            if($e->hasResponse()) {
                $response = $e->getResponse();
                $this->response = $e->getResponseBodySummary($response);
                $this->responseCode = $response->getStatusCode();
                $this->reasonPhrase = $response->getReasonPhrase();

                Log::error('Mobile SMS Gateway Response Code: ' . $this->responseCode);
                Log::error('Mobile SMS Gateway Response Reason Phrase: ' . $this->reasonPhrase);
                Log::error("Mobile SMS Gateway Response Body: \n" . $this->response);
            }
        }

        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    private function defaultParamName(string $name) {
        return ( isset($this->config['default_params']) && isset($this->config['default_params'][$name]) && $this->config['default_params'][$name] )
            ? $this->config['default_params'][$name]
            : $name;
    }

    /**
     * Add country code to mobile
     *
     * @param array|string $mobile
     * @return array|string
     */
    private function addCountryCode($mobile) {
        if(!$this->countryCode) {
            $this->countryCode = $this->config['country_code'] ? $this->config['country_code'] : '880';
        }

        if (is_array($mobile)) {
            array_walk($mobile, function (&$value, $key) {
                $value = $this->startsWithCountryCode($value, $this->countryCode) ? $value : $this->countryCode . $value;
            });
            return $mobile;
        }
        return $this->startsWithCountryCode($mobile, $this->countryCode) ? $mobile : $this->countryCode . $mobile;
    }

    /**
     * For multiple mobiles
     *
     * @param array $mobile
     * @param string $glue
     * @return string
     */
    private function composeBulkMobile(array $mobile, string $glue = ',') {
        return implode($glue, $mobile);
    }

    /**
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    private function startsWithCountryCode(string $mobile, string $code = '880') : bool {
        return strpos($mobile, $code) === 0;
    }

    /**
     * Get Guzzle Http Client
     *
     * @return Client|null
     */
    public function getClient()  {
        return self::$client;
    }
    /**
     * Return Response
     *
     * @return string
     */
    public function response() {
        return $this->response;
    }
    /**
     * Return Request
     *
     * @return string
     */
    public function request() {
        return $this->request;
    }
    /**
     * Return Response Code
     *
     * @return string
     */
    public function getResponseCode() {
        return $this->responseCode;
    }

    /**
     * Return Response Reason Phrase
     *
     * @return string
     */
    public function getReasonPhrase() {
        return $this->reasonPhrase;
    }
}
