<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\IncursionRepository;
use DanPowell\Jellies\Repositories\Game\EncounterRepository;


class EncounterController extends Controller
{

    protected $repo;
    protected $incursionRepo;

    public function __construct(EncounterRepository $repo,IncursionRepository $incursionRepo)
    {
        $this->repo = $repo;
        $this->incursionRepo = $incursionRepo;
    }

    public function show($id)
    {
        return view('jellies::encounter.show.encounterShow')->with([
            'model' => $this->repo->query()->find($id)
        ]);
    }

}
