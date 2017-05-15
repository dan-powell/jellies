<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\RealmRepository;

class RealmController extends Controller
{

    protected $repo;

    public function __construct(RealmRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('jellies::realm.index.realmIndex')->with([
            'models' => $this->repo->query()->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::realm.show.realmShow')->with([
            'model' => $this->repo->query()->with('types')->find($id)
        ]);
    }

}
