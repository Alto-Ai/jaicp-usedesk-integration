<?php

namespace AltoAi\JaicpUsedeskIntegration\Usedesk;

class Ticket {
    protected $id;
    protected $status_id;
    protected $subject;
    protected $client_id;
    protected $assignee_id;
    protected $group;
    protected $message;
    protected $files = array();
    protected $platform;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value){
            $this->$key = $value;
        }
    }

    public function hasFiles(){
        return count($this->getFiles()) > 0;
    }

    public function botCanAnswer(){
        return $this->getAssigneeId() == $_ENV['default_operator_id'] || (!$this->getAssigneeId() && strval($this->getGroup()) != strval($_ENV['operator_group_id']));
    }

    public function query(){
        if (self::hasFiles()){
            return $_ENV['answers']['file'];
        } else {
            return $this->getMessage();
        }
    }

    public function getId(){
        return $this->id;
    }

    public function getStatusId(){
        return $this->status_id;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function getClientId(){
        return $this->client_id;
    }

    public function getAssigneeId(){
        return $this->assignee_id;
    }

    public function getGroup(){
        return $this->group;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getFiles(){
        return $this->files;
    }

    public function getPlatform() : string {
        return $_ENV['channels'][$this->platform] ?? "";
    }
}
