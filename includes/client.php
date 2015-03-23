<?php

    class BIEClient
    {
        const URL = 'https://www.yurifarina.com/bie/api';
        const TOKEN = 'bie_token';

        private $token;

        public function __construct()
        {
            $this->blog = BIECore::blog();
            $this->token = get_option(self::TOKEN);
        }

        public function ready()
        {
            return (bool)$this->token;
        }

        public function call($operation, $params = array())
        {
            $url = self::URL . '/' . $operation;

            $params['blog'] = $this->blog;

            if($this->ready()) {
                $params['token'] = $this->token;
            }

            $response = wp_remote_post($url, array(
                'body' => $params,
                'timeout' => 0,
            ));

            if(is_wp_error($response)) {
                die($response->get_error_message());
            }

            $response = json_decode($response['body']);

            if(property_exists($response, 'error')) {
                if(is_object($response->error)) {
                    die($response->error->message);
                } elseif($response->code == 'invalid-session') {
                    throw new ClientInvalidSession();
                } else {
                    die($response->error);
                }
            }

            if(property_exists($response, 'token')) {
                update_option(self::TOKEN, $response->token);
            }

            return $response;
        }

        public function reset()
        {
            $this->token = null;
            delete_option(self::TOKEN);
        }
    }

    class ClientInvalidSession extends Exception { }

