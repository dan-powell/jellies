<?php

namespace DanPowell\Jellies\Services;

use DanPowell\Jellies\Repositories\Ui\MessageRepository;

class MessageService
{
    private $repo;

    public function __construct(MessageRepository $repo)
    {
        $this->repo = $repo;
    }

    public function basic($subject, $message, $id = null)
    {
        $this->repo->store($subject, $message, 'basic', $id);
    }
}
