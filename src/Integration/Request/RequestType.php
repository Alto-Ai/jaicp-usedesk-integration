<?php
namespace AltoAi\JaicpUsedeskIntegration\Integration\Request;

class RequestType {
    const MESSAGE_TYPE = "message";
    const TRIGGER_TYPE = "trigger";
    const UNKNOWN_TYPE = "unknown";

    public static function requestType(array $data){
        if (isset($data['chat_id'])){
            return self::MESSAGE_TYPE;
        } else if (isset($data['trigger'])){
            return self::TRIGGER_TYPE;
        } else {
            return self::UNKNOWN_TYPE;
        }
    }
}
