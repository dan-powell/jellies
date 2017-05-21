<?php

namespace DanPowell\Jellies\Console\Commands\User;

use Illuminate\Console\Command;
use DanPowell\Jellies\Repositories\UserRepository;

use DanPowell\Jellies\Jobs\AddAction;

class UserAddAction extends Command
{

    protected $repo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:actions {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes an encounter for all incursions. Optionally use --queue.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repo)
    {
        parent::__construct();
        $this->repo = $repo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get all active incursions
        $users = $this->repo->queryAll()->get();

        foreach($users as $user) {
            if ($this->option('queue')) {
                // Send the job to the queue
                dispatch(new AddAction($user));
            } else {
                $this->repo->addAction($user);
            }

        }

    }
}
