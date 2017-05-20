<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\ZoneRepository;

class ZoneController extends Controller
{

    protected $repo;

    public function __construct(ZoneRepository $repo)
    {
        $this->repo = $repo;
    }

    public function show($id)
    {
        return view('jellies::zone.show.zoneShow')->with([
            'model' => $this->repo->query()->with('enemies')->find($id)
        ]);
    }

}
