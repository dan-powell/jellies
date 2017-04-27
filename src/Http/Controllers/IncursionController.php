<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\IncursionRepository;
use DanPowell\Jellies\Repositories\Game\MinionRepository;

use DanPowell\Jellies\Http\Requests\Incursion\IncursionStoreRequest;
use DanPowell\Jellies\Http\Requests\Incursion\IncursionDestroyRequest;

class IncursionController extends Controller
{

    protected $repo;
    protected $minionRepo;

    public function __construct(IncursionRepository $repo, MinionRepository $minionRepo)
    {
        $this->repo = $repo;
        $this->minionRepo = $minionRepo;
    }

    public function index()
    {
        $incursions = $this->repo->query()->with('encounters')->get();

        $active = $incursions->filter(function($incursion){return $incursion->active;});
        $inactive = $incursions->reject(function($incursion){return $incursion->active;});

        return view('jellies::incursion.index.incursionIndex')->with([
            'incursions' => $incursions,
            'incursions_active' => $active,
            'incursions_inactive' => $inactive
        ]);
    }

    public function show($id)
    {
        return view('jellies::incursion.show.incursionShow')->with([
            'model' => $this->repo->query()->find($id)
        ]);
    }

    public function create()
    {
        return view('jellies::incursion.create.incursionCreate')->with([
            'minions' => $this->minionRepo->query()->available()->get()
        ]);
    }

    public function store(IncursionStoreRequest $request)
    {

        // TODO add better (more secure) validation

        $minions = $request->input('minions');

        $incursion = $this->repo->store($minions);

        if($incursion)  {
            \Notification::success(trans('incursion.create.success'));
            return redirect(route('incursion.show', $incursion->id));
        } else {
            \Notification::error(trans('incursion.create.error'));
            return redirect(route('incursion.create'));
        }

    }

    public function destroy($id, IncursionDestroyRequest $request)
    {

        // TODO add better (more secure) validation

        $destroy = $this->repo->destroy($id);

        if($destroy)  {
            \Notification::success(trans('incursion.destroy.success'));
            return redirect(route('incursion.index'));
        } else {
            \Notification::error(trans('incursion.destroy.error'));
            return redirect(route('incursion.show', $id));
        }
    }


}
