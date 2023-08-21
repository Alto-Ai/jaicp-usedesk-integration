<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\ApiRequests;
use AltoAi\JaicpUsedeskIntegration\Common\Logger;

class ApiRequest {
    protected $url;
    protected $settings;
    protected $result;
    protected $status;

    function __construct($url, $settings = []){
        $this->url = $url;
        if ($settings){
            if (count($settings) > 0){
                $this->settings = $settings;
            }
        }
    }

    public function make(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        foreach ($this->get_settings() as $key => $value){
            curl_setopt($curl, $key, $value);
        }

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $this->result = json_decode($result, true);
        $toReturn = [
            'status' => $this->getStatus(),
            'body' => $this->getResult(),
        ];
        Logger::log_to_file("log", $toReturn);
        return $toReturn;
    }

    function getResult(){
        return $this->result;
    }

    function getStatus(){
        return $this->status;
    }

    function get_settings(){
        return $this->settings;
    }

    function set_settings($settings){
        $this->settings = $settings;
        return $this->settings;
    }
}
