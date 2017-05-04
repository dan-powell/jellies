<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\IncursionRepository;
use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\Game\EnemyRepository;
use DanPowell\Jellies\Repositories\Ui\MessageRepository;
use DanPowell\Jellies\Repositories\UserRepository;

class DashboardController extends Controller
{

    private $incursionRepo;
    private $minionRepo;
    private $enemyRepo;
    private $messageRepo;
    private $userRepo;

    public function __construct(
        IncursionRepository $incursionRepo,
        MinionRepository $minionRepo,
        EnemyRepository $enemyRepo,
        MessageRepository $messageRepo,
        UserRepository $userRepo
        )
    {
        $this->incursionRepo = $incursionRepo;
        $this->minionRepo = $minionRepo;
        $this->enemyRepo = $enemyRepo;
        $this->messageRepo = $messageRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jellies::dashboard.show.dashboardShow')->with([
            'incursions' => $this->incursionRepo->query()->get(),
            'incursions_waiting' => $this->incursionRepo->query()->waiting()->get(),
            'minions' => $this->minionRepo->query()->get(),
            'enemies' => $this->enemyRepo->query()->get(),
            'messages' => $this->messageRepo->query()->get(),
            'leaderboard' => $this->userRepo->query()->orderByDesc('points')->limit(10)->get(),
        ]);
    }

}
