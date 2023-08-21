<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\ApiRequests;

class ApiRequest {
    protected $url;
    protected $settings;
    public $result;

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
        curl_close($curl);
        $this->result = json_decode($result, true);

        return $this->result;
    }

    function get_settings(){
        return $this->settings;
    }

    function set_settings($settings){
        $this->settings = $settings;
        return $this->settings;
    }
}
