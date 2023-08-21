<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\Interfaces;

use AltoAi\JaicpUsedeskIntegration\Integration\ApiRequests\JaicpApiRequest;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Ticket;

class JaicpInterface {
    
    public $bot_answer;
    public $transition;
    public $state;
    private $ticket;

    function __construct(Ticket $ticket){
        $this->ticket = $ticket;
    }

    function send_message(){
        $request = new JaicpApiRequest($_ENV['chat_api_url'], ['ticket' => $this->ticket]);
        $result = $request->make();

        $this->bot_answer = $result['data']['replies'];
        $this->transition = $result['data']['replies'][0]['transition'];
        $this->state = $result['data']['replies'][0]['state'];

        return $result;
    }
}
