<?php

namespace DanPowell\Jellies\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\Game\MiniontypeRepository;
use DanPowell\Jellies\Http\Requests\Minion\MinionStoreRequest;
use DanPowell\Jellies\Http\Requests\Minion\MinionUpdateRequest;
use DanPowell\Jellies\Http\Requests\Minion\MinionHealRequest;

class MinionController extends Controller
{

    protected $repo;
    protected $miniontypeRepo;

    public function __construct(MinionRepository $repo, MiniontypeRepository $miniontypeRepo)
    {
        $this->repo = $repo;
        $this->miniontypeRepo = $miniontypeRepo;
    }

    public function index()
    {
        return view('jellies::minion.index.minionIndex')->with([
            'models' => $this->repo->query()->with(['incursions'])->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::minion.show.minionShow')->with([
            'model' => $this->repo->query()->withTrashed()->with(['incursions', 'miniontype'])->find($id)
        ]);
    }

    public function create()
    {
        return view('jellies::minion.create.minionCreate')->with([
            'models' => $this->miniontypeRepo->query()->get()
        ]);
    }

    public function store(MinionStoreRequest $request)
    {

        $id = $request->get('id');

        $minion = $this->repo->store($id);

        if($minion) {
            \Notification::success(__('jellies::minion.create.success'));
        } else {
            \Notification::error(__('jellies::minion.create.error'));
        }

        return redirect(route('minion.show', $minion->id));
    }

    public function indexDeleted()
    {
        return view('jellies::minion.index.minionIndexDeleted')->with([
            'models' => $this->repo->query()->onlyTrashed()->with(['incursions'])->get()
        ]);
    }

    public function edit($id)
    {
        return view('jellies::minion.edit.minionEdit')->with([
            'model' => $this->repo->query()->findOrFail($id)
        ]);
    }

    public function update($id, MinionUpdateRequest $request)
    {

        $input = $request->all();

        $success = $this->repo->update($id, $input);

        if($success) {
            \Notification::success(__('jellies::minion.update.success'));
        } else {
            \Notification::error(__('jellies::minion.update.error'));
        }

        return redirect(route('minion.show', $id));
    }

    public function heal($id, MinionHealRequest $request)
    {

        $success = $this->repo->heal($id);

        if($success) {
            \Notification::success(__('jellies::minion.heal.success'));
        } else {
            \Notification::error(__('jellies::minion.heal.error'));
        }

        return redirect(route('minion.show', $id));
    }


}
