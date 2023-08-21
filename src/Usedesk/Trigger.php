<?php

namespace AltoAi\JaicpUsedeskIntegration\Usedesk;

class Trigger {
    public $id;
    public $trigger_id;
    public $user_id;
    public $ticket_id;
    public $data = array();
    public $old_status;
    public $new_status;
    public $client;
    public $assignee_id;
    public $ticket;

    public function __construct($requestData)
    {
        foreach ($requestData as $key => $value){
            $this->$key = $value;
        }
    }

    public function getTicket() : Ticket{
        if (isset($this->ticket)){
            return $this->ticket;
        } else {
            $this->ticket = new Ticket(['id' => $this->ticket_id]);
            return $this->ticket;
        }
    }
}