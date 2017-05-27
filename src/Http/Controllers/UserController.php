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

    public function index()
    {
        return view('jellies::user.index.userIndex')->with([
            'models' => $this->repo->query()->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::user.show.userShow')->with([
            'model' => $this->repo->query()->find($id)
        ]);
    }

    public function showmaterials()
    {
        return view('jellies::user.show.userShowMaterials')->with([
            'model' => $this->repo->current()
        ]);
    }

}
