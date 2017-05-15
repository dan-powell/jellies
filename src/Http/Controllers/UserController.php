<?php

namespace DanPowell\Jellies\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\UserRepository;


class UserController extends Controller
{

    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function show($id)
    {

    }

    public function showtypes()
    {
        return view('jellies::user.show.userShowTypes')->with([
            'model' => $this->repo->current()
        ]);
    }

}
