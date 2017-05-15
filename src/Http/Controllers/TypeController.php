<?php

namespace DanPowell\Jellies\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\TypeRepository;

class TypeController extends Controller
{

    protected $repo;

    public function __construct(TypeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('jellies::type.index.typeIndex')->with([
            'models' => $this->repo->query()->with(['effective', 'ineffective', 'modifiers'])->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::type.show.typeShow')->with([
            'model' => $this->repo->query()->with(['effective', 'ineffective', 'modifiers'])->find($id)
        ]);
    }

}
