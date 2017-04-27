<?php

namespace DanPowell\Jellies\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use DanPowell\Jellies\Repositories\Game\EncounterRepository;

class IncursionEncounter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $incursion;
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
    public function __construct($incursion)
    {
        $this->incursion = $incursion;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(EncounterRepository $repo)
    {
        $this->repo = $repo;
        $this->repo->encounter($this->incursion);
    }
}
