<?php

namespace DanPowell\Jellies\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use DanPowell\Jellies\Repositories\UserRepository;

class AddAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $repo;

    /**
    * The number of times the job may be attempted.
    *
    * @var int
    */
   public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->repo->addAction($this->user);
    }
}
