<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\Interfaces;

use AltoAi\JaicpUsedeskIntegration\Integration\ApiRequests\JaicpApiRequest;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Ticket;

class JaicpInterface {
    
    protected $bot_answer;
    protected $transition;
    protected $state;
    protected $ticket;

    function __construct(Ticket $ticket){
        $this->ticket = $ticket;
    }

    function send_message(){
        $request = new JaicpApiRequest($_ENV['chat_api_url'], ['ticket' => $this->ticket]);
        $result = $request->make();

        $this->bot_answer = $result['body']['data']['replies'];
        $this->transition = $result['body']['data']['replies'][0]['transition'];
        $this->state = $result['body']['data']['replies'][0]['state'];

        return $result;
    }

    public function getBotAnswer(){
        return $this->bot_answer;
    }

    public function getTransition(){
        return $this->transition;
    }

    public function getState(){
        return $this->state;
    }

    public function getTicket(){
        return $this->ticket;
    }
}
