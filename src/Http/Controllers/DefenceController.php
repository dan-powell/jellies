<?php

namespace DanPowell\Jellies\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\DefenceRepository;

class DefenceController extends Controller
{

    protected $repo;

    public function __construct(DefenceRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('jellies::defence.index.defenceIndex')->with([
            'models' => $this->repo->query()->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::defence.show.defenceShow')->with([
            'model' => $this->repo->query()->find($id)
        ]);
    }

}
