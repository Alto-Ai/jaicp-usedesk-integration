<?php

return [
    'env' => "test",
    'channels' => require_once('channels.php'),
    'answers' => [
        'file' => 'fileEvent',
    ],
    'chat_api_url' => "https://zb04.just-ai.com/chatadapter/chatapi/wGsSbQKF:aa9c6856df9f986acd4b3894941e47defddbb2ed",
    'usedesk_api_key' => "6e48eea704c96ea04625f0871920f217d1a423ac",
    'default_operator_id' => 246541,
    'operator_group_id' => 14516,
    'closed_dialog_status' => "2",
    'operator_state' => "/Chat_with_operator",
    'debug_phones' => ["79959123667", "79146627877"],
    'debug_logins' => [],
];