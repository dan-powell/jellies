<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Ui\MessageRepository;

class MessageController extends Controller
{

    private $repo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MessageRepository $repo)
    {
        $this->repo = $repo;
    }


    public function index()
    {
        return view('jellies::message.index.messageIndex')->with([
            'models' => $this->repo->query()->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::message.show.messageShow')->with([
            'model' => $this->repo->query()->find($id)
        ]);
    }

}
