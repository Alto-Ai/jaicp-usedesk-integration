<?php
namespace AltoAi\JaicpUsedeskIntegration\Integration;
use AltoAi\JaicpUsedeskIntegration\Integration\Interfaces\JaicpInterface;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\Handlers\MessageHandler;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\Handlers\TriggerHandler;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\RequestHandler;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\RequestType;

class IntegrationService {
    protected $requestHandler;
    protected $requestType;

    public $ticket;

    public function __construct(RequestHandler $requestHandler, string $requestType)
    {
        $this->requestHandler = $requestHandler;
        $this->requestType = $requestType;
    }

    public function processRequest(){
        $this->ticket();

        if ($this->requestHandler->botCanAnswer()){
            $jaicpInterface = new JaicpInterface($this->ticket);
            $result = $jaicpInterface->send_message();
            return $result;
        }
        return $this->ticket;
    }

    private function ticket(){
        $this->ticket = $this->requestHandler->getTicket();
    }

    
}
