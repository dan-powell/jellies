<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\IncursionRepository;
use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\Game\RealmRepository;

use DanPowell\Jellies\Http\Requests\Incursion\IncursionStoreRequest;
use DanPowell\Jellies\Http\Requests\Incursion\IncursionProceedRequest;
use DanPowell\Jellies\Http\Requests\Incursion\IncursionDestroyRequest;

class IncursionController extends Controller
{

    protected $repo;
    protected $minionRepo;
    protected $realmRepo;

    public function __construct(IncursionRepository $repo, MinionRepository $minionRepo, RealmRepository $realmRepo)
    {
        $this->repo = $repo;
        $this->minionRepo = $minionRepo;
        $this->realmRepo = $realmRepo;
    }

    public function index()
    {
        $incursions = $this->repo->query()->with('encounters')->get();

        $active = $incursions->filter(function($incursion){return $incursion->active;});
        $waiting = $incursions->filter(function($incursion){return $incursion->waiting;});
        $inactive = $incursions->reject(function($incursion){
            if ($incursion->active || $incursion->waiting) {
                return true;
            } else {
                return false;
            }
        });

        return view('jellies::incursion.index.incursionIndex')->with([
            'incursions' => $incursions,
            'incursions_active' => $active,
            'incursions_waiting' => $waiting,
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
            'minions' => $this->minionRepo->query()->available()->get(),
            'realms' => $this->realmRepo->query()->get()
        ]);
    }

    public function store(IncursionStoreRequest $request)
    {

        // TODO add better (more secure) validation

        $minions = $request->input('minions');
        $realm = $request->input('realm');

        $incursion = $this->repo->store($minions, $realm);

        if($incursion)  {
            \Notification::success(trans('jellies::incursion.create.success'));
            return redirect(route('incursion.show', $incursion->id));
        } else {
            \Notification::error(trans('jellies::incursion.create.error'));
            return redirect(route('incursion.create'));
        }

    }

    public function proceed($id, IncursionProceedRequest $request)
    {

        $incursion = $this->repo->proceed($id);

        if($incursion)  {
            \Notification::success(trans('jellies::incursion.proceed.success'));
        } else {
            \Notification::error(trans('jellies::incursion.proceed.error'));
        }

        return redirect(route('incursion.show', $id));

    }

    public function destroy($id, IncursionDestroyRequest $request)
    {

        // TODO add better (more secure) validation

        $destroy = $this->repo->destroy($id);

        if($destroy)  {
            \Notification::success(trans('jellies::incursion.destroy.success'));
            return redirect(route('incursion.index'));
        } else {
            \Notification::error(trans('jellies::incursion.destroy.error'));
            return redirect(route('incursion.show', $id));
        }
    }


}
