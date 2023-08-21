<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\ApiRequests;

class JaicpApiRequest extends ApiRequest{
    private $ticket;

    public function __construct($url, $settings = [], $process_now = false)
    {
        $this->url = $url;
        foreach ($settings as $key => $value) {
            $this->$key = $value;
        }
    }

    function get_settings(){
        $data = [
            'clientId' => $this->ticket->getClientId(),
            'query' => $this->ticket->query(),
            'data' => [
                "channel" => $this->ticket->getPlatform()
            ]
        ];
        $data = json_encode($data);
        return $this->set_settings([
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
        ]);
    }
}
