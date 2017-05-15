<?php

namespace DanPowell\Jellies\Http\Controllers;

use App\Http\Controllers\Controller;

use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\Ui\MessageRepository;
use DanPowell\Jellies\Repositories\UserRepository;

class DashboardController extends Controller
{

    private $minionRepo;
    private $messageRepo;
    private $userRepo;

    public function __construct(
        MinionRepository $minionRepo,
        MessageRepository $messageRepo,
        UserRepository $userRepo
        )
    {
        $this->minionRepo = $minionRepo;
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
            'minions' => $this->minionRepo->query()->get(),
            'messages' => $this->messageRepo->query()->get(),
            'leaderboard' => $this->userRepo->query()->limit(10)->get(),
        ]);
    }

}
