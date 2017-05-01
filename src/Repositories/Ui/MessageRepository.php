<?php

namespace DanPowell\Jellies\Repositories\Ui;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Ui\Message;

class MessageRepository extends AbstractModelRepository
{

    public function __construct()
    {
        $this->model = new Message();
    }

    // Get all if owned by user
    public function query()
    {
        return auth()->user()->messages();
    }


    public function store($subject, $message, $type = 'default', $id = null)
    {

        if(auth()->check() && !$id) {
            $id = auth()->user()->id;
        }

        $this->message = new Message();

        $this->message->user_id = $id;
        $this->message->subject = $subject;
        $this->message->message = $message;
        $this->message->type = $type;

        $this->message->save();

    }

}
