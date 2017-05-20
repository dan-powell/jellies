<?php

namespace DanPowell\Jellies\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\UserRepository;

use DanPowell\Jellies\Http\Requests\Minion\MinionStoreRequest;
use DanPowell\Jellies\Http\Requests\Minion\MinionUpdateRequest;

class MinionController extends Controller
{

    protected $repo;

    public function __construct(MinionRepository $repo, UserRepository $userRepo)
    {
        $this->repo = $repo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('jellies::minion.index.minionIndex')->with([
            'models' => $this->repo->query()->with(['types'])->get()
        ]);
    }

    public function indexDeleted()
    {
        return view('jellies::minion.index.minionIndexDeleted')->with([
            'models' => $this->repo->query()->onlyTrashed()->with(['types'])->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::minion.show.minionShow')->with([
            'model' => $this->repo->query()->withTrashed()->with(['types'])->find($id)
        ]);
    }

    public function create()
    {
        return view('jellies::minion.create.minionCreate')->with([
            'types' => $this->userRepo->getTypes()
        ]);
    }

    public function store(MinionStoreRequest $request)
    {

        if(!$request->get('type')) {
            $types = [];
        } else {
            $types = $request->get('type');
        }

        $minion = $this->repo->store($types);

        if($minion) {
            \Notification::success(__('jellies::minion.create.success'));
            return redirect(route('minion.show', $minion->id));
        } else {
            \Notification::error(__('jellies::minion.create.error'));
            return redirect(route('minion.create'));
        }


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

}
