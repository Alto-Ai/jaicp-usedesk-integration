<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\Request\Handlers;

use AltoAi\JaicpUsedeskIntegration\Integration\Interfaces\JaicpInterface;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\RequestHandler;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Ticket;

class MessageHandler implements RequestHandler{
    protected $ticket;
    protected $chat_id;
    protected $from;
    protected $platform;

    public function __construct($requestData)
    {
        $this->chat_id = $requestData['chat_id'];
        $this->from = $requestData['from'];
        $this->platform = $requestData['platform'];
        $ticket = $requestData['ticket'];
        $ticket['chat_id'] = $this->chat_id;
        $ticket['from'] = $this->from;
        $ticket['platform'] = $this->platform;
        $this->ticket = new Ticket($ticket);
    }
    public function handleRequest()
    {
        if ($this->botCanAnswer()){
            $jaicpInterface = new JaicpInterface($this->getTicket());
            $result = $jaicpInterface->send_message();
            return $result;
        }

        return $this->ticket;
    }

    public function getTicket() : Ticket{
        return $this->ticket;
    }

    public function botCanAnswer() : bool{
        if (isset($this->ticket)){
            return $this->ticket->botCanAnswer() && $this->from == "client";
        } else {
            return false;
        }
    }
}
