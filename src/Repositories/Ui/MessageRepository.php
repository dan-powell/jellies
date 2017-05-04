<?php

namespace DanPowell\Jellies\Repositories\Ui;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Ui\Message;
use DanPowell\Jellies\Mail\MessageMail;

use DanPowell\Jellies\Repositories\UserRepository;

class MessageRepository extends AbstractModelRepository
{

    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->model = new Message();
        $this->userRepo = $userRepo;
    }

    // Get all if owned by user
    public function query()
    {
        return auth()->user()->messages();
    }

    public function show($id)
    {
        $message = $this->query()->find($id);
        $message->read = true;
        $message->save();
        return $message;
    }

    public function store($subject, $message, $type = 'default', $action_name = null, $action_url = null, $id = null, $email = false)
    {

        if(auth()->check() && !$id) {
            $id = auth()->user()->id;
            $user = auth()->user();
        }

        $this->model->user_id = $id;
        $this->model->subject = $subject;
        $this->model->message = $message;
        $this->model->type = $type;
        $this->model->action_name = $action_name;
        $this->model->action_url = $action_url;

        $this->model->save();

        if($email) {

            if(!isset($user)) {
                $user = $this->userRepo->query()->find($id);
            }

            \Mail::to($user)->queue(new MessageMail($this->model));
        }


    }



}
