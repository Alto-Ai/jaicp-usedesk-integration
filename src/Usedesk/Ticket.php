<?php

namespace AltoAi\JaicpUsedeskIntegration\Usedesk;

class Ticket {
    public $id;
    public $status_id;
    public $subject;
    public $client_id;
    public $assignee_id;
    public $group;
    public $message;
    public $files = array();
    private $platform;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value){
            $this->$key = $value;
        }
    }

    public function hasFiles(){
        return count($this->files) > 0;
    }

    public function botCanAnswer(){
        return $this->assignee_id == $_ENV['default_operator_id'] || (!$this->assignee_id && strval($this->group) != strval($_ENV['operator_group_id']));
    }

    public function query(){
        if (self::hasFiles()){
            return $_ENV['answers']['file'];
        } else {
            return $this->message;
        }
    }

    public function getPlatform() : string {
        return $_ENV['channels'][$this->platform] ?? "";
    }
}
