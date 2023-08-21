<?php
namespace AltoAi\JaicpUsedeskIntegration\Integration;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\RequestHandler;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Ticket;

class IntegrationService {
    protected $requestHandler;
    protected $requestType;

    protected $ticket;

    public function __construct(RequestHandler $requestHandler, string $requestType)
    {
        $this->requestHandler = $requestHandler;
        $this->requestType = $requestType;
        $this->setTicket($requestHandler->getTicket());
    }

    public function processRequest(){

        return $this->requestHandler->handleRequest();
    }

    public function getTicket(){
        return $this->ticket;
    }

    protected function setTicket(Ticket $ticket){
        $this->ticket = $ticket;
    }

    
}
