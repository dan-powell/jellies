<?php

namespace DanPowell\Jellies\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\MaterialRepository;

class MaterialController extends Controller
{

    protected $repo;

    public function __construct(MaterialRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('jellies::material.index.materialIndex')->with([
            'models' => $this->repo->query()->with(['effective', 'ineffective', 'modifiers'])->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::material.show.materialShow')->with([
            'model' => $this->repo->query()->with(['effective', 'ineffective', 'modifiers'])->find($id)
        ]);
    }

}
