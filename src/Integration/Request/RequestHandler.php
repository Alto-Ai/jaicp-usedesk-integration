<?php
namespace AltoAi\JaicpUsedeskIntegration\Integration\Request;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Ticket;

interface RequestHandler {
    public function handleRequest();
    public function botCanAnswer() : bool;
    public function getTicket() : Ticket;
}
