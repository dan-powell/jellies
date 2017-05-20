<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\EnemyRepository;

class EnemyController extends Controller
{

    protected $repo;

    public function __construct(EnemyRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('jellies::enemy.index.enemyIndex')->with([
            'models' => $this->repo->query()->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::enemy.show.enemyShow')->with([
            'model' => $this->repo->query()->find($id)
        ]);
    }

}
