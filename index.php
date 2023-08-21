<?php
require 'vendor/autoload.php';
use AltoAi\JaicpUsedeskIntegration\Integration\IntegrationService;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\Handlers\MessageHandler;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\Handlers\TriggerHandler;
use AltoAi\JaicpUsedeskIntegration\Integration\Request\RequestType;

$debugMessage = [
    'chat_id' => 25413,
    'text' => 'foo',
    'client_id' => 12345,
    'client' => [
        'id' => 12345,
        'name' => 'Иван',
    ],
    'from' => 'client',
    'platform' => 'usedesk_tg',
    'secret' => '1234567890',
    'ticket' => [
        'id' => 98765,
        'status_id' => 1,
        'subject' => 'Chat',
        'client_id' => 12345,
        'assignee_id' => '', // ID бота 246541
        'group' => 56795, // ID операторской группы 14516 ID группы с ботом 56795
        'channel_id' => 31258,
        'message' => 'foo',
        'files' => [

        ],
    ],
];

$debugMessageWithFile = [
    'chat_id' => 25413,
    'text' => 'foo',
    'client_id' => 12345,
    'client' => [
        'id' => 12345,
        'name' => 'Иван',
    ],
    'from' => 'client',
    'platform' => 'usedesk_tg',
    'secret' => '1234567890',
    'ticket' => [
        'id' => 98765,
        'status_id' => 1,
        'subject' => 'Chat',
        'client_id' => 12345,
        'assignee_id' => '', // ID бота 246541
        'group' => 56795, // ID операторской группы 14516 ID группы с ботом 56795
        'channel_id' => 31258,
        'message' => 'foo',
        'files' => [
            'someFile'
        ],
    ],
];

$debugTrigger = [
    'secret' => '123456',
    'trigger' => [
        'id' => 12345,
        'trigger_id' => '',
        'user_id' => '',
        'ticket_id' => 98765,
        'data' => [
            [
                'target' => 'message_from_client',
                'value' => 4534,
            ],
        ],
        'old_status' => 0,
        'new_status' => 1,
    ],
    'client' => [
        'id' => 12345,
        'name' => 'Иван',
    ],
    'assignee_id' => '',
];
$_ENV = require_once("config/app.php");

$requestBody = $debugMessageWithFile;

$requestType = RequestType::requestType($requestBody);

if ($requestType == RequestType::MESSAGE_TYPE){
    $requestHandler = new MessageHandler($requestBody);
} else if ($requestType == RequestType::TRIGGER_TYPE){
    $requestHandler = new TriggerHandler($requestBody);
}

$integrationService = new IntegrationService($requestHandler, $requestType);
$ticket = $integrationService->processRequest();
return 404;
