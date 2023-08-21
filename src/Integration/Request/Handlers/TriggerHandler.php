<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\Request\Handlers;

use AltoAi\JaicpUsedeskIntegration\Integration\Request\RequestHandler;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Ticket;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Trigger;

class TriggerHandler implements RequestHandler{
    private $trigger;
    
    public function __construct($requestData)
    {
        $this->trigger = new Trigger($requestData);
    }

    public function handleRequest($requestData)
    {
        return true;
    }

    public function getTicket() : Ticket {
        return $this->trigger->getTicket();
    }

    public function botCanAnswer() : bool {
        return true;
    }
}
