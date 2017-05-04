<?php

namespace DanPowell\Jellies\Services;

use DanPowell\Jellies\Repositories\Ui\MessageRepository;

class MessageService
{
    private $repo;

    private $subject;
    private $message;
    private $type;
    private $action_name;
    private $action_url;
    private $id;

    public function __construct(MessageRepository $repo)
    {
        $this->repo = $repo;

        $this->subject = '';
        $this->message = '';
        $this->type = 'default';
        $this->action_name = null;
        $this->action_url = null;
        $this->id = null;
    }

    public function subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    public function action_name($action_name)
    {
        $this->action_name = $action_name;
        return $this;
    }

    public function action_url($action_url)
    {
        $this->action_url = $action_url;
        return $this;
    }

    public function id($id)
    {
        $this->id = $id;
        return $this;
    }

    public function save()
    {
        return $this->repo->store(
            $this->subject,
            $this->message,
            $this->type,
            $this->action_name,
            $this->action_url,
            $this->id,
            false);
    }

    public function send()
    {
        return $this->repo->store(
            $this->subject,
            $this->message,
            $this->type,
            $this->action_name,
            $this->action_url,
            $this->id,
            true);
    }
}
