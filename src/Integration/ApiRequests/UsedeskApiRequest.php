<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\ApiRequests;

class UsedeskApiRequest extends ApiRequest {

    function get_settings(){
        $data = [
            'api_token' => $_ENV['usedesk_api_key'],
        ];

        foreach ($this->settings as $key => $value) {
            $data[$key] = $value;
        }

        return $this->set_settings([
            CURLOPT_URL => $this->url,
            CURLOPT_USERAGENT => 'PHP-MCAPI/2.0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $data
        ]);
    }
}
