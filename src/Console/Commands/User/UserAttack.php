<?php

namespace DanPowell\Jellies\Console\Commands\User;

use Illuminate\Console\Command;
use DanPowell\Jellies\Repositories\UserRepository;
use DanPowell\Jellies\Repositories\Game\AttackRepository;

class UserAttack extends Command
{

    protected $repo;
    protected $attackRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:attack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force a random NPC to attack another player';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repo, AttackRepository $attackRepo)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->attackRepo = $attackRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get all active incursions
        $npc = $this->repo->queryAll()->Npc()->available()->get()->random();
        $npc_minion = $npc->minions->random();

        $target = $this->repo->queryAll()->available()->get()->random();

        $this->attackRepo->store($target->id, $npc_minion->id, $npc);

    }
}
