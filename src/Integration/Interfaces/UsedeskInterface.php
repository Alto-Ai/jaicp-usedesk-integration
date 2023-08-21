<?php

namespace AltoAi\JaicpUsedeskIntegration\Integration\Interfaces;

use AltoAi\JaicpUsedeskIntegration\Integration\ApiRequests\UsedeskApiRequest;
use AltoAi\JaicpUsedeskIntegration\Usedesk\Ticket;

class UsedeskInterface {
    private $ticket;
    private $channel;
    private $operator_id;
    private $chat_id;

    public function __construct(Ticket $ticket, $channel, $chat_id)
    {
        $this->ticket = $ticket;
        $this->channel = $channel;
        $this->chat_id = $chat_id;

        if ($ticket->assignee_id){
            $this->operator_id = $ticket->assignee_id;
        } else {
            $this->operator_id = $_ENV['default_operator_id'];
        }
    }

    public function switch_operator($operator_id){
        if ($this->operator_id != $operator_id){
            $this->operator_id = $operator_id;
            $request = new UsedeskApiRequest('https://api.usedesk.ru/chat/changeAssignee',
            [
                'chat_id' => $this->chat_id,
                'user_id' => $operator_id,
            ]
            );
            $result = $request->make();
        }
    }

    public function switch_to_operator_group($operator_group){
        $change_assignee_request = new UsedeskApiRequest("https://api.usedesk.ru/update/ticket",
            [
                'ticket_id' => $this->ticket->id,
                'group_id' => $operator_group,
                'user_id' => $_ENV['default_operator_id']
            ]);
        $result = $change_assignee_request->make();

        return $result;
    }


}
