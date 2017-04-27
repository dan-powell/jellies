<?php

namespace DanPowell\Jellies\Repositories\Ui;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Ui\Message;

class MessageRepository extends AbstractModelRepository
{

    // Get all if owned by user
    public function query()
    {
        return auth()->user()->messages();
    }

}
