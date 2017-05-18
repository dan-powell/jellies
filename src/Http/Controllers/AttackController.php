<?php

namespace DanPowell\Jellies\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\AttackRepository;
use DanPowell\Jellies\Repositories\UserRepository;

use DanPowell\Jellies\Http\Requests\Attack\AttackStoreRequest;

class AttackController extends Controller
{

    protected $repo;

    public function __construct(AttackRepository $repo, UserRepository $userRepo)
    {
        $this->repo = $repo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('jellies::attack.index.attackIndex')->with([
            'models' => $this->repo->query()->get()
        ]);
    }

    public function show($id)
    {
        return view('jellies::attack.show.attackShow')->with([
            'model' => $this->repo->query()->find($id)
        ]);
    }

    public function create()
    {
        return view('jellies::attack.create.attackCreate')->with([
            'users' => $this->userRepo->query()->available()->with('minions')->get(),
            'minions' => $this->userRepo->current()->minions()->get()
        ]);
    }

    public function store(AttackStoreRequest $request)
    {
        $user_id = $request->input('user');
        $minion_id = $request->input('minion');

        $attack = $this->repo->store($user_id, $minion_id);

        if($attack) {
            \Notification::success(__('jellies::attack.create.success'));
            return redirect(route('attack.show', $attack->id));
        } else {
            \Notification::error(__('jellies::attack.create.error'));
            return redirect(route('attack.create'));
        }

    }

}
